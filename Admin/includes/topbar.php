<?php /* Admin header (H-A): utility bar, crest and school name, main nav, book stripe. */ ?>
<div class="utility">
	<div class="wrap utility__inner">
		<span class="utility__motto">Sapientia servata</span>
		<div class="utility__account">
			<button type="button" class="theme-toggle" data-theme-toggle>Dark mode</button>
			<span class="role-chip role-chip--admin">Administrator</span>
			<a href="includes/logout.php">Log out</a>
		</div>
	</div>
</div>
<header class="site-header">
	<div class="wrap site-header__inner">
		<a class="brand" href="adminindex.php">
			<img class="brand__crest" src="../assets/img/logo.svg" alt="" />
			<span class="brand__text">
				<span class="brand__name">Win B. A. R. Academy</span>
				<span class="brand__tag">Online enrollment system</span>
			</span>
		</a>
		<?php include('includes/menu1.php'); ?>
	</div>
</header>
<div class="book-stripe" aria-hidden="true"></div>
