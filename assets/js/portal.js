/*
 * Win B. A. R. Academy portal: front-end helpers (no backend changes).
 *
 *   1. Message banners   Shows the message a page saved in sessionStorage ("winbarFlash" = "type|text")
 *                        as a banner under the page title. Types: success, error, info.
 *                        Also available as Winbar.flash(type, text).
 *   2. Confirm dialog    Any link or button with data-confirm opens a styled dialog first.
 *                        Attributes: data-confirm (message), data-confirm-title, data-confirm-action
 *                        (button label), data-confirm-tone="danger" (red button).
 *                        The element's old onclick="return confirm(...)" stays as a no-JS fallback.
 *   3. Require one       <form data-require-one="subject[]" data-require-message="..."> blocks
 *                        submitting with nothing ticked and shows the message as a banner.
 *   4. Unit counter      <form data-unit-counter> with a [data-unit-output] element: counts ticked
 *                        subjects and adds up the units in each row's td.num cell.
 *   5. Password helpers  Every password field gets a Show/Hide button and a Caps Lock warning.
 *   6. Dark mode switch  [data-theme-toggle] buttons switch light/dark and remember the choice.
 */
(function () {
  'use strict';

  var ICONS = { success: '✓', error: '!', info: 'i' };

  /* 1. Message banners ---------------------------------------------------- */
  function bannerSpot() {
    var head = document.querySelector('.page-head');
    if (head) return { parent: head.parentNode, before: head.nextSibling };
    var hero = document.querySelector('.hero');
    if (hero) {
      var holder = document.createElement('div');
      holder.className = 'wrap flash-holder';
      hero.parentNode.insertBefore(holder, hero.nextSibling);
      return { parent: holder, before: null };
    }
    var loginTop = document.querySelector('.login__form > div');
    if (loginTop) return { parent: loginTop.parentNode, before: loginTop.nextSibling };
    var toolbar = document.querySelector('.doc__toolbar');
    if (toolbar) return { parent: toolbar.parentNode, before: toolbar.nextSibling };
    var main = document.querySelector('main') || document.body;
    return { parent: main, before: main.firstChild };
  }

  function flash(type, text) {
    if (!text) return null;
    type = ICONS[type] ? type : 'info';
    var old = document.querySelector('.flash[data-live]');
    if (old) old.remove();

    var box = document.createElement('div');
    box.className = 'flash flash--' + type;
    box.setAttribute('data-live', '');
    box.setAttribute('role', type === 'error' ? 'alert' : 'status');

    var icon = document.createElement('span');
    icon.className = 'flash__icon';
    icon.setAttribute('aria-hidden', 'true');
    icon.textContent = ICONS[type];

    var msg = document.createElement('p');
    msg.className = 'flash__text';
    msg.textContent = text;

    var close = document.createElement('button');
    close.type = 'button';
    close.className = 'flash__close';
    close.setAttribute('aria-label', 'Dismiss message');
    close.textContent = '×';
    close.addEventListener('click', function () { box.remove(); });

    box.appendChild(icon);
    box.appendChild(msg);
    box.appendChild(close);

    var spot = bannerSpot();
    spot.parent.insertBefore(box, spot.before);
    return box;
  }

  function showMessage(saved) {
    var cut = saved.indexOf('|');
    flash(cut > 0 ? saved.slice(0, cut) : 'info', cut > 0 ? saved.slice(cut + 1) : saved);
  }

  /* The PHP sets one of two things before the page loads:
     - window.winbarFlashNow: a message for THIS page (no redirect follows), shown right away
     - sessionStorage "winbarFlash" plus window.winbarLeaving: a message for the page the
       redirect goes to; this page leaves it alone so the next page can show it */
  function showSavedMessage() {
    if (window.winbarFlashNow) { showMessage(String(window.winbarFlashNow)); return; }
    if (window.winbarLeaving) return;
    var saved = null;
    try {
      saved = sessionStorage.getItem('winbarFlash');
      sessionStorage.removeItem('winbarFlash');
    } catch (e) { return; }
    if (saved) showMessage(saved);
  }

  /* 2. Confirm dialog ----------------------------------------------------- */
  var dialog = null;
  var pending = null;

  function buildDialog() {
    dialog = document.createElement('dialog');
    dialog.className = 'confirm-dialog';
    dialog.setAttribute('aria-labelledby', 'confirm-title');
    dialog.innerHTML =
      '<div class="confirm-dialog__bar" aria-hidden="true"></div>' +
      '<div class="confirm-dialog__body">' +
        '<h2 id="confirm-title" class="confirm-dialog__title"></h2>' +
        '<p class="confirm-dialog__text"></p>' +
      '</div>' +
      '<div class="confirm-dialog__actions">' +
        '<button type="button" class="btn btn--ghost" data-choice="cancel">Cancel</button>' +
        '<button type="button" class="btn btn--primary" data-choice="ok"></button>' +
      '</div>';
    document.body.appendChild(dialog);

    dialog.addEventListener('click', function (e) {
      var choice = e.target.getAttribute && e.target.getAttribute('data-choice');
      if (e.target === dialog) choice = 'cancel';           /* click on the backdrop */
      if (!choice) return;
      dialog.close();
      if (choice === 'ok' && pending) proceed(pending);
      pending = null;
    });
  }

  function proceed(el) {
    if (el.tagName === 'A') { window.location.href = el.href; return; }
    var form = el.form;
    if (!form) return;
    el.setAttribute('data-confirmed', '');
    if (form.requestSubmit) { form.requestSubmit(el); }
    else {
      var hidden = document.createElement('input');
      hidden.type = 'hidden'; hidden.name = el.name; hidden.value = el.value;
      form.appendChild(hidden); form.submit();
    }
  }

  function askToConfirm(el) {
    if (typeof HTMLDialogElement === 'undefined') return window.confirm(el.getAttribute('data-confirm'));
    if (!dialog) buildDialog();
    dialog.querySelector('.confirm-dialog__title').textContent = el.getAttribute('data-confirm-title') || 'Are you sure?';
    dialog.querySelector('.confirm-dialog__text').textContent = el.getAttribute('data-confirm') || '';
    var ok = dialog.querySelector('[data-choice="ok"]');
    ok.textContent = el.getAttribute('data-confirm-action') || 'Confirm';
    ok.className = 'btn ' + (el.getAttribute('data-confirm-tone') === 'danger' ? 'btn--danger' : 'btn--primary');
    pending = el;
    dialog.showModal();
    dialog.querySelector('[data-choice="cancel"]').focus();
    return null;
  }

  /* Capture phase: runs before the element's own onclick fallback, which is then skipped */
  document.addEventListener('click', function (e) {
    var el = e.target.closest ? e.target.closest('[data-confirm]') : null;
    if (!el || el.hasAttribute('data-confirmed')) return;
    e.preventDefault();
    e.stopPropagation();
    var answer = askToConfirm(el);
    if (answer === true) proceed(el);
  }, true);

  /* 3. Require at least one ticked box ----------------------------------- */
  document.addEventListener('submit', function (e) {
    var form = e.target;
    var name = form.getAttribute && form.getAttribute('data-require-one');
    if (!name) return;
    var boxes = form.querySelectorAll('input[name="' + name + '"]');
    for (var i = 0; i < boxes.length; i++) { if (boxes[i].checked) return; }
    e.preventDefault();
    e.stopPropagation();
    var box = flash('error', form.getAttribute('data-require-message') || 'Pick at least one option.');
    if (box) box.scrollIntoView({ behavior: 'smooth', block: 'center' });
  }, true);

  /* 4. Unit counter -------------------------------------------------------- */
  function setupUnitCounter(form) {
    var out = form.querySelector('[data-unit-output]');
    if (!out) return;
    function update() {
      var boxes = form.querySelectorAll('input[type=checkbox]');
      var count = 0, units = 0;
      for (var i = 0; i < boxes.length; i++) {
        if (!boxes[i].checked) continue;
        count++;
        var row = boxes[i].closest('tr');
        var cell = row && row.querySelector('td.num');
        units += cell ? (parseFloat(cell.textContent) || 0) : 0;
      }
      out.textContent = count === 0
        ? 'No subjects selected yet'
        : count + (count === 1 ? ' subject' : ' subjects') + ' selected, ' + units + (units === 1 ? ' unit' : ' units');
      out.classList.toggle('is-empty', count === 0);
    }
    form.addEventListener('change', update);
    form.addEventListener('reset', function () { setTimeout(update, 0); });
    update();
  }

  /* 5. Password helpers --------------------------------------------------- */
  function setupPassword(input) {
    var wrap = document.createElement('span');
    wrap.className = 'pw-field';
    input.parentNode.insertBefore(wrap, input);
    wrap.appendChild(input);

    var toggle = document.createElement('button');
    toggle.type = 'button';
    toggle.className = 'pw-toggle';
    toggle.textContent = 'Show';
    toggle.setAttribute('aria-pressed', 'false');
    toggle.setAttribute('aria-label', 'Show password');
    toggle.addEventListener('click', function () {
      var showing = input.type === 'text';
      input.type = showing ? 'password' : 'text';
      toggle.textContent = showing ? 'Show' : 'Hide';
      toggle.setAttribute('aria-pressed', showing ? 'false' : 'true');
      toggle.setAttribute('aria-label', showing ? 'Show password' : 'Hide password');
      input.focus();
    });
    wrap.appendChild(toggle);

    var caps = document.createElement('p');
    caps.className = 'caps-warning';
    caps.setAttribute('role', 'status');
    caps.hidden = true;
    caps.textContent = 'Caps Lock is on';
    wrap.parentNode.insertBefore(caps, wrap.nextSibling);

    function check(e) {
      if (e.getModifierState) caps.hidden = !e.getModifierState('CapsLock');
    }
    input.addEventListener('keydown', check);
    input.addEventListener('keyup', check);
    input.addEventListener('blur', function () { caps.hidden = true; });
  }

  /* 6. Dark mode switch ----------------------------------------------------
     Default follows the device setting. Pressing a [data-theme-toggle] button
     sets html[data-theme] and remembers it in localStorage ("winbarTheme").
     A tiny script in each page's <head> applies the saved choice before paint. */
  var ICON_MOON = '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M20 14.5A8 8 0 0 1 9.5 4a8 8 0 1 0 10.5 10.5z" fill="currentColor"/></svg>';
  var ICON_SUN = '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><circle cx="12" cy="12" r="4.5" fill="currentColor"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3M4.9 4.9l2.1 2.1M17 17l2.1 2.1M4.9 19.1L7 17M17 7l2.1-2.1" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>';
  var darkQuery = window.matchMedia ? window.matchMedia('(prefers-color-scheme: dark)') : null;

  function currentTheme() {
    var set = document.documentElement.getAttribute('data-theme');
    if (set === 'dark' || set === 'light') return set;
    return darkQuery && darkQuery.matches ? 'dark' : 'light';
  }

  function paintToggles() {
    var dark = currentTheme() === 'dark';
    var buttons = document.querySelectorAll('[data-theme-toggle]');
    for (var i = 0; i < buttons.length; i++) {
      /* The visible text names the mode the button switches TO, so it is also the accessible name */
      buttons[i].innerHTML = (dark ? ICON_SUN : ICON_MOON) + '<span>' + (dark ? 'Light mode' : 'Dark mode') + '</span>';
    }
  }

  function setupThemeToggles() {
    document.addEventListener('click', function (e) {
      var btn = e.target.closest ? e.target.closest('[data-theme-toggle]') : null;
      if (!btn) return;
      var next = currentTheme() === 'dark' ? 'light' : 'dark';
      document.documentElement.setAttribute('data-theme', next);
      try { localStorage.setItem('winbarTheme', next); } catch (err) { /* private mode: works for this page only */ }
      paintToggles();
    });
    if (darkQuery && darkQuery.addEventListener) darkQuery.addEventListener('change', paintToggles);
    paintToggles();
  }

  /* Start ------------------------------------------------------------------ */
  function start() {
    setupThemeToggles();
    showSavedMessage();
    var forms = document.querySelectorAll('form[data-unit-counter]');
    for (var i = 0; i < forms.length; i++) setupUnitCounter(forms[i]);
    var pws = document.querySelectorAll('input[type=password]');
    for (var j = 0; j < pws.length; j++) setupPassword(pws[j]);
  }

  window.Winbar = { flash: flash };
  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', start);
  else start();
})();
