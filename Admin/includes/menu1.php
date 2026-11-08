<?php
	/* Admin main navigation. Highlights the section of the current page. */
	$currentPage = basename($_SERVER['PHP_SELF']);
	$adminNav = array(
		'Home'            => array('adminindex.php', array('adminindex.php')),
		'Manage students' => array('userreg.php', array('userreg.php', 'addnewuser.php', 'adminedit.php', 'resetpass.php')),
		'Manage subjects' => array('subjectreg.php', array('subjectreg.php', 'addnewsubj.php', 'addnewsection.php', 'addnewsched.php')),
		'Student report'  => array('includes/report.php', array('report.php')),
	);
?>
<nav class="mainnav" aria-label="Main">
	<ul>
		<?php foreach ($adminNav as $label => $item) { ?>
			<li><a href="<?php echo $item[0]; ?>"<?php if (in_array($currentPage, $item[1])) echo ' class="is-active" aria-current="page"'; ?>><?php echo $label; ?></a></li>
		<?php } ?>
	</ul>
</nav>
