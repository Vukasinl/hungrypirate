<?php
require "header.php";
?>
<?php
if (!isset($_SESSION['id'])) {
echo '<main>
	<div class="reg-form">
		<div class="reg-img">
			<img src="assets/imgs/reg.png">
		</div>
		<h1>Registruj se</h1>';
?>
<?php
if(isset($_GET['error'])){
	if ($_GET['error'] == 'empty') {
		echo '<p class="error">Morate popuniti sva polja!</p>';
	}else if ($_GET['error'] == 'invalidmailuser') {
		echo '<p class="error">Nedozvoljen e-mail i username!</p>';
	}else if ($_GET['error'] == 'invalidmail') {
		echo '<p class="error">Nedozvoljen e-mail!</p>';
	}else if ($_GET['error'] == 'invaliduser') {
		echo '<p class="error">Nedozvoljen username!</p>';
	}else if ($_GET['error'] == 'pwdmatch') {
		echo '<p class="error">Šifre se ne poklapaju!</p>';
	}else if ($_GET['error'] == 'invalidpwd') {
		echo '<p class="error">Nedozvoljena šifra!</p>';
	}else if ($_GET['error'] == 'usertaken') {
		echo '<p class="error">E-mail ili username su zauzeti!</p>';
	}else if ($_GET['error'] == 'sqlerror') {
		echo '<p class="error">Greška pri konekciji!</p>';
	}
}
?>
<?php
echo '<form action="scripts/php/register_scr.php" method="POST">
			<input type="text" name="username" placeholder="Username..." value=';
if(isset($_GET['username'])){
	echo $_GET['username'];
}
echo '>
<input type="text" name="email" placeholder="E-mail..." value=';
if(isset($_GET['email'])){
	echo $_GET['email'];
}
echo '><input type="password" name="pwd" placeholder="Šifra">
	<input type="password" name="pwd-rpt" placeholder="Ponovite šifru...">
	<button type="submit" name="register-submit" class="btn">Registruj se</button>
	</form>
	</div>
</main>';


}else{
	header("Location: index.php");
	exit();
}
?>
<?php
require "footer.php";
?>