# Win B. A. R. Academy portal redesign notes

## Overview

This is a UI and UX redesign of the 2014 online enrollment portal, rebranded as **Win B. A. R. Academy**, a fictional school.

**Version 3 (current)** was chosen by the team from a board of wireframe options. The layout borrows the structure of real university sites (University of Toronto, University of Chicago); the identity comes from the WinRAR-inspired "three books" crest.

| Area | Choice |
|---|---|
| Header | **H-A:** dark utility bar (motto, role, log out), crest and school name, main nav on the right, book stripe |
| Home | **P-A:** campus photo hero with an announcement card, quick-start tiles, news cards, and a mission/vision/programs band |
| Inner pages | **I-B with parts of I-A:** full-width white title band with breadcrumb and section tabs; panels with a hard shadow; dark table headers; search and paging toolbar inside the panel |
| Login | **L-A:** split screen, with the school identity on the left and the form on the right |
| Palette | **Charcoal and cobalt:** light grounds, muted charcoal and stone, bold book colors as accents |
| Type | **Modern:** Bricolage Grotesque headings, Public Sans body |
| Background | **Mixed:** faint graph-paper grid, light scattered shapes, and corner art in title bands |
| Retro level | **Medium:** beveled buttons, hard drop shadows, book stripes, pixel-font labels |

**Backend changes are limited and approved.** Round 4 changed only the message lines inside `echo` statements and one read-only report query (see Important decisions). Round 5, at the team's request, changed the account and password code, the login checks, and the database (see Accounts and passwords). Every other PHP logic block, SQL query, `$_POST` key, `$_SESSION` key, form field `name`, and file name is the same as in the original. This was checked with a script that compares the original and new files, and with an end-to-end test that fills in every form and checks the database.

## Goals

- Look and feel like a real university website, with a retro undertone.
- Replace the old school's branding (John Paul College, De Ocampo Medical Center) with an original identity.
- Make every page work on phones (the old layout was fixed at 960 to 1050 px).
- Fix UI bugs without touching the backend.

## Palette

All colors are tokens in `assets/css/theme-charcoal.css`, imported at the top of `style.css`. Change a color there and it updates everywhere.

| Token | Value | Role |
|---|---|---|
| `--ink` | `#262B36` charcoal | text, utility bar, table headers, footer, hard shadows |
| `--text-muted` | `#6A6F7A` stone | supporting text |
| `--bg` / `--surface-alt` | `#F5F6F7` | page ground |
| `--surface` | `#FFFFFF` | panels and title bands |
| `--primary` | `#1F4FD1` cobalt | main buttons, links, active nav (student) |
| `--danger` | `#C0283F` crimson | hero and login button, delete links, admin cues, dates |
| `--success` | `#12805A` emerald | third book color |
| `--highlight` | `#EAA800` gold | focus ring, motto, totals |

**Rules:**
- Pastel tints are only for small states (hover, selected rows).
- Every text and fill pair meets WCAG AA contrast.
- **Admin pages use crimson** for the active nav underline and the active tab. **Student pages use cobalt.** This way staff always know which area they're in.

**Fonts** are bundled in `assets/fonts/` (SIL Open Font License), so the site works offline:
- **Bricolage Grotesque:** headings.
- **Public Sans:** body text.
- **Silkscreen:** only the motto and the role chip.
- **IBM Plex Mono:** codes and numbers.

## Setup and accounts

