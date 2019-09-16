<?php
	include "connect.php";
	session_start();
	$username = $_POST['logUsername'];
	$password = $_POST['logPassword'];
	$query = mysqli_query($con, "SELECT * FROM admin WHERE username_admin='$username' and password_admin='$password'");
	$hasil = mysqli_fetch_array($query);
	if(mysqli_num_rows($query) == 1){
		$_SESSION["iduser"] = $hasil[0];
		$_SESSION['username']=$username;
		header('Location:admin.php');
	}
	else{
		$query2=mysqli_query($con, "SELECT * FROM customers WHERE username_customer='$username' and password_customer='$password'");
		$hasil2 = mysqli_fetch_array($query2);
		if (mysqli_num_rows($query2) == 1){
			$_SESSION["iduser"]=$hasil2[0];
			$_SESSION['username']=$username;
			header('Location:main.php');	
		}
		else {
			header('Location:main.php');	
		}
	}
?>