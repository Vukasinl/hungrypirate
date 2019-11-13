<?php
require "header.php";
?>
<?php
if (!isset($_SESSION['id'])) {
echo '<main>
	<div class="reg-form">
		<div class="reg-img">
			<img src="assets/imgs/login.png">
		</div>
		<h1>Prijavi se</h1>';
if(isset($_GET['error'])){
		if ($_GET['error'] == 'wrongpwd') {
			echo '<p class="error">Uneli ste pogrešnu šifru!</p>';
		}else if ($_GET['error'] == 'nouser') {
			echo '<p class="error">Pogrešan e-mail/username!</p>';
		}else if ($_GET['error'] == 'empty') {
			echo '<p class="error">Morate popuniti sva polja!</p>';
		}else if ($_GET['error'] == 'sqlerror') {
			echo '<p class="error">Greška pri konekciji!</p>';
		}
	}
echo '<form action="scripts/php/login_scr.php" method="POST">
			<input type="text" name="emailuser" placeholder="E-mail/Username...">
			<input type="password" name="pwd" placeholder="Šifra">
			<button type="submit" name="login-submit" class="btn">Prijavi se</button>
		</form>
	</div>
</main>';
}else {
	header("Location: index.php");
	exit();
}
?>
<?php
require "footer.php";
?>