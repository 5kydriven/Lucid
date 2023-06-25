<?php 
session_start(); 
include "connect.php";

if (isset($_POST['login'])) {

	$uname = mysqli_real_escape_string($conn, $_POST['username']);
	$pass = mysqli_real_escape_string($conn, md5($_POST['password']));

		$result = mysqli_query($conn, "SELECT * FROM user WHERE username='$uname' AND password='$pass'");

		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
            $_SESSION['id'] = $row['id'];
            header("Location: ../UserPage/user.php?id=".$row['id']);
		    exit();
		}else{
			header("Location: ../signin.php?error=Incorect Username or password");
	        exit();
		}
	
	
}else{
	header("Location: ../signin.php");
	exit();
}