**Fresh install:**
1. Copy the `winbar_school-main` folder into `C:\xampp\htdocs\`.
2. Start Apache and MySQL in XAMPP.
3. In phpMyAdmin, go to **Import**, choose `database/online_enroll.sql`, and click **Import**. The file creates the `online_enroll` database itself.

**Already imported the old file?** Import `database/update-2026-11-09.sql` once instead. It widens the short columns, removes the old Dennis accounts and their test data, and adds the sample accounts. Any other test students you created keep working; see "Passwords" below.

| Role | Username | Password | Name |
|---|---|---|---|
| Administrator | `admin` | `Admin@2026` | Ana Reyes (fictional registrar) |
| Student | `25-1001` | `Student@2026` | Juan P. Dela Cruz (sample student, BSIT II-1) |

Change both passwords before using the site for anything real. The admin changes their own under **Manage students > Admin account**; student passwords are reset by the admin.

`database/original-2014-online_enroll.sql` is the professor's original file, kept for reference only.

## Accounts and passwords (round 5)

- **Passwords are hashed** with PHP's `password_hash()` (bcrypt) and checked with `password_verify()`. The database never stores the real password, which is why the admin account page can't show the current one.
- **Old plain-text accounts still work.** When an account created before hashing logs in with its correct password, the login replaces the stored password with a hash. This applies only to values that aren't hashes yet.
- **Students can't change their own passwords** (school rule). The student "Change password" page is now **Password help**, which explains how to ask the registrar. Admins reset a student's password with **Reset password** on the student list (`Admin/resetpass.php`). New passwords need at least 8 characters.
- **Student IDs use the entry year:** `YY-NNNN`, for example `25-1001`. Add a student fills in the next free ID for the current year (26-1001, 26-1002, and so on). The admin can edit it, and the form rejects other formats. The username defaults to the student ID.
- **Prepared statements** replace the old SQL text building in the login, add student, admin account, and reset password queries. Other pages still build SQL from user input; see the backend issues below.

## Dark mode (round 5)

- **The switch** sits in the top bar of every page after logging in. The login page has no switch (removed on request); it follows the visitor's saved choice, or the device setting if none is saved.
- **Its look matches what's around it.** In the top bar, it has the role chip's shape, size and pixel font, drawn as an outline so it reads as a button, not a label; on hover it fills gold like the other top-bar links. (Round 5 first shipped it as a rounded pill, which didn't match anything else on the site.)
- **The default follows the device:** with no choice saved, the site matches the device's light or dark setting. A choice made with the switch is remembered per browser (`localStorage` key `winbarTheme`).
- **No flash of light mode:** a small script at the top of each page's `<head>` applies the saved choice before the page is drawn.
- **Colors use role tokens,** so dark mode is only a second set of values in `assets/css/theme-charcoal.css`:

| Token | Role |
|---|---|
| `--text` | text |
| `--chrome` | dark bars: top bar, table headers, footer |
| `--outline` | outlines |
| `--shadow-color` | hard shadows |
| `--field` | inputs |

- **Accent colors have two values.** Each has a fill version (buttons, badges) and a `-strong` version for text. Use `-strong` for any accent-colored text, so it stays readable on dark backgrounds.
- **Printed documents always stay light.** The enrollment form and the student report re-declare the light values on `.doc-page`.

## Main components

| Class | What it is |
|---|---|
| `.utility`, `.site-header`, `.brand`, `.mainnav` | Header (in `includes/topbar.php`) |
| `.page` > `.page-head` | Page container and full-width title band |
| `.crumbs`, `.tabs` | Breadcrumb and section tabs inside the title band |
| `.window` + `__title` / `__body` / `__footer` | Panel with a charcoal outline and hard shadow |
| `.btn`, `.btn--primary`, `.btn--danger`, `.btn--ghost` | Beveled buttons. Plain `input[type=submit]` is styled as primary automatically |
| `.fields`, `.field`, `.form-section` | Form layout |
| `.data-table`, `table.display` | Tables (DataTables plugin tables share the look) |
| `.tiles`, `.details`, `.badge`, `.notice` | Smaller parts |
| `.hero`, `.quick-grid`, `.news-grid`, `.about-band` | Home page sections |
| `.login`, `.login__brand`, `.login__panel` | Split-screen login |
| `.doc` | Printable documents, with their own print styles |
| `.wrap` | Centered 1180 px container used by the header, footer, and home sections |

## Structure

```
style.css                    layout and components
assets/
  css/theme-charcoal.css     palette tokens
  fonts/                     bundled web fonts
  img/                       crest, favicon, background art, placeholder photos
assets/js/portal.js          message banners, confirm dialog, unit counter, password helpers, dark mode switch
database/
  online_enroll.sql          full database for a fresh install (sample accounts, hashed passwords)
  update-2026-11-09.sql      one-time update for a database imported from the original file
  original-2014-online_enroll.sql   the professor's original, for reference
Admin/resetpass.php          admin resets a student's password
tools/make-patterns.py       regenerates bg-scatter.svg and corner-art.svg
Admin/includes/  and  student/includes/
  head.php                   viewport, favicon, stylesheet
  topbar.php                 utility bar, crest, nav, book stripe
  menu1.php / menu.php       main nav items (current page highlighted automatically)
  menu2.php                  footer quick links
  footer.php                 footer columns and copyright
