<?php
	require 'dbconn.inc.php';
	$nccid = $_POST['nccid'];
	$password = $_POST['password'];
	if (empty($nccid) || empty($password)){
		header("Location:../index.php?error=emptyfields");
		exit();
}
else{
	$sql = "SELECT * FROM users WHERE nccid=?;";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		header("Location:../index.php?error=sqlerror");
		exit();
	}
	else{
		mysqli_stmt_bind_param($stmt, "s", $nccid);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		if ($row = mysqli_fetch_assoc($result)){
			$pwdCheck = password_verify($password, $row['password']);
			if($pwdCheck == false){
				header("Location:../index.php?error=wrongpwd");
			exit();
			}
			else if($pwdCheck == true){
				session_start(); //STORE DEPARTMENT ID HERE




				if($row['fname'] == 'Admin'){
					$_SESSION['fname'] = $row['fname'];
					$_SESSION['user_num'] = $row['user_num'];
					header("Location:../home_admin.php");
					exit();	
				}
				else{
					if($row['approval'] == ''){
						header("Location:../index.php?error=notappr");
						exit();
					}else{
						$_SESSION['nccid'] = $row['nccid'];
						$_SESSION['user_num'] = $row['user_num'];
						header("Location:../user.php?");
						exit();
					}

				}
			}
			else{
				header("Location:../index.php?error=wrongpwd");
				exit();
			}
			}
			else{
				header("Location:../index.php?error=nouser");
				exit();
			}


		}
	}
