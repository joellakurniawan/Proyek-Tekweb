<?php
	include "connect.php";
	$nama = $_POST['username'];
	$password = $_POST['password'];
	$confpassword = $_POST['confPassword'];
	if($nama != ''){
		if($password == '' || $confpassword ==''){
			echo '<script language="javascript"> window.alert("password masih salah");
				 window.location.href="main.php";
				</script>';
		}
		if($password == $confpassword){
			$sudahada = "SELECT * FROM 'customers' WHERE 'username'='".$nama."'";
			if (mysqli_num_rows($sudahada)==0){
				echo '<script language="javascript"> window.alert("username sudah ada");
				 window.location.href="main.php";
				</script>';	
			}
			else{
				$sql = "INSERT INTO customers values(NULL,'$nama','$password')";
				mysqli_query($con,$sql);
				echo '<script language="javascript"> window.alert("registrasi berhasil");
				 window.location.href="main.php";
				</script>';
			}
		}
		else{
			echo '<script language="javascript"> window.alert("password salah"); window.location.href="main.php";</script>';
		}
	}
	else{
		echo '<script language="javascript"> window.alert("Username harap diisi");window.location.href="main.php";</script>';
	}
?>