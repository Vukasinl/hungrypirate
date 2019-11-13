<?php 

if(isset($_POST['login-submit'])) {
	require "db_scr.php";

	$emailuser = $_POST['emailuser'];
	$pwd = $_POST['pwd'];

	if (empty($emailuser) || empty($pwd)) {
		header("Location: ../../login.php?error=empty");
		exit();
	}else {
		$query = "SELECT * FROM users WHERE username=? OR email=?;";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $query)) {
			header("Location: ../../login.php?error=sqlerror");
			exit();
		}else {
			mysqli_stmt_bind_param($stmt, "ss", $emailuser, $emailuser);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if ($row = mysqli_fetch_assoc($result)) {
				$pwdCheck = password_verify($pwd, $row['pwd']);
				if ($pwdCheck == false) {
					header("Location: ../../login.php?error=wrongpwd");
					exit();
				}else if($pwdCheck == true){
					session_start();
					$_SESSION['id'] = $row['id'];
					$_SESSION['username'] = $row['username'];
					header("Location: ../../index.php?success=login");
					exit();
				}else{
					header("Location: ../../login.php?error=wrongpwd");
					exit();
				}
			}else{
				header("Location: ../../login.php?error=nouser");
				exit();
			}
		}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	}
	
}else{
	header("Location: ../../login.php");
	exit();
}