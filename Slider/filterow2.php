<?php
	session_start();
	$lokasiawal="";
	$lokasitujuan="";
	$bandaraawal="";
	$bandaratujuan="";
	$strjson=file_get_contents("airports.json");
	$array=json_decode($strjson);
	if($_SESSION['reschedule']==1){
		foreach ($array as $item) {
		if($item->code == $_SESSION['lokasi_awal']){
			$_SESSION['lokasiawal'] = $item->code;
			$_SESSION['bandaraawal'] = $item->name;
			//echo $item->city."".$aa." ".$item->code;	
		}
		if($item->code == $_SESSION['lokasi_tujuan']){
			$_SESSION['lokasitujuan'] = $item->code;
			$_SESSION['bandaratujuan'] = $item->name;
		}
		}
		$_SESSION['jumlahpassengers'] = $_SESSION['jumlah_passenger'];
		$_SESSION['tanggalberangkat'] = $_SESSION['tanggal_penerbangan'];
		header('Location:filterow.php');
	}
	else{
		foreach ($array as $item) {
		if($item->city == $_POST['ow_lokasiawal']){
			$_SESSION['lokasiawal'] = $item->code;
			$_SESSION['bandaraawal'] = $item->name;
			//echo $item->city."".$aa." ".$item->code;	
		}
		if($item->city == $_POST['ow_lokasitujuan']){
			$_SESSION['lokasitujuan'] = $item->code;
			$_SESSION['bandaratujuan'] = $item->name;
		}
		}
		$_SESSION['jumlahpassengers'] = $_POST['ow_passengers'];
		$_SESSION['tanggalberangkat'] = $_POST['ow_tanggalberangkat'];
		//echo $_SESSION['lokasiawal']." ".$_SESSION['lokasitujuan']." ".$_SESSION['tanggalberangkat'];
		header('Location:filterow.php');
	}
?>