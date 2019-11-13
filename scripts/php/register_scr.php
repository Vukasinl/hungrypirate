<?php 

if(isset($_POST['register-submit'])) {
	require "db_scr.php";

	$username = $_POST['username'];
	$email = $_POST['email'];
	$pwd = $_POST['pwd'];
	$pwdRpt = $_POST['pwd-rpt'];

	if(empty($username) || empty($email) || empty($pwd) || empty($pwdRpt)){
		header("Location: ../../register.php?error=empty&username=".$username."&email=".$email);
		exit();
	}else if((!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email)>255) &&
		(!preg_match('/^[a-zA-z0-9]*$/', $username) || strlen($username)>16 ||
		 strlen($username)<5)){
		header("Location: ../../register.php?error=invalidmailuser");
		exit();
	}else if(!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email)>255){
		header("Location: ../../register.php?error=invalidmail&username=".$username);
		exit();
	}else if(!preg_match('/^[a-zA-z0-9]*$/', $username) || strlen($username)>16 || strlen($username)<5){
		header("Location: ../../register.php?error=invaliduser&email=".$email);
		exit();
	}else if($pwd !== $pwdRpt){
		header("Location: ../../register.php?error=pwdmatch&username=".$username."&email=".$email);
		exit();
	}else if(strlen($pwd)<8 || !preg_match('/^\S*$/',$pwd) || !preg_match('/[0-9]/',$pwd)){
		header("Location: ../../register.php?error=invalidpwd&username=".$username."&email=".$email);
		exit();
	}else{

		$query = "SELECT id FROM users WHERE username=? OR email=?;";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $query)) {
			header("Location: ../../register.php?error=sqlerror");
			exit();
		}else{
			mysqli_stmt_bind_param($stmt, "ss", $username, $email);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$resCheck = mysqli_num_rows($result);
			if($resCheck > 0){
				header("Location: ../../register.php?error=usertaken&email=".$email);
				exit();
			}else{
				$query = "INSERT INTO users (username, email, pwd) VALUES (?, ?, ?);";
				if (!mysqli_stmt_prepare($stmt, $query)) {
					header("Location: ../../register.php?error=sqlerror");
					exit();
				}else{
					$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
					mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
					mysqli_stmt_execute($stmt);
					header("Location: ../../index.php?success=register");
					exit();
				}
			}
		}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	}
}else{
	header("Location: ../../register.php");
	exit();
}
