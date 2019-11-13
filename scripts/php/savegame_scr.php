<?php
session_start();
	require "db_scr.php";
	$userid = $_SESSION['id'];
	$coins = $_POST['coins'];
	$score = $_POST['score'];
	$food = $_POST['food'];
	$fridge = $_POST['fridge'];
	$query = "SELECT * FROM gamestats WHERE userid = '$userid' AND active = 1;";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
	$gameid = $row['id'];
	$query = "UPDATE gamestats SET coins = '$coins',score = '$score',food = '$food', fridge = '$fridge' WHERE id = '$gameid';";
	$execute = mysqli_query($conn, $query);
	if(!$execute){
		header("Location: ../../index.php?error=sqlerror");
		exit();
	}else{
		echo "Saved successfully!";
	}
	mysqli_close();