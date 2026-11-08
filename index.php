<?php
session_start();
include('conn.php');

if(isset($_POST['submit']))
{
	$username=$_POST['username'];
	$password=$_POST['password'];
	
	/* Look the user up with a prepared statement (no SQL injection), then check the password hash.
	   Accounts created before hashing still hold a plain-text password: the first correct login
	   replaces it with a hash, so old test accounts keep working. */
	$found=null;
	$stmt=$conn->prepare("SELECT * FROM usertbl WHERE username=? LIMIT 1");
	$stmt->bind_param("s",$username);
	$stmt->execute();
	$candidate=$stmt->get_result()->fetch_assoc();
	if($candidate)
	{
		if(password_verify($password,$candidate['password']))
		{
			$found=$candidate;
		}
		else if(!password_get_info($candidate['password'])['algo'] && hash_equals((string)$candidate['password'],(string)$password))
		{
			$newhash=password_hash($password,PASSWORD_DEFAULT);
			$upgrade=$conn->prepare("UPDATE usertbl SET password=? WHERE ID=?");
			$upgrade->bind_param("si",$newhash,$candidate['ID']);
			$upgrade->execute();
			$found=$candidate;
		}
	}
		if($found===null)
			{
				echo"<script>window.winbarFlashNow='error|That username and password don\'t match an account. Try again.';</script>";
			}
		else
			{
				$rowval=$found;
					{
						if($rowval['user_type']=='admin')
							{
								$_SESSION['username']='$rowval[username]';
								$_SESSION['type']='admin';
								$_SESSION['logcheck']=1;
								echo"<script>try{sessionStorage.setItem('winbarFlash','success|Logged in as administrator.')}catch(e){alert('Logged in as administrator.')}window.winbarLeaving=1;</script>";
								echo"<script>window.location='Admin/adminindex.php'</script>";
							}
						else	
							{
								$_SESSION['username']='$rowval[username]';
								$_SESSION['type']='student';
									$_SESSION['logcheck']=1;
								$_SESSION['userID']=$rowval['ID'];
								echo"<script>try{sessionStorage.setItem('winbarFlash','success|Logged in. Welcome back.')}catch(e){alert('Logged in. Welcome back.')}window.winbarLeaving=1;</script>";
								echo"<script>window.location='student/studentindex.php'</script>";
							}
					}
			}
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Log in | Win B. A. R. Academy</title>
<meta name="color-scheme" content="light dark" />
<script>try{var t=localStorage.getItem("winbarTheme");if(t==="dark"||t==="light")document.documentElement.setAttribute("data-theme",t);}catch(e){}</script>
<link rel="icon" type="image/svg+xml" href="assets/img/favicon.svg" />
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="assets/js/portal.js" defer></script>
</head>
<body class="login-page">

<div class="login">
	<section class="login__brand">
		<svg class="login__art" viewBox="0 0 500 500" aria-hidden="true" focusable="false">
			<path class="art-crimson" d="M40 500 a210 210 0 0 1 420 0 Z"/>
			<circle class="art-cobalt-ring" cx="380" cy="150" r="70"/>
			<path class="art-emerald" d="M150 120 l60 104 h-120 z"/>
			<rect class="art-gold" x="330" y="300" width="44" height="44" transform="rotate(45 352 322)"/>
		</svg>
		<div class="login__school">
			<img class="login__crest" src="assets/img/logo.svg" alt="Win B. A. R. Academy crest" />
			<p class="login__name">Win B. A. R. Academy</p>
			<p class="login__motto">Sapientia servata</p>
		</div>
		<p class="login__tag">Online enrollment system</p>
	</section>

	<main class="login__panel">
		<form class="login__form" method="POST">
			<div>
				<h1>Log in</h1>
				<p class="login__help">Students and administrators use the same login.</p>
			</div>
			<div class="field">
				<label for="username">Username</label>
				<input type="text" id="username" name="username" class="text" required="required" autocomplete="username" />
			</div>
			<div class="field">
				<label for="password">Password</label>
				<input type="password" id="password" name="password" class="text" required="required" autocomplete="current-password" />
			</div>
			<input type="submit" name="submit" value="Log in" class="btn btn--danger btn--block" />
			<p class="login__help">Forgot your password? Ask the registrar's office to reset it.</p>
			<div class="book-stripe" aria-hidden="true"></div>
		</form>
	</main>
</div>

</body>
</html>
