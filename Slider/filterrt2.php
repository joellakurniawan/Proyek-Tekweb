<?php
	session_start();
	$lokasiawal="";
	$lokasitujuan="";
	$bandaraawal="";
	$bandaratujuan="";
	$strjson=file_get_contents("airports.json");
	$array=json_decode($strjson);
	foreach ($array as $item) {
		if($item->city == $_POST['rt_lokasiawal']){
			$_SESSION['lokasiawal'] = $item->code;
			$_SESSION['bandaraawal'] = $item->name;
			//echo $item->city."".$aa." ".$item->code;	
		}
		if($item->city == $_POST['rt_lokasitujuan']){
			$_SESSION['lokasitujuan'] = $item->code;
			$_SESSION['bandaratujuan'] = $item->name;
		}
	}
	$_SESSION['jumlahpassengers'] = $_POST['rt_passengers'];
	$_SESSION['tanggalberangkat'] = $_POST['rt_tanggalberangkat'];
	$_SESSION['tanggalpulang'] = $_POST['rt_tanggalpulang'];
	//echo $_SESSION['lokasiawal']." ".$_SESSION['lokasitujuan']." ".$_SESSION['tanggalberangkat']." ".$_SESSION['tanggalpulang'];
	header('Location:filterrt.php');
?>