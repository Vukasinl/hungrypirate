<?php

$host = "localhost";
$user = "root";
$pwd = "";
$db = "gameprojekat";

$conn = mysqli_connect($host, $user, $pwd, $db);

if(!$conn)
	die("Konekcija neuspešna: ".mysqli_connect_error());