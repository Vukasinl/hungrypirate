<?php
session_start();
error_reporting( E_ALL & ~E_NOTICE ^ E_DEPRECATED );
$json_array = array();
require "db_scr.php";
	$userid = $_SESSION['id'];
	$query = "SELECT * FROM gamestats WHERE userid = '$userid' AND active = 1;";
	$result = mysqli_query($conn, $query);
	$json = mysqli_fetch_assoc($result);
    echo json_encode($json);
    
?>