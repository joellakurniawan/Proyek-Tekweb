<?php
include "connect.php";
session_start();
if (!isset($_SESSION['iduser']) || !isset($_SESSION['lokasiawal'])){
	header('Location:main.php');
}
if(isset($_POST['showmaskapai'])){
	$sql = "SELECT DISTINCT nama_airlines, kode_airlines FROM airlines
	WHERE id_airlines IN (SELECT a.id_airlines
	FROM jadwal_penerbangan jp
	JOIN pesawat p ON jp.id_pesawat = p.id_pesawat
	JOIN airlines a ON p.id_airlines = a.id_airlines
	WHERE jp.lokasi_awal =  '".$_SESSION['lokasiawal']."'
	AND jp.lokasi_tujuan =  '".$_SESSION['lokasitujuan']."'
	AND jp.tanggal_penerbangan = '".$_SESSION['tanggalberangkat']."')
	OR id_airlines IN (SELECT a.id_airlines
	FROM jadwal_penerbangan jd1
	JOIN jadwal_penerbangan jd2
	JOIN pesawat p1 ON jd1.id_pesawat = p1.id_pesawat
	JOIN pesawat p2 ON jd2.id_pesawat = p2.id_pesawat
	JOIN airlines a ON p1.id_airlines = a.id_airlines
	WHERE jd1.lokasi_awal='".$_SESSION['lokasiawal']."' 
	AND jd1.lokasi_tujuan=jd2.lokasi_awal 
	AND jd2.lokasi_tujuan='".$_SESSION['lokasitujuan']."' 
	AND jd1.tanggal_penerbangan='".$_SESSION['tanggalberangkat']."' 
	AND jd2.tanggal_penerbangan='".$_SESSION['tanggalberangkat']."' 
	AND jd2.jam_berangkat>jd1.jam_tiba
	AND p1.id_airlines = p2.id_airlines)
	OR id_airlines IN (SELECT a.id_airlines
	FROM jadwal_penerbangan jd1
	JOIN jadwal_penerbangan jd2
	JOIN pesawat p1 ON jd1.id_pesawat = p1.id_pesawat
	JOIN pesawat p2 ON jd2.id_pesawat = p2.id_pesawat
	JOIN airlines a ON p1.id_airlines = a.id_airlines
	WHERE jd1.lokasi_awal =  '".$_SESSION['lokasiawal']."'
	AND jd1.lokasi_tujuan = jd2.lokasi_awal
	AND jd2.lokasi_tujuan =  '".$_SESSION['lokasitujuan']."'
	AND jd1.tanggal_penerbangan =  '".$_SESSION['tanggalberangkat']."'
	AND jd2.tanggal_penerbangan=DATE_ADD('".$_SESSION['tanggalberangkat']."', INTERVAL 1 DAY)
	AND jd2.jam_berangkat<=jd1.jam_berangkat
	AND p1.id_airlines = p2.id_airlines)
	OR id_airlines IN (SELECT a.id_airlines
	FROM jadwal_penerbangan jd1
	JOIN jadwal_penerbangan jd2
	JOIN jadwal_penerbangan jd3
	JOIN pesawat p1 ON jd1.id_pesawat = p1.id_pesawat
	JOIN pesawat p2 ON jd2.id_pesawat = p2.id_pesawat
	JOIN pesawat p3 ON jd3.id_pesawat = p3.id_pesawat
	JOIN airlines a ON p1.id_airlines = a.id_airlines
	WHERE jd1.lokasi_awal =  '".$_SESSION['lokasiawal']."'
	AND jd1.lokasi_tujuan = jd2.lokasi_awal
	AND jd3.lokasi_awal = jd2.lokasi_tujuan
	AND jd3.lokasi_tujuan =  '".$_SESSION['lokasitujuan']."'
	AND jd1.tanggal_penerbangan =  '".$_SESSION['tanggalberangkat']."'
	AND jd2.tanggal_penerbangan =  '".$_SESSION['tanggalberangkat']."'
	AND jd3.tanggal_penerbangan =  '".$_SESSION['tanggalberangkat']."'
	AND jd2.jam_berangkat > jd1.jam_tiba
	AND jd3.jam_berangkat > jd2.jam_tiba
	AND p1.id_airlines = p2.id_airlines
	AND p2.id_airlines = p3.id_airlines)
	OR id_airlines IN (SELECT a.id_airlines
	FROM jadwal_penerbangan jd1
	JOIN jadwal_penerbangan jd2
	JOIN jadwal_penerbangan jd3
	JOIN pesawat p1 ON jd1.id_pesawat = p1.id_pesawat
	JOIN pesawat p2 ON jd2.id_pesawat = p2.id_pesawat
	JOIN pesawat p3 ON jd3.id_pesawat = p3.id_pesawat
	JOIN airlines a ON p1.id_airlines = a.id_airlines
	WHERE jd1.lokasi_awal =  '".$_SESSION['lokasiawal']."'
	AND jd1.lokasi_tujuan = jd2.lokasi_awal
	AND jd3.lokasi_awal = jd2.lokasi_tujuan
	AND jd3.lokasi_tujuan =  '".$_SESSION['lokasitujuan']."'
	AND jd1.tanggal_penerbangan =  '".$_SESSION['tanggalberangkat']."'
	AND jd2.tanggal_penerbangan =  '".$_SESSION['tanggalberangkat']."'
	AND jd3.tanggal_penerbangan =  DATE_ADD('".$_SESSION['tanggalberangkat']."', INTERVAL 1 DAY)
	AND jd2.jam_berangkat > jd1.jam_tiba
	AND jd3.jam_berangkat<=jd2.jam_tiba
	AND p1.id_airlines = p2.id_airlines
	AND p2.id_airlines = p3.id_airlines)
	OR id_airlines IN (SELECT a.id_airlines
	FROM jadwal_penerbangan jd1
	JOIN jadwal_penerbangan jd2
	JOIN jadwal_penerbangan jd3
	JOIN pesawat p1 ON jd1.id_pesawat = p1.id_pesawat
	JOIN pesawat p2 ON jd2.id_pesawat = p2.id_pesawat
	JOIN pesawat p3 ON jd3.id_pesawat = p3.id_pesawat
	JOIN airlines a ON p1.id_airlines = a.id_airlines
	WHERE jd1.lokasi_awal =  '".$_SESSION['lokasiawal']."'
	AND jd1.lokasi_tujuan = jd2.lokasi_awal
	AND jd3.lokasi_awal = jd2.lokasi_tujuan
	AND jd3.lokasi_tujuan =  '".$_SESSION['lokasitujuan']."'
	AND jd1.tanggal_penerbangan =  '".$_SESSION['tanggalberangkat']."'
	AND jd2.tanggal_penerbangan =  DATE_ADD('".$_SESSION['tanggalberangkat']."', INTERVAL 1 DAY)
	AND jd3.tanggal_penerbangan =  DATE_ADD('".$_SESSION['tanggalberangkat']."', INTERVAL 1 DAY)
	AND jd2.jam_berangkat<=jd1.jam_tiba 
	AND jd3.jam_berangkat>jd2.jam_tiba
	AND p1.id_airlines = p2.id_airlines
	AND p2.id_airlines = p3.id_airlines)";
	$result=mysqli_query($con, $sql);
	while ($row=mysqli_fetch_array($result)){
		echo '<li><label class="container" style="color: #FFFFFF;">'.$row[0].'
		<input type="checkbox" class="filter '.$row[1].'" checked>
		<span class="checkmark"></span>
		</label></li>';
	}
	exit();
}
if(isset($_POST['setmaskapai'])){
	$sql = "SELECT DISTINCT nama_airlines, kode_airlines FROM airlines
	WHERE id_airlines IN (SELECT a.id_airlines
	FROM jadwal_penerbangan jp
	JOIN pesawat p ON jp.id_pesawat = p.id_pesawat
	JOIN airlines a ON p.id_airlines = a.id_airlines
	WHERE jp.lokasi_awal =  '".$_SESSION['lokasiawal']."'
	AND jp.lokasi_tujuan =  '".$_SESSION['lokasitujuan']."'
	AND jp.tanggal_penerbangan = '".$_SESSION['tanggalberangkat']."')
	OR id_airlines IN (SELECT a.id_airlines
	FROM jadwal_penerbangan jd1
	JOIN jadwal_penerbangan jd2
	JOIN pesawat p1 ON jd1.id_pesawat = p1.id_pesawat
	JOIN pesawat p2 ON jd2.id_pesawat = p2.id_pesawat
	JOIN airlines a ON p1.id_airlines = a.id_airlines
	WHERE jd1.lokasi_awal='".$_SESSION['lokasiawal']."' 
	AND jd1.lokasi_tujuan=jd2.lokasi_awal 
	AND jd2.lokasi_tujuan='".$_SESSION['lokasitujuan']."' 
	AND jd1.tanggal_penerbangan='".$_SESSION['tanggalberangkat']."' 
	AND jd2.tanggal_penerbangan='".$_SESSION['tanggalberangkat']."' 
	AND jd2.jam_berangkat>jd1.jam_tiba
	AND p1.id_airlines = p2.id_airlines)
	OR id_airlines IN (SELECT a.id_airlines
	FROM jadwal_penerbangan jd1
	JOIN jadwal_penerbangan jd2
	JOIN pesawat p1 ON jd1.id_pesawat = p1.id_pesawat
	JOIN pesawat p2 ON jd2.id_pesawat = p2.id_pesawat
	JOIN airlines a ON p1.id_airlines = a.id_airlines
	WHERE jd1.lokasi_awal =  '".$_SESSION['lokasiawal']."'
	AND jd1.lokasi_tujuan = jd2.lokasi_awal
	AND jd2.lokasi_tujuan =  '".$_SESSION['lokasitujuan']."'
	AND jd1.tanggal_penerbangan =  '".$_SESSION['tanggalberangkat']."'
	AND jd2.tanggal_penerbangan=DATE_ADD('".$_SESSION['tanggalberangkat']."', INTERVAL 1 DAY)
	AND jd2.jam_berangkat<=jd1.jam_berangkat
	AND p1.id_airlines = p2.id_airlines)
	OR id_airlines IN (SELECT a.id_airlines
	FROM jadwal_penerbangan jd1
	JOIN jadwal_penerbangan jd2
	JOIN jadwal_penerbangan jd3
	JOIN pesawat p1 ON jd1.id_pesawat = p1.id_pesawat
	JOIN pesawat p2 ON jd2.id_pesawat = p2.id_pesawat
	JOIN pesawat p3 ON jd3.id_pesawat = p3.id_pesawat
	JOIN airlines a ON p1.id_airlines = a.id_airlines
	WHERE jd1.lokasi_awal =  '".$_SESSION['lokasiawal']."'
	AND jd1.lokasi_tujuan = jd2.lokasi_awal
	AND jd3.lokasi_awal = jd2.lokasi_tujuan
	AND jd3.lokasi_tujuan =  '".$_SESSION['lokasitujuan']."'
	AND jd1.tanggal_penerbangan =  '".$_SESSION['tanggalberangkat']."'
	AND jd2.tanggal_penerbangan =  '".$_SESSION['tanggalberangkat']."'
	AND jd3.tanggal_penerbangan =  '".$_SESSION['tanggalberangkat']."'
	AND jd2.jam_berangkat > jd1.jam_tiba
	AND jd3.jam_berangkat > jd2.jam_tiba
	AND p1.id_airlines = p2.id_airlines
	AND p2.id_airlines = p3.id_airlines)
	OR id_airlines IN (SELECT a.id_airlines
	FROM jadwal_penerbangan jd1
	JOIN jadwal_penerbangan jd2
	JOIN jadwal_penerbangan jd3
	JOIN pesawat p1 ON jd1.id_pesawat = p1.id_pesawat
	JOIN pesawat p2 ON jd2.id_pesawat = p2.id_pesawat
	JOIN pesawat p3 ON jd3.id_pesawat = p3.id_pesawat
	JOIN airlines a ON p1.id_airlines = a.id_airlines
	WHERE jd1.lokasi_awal =  '".$_SESSION['lokasiawal']."'
	AND jd1.lokasi_tujuan = jd2.lokasi_awal
	AND jd3.lokasi_awal = jd2.lokasi_tujuan
	AND jd3.lokasi_tujuan =  '".$_SESSION['lokasitujuan']."'
	AND jd1.tanggal_penerbangan =  '".$_SESSION['tanggalberangkat']."'
	AND jd2.tanggal_penerbangan =  '".$_SESSION['tanggalberangkat']."'
	AND jd3.tanggal_penerbangan =  DATE_ADD('".$_SESSION['tanggalberangkat']."', INTERVAL 1 DAY)
	AND jd2.jam_berangkat > jd1.jam_tiba
	AND jd3.jam_berangkat<=jd2.jam_tiba
	AND p1.id_airlines = p2.id_airlines
	AND p2.id_airlines = p3.id_airlines)
	OR id_airlines IN (SELECT a.id_airlines
	FROM jadwal_penerbangan jd1
	JOIN jadwal_penerbangan jd2
	JOIN jadwal_penerbangan jd3
	JOIN pesawat p1 ON jd1.id_pesawat = p1.id_pesawat
	JOIN pesawat p2 ON jd2.id_pesawat = p2.id_pesawat
	JOIN pesawat p3 ON jd3.id_pesawat = p3.id_pesawat
	JOIN airlines a ON p1.id_airlines = a.id_airlines
	WHERE jd1.lokasi_awal =  '".$_SESSION['lokasiawal']."'
	AND jd1.lokasi_tujuan = jd2.lokasi_awal
	AND jd3.lokasi_awal = jd2.lokasi_tujuan
	AND jd3.lokasi_tujuan =  '".$_SESSION['lokasitujuan']."'
	AND jd1.tanggal_penerbangan =  '".$_SESSION['tanggalberangkat']."'
	AND jd2.tanggal_penerbangan =  DATE_ADD('".$_SESSION['tanggalberangkat']."', INTERVAL 1 DAY)
	AND jd3.tanggal_penerbangan =  DATE_ADD('".$_SESSION['tanggalberangkat']."', INTERVAL 1 DAY)
	AND jd2.jam_berangkat<=jd1.jam_tiba 
	AND jd3.jam_berangkat>jd2.jam_tiba
	AND p1.id_airlines = p2.id_airlines
	AND p2.id_airlines = p3.id_airlines)";
	$result=mysqli_query($con, $sql);
	$a = [];
	while ($row=mysqli_fetch_array($result, MYSQL_ASSOC)){
		array_push($a, $row);
	}
	echo json_encode($a);
	exit();
}
if(isset($_POST['showdata'])){
	$tersedia = "SELECT jp.id_jdpenerbangan, p.kapasitas_pesawat
	FROM jadwal_penerbangan jp
	JOIN pesawat p ON jp.id_pesawat = p.id_pesawat
	WHERE jp.lokasi_awal =  '".$_SESSION['lokasiawal']."'
	AND jp.lokasi_tujuan =  '".$_SESSION['lokasitujuan']."'
	AND jp.tanggal_penerbangan =  '".$_SESSION['tanggalberangkat']."'";
	$result=mysqli_query($con, $tersedia);
	while($row=mysqli_fetch_array($result)){	
		$terpesan = "SELECT SUM( jumlah_passenger ) 
		FROM pesanan
		WHERE id_jdpenerbangan =".$row[0]."";
		$result=mysqli_query($con,$terpesan);
		$terpesan=mysqli_fetch_array($result);
		$sisa=(int)$row[1]-(int)$terpesan[0]-(int)$_SESSION['jumlah_passengers'];
		if($sisa>0){
			$sql = "SELECT *
			FROM jadwal_penerbangan jp
			JOIN pesawat p ON jp.id_pesawat = p.id_pesawat
			JOIN airlines a ON p.id_airlines = a.id_airlines
			WHERE jp.id_jdpenerbangan = ".$row[0]."";
			$result = mysqli_query($con,$sql);
			while ($row=mysqli_fetch_array($result)){
				if ($row[2] <= "06.00"){
					$waktuberangkat="subuh";
				}
				else if ($row[2] < "12.00" && $row[2] >= "06.00"){
					$waktuberangkat="pagi";	
				}
				else if ($row[2] < "18.00" && $row[2] >= "12.00"){
					$waktuberangkat="siang";	
				}
				else if ($row[2] < "24.00" && $row[2] >= "18.00"){
					$waktuberangkat="malam";	
				}
				if ((int)$row[8] < 3000000){
					$rangeharga = "bwh3";
				}
				else if ((int)$row[8] >= 3000000 && (int)$row[8] < 5000000){
					$rangeharga = "3smp5";
				}
				else if ((int)$row[8] >= 5000000 && (int)$row[8] < 10000000){
					$rangeharga = "5smp10";
				}
				else if ((int)$row[8] >= 10000000){
					$rangeharga = "ats10";
				}
				echo '<li class="item langsung '.$waktuberangkat.' '.$row[15].' '.$rangeharga.'">
				<time datetime="'.$row['tanggal_penerbangan'].'">
				<span class="day">'.$row['jam_berangkat'].'</span>
				<span class="strip">--------------</span>
				<span class="month">'.$row['jam_tiba'].'</span>
				</time>
				<img alt="Independence Day" src="assets/logo airlines/'.$row['foto_airlines'].'.jpg" />
				<div class="col-sm-5 info">
				<h2 class="title">'.$row['lokasi_awal'].' - '.$row['lokasi_tujuan'].' <small>(Langsung)</small></h2>
				<p class="desc" style="font-size:10pt;">From: '.$_SESSION['bandaraawal'].' ('.$row['lokasi_awal'].') <br> To: '.$_SESSION['bandaratujuan'].' ('.$row['lokasi_tujuan'].') <br> <b> Flight No: '.$row['kode_pesawat'].' </b> </p>
				</div>
				<div class="harga">
				<p style="padding-top:45px; padding-right:5px; font-size: 16pt;">'.number_format($row['harga'],0,',','.').'IDR </p>
				</div>
				<div class="social">
				<ul>
				<li class="pilih" style="width:20%; visibility: hidden;"><a href="#pilih" disabled></a></li>
				<li class="dropdown detail" style="width:20%;">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-info-circle"></span></a>
				<ul class="dropdown-menu">
				<li><b> '.$row['jam_berangkat'].' - '.$row['tanggal_penerbangan'].'</b></li>
				<li> '.$_SESSION['bandaraawal'].' ('.$row['lokasi_awal'].') </li>
				<li style="background-color: #ededed; font-size:5pt;"> &nbsp; </li>
				<li style="background-color: #ededed;"><b> '.$row['durasi'].'</b> - '.$row['kode_pesawat'].' </li>
				<li style="background-color: #ededed; font-size:5pt;"> &nbsp; </li>
				<li><b> '.$row['jam_tiba'].' - '.$row['tanggal_penerbangan'].'</b> </li>
				<li> '.$_SESSION['bandaratujuan'].' ('.$row['lokasi_tujuan'].') </li>
				</ul>
				</li>
				<li class="pilih" style="width:20%;" data-val="'.$row['id_jdpenerbangan'].'" data-harga="'.$row['harga'].'"><a href="/Slider/pembayaran/index.php"><span class="fa fa-check-circle"></span></a></li>
				<li class="pilih" style="width:20%; visibility: hidden;"><a href="#pilih" disabled></a></li>
				</ul>
				</div>
				</li>';
			}
		}
		else{
			echo '';
		}
	}

	//1 transit hari sama
	$tersedia = "SELECT jd1.id_jdpenerbangan, p1.kapasitas_pesawat, jd2.id_jdpenerbangan, p2.kapasitas_pesawat
	FROM jadwal_penerbangan jd1
	JOIN jadwal_penerbangan jd2
	JOIN pesawat p1 ON jd1.id_pesawat = p1.id_pesawat
	JOIN pesawat p2 ON jd2.id_pesawat = p2.id_pesawat
	WHERE jd1.lokasi_awal =  '".$_SESSION['lokasiawal']."'
	AND jd1.lokasi_tujuan = jd2.lokasi_awal
	AND jd2.lokasi_tujuan =  '".$_SESSION['lokasitujuan']."'
	AND jd1.tanggal_penerbangan =  '".$_SESSION['tanggalberangkat']."'
	AND jd2.tanggal_penerbangan =  '".$_SESSION['tanggalberangkat']."'
	AND jd2.jam_berangkat > jd1.jam_tiba
	AND p1.id_airlines = p2.id_airlines";
	$result=mysqli_query($con, $tersedia);
	while($row=mysqli_fetch_array($result)){
		$terpesan1 = "SELECT SUM( jumlah_passenger ) 
		FROM pesanan
		WHERE id_jdpenerbangan =".$row[0]."";
		$result=mysqli_query($con,$terpesan1);
		$terpesan1=mysqli_fetch_array($result);
		$sisa1=(int)$row[1]-(int)$terpesan1[0]-(int)$_SESSION['jumlah_passengers'];
		$terpesan2 = "SELECT SUM( jumlah_passenger ) 
		FROM pesanan
		WHERE id_jdpenerbangan =".$row[2]."";
		$result=mysqli_query($con,$terpesan2);
		$terpesan2=mysqli_fetch_array($result);
		$sisa2=(int)$row[3]-(int)$terpesan2[0]-(int)$_SESSION['jumlah_passengers'];
		if($sisa1>0 && $sisa2>0){
			$sql = "SELECT * 
			FROM jadwal_penerbangan jd1
			JOIN jadwal_penerbangan jd2
			JOIN pesawat p1 ON jd1.id_pesawat = p1.id_pesawat
			JOIN pesawat p2 ON jd2.id_pesawat = p2.id_pesawat
			JOIN airlines a ON p1.id_airlines = a.id_airlines
			WHERE jd1.id_jdpenerbangan =  ".$row[0]."
			AND jd2.id_jdpenerbangan = ".$row[2]."";
			$result = mysqli_query($con,$sql);
			while ($row=mysqli_fetch_array($result)){
				$value = strval($row[0])."-".strval($row[9]);
				$value= strval($value);
				$harga = (int)$row[8]+(int)$row[17];
				if ($row[3]<$row[2]){
					$date1 = date('Y-m-d',strtotime($row[1] . "+1 days"));
				}
				else {
					$date1=$row[1];
				}
				if ($row[12]<$row[11]){
					$date2 = date('Y-m-d',strtotime($row[10] . "+1 days"));
				}
				else {
					$date2=$row[10];
				}
				$data = file_get_contents('airports.json');
				$airports = json_decode($data);
				foreach($airports as $airport){
					if ($airport->code == $row[5]){
						$bandara1 = $airport->name;
					}
					else if ($airport->code == $row[6]){
						$bandara2 = $airport->name;
					}
					else if ($airport->code == $row[15]){
						$bandara3 = $airport->name;
					}
				}
				if ($row[2] < "06.00"){
					$waktuberangkat="subuh";
				}
				else if ($row[2] < "12.00" && $row[2] > "06.00"){
					$waktuberangkat="pagi";	
				}
				else if ($row[2] < "18.00" && $row[2] > "12.00"){
					$waktuberangkat="siang";	
				}
				else if ($row[2] < "24.00" && $row[2] > "18.00"){
					$waktuberangkat="malam";	
				}
				if ($harga < 3000000){
					$rangeharga = "bwh3";
				}
				else if ($harga >= 3000000 && $harga < 5000000){
					$rangeharga = "3smp5";
				}
				else if ($harga >= 5000000 && $harga < 10000000){
					$rangeharga = "5smp10";
				}
				else if ($harga >= 10000000){
					$rangeharga = "ats10";
				}
				echo '<li class="item 1transit '.$waktuberangkat.' '.$row[28].' '.$rangeharga.'">
				<time datetime="'.$row[1].'">
				<span class="day">'.$row[2].'</span>
				<span class="strip">--------------</span>
				<span class="month">'.$row[12].'</span>
				</time>
				<img alt="Independence Day" src="assets/logo airlines/'.$row[29].'.jpg" />
				<div class="col-sm-5 info">
				<h2 class="title">'.$row[5].' - '.$row[15].'<small>(1 Transit)</small></h2>
				<p class="desc" style="font-size:10pt;">From: '.$_SESSION['bandaraawal'].' ('.$row[5].') <br> To: '.$_SESSION['bandaratujuan'].' ('.$row[15].') <br> <b> Flight No: '.$row[21].', '.$row[25].' </b> </p>
				</div>
				<div class="harga">
				<p style="padding-top:45px; padding-right:5px; font-size: 16pt;">'.number_format($harga,0,',','.').'IDR </p>
				</div>
				<div class="social">
				<ul>
				<li style="width:20%; visibility: hidden;"><a href="#pilih" disabled></a></li>
				<li class="dropdown detail" style="width:20%;">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-info-circle"></span></a>
				<ul class="dropdown-menu">
				<li><b> '.$row[2].' - '.$row[1].'</b></li>
				<li> '.$bandara1.' ('.$row[5].') </li>
				<li style="background-color: #ededed; font-size:5pt;"> &nbsp; </li>
				<li style="background-color: #ededed;"><b> '.$row[4].'</b> - '.$row[21].' </li>
				<li style="background-color: #ededed; font-size:5pt;"> &nbsp; </li>
				<li><b> '.$row[3].' - '.$date1.'</b> </li>
				<li> '.$bandara2.' ('.$row[6].') </li>
				<li role="separator" class="divider"></li>
				<li><b> '.$row[11].' - '.$row[10].'</b></li>
				<li> '.$bandara2.' ('.$row[14].') </li>
				<li style="background-color: #ededed; font-size:5pt;"> &nbsp; </li>
				<li style="background-color: #ededed;"><b> '.$row[13].'</b> - '.$row[25].' </li>
				<li style="background-color: #ededed; font-size:5pt;"> &nbsp; </li>
				<li><b> '.$row[12].' - '.$date2.'</b> </li>
				<li> '.$bandara3.' ('.$row[15].') </li>
				</ul>
				</li>
				<li class="pilih" style="width:20%;" data-val="'.$value.'" data-harga="'.$harga.'"><a href="/Slider/pembayaran/index.php"><span class="fa fa-check-circle"></span></a></li>
				<li style="width:20%; visibility: hidden;"><a href="#pilih" disabled></a></li>
				</ul>
				</div>
				</li>';
			}
		}
		else{
			echo '';
		}
	}

	//1 transit hari beda
	$tersedia = "SELECT jd1.id_jdpenerbangan, p1.kapasitas_pesawat, jd2.id_jdpenerbangan, p2.kapasitas_pesawat
	FROM jadwal_penerbangan jd1
	JOIN jadwal_penerbangan jd2
	JOIN pesawat p1 ON jd1.id_pesawat = p1.id_pesawat
	JOIN pesawat p2 ON jd2.id_pesawat = p2.id_pesawat
	WHERE jd1.lokasi_awal =  '".$_SESSION['lokasiawal']."'
	AND jd1.lokasi_tujuan = jd2.lokasi_awal
	AND jd2.lokasi_tujuan =  '".$_SESSION['lokasitujuan']."'
	AND jd1.tanggal_penerbangan =  '".$_SESSION['tanggalberangkat']."'
	AND jd2.tanggal_penerbangan=DATE_ADD('".$_SESSION['tanggalberangkat']."', INTERVAL 1 DAY)
	AND jd2.jam_berangkat<=jd1.jam_berangkat
	AND p1.id_airlines = p2.id_airlines";
	$result=mysqli_query($con, $tersedia);
	while($row=mysqli_fetch_array($result)){
		$terpesan1 = "SELECT SUM( jumlah_passenger ) 
		FROM pesanan
		WHERE id_jdpenerbangan =".$row[0]."";
		$result=mysqli_query($con,$terpesan1);
		$terpesan1=mysqli_fetch_array($result);
		$sisa1=(int)$row[1]-(int)$terpesan1[0]-(int)$_SESSION['jumlah_passengers'];
		$terpesan2 = "SELECT SUM( jumlah_passenger ) 
		FROM pesanan
		WHERE id_jdpenerbangan =".$row[2]."";
		$result=mysqli_query($con,$terpesan2);
		$terpesan2=mysqli_fetch_array($result);
		$sisa2=(int)$row[3]-(int)$terpesan2[0]-(int)$_SESSION['jumlah_passengers'];
		if($sisa1>0 && $sisa2>0){
			$sql = "SELECT * 
			FROM jadwal_penerbangan jd1
			JOIN jadwal_penerbangan jd2
			JOIN pesawat p1 ON jd1.id_pesawat = p1.id_pesawat
			JOIN pesawat p2 ON jd2.id_pesawat = p2.id_pesawat
			JOIN airlines a ON p1.id_airlines = a.id_airlines
			WHERE jd1.id_jdpenerbangan =  ".$row[0]."
			AND jd2.id_jdpenerbangan = ".$row[2]."";
			$result = mysqli_query($con,$sql);
			while ($row=mysqli_fetch_array($result)){
				$value = $row[0]."-".$row[9];
				$harga = (int)$row[8]+(int)$row[17];
				if ($row[3]<$row[2]){
					$date1 = date('Y-m-d',strtotime($row[1] . "+1 days"));
				}
				else {
					$date1=$row[1];
				}
				if ($row[12]<$row[11]){
					$date2 = date('Y-m-d',strtotime($row[10] . "+1 days"));
				}
				else {
					$date2=$row[10];
				}
				$data = file_get_contents('airports.json');
				$airports = json_decode($data);
				foreach($airports as $airport){
					if ($airport->code == $row[5]){
						$bandara1 = $airport->name;
					}
					else if ($airport->code == $row[6]){
						$bandara2 = $airport->name;
					}
					else if ($airport->code == $row[15]){
						$bandara3 = $airport->name;
					}
				}
				if ($row[2] < "06.00"){
					$waktuberangkat="subuh";
				}
				else if ($row[2] < "12.00" && $row[2] > "06.00"){
					$waktuberangkat="pagi";	
				}
				else if ($row[2] < "18.00" && $row[2] > "12.00"){
					$waktuberangkat="siang";	
				}
				else if ($row[2] < "24.00" && $row[2] > "18.00"){
					$waktuberangkat="malam";	
				}
				if ($harga < 3000000){
					$rangeharga = "bwh3";
				}
				else if ($harga >= 3000000 && $harga < 5000000){
					$rangeharga = "3smp5";
				}
				else if ($harga >= 5000000 && $harga < 10000000){
					$rangeharga = "5smp10";
				}
				else if ($harga >= 10000000){
					$rangeharga = "ats10";
				}
				echo '<li class="item 1transit '.$waktuberangkat.' '.$row[28].' '.$rangeharga.'">
				<time datetime="'.$row[1].'">
				<span class="day">'.$row[2].'</span>
				<span class="strip">--------------</span>
				<span class="month">'.$row[12].'</span>
				</time>
				<img alt="Independence Day" src="assets/logo airlines/'.$row[29].'.jpg" />
				<div class="col-sm-5 info">
				<h2 class="title">'.$row[5].' - '.$row[15].' <small>(1 Transit)</small></h2>
				<p class="desc" style="font-size:10pt;">From: '.$_SESSION['bandaraawal'].' ('.$row[5].') <br> To: '.$_SESSION['bandaratujuan'].' ('.$row[15].') <br> <b> Flight No: '.$row[21].', '.$row[25].' </b> </p>
				</div>
				<div class="harga">
				<p style="padding-top:45px; padding-right:5px; font-size: 16pt;">'.number_format($harga,0,',','.').'IDR </p>
				</div>
				<div class="social">
				<ul>
				<li class="pilih" style="width:20%; visibility: hidden;"><a href="#pilih" disabled></a></li>
				<li class="dropdown detail" style="width:20%;">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-info-circle"></span></a>
				<ul class="dropdown-menu">
				<li><b> '.$row[2].' - '.$row[1].'</b></li>
				<li> '.$bandara1.' ('.$row[5].') </li>
				<li style="background-color: #ededed; font-size:5pt;"> &nbsp; </li>
				<li style="background-color: #ededed;"><b> '.$row[4].'</b> - '.$row[21].' </li>
				<li style="background-color: #ededed; font-size:5pt;"> &nbsp; </li>
				<li><b> '.$row[3].' - '.$date1.'</b> </li>
				<li> '.$bandara2.' ('.$row[6].') </li>
				<li role="separator" class="divider"></li>
				<li><b> '.$row[11].' - '.$row[10].'</b></li>
				<li> '.$bandara2.' ('.$row[14].') </li>
				<li style="background-color: #ededed; font-size:5pt;"> &nbsp; </li>
				<li style="background-color: #ededed;"><b> '.$row[13].'</b> - '.$row[25].' </li>
				<li style="background-color: #ededed; font-size:5pt;"> &nbsp; </li>
				<li><b> '.$row[12].' - '.$date2.'</b> </li>
				<li> '.$bandara3.' ('.$row[15].') </li>
				</ul>
				</li>
				<li class="pilih" style="width:20%;" data-val="'.$value.'" data-harga="'.$harga.'"><a href="/Slider/pembayaran/index.php"><span class="fa fa-check-circle"></span></a></li>
				<li class="pilih" style="width:20%; visibility: hidden;"><a href="#pilih" disabled></a></li>
				</ul>
				</div>
				</li>';
			}
		}
		else{
			echo '';
		}
	}

	//2 transit 123sama
	$tersedia = "SELECT jd1.id_jdpenerbangan, p1.kapasitas_pesawat, jd2.id_jdpenerbangan, p2.kapasitas_pesawat, jd3.id_jdpenerbangan, p3.kapasitas_pesawat
	FROM jadwal_penerbangan jd1
	JOIN jadwal_penerbangan jd2
	JOIN jadwal_penerbangan jd3
	JOIN pesawat p1 ON jd1.id_pesawat = p1.id_pesawat
	JOIN pesawat p2 ON jd2.id_pesawat = p2.id_pesawat
	JOIN pesawat p3 ON jd3.id_pesawat = p3.id_pesawat
	WHERE jd1.lokasi_awal =  '".$_SESSION['lokasiawal']."'
	AND jd1.lokasi_tujuan = jd2.lokasi_awal
	AND jd3.lokasi_awal = jd2.lokasi_tujuan
	AND jd3.lokasi_tujuan =  '".$_SESSION['lokasitujuan']."'
	AND jd1.tanggal_penerbangan =  '".$_SESSION['tanggalberangkat']."'
	AND jd2.tanggal_penerbangan =  '".$_SESSION['tanggalberangkat']."'
	AND jd3.tanggal_penerbangan =  '".$_SESSION['tanggalberangkat']."'
	AND jd2.jam_berangkat > jd1.jam_tiba
	AND jd3.jam_berangkat > jd2.jam_tiba
	AND p1.id_airlines = p2.id_airlines
	AND p2.id_airlines = p3.id_airlines";
	$result=mysqli_query($con, $tersedia);
	while($row=mysqli_fetch_array($result)){
		$terpesan1 = "SELECT SUM( jumlah_passenger ) 
		FROM pesanan
		WHERE id_jdpenerbangan =".$row[0]."";
		$result=mysqli_query($con,$terpesan1);
		$terpesan1=mysqli_fetch_array($result);
		$sisa1=(int)$row[1]-(int)$terpesan1[0]-(int)$_SESSION['jumlah_passengers'];
		$terpesan2 = "SELECT SUM( jumlah_passenger ) 
		FROM pesanan
		WHERE id_jdpenerbangan =".$row[2]."";
		$result=mysqli_query($con,$terpesan2);
		$terpesan2=mysqli_fetch_array($result);
		$sisa2=(int)$row[3]-(int)$terpesan2[0]-(int)$_SESSION['jumlah_passengers'];
		$terpesan3 = "SELECT SUM( jumlah_passenger ) 
		FROM pesanan
		WHERE id_jdpenerbangan =".$row[4]."";
		$result=mysqli_query($con,$terpesan3);
		$terpesan3=mysqli_fetch_array($result);
		$sisa3=(int)$row[5]-(int)$terpesan3[0]-(int)$_SESSION['jumlah_passengers'];
		if($sisa1>0 && $sisa2>0 && $sisa3>0){
			$sql = "SELECT * 
			FROM jadwal_penerbangan jd1
			JOIN jadwal_penerbangan jd2
			JOIN jadwal_penerbangan jd3
			JOIN pesawat p1 ON jd1.id_pesawat = p1.id_pesawat
			JOIN pesawat p2 ON jd2.id_pesawat = p2.id_pesawat
			JOIN pesawat p3 ON jd3.id_pesawat = p3.id_pesawat
			JOIN airlines a ON p1.id_airlines = a.id_airlines
			WHERE jd1.id_jdpenerbangan = ".$row[0]."
			AND jd2.id_jdpenerbangan = ".$row[2]."
			AND jd3.id_jdpenerbangan = ".$row[4]."";
			$result = mysqli_query($con,$sql);
			while ($row=mysqli_fetch_array($result)){
				$value = $row[0]."-".$row[9]."-".$row[18];
				$harga = (int)$row[8]+(int)$row[17]+(int)$row[26];
				if ($row[3]<$row[2]){
					$date1 = date('Y-m-d',strtotime($row[1] . "+1 days"));
				}
				else {
					$date1=$row[1];
				}
				if ($row[12]<$row[11]){
					$date2 = date('Y-m-d',strtotime($row[10] . "+1 days"));
				}
				else {
					$date2=$row[10];
				}
				if ($row[21]<$row[20]){
					$date3 = date('Y-m-d',strtotime($row[19] . "+1 days"));
				}
				else {
					$date3=$row[19];
				}
				$data = file_get_contents('airports.json');
				$airports = json_decode($data);
				foreach($airports as $airport){
					if ($airport->code == $row[5]){
						$bandara1 = $airport->name;
					}
					else if ($airport->code == $row[6]){
						$bandara2 = $airport->name;
					}
					else if ($airport->code == $row[23]){
						$bandara3 = $airport->name;
					}
					else if ($airport->code == $row[24]){
						$bandara4 = $airport->name;
					}
				}
				if ($row[2] < "06.00"){
					$waktuberangkat="subuh";
				}
				else if ($row[2] < "12.00" && $row[2] > "06.00"){
					$waktuberangkat="pagi";	
				}
				else if ($row[2] < "18.00" && $row[2] > "12.00"){
					$waktuberangkat="siang";	
				}
				else if ($row[2] < "24.00" && $row[2] > "18.00"){
					$waktuberangkat="malam";	
				}
				if ($harga < 3000000){
					$rangeharga = "bwh3";
				}
				else if ($harga >= 3000000 && $harga < 5000000){
					$rangeharga = "3smp5";
				}
				else if ($harga >= 5000000 && $harga < 10000000){
					$rangeharga = "5smp10";
				}
				else if ($harga >= 10000000){
					$rangeharga = "ats10";
				}
				echo '<li class="item 2transit '.$waktuberangkat.' '.$row[41].' '.$rangeharga.'">
				<time datetime="'.$row[1].'">
				<span class="day">'.$row[2].'</span>
				<span class="strip">--------------</span>
				<span class="month">'.$row[21].'</span>
				</time>
				<img alt="Independence Day" src="assets/logo airlines/'.$row[42].'.jpg" />
				<div class="col-sm-5 info">
				<h2 class="title">'.$row[5].' - '.$row[24].' <small>(2 Transit)</small></h2>
				<p class="desc" style="font-size:10pt;">From: '.$_SESSION['bandaraawal'].' ('.$row[5].') <br> To: '.$_SESSION['bandaratujuan'].' ('.$row[24].') <br> <b> Flight No: '.$row[30].', '.$row[34].', '.$row[38].' </b> </p>
				</div>
				<div class="harga">
				<p style="padding-top:45px; padding-right:5px; font-size: 16pt;">'.number_format($harga,0,',','.').'IDR </p>
				</div>
				<div class="social">
				<ul>
				<li class="pilih" style="width:20%; visibility: hidden;"><a href="#pilih" disabled></a></li>
				<li class="dropdown detail" style="width:20%;">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-info-circle"></span></a>
				<ul class="dropdown-menu">
				<li><b> '.$row[2].' - '.$row[1].'</b></li>
				<li> '.$bandara1.' ('.$row[5].') </li>
				<li style="background-color: #ededed; font-size:5pt;"> &nbsp; </li>
				<li style="background-color: #ededed;"><b> '.$row[4].'</b> - '.$row[30].' </li>
				<li style="background-color: #ededed; font-size:5pt;"> &nbsp; </li>
				<li><b> '.$row[3].' - '.$date1.'</b> </li>
				<li> '.$bandara2.' ('.$row[6].') </li>
				<li role="separator" class="divider"></li>
				<li><b> '.$row[11].' - '.$row[10].'</b></li>
				<li> '.$bandara2.' ('.$row[14].') </li>
				<li style="background-color: #ededed; font-size:5pt;"> &nbsp; </li>
				<li style="background-color: #ededed;"><b> '.$row[13].'</b> - '.$row[34].' </li>
				<li style="background-color: #ededed; font-size:5pt;"> &nbsp; </li>
				<li><b> '.$row[12].' - '.$date2.'</b> </li>
				<li> '.$bandara3.' ('.$row[23].') </li>
				<li role="separator" class="divider"></li>
				<li><b> '.$row[20].' - '.$row[19].'</b></li>
				<li> '.$bandara3.' ('.$row[23].') </li>
				<li style="background-color: #ededed; font-size:5pt;"> &nbsp; </li>
				<li style="background-color: #ededed;"><b> '.$row[22].'</b> - '.$row[38].' </li>
				<li style="background-color: #ededed; font-size:5pt;"> &nbsp; </li>
				<li><b> '.$row[21].' - '.$date3.'</b> </li>
				<li> '.$bandara4.' ('.$row[24].') </li>
				</ul>
				</li>
				<li class="pilih" style="width:20%;" data-val="'.$value.'" data-harga="'.$harga.'"><a href="/Slider/pembayaran/index.php"><span class="fa fa-check-circle"></span></a></li>
				<li class="pilih" style="width:20%; visibility: hidden;"><a href="#pilih" disabled></a></li>
				</ul>
				</div>
				</li>';
			}
		}
		else{
			echo '';
		}
	}

	//2 transit 12 sama 3 beda
	$tersedia = "SELECT jd1.id_jdpenerbangan, p1.kapasitas_pesawat, jd2.id_jdpenerbangan, p2.kapasitas_pesawat, jd3.id_jdpenerbangan, p3.kapasitas_pesawat
	FROM jadwal_penerbangan jd1
	JOIN jadwal_penerbangan jd2
	JOIN jadwal_penerbangan jd3
	JOIN pesawat p1 ON jd1.id_pesawat = p1.id_pesawat
	JOIN pesawat p2 ON jd2.id_pesawat = p2.id_pesawat
	JOIN pesawat p3 ON jd3.id_pesawat = p3.id_pesawat
	WHERE jd1.lokasi_awal =  '".$_SESSION['lokasiawal']."'
	AND jd1.lokasi_tujuan = jd2.lokasi_awal
	AND jd3.lokasi_awal = jd2.lokasi_tujuan
	AND jd3.lokasi_tujuan =  '".$_SESSION['lokasitujuan']."'
	AND jd1.tanggal_penerbangan =  '".$_SESSION['tanggalberangkat']."'
	AND jd2.tanggal_penerbangan =  '".$_SESSION['tanggalberangkat']."'
	AND jd3.tanggal_penerbangan =  DATE_ADD('".$_SESSION['tanggalberangkat']."', INTERVAL 1 DAY)
	AND jd2.jam_berangkat > jd1.jam_tiba
	AND jd3.jam_berangkat<=jd2.jam_tiba
	AND p1.id_airlines = p2.id_airlines
	AND p2.id_airlines = p3.id_airlines";
	$result=mysqli_query($con, $tersedia);
	while($row=mysqli_fetch_array($result)){
		$terpesan1 = "SELECT SUM( jumlah_passenger ) 
		FROM pesanan
		WHERE id_jdpenerbangan =".$row[0]."";
		$result=mysqli_query($con,$terpesan1);
		$terpesan1=mysqli_fetch_array($result);
		$sisa1=(int)$row[1]-(int)$terpesan1[0]-(int)$_SESSION['jumlah_passengers'];
		$terpesan2 = "SELECT SUM( jumlah_passenger ) 
		FROM pesanan
		WHERE id_jdpenerbangan =".$row[2]."";
		$result=mysqli_query($con,$terpesan2);
		$terpesan2=mysqli_fetch_array($result);
		$sisa2=(int)$row[3]-(int)$terpesan2[0]-(int)$_SESSION['jumlah_passengers'];
		$terpesan3 = "SELECT SUM( jumlah_passenger ) 
		FROM pesanan
		WHERE id_jdpenerbangan =".$row[4]."";
		$result=mysqli_query($con,$terpesan3);
		$terpesan3=mysqli_fetch_array($result);
		$sisa3=(int)$row[5]-(int)$terpesan3[0]-(int)$_SESSION['jumlah_passengers'];
		if($sisa1>0 && $sisa2>0 && $sisa3>0){
			$sql = "SELECT * 
			FROM jadwal_penerbangan jd1
			JOIN jadwal_penerbangan jd2
			JOIN jadwal_penerbangan jd3
			JOIN pesawat p1 ON jd1.id_pesawat = p1.id_pesawat
			JOIN pesawat p2 ON jd2.id_pesawat = p2.id_pesawat
			JOIN pesawat p3 ON jd3.id_pesawat = p3.id_pesawat
			JOIN airlines a ON p1.id_airlines = a.id_airlines
			WHERE jd1.id_jdpenerbangan = ".$row[0]."
			AND jd2.id_jdpenerbangan = ".$row[2]."
			AND jd3.id_jdpenerbangan = ".$row[4]."";
			$result = mysqli_query($con,$sql);
			while ($row=mysqli_fetch_array($result)){
				$value = $row[0]."-".$row[9]."-".$row[18];
				$harga = (int)$row[8]+(int)$row[17]+(int)$row[26];
				if ($row[3]<$row[2]){
					$date1 = date('Y-m-d',strtotime($row[1] . "+1 days"));
				}
				else {
					$date1=$row[1];
				}
				if ($row[12]<$row[11]){
					$date2 = date('Y-m-d',strtotime($row[10] . "+1 days"));
				}
				else {
					$date2=$row[10];
				}
				if ($row[21]<$row[20]){
					$date3 = date('Y-m-d',strtotime($row[19] . "+1 days"));
				}
				else {
					$date3=$row[19];
				}
				$data = file_get_contents('airports.json');
				$airports = json_decode($data);
				foreach($airports as $airport){
					if ($airport->code == $row[5]){
						$bandara1 = $airport->name;
					}
					else if ($airport->code == $row[6]){
						$bandara2 = $airport->name;
					}
					else if ($airport->code == $row[23]){
						$bandara3 = $airport->name;
					}
					else if ($airport->code == $row[24]){
						$bandara4 = $airport->name;
					}
				}
				if ($row[2] < "06.00"){
					$waktuberangkat="subuh";
				}
				else if ($row[2] < "12.00" && $row[2] > "06.00"){
					$waktuberangkat="pagi";	
				}
				else if ($row[2] < "18.00" && $row[2] > "12.00"){
					$waktuberangkat="siang";	
				}
				else if ($row[2] < "24.00" && $row[2] > "18.00"){
					$waktuberangkat="malam";	
				}
				if ($harga < 3000000){
					$rangeharga = "bwh3";
				}
				else if ($harga >= 3000000 && $harga < 5000000){
					$rangeharga = "3smp5";
				}
				else if ($harga >= 5000000 && $harga < 10000000){
					$rangeharga = "5smp10";
				}
				else if ($harga >= 10000000){
					$rangeharga = "ats10";
				}
				echo '<li class="item 2transit '.$waktuberangkat.' '.$row[41].' '.$rangeharga.'">
				<time datetime="'.$row[1].'">
				<span class="day">'.$row[2].'</span>
				<span class="strip">--------------</span>
				<span class="month">'.$row[21].'</span>
				</time>
				<img alt="Independence Day" src="assets/logo airlines/'.$row[42].'.jpg" />
				<div class="col-sm-5 info">
				<h2 class="title">'.$row[5].' - '.$row[24].' <small>(2 Transit)</small></h2>
				<p class="desc" style="font-size:10pt;">From: '.$_SESSION['bandaraawal'].' ('.$row[5].') <br> To: '.$_SESSION['bandaratujuan'].' ('.$row[24].') <br> <b> Flight No: '.$row[30].', '.$row[34].', '.$row[38].' </b> </p>
				</div>
				<div class="harga">
				<p style="padding-top:45px; padding-right:5px; font-size: 16pt;">'.number_format($harga,0,',','.').'IDR </p>
				</div>
				<div class="social">
				<ul>
				<li class="pilih" style="width:20%; visibility: hidden;"><a href="#pilih" disabled></a></li>
				<li class="dropdown detail" style="width:20%;">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-info-circle"></span></a>
				<ul class="dropdown-menu">
				<li><b> '.$row[2].' - '.$row[1].'</b></li>
				<li> '.$bandara1.' ('.$row[5].') </li>
				<li style="background-color: #ededed; font-size:5pt;"> &nbsp; </li>
				<li style="background-color: #ededed;"><b> '.$row[4].'</b> - '.$row[30].' </li>
				<li style="background-color: #ededed; font-size:5pt;"> &nbsp; </li>
				<li><b> '.$row[3].' - '.$date1.'</b> </li>
				<li> '.$bandara2.' ('.$row[6].') </li>
				<li role="separator" class="divider"></li>
				<li><b> '.$row[11].' - '.$row[10].'</b></li>
				<li> '.$bandara2.' ('.$row[14].') </li>
				<li style="background-color: #ededed; font-size:5pt;"> &nbsp; </li>
				<li style="background-color: #ededed;"><b> '.$row[13].'</b> - '.$row[34].' </li>
				<li style="background-color: #ededed; font-size:5pt;"> &nbsp; </li>
				<li><b> '.$row[12].' - '.$date2.'</b> </li>
				<li> '.$bandara3.' ('.$row[23].') </li>
				<li role="separator" class="divider"></li>
				<li><b> '.$row[20].' - '.$row[19].'</b></li>
				<li> '.$bandara3.' ('.$row[23].') </li>
				<li style="background-color: #ededed; font-size:5pt;"> &nbsp; </li>
				<li style="background-color: #ededed;"><b> '.$row[22].'</b> - '.$row[38].' </li>
				<li style="background-color: #ededed; font-size:5pt;"> &nbsp; </li>
				<li><b> '.$row[21].' - '.$date3.'</b> </li>
				<li> '.$bandara4.' ('.$row[24].') </li>
				</ul>
				</li>
				<li class="pilih" style="width:20%;" data-val="'.$value.'" data-harga="'.$harga.'"><a href="/Slider/pembayaran/index.php"><span class="fa fa-check-circle"></span></a></li>
				<li class="pilih" style="width:20%; visibility: hidden;"><a href="#pilih" disabled></a></li>
				</ul>
				</div>
				</li>';
			}
		}
		else{
			echo '';
		}
	}

	//2 transit 1 beda 23 sama
	$tersedia = "SELECT jd1.id_jdpenerbangan, p1.kapasitas_pesawat, jd2.id_jdpenerbangan, p2.kapasitas_pesawat, jd3.id_jdpenerbangan, p3.kapasitas_pesawat
	FROM jadwal_penerbangan jd1
	JOIN jadwal_penerbangan jd2
	JOIN jadwal_penerbangan jd3
	JOIN pesawat p1 ON jd1.id_pesawat = p1.id_pesawat
	JOIN pesawat p2 ON jd2.id_pesawat = p2.id_pesawat
	JOIN pesawat p3 ON jd3.id_pesawat = p3.id_pesawat
	WHERE jd1.lokasi_awal =  '".$_SESSION['lokasiawal']."'
	AND jd1.lokasi_tujuan = jd2.lokasi_awal
	AND jd3.lokasi_awal = jd2.lokasi_tujuan
	AND jd3.lokasi_tujuan =  '".$_SESSION['lokasitujuan']."'
	AND jd1.tanggal_penerbangan =  '".$_SESSION['tanggalberangkat']."'
	AND jd2.tanggal_penerbangan =  DATE_ADD('".$_SESSION['tanggalberangkat']."', INTERVAL 1 DAY)
	AND jd3.tanggal_penerbangan =  DATE_ADD('".$_SESSION['tanggalberangkat']."', INTERVAL 1 DAY)
	AND jd2.jam_berangkat<=jd1.jam_tiba 
	AND jd3.jam_berangkat>jd2.jam_tiba
	AND p1.id_airlines = p2.id_airlines
	AND p2.id_airlines = p3.id_airlines";
	$result=mysqli_query($con, $tersedia);
	while($row=mysqli_fetch_array($result)){
		$terpesan1 = "SELECT SUM( jumlah_passenger ) 
		FROM pesanan
		WHERE id_jdpenerbangan =".$row[0]."";
		$result=mysqli_query($con,$terpesan1);
		$terpesan1=mysqli_fetch_array($result);
		$sisa1=(int)$row[1]-(int)$terpesan1[0]-(int)$_SESSION['jumlah_passengers'];
		$terpesan2 = "SELECT SUM( jumlah_passenger ) 
		FROM pesanan
		WHERE id_jdpenerbangan =".$row[2]."";
		$result=mysqli_query($con,$terpesan2);
		$terpesan2=mysqli_fetch_array($result);
		$sisa2=(int)$row[3]-(int)$terpesan2[0]-(int)$_SESSION['jumlah_passengers'];
		$terpesan3 = "SELECT SUM( jumlah_passenger ) 
		FROM pesanan
		WHERE id_jdpenerbangan =".$row[4]."";
		$result=mysqli_query($con,$terpesan3);
		$terpesan3=mysqli_fetch_array($result);
		$sisa3=(int)$row[5]-(int)$terpesan3[0]-(int)$_SESSION['jumlah_passengers'];
		if($sisa1>0 && $sisa2>0 && $sisa3>0){
			$sql = "SELECT * 
			FROM jadwal_penerbangan jd1
			JOIN jadwal_penerbangan jd2
			JOIN jadwal_penerbangan jd3
			JOIN pesawat p1 ON jd1.id_pesawat = p1.id_pesawat
			JOIN pesawat p2 ON jd2.id_pesawat = p2.id_pesawat
			JOIN pesawat p3 ON jd3.id_pesawat = p3.id_pesawat
			JOIN airlines a ON p1.id_airlines = a.id_airlines
			WHERE jd1.id_jdpenerbangan = ".$row[0]."
			AND jd2.id_jdpenerbangan = ".$row[2]."
			AND jd3.id_jdpenerbangan = ".$row[4]."";
			$result = mysqli_query($con,$sql);
			while ($row=mysqli_fetch_array($result)){
				$value = $row[0]."-".$row[9]."-".$row[18];
				$harga = (int)$row[8]+(int)$row[17]+(int)$row[26];
				if ($row[3]<$row[2]){
					$date1 = date('Y-m-d',strtotime($row[1] . "+1 days"));
				}
				else {
					$date1=$row[1];
				}
				if ($row[12]<$row[11]){
					$date2 = date('Y-m-d',strtotime($row[10] . "+1 days"));
				}
				else {
					$date2=$row[10];
				}
				if ($row[21]<$row[20]){
					$date3 = date('Y-m-d',strtotime($row[19] . "+1 days"));
				}
				else {
					$date3=$row[19];
				}
				$data = file_get_contents('airports.json');
				$airports = json_decode($data);
				foreach($airports as $airport){
					if ($airport->code == $row[5]){
						$bandara1 = $airport->name;
					}
					else if ($airport->code == $row[6]){
						$bandara2 = $airport->name;
					}
					else if ($airport->code == $row[23]){
						$bandara3 = $airport->name;
					}
					else if ($airport->code == $row[24]){
						$bandara4 = $airport->name;
					}
				}
				if ($row[2] < "06.00"){
					$waktuberangkat="subuh";
				}
				else if ($row[2] < "12.00" && $row[2] > "06.00"){
					$waktuberangkat="pagi";	
				}
				else if ($row[2] < "18.00" && $row[2] > "12.00"){
					$waktuberangkat="siang";	
				}
				else if ($row[2] < "24.00" && $row[2] > "18.00"){
					$waktuberangkat="malam";	
				}
				if ($harga < 3000000){
					$rangeharga = "bwh3";
				}
				else if ($harga >= 3000000 && $harga < 5000000){
					$rangeharga = "3smp5";
				}
				else if ($harga >= 5000000 && $harga < 10000000){
					$rangeharga = "5smp10";
				}
				else if ($harga >= 10000000){
					$rangeharga = "ats10";
				}
				echo '<li class="item 2transit '.$waktuberangkat.' '.$row[41].' '.$rangeharga.'">
				<time datetime="'.$row[1].'">
				<span class="day">'.$row[2].'</span>
				<span class="strip">--------------</span>
				<span class="month">'.$row[21].'</span>
				</time>
				<img alt="Independence Day" src="assets/logo airlines/'.$row[42].'.jpg" />
				<div class="col-sm-5 info">
				<h2 class="title">'.$row[5].' - '.$row[24].' <small>(2 Transit)</small></h2>
				<p class="desc" style="font-size:10pt;">From: '.$_SESSION['bandaraawal'].' ('.$row[5].') <br> To: '.$_SESSION['bandaratujuan'].' ('.$row[24].') <br> <b> Flight No: '.$row[30].', '.$row[34].', '.$row[38].' </b> </p>
				</div>
				<div class="harga">
				<p style="padding-top:45px; padding-right:5px; font-size: 16pt;">'.number_format($harga,0,',','.').'IDR </p>
				</div>
				<div class="social">
				<ul>
				<li class="pilih" style="width:20%; visibility: hidden;"><a href="#pilih" disabled></a></li>
				<li class="dropdown detail" style="width:20%;">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-info-circle"></span></a>
				<ul class="dropdown-menu">
				<li><b> '.$row[2].' - '.$row[1].'</b></li>
				<li> '.$bandara1.' ('.$row[5].') </li>
				<li style="background-color: #ededed; font-size:5pt;"> &nbsp; </li>
				<li style="background-color: #ededed;"><b> '.$row[4].'</b> - '.$row[30].' </li>
				<li style="background-color: #ededed; font-size:5pt;"> &nbsp; </li>
				<li><b> '.$row[3].' - '.$date1.'</b> </li>
				<li> '.$bandara2.' ('.$row[6].') </li>
				<li role="separator" class="divider"></li>
				<li><b> '.$row[11].' - '.$row[10].'</b></li>
				<li> '.$bandara2.' ('.$row[14].') </li>
				<li style="background-color: #ededed; font-size:5pt;"> &nbsp; </li>
				<li style="background-color: #ededed;"><b> '.$row[13].'</b> - '.$row[34].' </li>
				<li style="background-color: #ededed; font-size:5pt;"> &nbsp; </li>
				<li><b> '.$row[12].' - '.$date2.'</b> </li>
				<li> '.$bandara3.' ('.$row[23].') </li>
				<li role="separator" class="divider"></li>
				<li><b> '.$row[20].' - '.$row[19].'</b></li>
				<li> '.$bandara3.' ('.$row[23].') </li>
				<li style="background-color: #ededed; font-size:5pt;"> &nbsp; </li>
				<li style="background-color: #ededed;"><b> '.$row[22].'</b> - '.$row[38].' </li>
				<li style="background-color: #ededed; font-size:5pt;"> &nbsp; </li>
				<li><b> '.$row[21].' - '.$date3.'</b> </li>
				<li> '.$bandara4.' ('.$row[24].') </li>
				</ul>
				</li>
				<li class="pilih" style="width:20%;" data-val="'.$value.'" data-harga="'.$harga.'"><a href="/Slider/pembayaran/index.php"><span class="fa fa-check-circle"></span></a></li>
				<li class="pilih" style="width:20%; visibility: hidden;"><a href="#pilih" disabled></a></li>
				</ul>
				</div>
				</li>';
				echo $value;
			}
		}
		else{
			echo '';
		}
	}
	exit();
}
if(isset($_POST['pilih'])){
	$_SESSION['idjdpenerbangan'] = $_POST['idjdpenerbangan'];
	$_SESSION['hargatiket'] = $_POST['hargatiket'];
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>

	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<title></title>
	<style type="text/css">
	@import url("http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,400italic");
	@import url("//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css");
	body {
		padding: 0px 0px;
		background-color: rgb(220, 220, 220);
	}

	.event-list {
		list-style: none;
		font-family: 'Lato', sans-serif;
		margin: 0px;
		padding: 0px;
	}
	.event-list > li {
		background-color: rgb(255, 255, 255);
		box-shadow: 0px 0px 5px rgb(51, 51, 51);
		box-shadow: 0px 0px 5px rgba(51, 51, 51, 0.7);
		padding: 0px;
		margin: 0px 0px 20px;
	}
	.event-list > li > time {
		display: inline-block;
		width: 100%;
		color: rgb(255, 255, 255);
		background-color: #202d47;
		padding: 5px;
		text-align: center;
		text-transform: uppercase;
	}
	.event-list > li:nth-child(even) > time {
		background-color: rgb(165, 82, 167);
	}
	.event-list > li > time > span {
		display: none;
	}
	.event-list > li > time > .day {
		display: block;
		margin-top:10px;
		font-size: 30pt;
		font-weight: 500;
		line-height: 1;
	}
	.event-list > li > time > .strip {
		display: block;
		font-size: 15pt;
		font-weight: 100;
		line-height: 1;
	}
	.event-list > li time > .month {
		display: block;
		font-size: 30pt;
		font-weight: 500;
		line-height: 1;
	}
	.event-list > li > img {
		width: 100%;
	}
	.event-list > li > .info {
		padding-top: 5px;
		text-align: center;
	}
	.event-list > li > .info > .title {
		font-size: 17pt;
		font-weight: 700;
		margin: 0px;
	}
	.event-list > li > .info > .desc {
		font-size: 12pt;
		font-weight: 300;
		margin: 0px;
	}
	.event-list > li > .info > ul,
	.event-list > li > .social > ul {
		display: table;
		list-style: none;
		margin: 10px 0px 0px;
		padding: 0px;
		width: 100%;
		text-align: center;
	}
	.event-list > li > .social > ul {
		margin: 0px;
	}
	.event-list > li > .info > ul > li,
	.event-list > li > .social > ul > li {
		display: table-cell;
		cursor: pointer;
		color: rgb(30, 30, 30);
		font-size: 11pt;
		font-weight: 300;
		padding: 3px 0px;
	}
	.event-list > li > .info > ul > li > a {
		display: block;
		width: 100%;
		color: rgb(30, 30, 30);
		text-decoration: none;
	} 
	.event-list > li > .social > ul > li {    
		padding: 0px;
	}
	.event-list > li > .social > ul > li > a {
		padding: 3px 0px;
	} 
	.event-list > li > .info > ul > li:hover,
	.event-list > li > .social > ul > li:hover {
		color: rgb(30, 30, 30);
		background-color: rgb(200, 200, 200);
	}
	.pilih a{
		display: block;
		width: 100%;
		color: #20a000 !important;
	}
	.pilih:hover a {
		color: rgb(255, 255, 255) !important;
		background-color: #20a000 !important;
	}
	.detail a{
		display: block;
		width: 100%;
		color: #1a2d4c !important;
	}
	.detail:hover a {
		color: rgb(255, 255, 255) !important;
		background-color: #1a2d4c !important;
	}
	@media (min-width: 768px) {
		.event-list > li {
			position: relative;
			display: block;
			width: 100%;
			height: 120px;
			padding: 0px;
		}
		.event-list > li > time,
		.event-list > li > img  {
			display: inline-block;
		}
		.event-list > li > time,
		.event-list > li > img {
			width: 120px;
			float: left;
		}
		.event-list > li > .info {
			background-color: rgb(245, 245, 245);
			overflow: hidden;
		}
		.event-list > li > time,
		.event-list > li > img {
			width: 120px;
			height: 120px;
			padding: 0px;
			margin: 0px;
		}
		.event-list > li > .info {
			background-color: #FFFFFF;
			position: relative;
			height: 120px;
			text-align: left;
			padding-right: 40px;
			padding-top: 15px;
		}	
		.event-list > li > .info > .title, 
		.event-list > li > .info > .desc {
			padding: 0px 10px 0px 10px;
		}
		.event-list > li > .info > ul {
			position: absolute;
			left: 0px;
			bottom: 0px;
		}
		.event-list > li > .social {
			position: absolute;
			top: 0px;
			right: 0px;
			display: block;
			width: 40px;
		}
		.event-list > li > .social > ul {
			border-left: 1px solid rgb(230, 230, 230);
		}
		.event-list > li > .social > ul > li {			
			display: block;
			padding: 0px;
		}
		.event-list > li > .social > ul > li > a {
			display: block;
			width: 40px;
			padding: 10px 0px 9px;
		}
	}

	.process-step .btn:focus{outline:none}
	.process{display:table;width:100%;position:relative}
	.process-row{display:table-row}
	.process-step button[disabled]{opacity:1 !important;filter: alpha(opacity=100) !important}
	.process-row:before{top:40px;bottom:0;position:absolute;content:" ";width:100%;height:1px;background-color:#ccc;z-order:0}
	.process-step{display:table-cell;text-align:center;position:relative}
	.process-step p{margin-top:4px}
	.btn-circle{width:80px;height:80px;text-align:center;font-size:12px;border-radius:50%}

	#wrapper {
		overflow: scroll;
	}
	#wrapper {
		padding-left: 0;
		-webkit-transition: all 0.5s ease;
		-moz-transition: all 0.5s ease;
		-o-transition: all 0.5s ease;
		transition: all 0.5s ease;
	}
	#wrapper.toggled {
		padding-left: 250px;
	}
	#sidebar-wrapper {
		z-index: 1000;
		position: fixed;
		left: 250px;
		width: 0;
		height: 100%;
		margin-left: -250px;
		overflow-y: auto;
		background: #003a40;
		border-right: 4px solid #5cb03b;
		-webkit-transition: all 0.5s ease;
		-moz-transition: all 0.5s ease;
		-o-transition: all 0.5s ease;
		transition: all 0.5s ease;
	}
	.sidebar-header {
		padding: 10px ;
		text-align: center;
		background: #375cfc;
	}
	#wrapper.toggled #sidebar-wrapper {
		width: 250px;
	}
	#page-content-wrapper {
		width: 100%;
		position: absolute;
		padding: 15px;
	}
	#wrapper.toggled #page-content-wrapper {
		position: absolute;
		margin-right: -250px;
	}
	/* Sidebar Styles */
	.sidebar-nav {
		position: absolute;
		top: 0;
		width: 250px;
		margin: 0;
		padding: 0;
		list-style: none;
	}
	.sidebar-nav li {
		background-color: #003a40;
	}
	.sidebar-nav li a {
		display: block;
		padding: 7px 10px;
		text-decoration: none;
		color: #d9e2e3;
	}
	.sidebar-nav li a:hover {
		text-decoration: none;
		color: #fff;
		background: rgba(255, 255, 255, 0.2);
	}
	.sidebar-nav li a:active,
	.sidebar-nav li a:focus {
		text-decoration: none;
	}
	.sidebar-nav li.active > a {
		background: #5cb03b;
		color: #ffffff;
	}
	.sidebar-nav li.parent > a {
		background: #002c31;
		color: #ffffff;
	}
	.sidebar-nav .dropdown li {
		text-indent: 30px;
	}
	.sidebar-nav .dropdown .dropdown-icon {
		position: absolute;
		top: 0;
		right: 4px;
		z-index: 2000;
	}
	.sidebar-nav .dropdown .dropdown-submenu {
		list-style: none;
		padding-left: 0;
	}
	.sidebar-nav .dropdown .dropdown-submenu li {
		text-indent: 10px;
	}
	.sidebar-nav .dropdown .dropdown-submenu .dropdown-submenu li {
		text-indent: 20px;
	}
	.sidebar-nav > .sidebar-brand {
		height: 65px;
		font-size: 18px;
		line-height: 60px;
	}
	.sidebar-nav > .sidebar-brand a {
		color: #999999;
	}
	.sidebar-nav > .sidebar-brand a:hover {
		color: #fff;
		background: none;
	}
	@media (min-width: 768px) {
		#wrapper {
			padding-left: 250px;
		}
		#wrapper.toggled {
			padding-left: 0;
		}
		#sidebar-wrapper {
			width: 250px;
		}
		#wrapper.toggled #sidebar-wrapper {
			width: 0;
		}
		#page-content-wrapper {
			padding: 20px;
			position: relative;
		}
		#wrapper.toggled #page-content-wrapper {
			position: relative;
			margin-right: 0;
		}
		/* The container */
		.container {
			display: block;
			position: relative;
			padding-left: 55px;
			margin-bottom: 12px;
			cursor: pointer;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}
		/* Hide the browser's default checkbox */
		.container input {
			position: absolute;
			opacity: 0;
			cursor: pointer;
		}

		/* Create a custom checkbox */
		.checkmark {
			position: absolute;
			top: 0;
			left: 0;
			height: 20px;
			width: 20px;
			margin-left:30px;
			background-color: #eee;
		}

		/* On mouse-over, add a grey background color */
		.container:hover input ~ .checkmark {
			background-color: #ccc;
		}

		/* When the checkbox is checked, add a blue background */
		.container input:checked ~ .checkmark {
			background-color: #2196F3;
		}

		/* Create the checkmark/indicator (hidden when not checked) */
		.checkmark:after {
			content: "";
			position: absolute;
			display: none;
		}

		/* Show the checkmark when checked */
		.container input:checked ~ .checkmark:after {
			display: block;
		}

		/* Style the checkmark/indicator */
		.container .checkmark:after {
			left: 9px;
			top: 5px;
			width: 5px;
			height: 10px;
			border: solid white;
			border-width: 0 3px 3px 0;
			-webkit-transform: rotate(45deg);
			-ms-transform: rotate(45deg);
			transform: rotate(45deg);
		}
		/* detail */
		@media only screen and (min-width: 768px) {
			.dropdown:hover .dropdown-menu {
				display: block;
			}
		}
	</style>

	<script type="text/javascript">
		$(document).ready(function(){
			showdata();
			showmaskapai();
			var maskapai;
			$.ajax({
				url : "filterow.php",
				type : "POST",
				async : false,
				cache : false,
				data : {
					setmaskapai : 1
				},
				dataType: "json",
				success: function(result){
					maskapai = result;
				}
			});
			$(".event-list").on("click", ".pilih", function(){
				var a = $(this).data("val");
				var b = $(this).data("harga");
				$.ajax({
					url : "filterow.php",
					type : "POST",
					async : false,
					cache : false,
					data : {
						pilih : 1,
						idjdpenerbangan : a,
						hargatiket : b
					},
					success: function(result){
					}
				});
			});

			$(".sidebar-nav").on("click", ".filter", function(){
			if ($(".filterlangsung").prop("checked")==false){
				$(".item.langsung").hide();
			}
			else if($(".filterlangsung").prop("checked")==true){
				$(".item.langsung").show();
				if ($(".filtersubuh").prop("checked")==false){
					$(".item.langsung.subuh").hide();
				}
				else if($(".filtersubuh").prop("checked")==true){
					$(".item.langsung.subuh").show();
					if ($(".filterbwh3").prop("checked")==false){
						$(".item.langsung.subuh.bwh3").hide();
					}
					else if($(".filterbwh3").prop("checked")==true){
						$(".item.langsung.subuh.bwh3").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.langsung.subuh.bwh3."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.langsung.subuh.bwh3."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filter3smp5").prop("checked")==false){
						$(".item.langsung.subuh.3smp5").hide();
					}
					else if($(".filter3smp5").prop("checked")==true){
						$(".item.langsung.subuh.3smp5").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.langsung.subuh.3smp5."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.langsung.subuh.3smp5."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filter5smp10").prop("checked")==false){
						$(".item.langsung.subuh.5smp10").hide();
					}
					else if($(".filter5smp10").prop("checked")==true){
						$(".item.langsung.subuh.5smp10").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.langsung.subuh.5smp10."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.langsung.subuh.5smp10."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filterats10").prop("checked")==false){
						$(".item.langsung.subuh.ats10").hide();
					}
					else if($(".filterats10").prop("checked")==true){
						$(".item.langsung.subuh.ats10").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.langsung.subuh.ats10."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.langsung.subuh.ats10."+maskapai[i].kode_airlines).show();
							}
						}
					}
				}
				if ($(".filterpagi").prop("checked")==false){
					$(".item.langsung.pagi").hide();
				}
				else if($(".filterpagi").prop("checked")==true){
					$(".item.langsung.pagi").show();
					if ($(".filterbwh3").prop("checked")==false){
						$(".item.langsung.pagi.bwh3").hide();
					}
					else if($(".filterbwh3").prop("checked")==true){
						$(".item.langsung.pagi.bwh3").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.langsung.pagi.bwh3."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.langsung.pagi.bwh3."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filter3smp5").prop("checked")==false){
						$(".item.langsung.pagi.3smp5").hide();
					}
					else if($(".filter3smp5").prop("checked")==true){
						$(".item.langsung.pagi.3smp5").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.langsung.pagi.3smp5."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.langsung.pagi.3smp5."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filter5smp10").prop("checked")==false){
						$(".item.langsung.pagi.5smp10").hide();
					}
					else if($(".filter5smp10").prop("checked")==true){
						$(".item.langsung.pagi.5smp10").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.langsung.pagi.5smp10."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.langsung.pagi.5smp10."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filterats10").prop("checked")==false){
						$(".item.langsung.pagi.ats10").hide();
					}
					else if($(".filterats10").prop("checked")==true){
						$(".item.langsung.pagi.ats10").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.langsung.pagi.ats10."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.langsung.pagi.ats10."+maskapai[i].kode_airlines).show();
							}
						}
					}
				}
				if ($(".filtersiang").prop("checked")==false){
					$(".item.langsung.siang").hide();
				}
				else if($(".filtersiang").prop("checked")==true){
					$(".item.langsung.siang").show();
					if ($(".filterbwh3").prop("checked")==false){
						$(".item.langsung.siang.bwh3").hide();
					}
					else if($(".filterbwh3").prop("checked")==true){
						$(".item.langsung.siang.bwh3").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.langsung.siang.bwh3."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.langsung.siang.bwh3."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filter3smp5").prop("checked")==false){
						$(".item.langsung.siang.3smp5").hide();
					}
					else if($(".filter3smp5").prop("checked")==true){
						$(".item.langsung.siang.3smp5").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.langsung.siang.3smp5."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.langsung.siang.3smp5."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filter5smp10").prop("checked")==false){
						$(".item.langsung.siang.5smp10").hide();
					}
					else if($(".filter5smp10").prop("checked")==true){
						$(".item.langsung.siang.5smp10").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.langsung.siang.5smp10."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.langsung.siang.5smp10."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filterats10").prop("checked")==false){
						$(".item.langsung.siang.ats10").hide();
					}
					else if($(".filterats10").prop("checked")==true){
						$(".item.langsung.siang.ats10").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.langsung.siang.ats10."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.langsung.siang.ats10."+maskapai[i].kode_airlines).show();
							}
						}
					}
				}
				if ($(".filtermalam").prop("checked")==false){
					$(".item.langsung.malam").hide();
				}
				else if($(".filtermalam").prop("checked")==true){
					$(".item.langsung.malam").show();
					if ($(".filterbwh3").prop("checked")==false){
						$(".item.langsung.malam.bwh3").hide();
					}
					else if($(".filterbwh3").prop("checked")==true){
						$(".item.langsung.malam.bwh3").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.langsung.malam.bwh3."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.langsung.malam.bwh3."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filter3smp5").prop("checked")==false){
						$(".item.langsung.malam.3smp5").hide();
					}
					else if($(".filter3smp5").prop("checked")==true){
						$(".item.langsung.malam.3smp5").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.langsung.malam.3smp5."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.langsung.malam.3smp5."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filter5smp10").prop("checked")==false){
						$(".item.langsung.malam.5smp10").hide();
					}
					else if($(".filter5smp10").prop("checked")==true){
						$(".item.langsung.malam.5smp10").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.langsung.malam.5smp10."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.langsung.malam.5smp10."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filterats10").prop("checked")==false){
						$(".item.langsung.malam.ats10").hide();
					}
					else if($(".filterats10").prop("checked")==true){
						$(".item.langsung.malam.ats10").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.langsung.malam.ats10."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.langsung.malam.ats10."+maskapai[i].kode_airlines).show();
							}
						}
					}
				}
			}
			if ($(".filter1transit").prop("checked")==false){
				$(".item.1transit").hide();
			}
			else if($(".filter1transit").prop("checked")==true){
				$(".item.1transit").show();
				if ($(".filtersubuh").prop("checked")==false){
					$(".item.1transit.subuh").hide();
				}
				else if($(".filtersubuh").prop("checked")==true){
					$(".item.1transit.subuh").show();
					if ($(".filterbwh3").prop("checked")==false){
						$(".item.1transit.subuh.bwh3").hide();
					}
					else if($(".filterbwh3").prop("checked")==true){
						$(".item.1transit.subuh.bwh3").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.1transit.subuh.bwh3."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.1transit.subuh.bwh3."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filter3smp5").prop("checked")==false){
						$(".item.1transit.subuh.3smp5").hide();
					}
					else if($(".filter3smp5").prop("checked")==true){
						$(".item.1transit.subuh.3smp5").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.1transit.subuh.3smp5."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.1transit.subuh.3smp5."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filter5smp10").prop("checked")==false){
						$(".item.1transit.subuh.5smp10").hide();
					}
					else if($(".filter5smp10").prop("checked")==true){
						$(".item.1transit.subuh.5smp10").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.1transit.subuh.5smp10."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.1transit.subuh.5smp10."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filterats10").prop("checked")==false){
						$(".item.1transit.subuh.ats10").hide();
					}
					else if($(".filterats10").prop("checked")==true){
						$(".item.1transit.subuh.ats10").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.1transit.subuh.ats10."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.1transit.subuh.ats10."+maskapai[i].kode_airlines).show();
							}
						}
					}
				}
				if ($(".filterpagi").prop("checked")==false){
					$(".item.1transit.pagi").hide();
				}
				else if($(".filterpagi").prop("checked")==true){
					$(".item.1transit.pagi").show();
					if ($(".filterbwh3").prop("checked")==false){
						$(".item.1transit.pagi.bwh3").hide();
					}
					else if($(".filterbwh3").prop("checked")==true){
						$(".item.1transit.pagi.bwh3").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.1transit.pagi.bwh3."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.1transit.pagi.bwh3."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filter3smp5").prop("checked")==false){
						$(".item.1transit.pagi.3smp5").hide();
					}
					else if($(".filter3smp5").prop("checked")==true){
						$(".item.1transit.pagi.3smp5").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.1transit.pagi.3smp5."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.1transit.pagi.3smp5."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filter5smp10").prop("checked")==false){
						$(".item.1transit.pagi.5smp10").hide();
					}
					else if($(".filter5smp10").prop("checked")==true){
						$(".item.1transit.pagi.5smp10").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.1transit.pagi.5smp10."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.1transit.pagi.5smp10."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filterats10").prop("checked")==false){
						$(".item.1transit.pagi.ats10").hide();
					}
					else if($(".filterats10").prop("checked")==true){
						$(".item.1transit.pagi.ats10").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.1transit.pagi.ats10."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.1transit.pagi.ats10."+maskapai[i].kode_airlines).show();
							}
						}
					}
				}
				if ($(".filtersiang").prop("checked")==false){
					$(".item.1transit.siang").hide();
				}
				else if($(".filtersiang").prop("checked")==true){
					$(".item.1transit.siang").show();
					if ($(".filterbwh3").prop("checked")==false){
						$(".item.1transit.siang.bwh3").hide();
					}
					else if($(".filterbwh3").prop("checked")==true){
						$(".item.1transit.siang.bwh3").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.1transit.siang.bwh3."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.1transit.siang.bwh3."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filter3smp5").prop("checked")==false){
						$(".item.1transit.siang.3smp5").hide();
					}
					else if($(".filter3smp5").prop("checked")==true){
						$(".item.1transit.siang.3smp5").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.1transit.siang.3smp5."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.1transit.siang.3smp5."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filter5smp10").prop("checked")==false){
						$(".item.1transit.siang.5smp10").hide();
					}
					else if($(".filter5smp10").prop("checked")==true){
						$(".item.1transit.siang.5smp10").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.1transit.siang.5smp10."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.1transit.siang.5smp10."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filterats10").prop("checked")==false){
						$(".item.1transit.siang.ats10").hide();
					}
					else if($(".filterats10").prop("checked")==true){
						$(".item.1transit.siang.ats10").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.1transit.siang.ats10."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.1transit.siang.ats10."+maskapai[i].kode_airlines).show();
							}
						}
					}
				}
				if ($(".filtermalam").prop("checked")==false){
					$(".item.1transit.malam").hide();
				}
				else if($(".filtermalam").prop("checked")==true){
					$(".item.1transit.malam").show();
					if ($(".filterbwh3").prop("checked")==false){
						$(".item.1transit.malam.bwh3").hide();
					}
					else if($(".filterbwh3").prop("checked")==true){
						$(".item.1transit.malam.bwh3").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.1transit.malam.bwh3."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.1transit.malam.bwh3."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filter3smp5").prop("checked")==false){
						$(".item.1transit.malam.3smp5").hide();
					}
					else if($(".filter3smp5").prop("checked")==true){
						$(".item.1transit.malam.3smp5").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.1transit.malam.3smp5."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.1transit.malam.3smp5."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filter5smp10").prop("checked")==false){
						$(".item.1transit.malam.5smp10").hide();
					}
					else if($(".filter5smp10").prop("checked")==true){
						$(".item.1transit.malam.5smp10").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.1transit.malam.5smp10."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.1transit.malam.5smp10."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filterats10").prop("checked")==false){
						$(".item.1transit.malam.ats10").hide();
					}
					else if($(".filterats10").prop("checked")==true){
						$(".item.1transit.subuh.malam").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.1transit.malam.ats10."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.1transit.malam.ats10."+maskapai[i].kode_airlines).show();
							}
						}
					}
				}
			}
			if ($(".filter2transit").prop("checked")==false){
				$(".item.2transit").hide();
			}
			else if($(".filter2transit").prop("checked")==true){
				$(".item.2transit").show();
				if ($(".filtersubuh").prop("checked")==false){
					$(".item.2transit.subuh").hide();
				}
				else if($(".filtersubuh").prop("checked")==true){
					$(".item.2transit.subuh").show();
					if ($(".filterbwh3").prop("checked")==false){
						$(".item.2transit.subuh.bwh3").hide();
					}
					else if($(".filterbwh3").prop("checked")==true){
						$(".item.2transit.subuh.bwh3").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.2transit.subuh.bwh3."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.2transit.subuh.bwh3."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filter3smp5").prop("checked")==false){
						$(".item.2transit.subuh.3smp5").hide();
					}
					else if($(".filter3smp5").prop("checked")==true){
						$(".item.2transit.subuh.3smp5").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.2transit.subuh.3smp5."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.2transit.subuh.3smp5."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filter5smp10").prop("checked")==false){
						$(".item.2transit.subuh.5smp10").hide();
					}
					else if($(".filter5smp10").prop("checked")==true){
						$(".item.2transit.subuh.5smp10").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.2transit.subuh.5smp10."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.2transit.subuh.5smp10."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filterats10").prop("checked")==false){
						$(".item.2transit.subuh.ats10").hide();
					}
					else if($(".filterats10").prop("checked")==true){
						$(".item.2transit.subuh.ats10").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.2transit.subuh.ats10."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.2transit.subuh.ats10."+maskapai[i].kode_airlines).show();
							}
						}
					}
				}
				if ($(".filterpagi").prop("checked")==false){
					$(".item.2transit.pagi").hide();
				}
				else if($(".filterpagi").prop("checked")==true){
					$(".item.2transit.pagi").show();
					if ($(".filterbwh3").prop("checked")==false){
						$(".item.2transit.pagi.bwh3").hide();
					}
					else if($(".filterbwh3").prop("checked")==true){
						$(".item.2transit.pagi.bwh3").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.2transit.pagi.bwh3."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.2transit.pagi.bwh3."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filter3smp5").prop("checked")==false){
						$(".item.2transit.pagi.3smp5").hide();
					}
					else if($(".filter3smp5").prop("checked")==true){
						$(".item.2transit.pagi.3smp5").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.2transit.pagi.3smp5."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.2transit.pagi.3smp5."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filter5smp10").prop("checked")==false){
						$(".item.2transit.pagi.5smp10").hide();
					}
					else if($(".filter5smp10").prop("checked")==true){
						$(".item.2transit.pagi.5smp10").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.2transit.pagi.5smp10."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.2transit.pagi.5smp10."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filterats10").prop("checked")==false){
						$(".item.2transit.pagi.ats10").hide();
					}
					else if($(".filterats10").prop("checked")==true){
						$(".item.2transit.pagi.ats10").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.2transit.pagi.ats10."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.2transit.pagi.ats10."+maskapai[i].kode_airlines).show();
							}
						}
					}
				}
				if ($(".filtersiang").prop("checked")==false){
					$(".item.2transit.siang").hide();
				}
				else if($(".filtersiang").prop("checked")==true){
					$(".item.2transit.siang").show();
					if ($(".filterbwh3").prop("checked")==false){
						$(".item.2transit.siang.bwh3").hide();
					}
					else if($(".filterbwh3").prop("checked")==true){
						$(".item.2transit.siang.bwh3").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.2transit.siang.bwh3."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.2transit.siang.bwh3."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filter3smp5").prop("checked")==false){
						$(".item.2transit.siang.3smp5").hide();
					}
					else if($(".filter3smp5").prop("checked")==true){
						$(".item.2transit.siang.3smp5").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.2transit.siang.3smp5."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.2transit.siang.3smp5."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filter5smp10").prop("checked")==false){
						$(".item.2transit.siang.5smp10").hide();
					}
					else if($(".filter5smp10").prop("checked")==true){
						$(".item.2transit.siang.5smp10").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.2transit.siang.5smp10."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.2transit.siang.5smp10."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filterats10").prop("checked")==false){
						$(".item.2transit.siang.ats10").hide();
					}
					else if($(".filterats10").prop("checked")==true){
						$(".item.2transit.siang.ats10").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.2transit.siang.ats10."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.2transit.siang.ats10."+maskapai[i].kode_airlines).show();
							}
						}
					}
				}
				if ($(".filtermalam").prop("checked")==false){
					$(".item.2transit.malam").hide();
				}
				else if($(".filtermalam").prop("checked")==true){
					$(".item.2transit.malam").show();
					if ($(".filterbwh3").prop("checked")==false){
						$(".item.2transit.malam.bwh3").hide();
					}
					else if($(".filterbwh3").prop("checked")==true){
						$(".item.2transit.malam.bwh3").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.2transit.malam.bwh3."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.2transit.malam.bwh3."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filter3smp5").prop("checked")==false){
						$(".item.2transit.malam.3smp5").hide();
					}
					else if($(".filter3smp5").prop("checked")==true){
						$(".item.2transit.malam.3smp5").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.2transit.malam.3smp5."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.2transit.malam.3smp5."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filter5smp10").prop("checked")==false){
						$(".item.2transit.malam.5smp10").hide();
					}
					else if($(".filter5smp10").prop("checked")==true){
						$(".item.2transit.malam.5smp10").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.2transit.malam.5smp10."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.2transit.malam.5smp10."+maskapai[i].kode_airlines).show();
							}
						}
					}
					if ($(".filterats10").prop("checked")==false){
						$(".item.2transit.malam.ats10").hide();
					}
					else if($(".filterats10").prop("checked")==true){
						$(".item.2transit.malam.ats10").show();
						for (var i=0;i<maskapai.length;i++){
							if($("."+maskapai[i].kode_airlines).prop("checked")==false){
								$(".item.2transit.malam.ats10."+maskapai[i].kode_airlines).hide();
							}
							else if($("."+maskapai[i].kode_airlines).prop("checked")==true){
								$(".item.2transit.malam.ats10."+maskapai[i].kode_airlines).show();
							}
						}
					}
				}
			}
			
		});