```

A typical inner page looks like this:

```php
<body class="role-admin">                 <!-- or role-student -->
<?php include('includes/topbar.php'); ?>
<main class="page">
  <div class="page-head">
    <div>
      <p class="crumbs"><a href="adminindex.php">Home</a> / Manage students</p>
      <h1>Students</h1>
      <p class="page-head__lead">One sentence about the page.</p>
    </div>
    <div class="page-head__actions"> ...buttons... </div>
    <nav class="tabs"> ...section tabs, current one has class="is-active"... </nav>
  </div>
  <section class="window"> ... </section>
</main>
<?php include('includes/footer.php'); ?>
```

## Placeholder images to replace

Save your real photo over the placeholder **with the same file name** and nothing else needs to change.

| File | Shown on | Recommended size |
|---|---|---|
| `assets/img/banner-campus.jpg` | Home page hero (admin and student) | 1920 × 900, subject on the right side (the card covers the left) |
| `assets/img/news-1.jpg` | Home, first news card | 800 × 500 |
| `assets/img/news-2.jpg` | Home, second news card | 800 × 500 |
| `assets/img/news-3.jpg` | Home, third news card | 800 × 500 |
| `assets/img/logo.svg` | Header, footer, login, printed forms | SVG |

**Placeholder text to fill in.** Square brackets mark unfinished text:
- `[Third news headline]`, `[Office hours and room]`, and the footer's `[Office hours]`, `[Email address]`, `[Phone number]`.
- The school address "88 Archive Road, Metro Manila" and the motto *Sapientia servata* ("knowledge kept safe") are suggestions; change them in `includes/footer.php`, `includes/topbar.php`, `index.php`, and the two printables.

## Important decisions

- **Markup was rewritten, logic was not.** In every page, the PHP block above `<!DOCTYPE>` is unchanged byte for byte. PHP inside the page body (table loops, totals) was kept the same, except for the classes and labels inside `echo` strings.
- **The fonts are bundled, not loaded from Google Fonts**, so the portal works on an offline XAMPP lab machine.
- **Design history.** v1 had a sticker and app-window look. v2 kept the original layout with muted and bold themes. v3 is a university-style layout picked from a board of wireframe options. Earlier versions are not in this folder.
- **Tabs replace "Back to" buttons.** Students and admin sections show tabs in the title band, so related pages are one click apart.
- **Utility links like "Academic calendar" were left out,** because those pages don't exist. Only real pages are linked.
- **Browser popups were replaced by banners (approved).** The PHP printed `alert()` popups before the page loads, so no script could catch them. The only change is the text inside those `echo` lines: they now save the message (`sessionStorage`, or `window.winbarFlashNow` when no redirect follows), and `assets/js/portal.js` shows it as a banner under the page title. Conditions, queries, and redirects are untouched; a comparison with the message lines removed shows the logic blocks are identical to the original.
- **Report fix A (approved).** In `Admin/includes/report.php`, the crashing `sched_tbl` lookup was replaced with a read-only lookup of each student's latest row in `student_subject`. The column is now "Enrolled subjects" and shows the subject codes and total units.
- **Delete and submit confirmations use a styled dialog.** Each link keeps its old `onclick="return confirm(...)"` as a fallback if JavaScript fails to load.
- **The old images were removed.** 33 images were no longer used by any page, most of them the real logos and photos of other schools. They are still in the original zip.

## Fixes made in the UI layer

Round 4 (front-end upgrades, all tested end to end):
- **Message banners** replace every `alert()` popup: success (green), error (crimson), and info (cobalt), with a dismiss button.
- **Styled confirm dialog** for deleting a student or subject (it names what's being deleted) and for submitting the enrollment form.
- **Live unit counter** on Enroll now ("2 subjects selected, 5 units"). Submitting with no subjects shows a banner instead of a popup.
- **Password helpers:** every password field has a Show/Hide button and a Caps Lock warning. This replaced the checkbox on the admin account page.
- **Format hints on Add a student:**
  - Student number must look like `2026-001`.
  - Contact number must be 11 digits starting with `09`.
  - Email must be a valid address. The field is now `type="email"`, so a badly formed email is rejected in the browser.
  - Fields with a wrong value turn red.
- **Logged-out and "Log in to continue" messages** on the login page.
- **Two broken message lines fixed:**
  - The login error never appeared, because an apostrophe broke its script.
  - The redirect after changing a password never ran, because of a stray `)`.
- **Print:** the document header keeps its desktop layout on paper, and rows no longer print with the hover color.

Earlier rounds:

- The student list's **Course and Year Level columns were swapped**, and a stray `;` appeared in every row.
- The profile page had a fake **"Add new user" button** and showed "BSIT" for every student no matter their course.
- The admin edit page **showed the password in plain text**. It is now masked, with a "Show password" checkbox.
- The enrollment form's fee rows didn't line up with its 10 columns. It now also has signature lines and print styles.
- The "Year graduated" lists stopped at 2010. They now go up to the current year.
- **Enroll page:** students must tick at least one subject before submitting. Before, submitting with none showed a PHP warning on the next page.
- **Change password:** the two new passwords must match before the form submits. Before, a mismatch failed silently. The new password is also limited to 11 characters, the database column's size.
- The dead **Curriculum** nav link was removed. Re-add it in `student/includes/menu.php` when that page exists.
- JavaScript errors from scripts that ran before jQuery loaded, and from missing jQuery UI files, were removed.
- Every input now has its own `id` and `<label>`. Before, almost all of them shared `id="name"`.

## Backend issues found (status)

These were already there before the redesign. They need PHP or database changes, which were outside this task.

1. **Adding subjects and submitting enrollments fail on modern MySQL/MariaDB.** Their INSERT queries put `''` into the auto-increment `ID` column, which strict SQL mode (the default today) rejects. The fix is to use `NULL` instead of `''`, or to turn off strict mode in XAMPP's `my.ini`. *Partly fixed in round 5: Add a student now uses `NULL` and works in strict mode.*
2. **Subject day and instructor are saved into each other's columns.** In `Admin/addnewsubj.php`, the INSERT lists `$sday, $sinstructor`, but the table's column order is `instructor, day`.
3. ~~**The student report crashes after the first row.**~~ **Fixed (option A):** the report now lists each student's latest enrollment from `student_subject`. `sched_tbl` holds class schedules by section and is still unused.
4. **Pages with no login check.** These pages don't include `logcheck.php`, so anyone with the URL can use them without logging in:
   - `Admin/includes/report.php` shows the student list.
   - `Admin/deletecurruser.php` and `Admin/deletecurrsubj.php` delete a student or subject, given only an ID in the address.

   Add `session_start();` and the admin login check to each of them.
9. **Fixed in round 5: students could use admin pages.** The admin login check only asked "is someone logged in?", so a logged-in student could open admin pages. `Admin/logcheck.php` now requires an admin session, and `student/logcheck.php` requires a student session. Both now stop the page after redirecting; before, the rest of the protected page still ran.
5. **SQL injection:** most queries insert user input directly into the SQL text. Use prepared statements. *Partly fixed in round 5: login, add student, admin account, and reset password now use prepared statements. Still open: add subject, delete pages, enrollment pages, profile.*
6. ~~**Passwords are stored as plain text,** and usernames and passwords are limited to 11 characters.~~ **Fixed in round 5:** passwords are hashed and the columns are widened.
7. **The section pages are unfinished.** `Admin/addnewsection.php` and `addnewsched.php` aren't linked anywhere, and their save code runs the add-subject INSERT. They now show a "not finished" notice.
8. **Dead files, safe to delete:**
   - `student/includes/report.php`: a hospital-system leftover that queries `nurse_tbl` and uses `mysql_` functions removed in PHP 7.
   - `Admin/includes/menu.php`: links to pages that don't exist.

## Workflow for future changes

1. Change colors only in `assets/css/theme-charcoal.css`.
2. For a new page, copy the structure of an existing page of the same kind: a list page like `userreg.php`, a form like `addnewsubj.php`, or a printable page like `showsubs.php`. Give it a breadcrumb, and tabs if it belongs to a section.
3. Add new nav items to the array at the top of `menu1.php` (admin) or `menu.php` (student). The current page is highlighted automatically.
4. Keep one primary button per screen.

## Open questions

- Is "Win B. A. R. Academy" final, including the dots? It appears in the top bars, the login page, and the printed documents.
- Should the academic year on the enrollment form ("A.Y. 2026–2027") come from settings instead of being written into the page?
- Real content: the campus photo, news items, registrar contact details, and the final motto.
- Should the team fix the rest of backend issue 1 (add subject, enrollment) and issue 4 (pages with no login check) before the demo? Without it, the main forms don't save on a default XAMPP install.
