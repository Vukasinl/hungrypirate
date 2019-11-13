<?php require "header.php"; ?>
<main>
	<?php
	if (isset($_GET['success'])) {
		if ($_GET['success'] == 'register') {
			echo '<p class="success">Uspešno ste se registrovali!</p>';		
		}else if ($_GET['success'] == 'login') {
			echo '<p class="success">Uspešno ste se prijavili!</p>';		
		}
	}
	?>
	<div class="game-container">
		<?php 
		if (isset($_SESSION['id'])) {
		require "scripts/php/gameload_scr.php";
		}else {
			echo '<div class="annoucement-window">
			<div class="an-login">
				<span>Molimo vas da se ulogujete</span>
				<section class="btns">
					<a href="login.php" class="btn">Uloguj se</a>
					<a href="register.php" class="btn">Registruj se</a>
				</section>
			</div>
		</div>';
		}
		?>
	</div>
</main>

<?php require "footer.php"; ?>