<?php
session_start();
include('logcheck.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Student home | Win B. A. R. Academy</title>
<?php include('includes/head.php'); ?>
</head>
<body class="role-student">

<?php include('includes/topbar.php'); ?>

<main class="home">
	<section class="hero">
		<img class="hero__photo" src="../assets/img/banner-campus.jpg" alt="" />
		<div class="wrap hero__inner">
			<div class="hero__card">
				<p class="eyebrow">Now open</p>
				<h1>Second-semester enrollment</h1>
				<p>Check that your profile is correct, then pick this semester's subjects and print your enrollment form for the registrar.</p>
				<div class="hero__actions">
					<a class="btn btn--danger" href="enroll.php">Enroll now</a>
					<a class="btn" href="studentprofile.php">View my profile</a>
				</div>
			</div>
		</div>
	</section>

	<section class="wrap home-section">
		<h2 class="section-title">Quick start</h2>
		<div class="quick-grid">
			<a class="quick quick--crimson" href="enroll.php"><strong>Enroll now</strong><span>Choose this semester's subjects</span></a>
			<a class="quick quick--cobalt" href="studentprofile.php"><strong>My profile</strong><span>Check your student record</span></a>
			<a class="quick quick--emerald" href="changepass.php"><strong>Password help</strong><span>Forgot it? The registrar resets it</span></a>
			<div class="quick quick--gold"><strong>Registrar's office</strong><span>[Office hours and room]</span></div>
		</div>
	</section>

	<section class="wrap home-section">
		<h2 class="section-title">Latest news</h2>
		<div class="news-grid">
			<article class="news-card">
				<img src="../assets/img/news-1.jpg" alt="Students lined up at the registrar's window" />
				<time datetime="2026-11-03">November 3, 2026</time>
				<h3>Second-semester enrollment is open</h3>
				<p>Pick your subjects under Enroll now and print the form before visiting the registrar.</p>
			</article>
			<article class="news-card">
				<img src="../assets/img/news-2.jpg" alt="Foundation week booths on the school grounds" />
				<time datetime="2026-10-24">October 24, 2026</time>
				<h3>Foundation week recap</h3>
				<p>Booths, a retro game night, and our first pixel-art contest. Photos are on the student lounge board.</p>
			</article>
			<article class="news-card">
				<img src="../assets/img/news-3.jpg" alt="[Describe the photo]" />
				<time datetime="2026-10-10">October 10, 2026</time>
				<h3>[Third news headline]</h3>
				<p>[One or two sentences about the news item.]</p>
			</article>
		</div>
	</section>

	<section class="about-band">
		<div class="wrap about-band__inner">
			<div>
				<h2>Our mission</h2>
				<p>To give every student the skills, habits, and confidence to keep learning long after they leave our halls.</p>
			</div>
			<div>
				<h2>Our vision</h2>
				<p>A campus where no lesson gets lost: every idea saved, organized, and ready to unpack in the real world.</p>
			</div>
			<div>
				<h2>Our programs</h2>
				<ul class="program-list">
					<li><span class="book book--crimson"></span>BS Information Technology</li>
					<li><span class="book book--cobalt"></span>BS Computer Science</li>
					<li><span class="book book--emerald"></span>TESDA short courses</li>
				</ul>
			</div>
		</div>
	</section>
</main>

<?php include('includes/footer.php'); ?>

</body>
</html>
