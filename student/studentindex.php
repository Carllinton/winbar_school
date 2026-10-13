<?php
session_start();
include('logcheck.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>John Paul College</title>

<link href = "style.css" rel = "stylesheet" type = "text/css"/>
</head>

<body>

<div class='header'>
</div>
	
<nav class='container'>
<?php
include('includes/menu.php');
?>
</nav>





<div id="main">
	<div class="shell">
		<!-- Box -->
		<div class="box">
			<h2>Welcome Student</h2>
			
			<div class="entry">
				 <p><b>John Paul College</b></font></p>
		<br><b>Mission:</b></font>
        <p> A center of learning and academic excellence in the Province of Oriental Mindoro</p>
        <br><b>Vision:</b></font>
        <p>John Paul College is committed to achieve lasting improvements in education and in the lives of the people by producing students who have the ability to think critically, create, lead, compete and excel towards full development of the family, community and global environment</p>
			</div>
			
		</div>
		<!-- /Box -->
		<!-- Box -->
		<div class="box">
			<h2>Latest Events</h2>
			
			<div class="entry">
				<!-- News -->	
				<div class="news">
					<ul>
						<li>
							<div class="post-image">
								<a href="#"><img src="news1.jpg" width='90' height='70' alt="" /></a>
							</div>
							<div class="post-data">
								<h5><a href="#">September 11th, 2010</a></h5>
								<p>Nam scelerisque mi ut leo eleifend imperdiet. Donec at molestie diam. Etiam quam nisi, elementum sed commodo, posuere <a href="#">&hellip;</a></p>
							</div>
							<div class="cl">&nbsp;</div>
						</li>
						
						<li class="last">
							<div class="post-image">
								<a href="#"><img src="news2.jpg" width='90' height='70'  alt="" /></a>
							</div>
							<div class="post-data">
								<h5><a href="#">September 10th, 2010</a></h5>
								<p>Nam scelerisque mi ut leo eleifend imperdiet. Donec at molestie diam. Etiam quam nisi, elementum sed commodo, posuere <a href="#">&hellip;</a></p>
							</div>
							<div class="cl">&nbsp;</div>
						</li>
					</ul>
				</div>
				<!-- /News -->
			</div>
			
			<div class="buttons">
				<a href="#" class="button"><span>Read More</span></a>
			</div>
		</div>
		<!-- /Box -->
		<!-- Box -->
		<div class="box last-box">
			<h2>Programs</h2>
			
			<div class="entry bullet-list">
				<ul>
					  <li><a href="#">CHED COURSES</a></li>
	                    <li><a href="#">TESDA COURSES</a></li>
				</ul>
				<div class="post-image">
								<a href="#"><img src="news3.jpg" width='100' height='100' alt="" /></a>
								<a href="#"><img src="news4.jpg" width='100' height='100' alt="" /></a>
							</div>
			</div>
		
		</div>
		<!-- /Box -->
		<div class="cl">&nbsp;</div>
	</div>
  <div><br></div>
</div>
<!-- /Main -->

<!-- Footer -->
<div id="footer">
	<div class="shell">
		<!-- Mini Nav --> 
		<div class="footer-navigation"> 
			<?php
include('includes/menu2.php');
?>
		</div> 
		<!-- /Mini Nav --> 
		
		<!-- Copyrights --> 
		<p class="right"> 
			Copyright 2014 | Online Enrollment
		</p> 
		<!-- /Copyrights --> 
		
		<div class="cl">&nbsp;</div> 
	</div>
</div>




</body>
</html>