$('#sidebar-wrapper .dropdown-submenu').hide();
$('#sidebar-wrapper .dropdown').append('<a href="#" class="dropdown-icon"><span class="caret"></span></a>');

$('#sidebar-wrapper .dropdown-icon').click(function () {
	$(this).closest('.dropdown').find('.dropdown-submenu').first().slideToggle();
});

});
function showdata(){
	$.ajax({
		url : "filterow.php",
		type : "POST",
		async : false,
		cache : false,
		data : {
			showdata : 1
		},
		success: function(result){
			$(".event-list").html(result);
		}
	});
}
function showmaskapai(){
	$.ajax({
		url : "filterow.php",
		type : "POST",
		async : false,
		cache : false,
		data : {
			showmaskapai : 1
		},
		success: function(result){
			$(".maskapai").html(result);
		}
	});
}
</script>
</head>
<body>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Popper.JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
	<!-- Bootstrap JS -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
	
	<div id="sidebar-wrapper">
		<ul class="sidebar-nav">
			<li class="sidebar-header">
				<img src="assets/logo_company.png" class="brand_logo" alt="Logo">
			</li>
			<li class="dropdown">
				<a disabled style="font-weight: bolder;">Transit</a>
				<ul class="dropdown-submenu" role="menu">
					<li><label class="container" style="color: #FFFFFF;">Langsung
						<input type="checkbox" class="filter filterlangsung" checked>
						<span class="checkmark"></span>
					</label></li>
					<li><label class="container" style="color: #FFFFFF;">1 Transit
						<input type="checkbox" class="filter filter1transit" checked>
						<span class="checkmark"></span>
					</label></li>
					<li><label class="container" style="color: #FFFFFF;">2 Transit
						<input type="checkbox" class="filter filter2transit" checked>
						<span class="checkmark"></span>
					</label></li>
				</ul>
			</li>
			<li class="dropdown">
				<a style="font-weight: bolder;">Maskapai</a>
				<ul class="dropdown-submenu maskapai" role="menu">
				</ul>
			</li>
			<li class="dropdown">
				<a style="font-weight: bolder;">Waktu Berangkat</a>
				<ul class="dropdown-submenu waktu" role="menu">
					<li><label class="container" style="color: #FFFFFF;">00.00-06.00
						<input type="checkbox" class="filter filtersubuh" checked>
						<span class="checkmark"></span>
					</label></li>
					<li><label class="container" style="color: #FFFFFF;">06.00-12.00
						<input type="checkbox" class="filter filterpagi" checked>
						<span class="checkmark"></span>
					</label></li>
					<li><label class="container" style="color: #FFFFFF;">12.00-18.00
						<input type="checkbox" class="filter filtersiang" checked>
						<span class="checkmark"></span>
					</label></li>
					<li><label class="container" style="color: #FFFFFF;">18.00-00.00
						<input type="checkbox" class="filter filtermalam" checked>
						<span class="checkmark"></span>
					</label></li>
				</ul>
			</li>
			<li class="dropdown">
				<a style="font-weight: bolder;">Harga Tiket</a>
				<ul class="dropdown-submenu waktu" role="menu">
					<li><label class="container" style="color: #FFFFFF;"> < 3.000.000
						<input type="checkbox" class="filter filterbwh3" checked>
						<span class="checkmark"></span>
					</label></li>
					<li><label class="container" style="color: #FFFFFF;"> 3.000.000-5.000.000
						<input type="checkbox" class="filter filter3smp5" checked>
						<span class="checkmark"></span>
					</label></li>
					<li><label class="container" style="color: #FFFFFF;"> 5.000.000-10.000.000
						<input type="checkbox" class="filter filter5smp10" checked>
						<span class="checkmark"></span>
					</label></li>
					<li><label class="container" style="color: #FFFFFF;"> > 10.000.000
						<input type="checkbox" class="filter filterats10" checked>
						<span class="checkmark"></span>
					</label></li>
				</ul>
			</li>
		</ul>

	</div>

	<div class="container" style="margin-left:300px;">
		<br><br><br>
		<div class="row">
			<div class="process">
				<div class="process-row nav nav-tabs">
					<div class="process-step">
						<button type="button" class="btn btn-info btn-circle" data-toggle="tab" href="#menu1"><i class="fa fa-plane fa-3x"></i></button>
						<p><small>Pilih Tiket Berangkat</small></p>
					</div>
				</div>
			</div>
			<div class="tab-content">
				<div id="menu1" class="tab-pane fade active in">
					<div class="row">
						<div class="[ col-xs-12 col-sm-offset-2 col-sm-8 ]">
							<ul class="event-list">
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>