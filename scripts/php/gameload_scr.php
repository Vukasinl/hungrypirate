<?php

if ($_SERVER['PHP_SELF'] == '/projekat/index.php') {
	
	require "db_scr.php";
	$userid = $_SESSION['id'];
	$query = "SELECT * FROM gamestats WHERE userid = '$userid' AND active = 1;";
	$result = mysqli_query($conn, $query);
	$resCheck = mysqli_num_rows($result);
	if ($resCheck === 0){
				
		echo '<div class="annoucement-window">
				<div class="an-newgame">
					
						<span>Nova igra</span>
						<form action="scripts/php/newgame_scr.php" method="POST">
							<input type="text" name="heroname" placeholder="Unesite ime heroja">
							<p>Izaberite boju sobe:</p>
							<select name="roomcolor">
								<option value="blue">Plava</option>
								<option value="green">Zelena</option>
								<option value="red">Crvena</option>
								<option value="yellow">Žuta</option>
								<option value="white">Bela</option>
							</select>
							<div class="center-btn">
								<button type="submit" class="btn" name="newgame-submit">Nova igra</button>
							</div>
						</form>
					
				</div>
			</div>';
	}else {
		echo '<div id="game-window">
		<div id="player">
  			<p id="pimg"> </p>
		</div>
		<div class="endgame">
			<p>IZGUBILI STE!</p>
			<p id="finalscore">SCORE: </p>
			<button class="btn newgame-btn" onclick="game.endGame()">Nova igra</button>
		</div>
		<img src="assets/imgs/empty-room-green.jpg" id="background">
		<div class="ui-bar">
			<img src="assets/imgs/food.png" id="food-img">
			<span id="food"></span>
			<img src="assets/imgs/gold.png" id="gold-img">
			<span id="gold"></span>
			<span id="score-txt">Score: </span>
			<span id="score"></span>
		</div>
		<div id="fridge-window">
			<img src="assets/imgs/close.png" id="close-img">
			<h1>Frižider</h1>
			<div id="fridge-shop">
				<h2>Prodavnica</h2>
				<div class="fridge-shop-cont">
					<form name="shop">
						<label class="shop-item apple">
							<input type="radio" id="shop-01" name="shopradio" value="apple">
						</label>
						<label class="shop-item sandwich">
							<input type="radio" id="shop-02" name="shopradio" value="sandwich">
						</label>
						<label class="shop-item burger">
							<input type="radio" id="shop-03" name="shopradio" value="burger">
						</label>
						<label class="shop-item pizza">
							<input type="radio" id="shop-04" name="shopradio" value="pizza">
						</label>
					</form>
					<span id="item-info-text">Cena: </span>
					<span id="item-info"></span>
					<button id="buy-btn">Kupi</button>					
				</div>
			</div>
			<div id="fridge-storage">
				<h2>Skladište</h2>
				<div class="fridge-storage-cont">
					<form name="storage">
						<div class="storage-row">
							<label class="storage-slot" id="storage0">
								<input type="radio" name="storage-radio" value="">
							</label>
							<label class="storage-slot" id="storage1">
								<input type="radio" id="storage1" name="storage-radio" value="">
							</label>
							<label class="storage-slot" id="storage2">
								<input type="radio" name="storage-radio" value="">
							</label>
						</div>
						<div class="storage-row">
							<label class="storage-slot" id="storage3">
								<input type="radio" name="storage-radio" value="">
							</label>
							<label class="storage-slot" id="storage4">
								<input type="radio" name="storage-radio" value="">
							</label>
							<label class="storage-slot" id="storage5">
								<input type="radio" name="storage-radio" value="">
							</label>
						</div>
					</form>						
				</div>
				<div class="storage-side">
					<p id="storage-info-1"></p>
					<p id="storage-info-2"></p>
				</div>
				<button id="eat-btn">Jedi</button>
			</div>
		</div>
	</div>
	<script src="scripts/js/game.js"></script>';
	}
	mysqli_close();
	
}else{
	header("Location: ../../index.php");
	exit();
}