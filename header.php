<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Naslov</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
	<header>
		<nav class="navbar">
			<?php 
			if (isset($_SESSION['id'])) {
				echo '<form action="scripts/php/logout_scr.php" method="POST">
				<button type="submit" name="logout-submit" class="btn">Odjavi se</button>
			</form>';
			}
			?>
			<img src="assets/imgs/hembrgr.png" id="navimg" onclick="openNav()">
			
		</nav>
		<aside class="nav">
			<ul>
				<li><a href="index.php">Naslovna</a></li>
				<li><a href="register.php">Registruj se</a></li>
			</ul>
		</aside>
	</header>