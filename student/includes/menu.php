<?php
	/* Student main navigation. Highlights the section of the current page. */
	$currentPage = basename($_SERVER['PHP_SELF']);
	$studentNav = array(
		'Home'       => array('studentindex.php', array('studentindex.php')),
		'My profile' => array('studentprofile.php', array('studentprofile.php', 'changepass.php')),
		'Enroll now' => array('enroll.php', array('enroll.php', 'showsubs.php')),
	);
?>
<nav class="mainnav" aria-label="Main">
	<ul>
		<?php foreach ($studentNav as $label => $item) { ?>
			<li><a href="<?php echo $item[0]; ?>"<?php if (in_array($currentPage, $item[1])) echo ' class="is-active" aria-current="page"'; ?>><?php echo $label; ?></a></li>
		<?php } ?>
	</ul>
</nav>
