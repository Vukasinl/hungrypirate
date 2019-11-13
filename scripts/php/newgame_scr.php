<?php
session_start();
if (isset($_POST['newgame-submit'])) {
	require "db_scr.php";
	$heroName = $_POST['heroname'];
	$roomColor = $_POST['roomcolor'];

	if(!preg_match('/^[a-zA-z0-9]*$/', $heroName) || strlen($heroName)>14 || empty($heroName) || strlen($heroName) < 4){
		header("Location: ../../index.php?error=heroname");
		exit();
	}else {
		$query = "SELECT * FROM gamestats WHERE heroname=?;";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt,$query)) {
			header("Location: ../../index.php?error=sqlerror");
			exit();
		}else{
			mysqli_stmt_bind_param($stmt, "s", $heroName);
			mysqli_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$resCheck = mysqli_num_rows($result);
			if($resCheck > 0){
				header("Location: ../../index.php?error=herotaken");
				exit();
			}else{
				$query = "INSERT INTO gamestats (heroname, roomcolor, userid) VALUES(?, ?, ?);";
				if (!mysqli_stmt_prepare($stmt, $query)) {
					header("Location: ../../index.php?error=sqlerror");
					exit();
				}else{
					$userid = $_SESSION['id'];
					mysqli_stmt_bind_param($stmt, "ssi", $heroName, $roomColor, $userid);
					mysqli_stmt_execute($stmt);
					header("Location: ../../index.php?success=newgame");
					exit();
				}
			}
		}
		mysqli_stmt_close();
		mysqli_close();
	}

}else{
	header("Location: ../../index.php");
	exit();
}