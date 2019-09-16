<?php
include "connect.php";
session_start();
if (!isset($_SESSION['iduser']) || !isset($_SESSION['lokasiawal'])){
	header('Location:main.php');
}
if(isset($_POST['showdata'])){
	$tersedia = "SELECT jp.id_jdpenerbangan, p.kapasitas_pesawat
	FROM jadwal_penerbangan jp
	JOIN pesawat p ON jp.id_pesawat = p.id_pesawat
	JOIN airlines a ON p.id_airlines = a.id_airlines
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
				echo '<li>
				<time datetime="'.$row['tanggal_penerbangan'].'">
				<span class="day">'.$row['jam_berangkat'].'</span>
				<span class="strip">--------------</span>
				<span class="month">'.$row['jam_tiba'].'</span>
				</time>
				<img alt="Independence Day" src="assets/logo airlines/'.$row['foto_airlines'].'.jpg" />
				<div class="col-sm-5 info">
				<h2 class="title">'.$row['lokasi_awal'].' - '.$row['lokasi_tujuan'].'</h2>
				<p class="desc" style="font-size:11pt;">From: '.$_SESSION['bandaraawal'].' ('.$row['lokasi_awal'].') <br> To: '.$_SESSION['bandaratujuan'].' ('.$row['lokasi_tujuan'].') <br> <b> Flight No: '.$row['kode_pesawat'].' </b> </p>
				</div>
				<div class="harga">
				<p style="padding-top:45px; padding-right:5px; font-size: 16pt;">'.number_format($row['harga'],0,',','.').'IDR </p>
				</div>
				<div class="social">
				<ul>
				<li class="pilih" style="width:20%; visibility: hidden;"><a href="#pilih" disabled></a></li>
				<li class="pilih" style="width:20%; visibility: hidden;"><a href="#pilih" disabled></a></li>
				<li class="pilih" style="width:20%;" value="'.$row['id_jdpenerbangan'].'"><a href="/Slider/pembayaran/index.php"><span class="fa fa-check-circle"></span></a></li>
				<li class="pilih" style="width:20%; visibility: hidden;"><a href="#pilih" disabled></a></li>
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
	exit();
}
if(isset($_POST['pilih'])){
	$_SESSION['idjdpenerbangan'] = $_POST['idjdpenerbangan'];
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
		padding: 60px 0px;
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

	@import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";
	body {
		/*font-family: 'Poppins', sans-serif;*/
		background: #E9ECEF;
	}

	p {
		/*font-family: 'Poppins', sans-serif;*/
		font-size: 1.1em;
		font-weight: 300;
		line-height: 1.7em;
		color: #999;
	}

	a, a:hover, a:focus {
		color: inherit;
		text-decoration: none;
		transition: all 0.3s;
	}

	.jumbotron {
		margin-left : 250px;
	}

	#sidebar {
		/* don't forget to add all the previously mentioned styles here too */
		transition: all 0.3s;
		width: 250px;
		position: fixed;
		top: 0;
		left: 0;
		height: 100vh;
		/*z-index: 999;*/
		background: #375cfc;
		color: #fff;
	}

	#sidebar .sidebar-header {
		padding: 10px ;
		text-align: center;
		background: #375cfc;
	}

	#sidebar ul.components {
		padding: 20px 0;
		border-bottom: 1px solid #47748b;
	}
	#sidebar button {           
		margin-left: 10px;
		text-align: center;
		width: 90%;
	}

	#sidebar ul p {
		color: #fff;
		padding: 10px;
	}

	#sidebar ul li a {
		padding: 10px;
		font-size: 1.1em;
		display: block;
	}
	#sidebar ul li a:hover {
		color: #7386D5;
		background: #fff;
	}

	#sidebar ul li.active > a, a[aria-expanded="true"] {
		color: #7386D5;
		background: white;
	}
	ul ul a {
		font-size: 0.9em !important;
		padding-left: 30px !important;
		background: #5172ff;
	}
	.wrapper {
		display: flex;
		width: 100%;
	}
	a[data-toggle="collapse"] {
		position: relative;
	}

	.dropdown-toggle::after {
		display: block;
		position: absolute;
		top: 50%;
		right: 20px;
		transform: translateY(-50%);
	}
	.btn {
		-webkit-transition: 0.2s;
		-moz-transition: 0.2s;
		-o-transition: 0.2s;
		-ms-transition: 0.2s;
		transition: 0.2s;
		-webkit-border-radius: 3px;
		border-radius: 3px;
	}
	.btn:hover {
		-webkit-border-radius: 10px;
		border-radius: 10px;
	}
	.btn > .fa,
	.btn > .im {
		margin: 0 5px;
	}
	.btn-primary {
		background: #68d8d8;
		border-color: #66D7D7;
	}
	.btn-primary:hover {
		background: #68d8d8;
		border-color: #66D7D7;
	}
</style>

<script type="text/javascript">
	$(document).ready(function(){
		showdata();
		$(".event-list").on("click", ".pilih", function(){
			var a = $(this).val();
			$.ajax({
				url : "filterow.php",
				type : "POST",
				async : false,
				cache : false,
				data : {
					pilih : 1,
					idjdpenerbangan : a
				},
				success: function(result){

				}
			});
		});
		$(".filter").on("click", function(){
			$(".filter").closest("li").removeClass("active");
			if($(this).parent().attr("class") == 'dropdown'){
				$('.components').on('shown.bs.tab', '.filter', function (e) {
					if (e.relatedTarget) {
						$(e.relatedTarget).removeClass('active');
					}
				});
			}
			else{
				if($(this).html() == "Debit" || $(this).html() == "Kredit"){}
					else{
						$(".collapse").removeClass("show");
						$(".toogle").attr("aria-expanded","false"); 
					}
					$(this).closest("li").addClass("active");
					showdata($(this).attr("name"));
					if($(this).html()=="Customer"){
						$(".Customer").show(); 
						$(".Airline").hide();
						$(".Pesawat").hide();
						$(".Airport").hide();
						$(".Debit").hide();
						$(".Kredit").hide();
						$(".JadwalPenerbangan").hide();
						$(".Kursi").hide();
						$(".Pesanan").hide();
					}
					else if($(this).html()=="Airline"){
						$(".Customer").hide();
						$(".Airline").show();
						$(".Pesawat").hide();
						$(".Airport").hide();
						$(".Debit").hide();
						$(".Kredit").hide();
						$(".JadwalPenerbangan").hide();
						$(".Kursi").hide();
						$(".Pesanan").hide();    
					}
					else if($(this).html()=="Pesawat"){
						$(".Customer").hide();
						$(".Airline").hide();
						$(".Pesawat").show();
						$(".Airport").hide();
						$(".Debit").hide();
						$(".Kredit").hide();
						$(".JadwalPenerbangan").hide();
						$(".Kursi").hide();
						$(".Pesanan").hide();    
					}
					else if($(this).html()=="Airport"){
						$(".Customer").hide();
						$(".Airline").hide();
						$(".Pesawat").hide();
						$(".Airport").show();
						$(".Debit").hide();
						$(".Kredit").hide();
						$(".JadwalPenerbangan").hide();
						$(".Kursi").hide();
						$(".Pesanan").hide();    
					}
					else if($(this).html()=="Debit"){
						$(".Customer").hide();
						$(".Airline").hide();
						$(".Pesawat").hide();
						$(".Airport").hide();
						$(".Debit").show();
						$(".Kredit").hide();
						$(".JadwalPenerbangan").hide();
						$(".Kursi").hide();
						$(".Pesanan").hide();    
					}
					else if($(this).html()=="Kredit"){
						$(".Customer").hide();
						$(".Airline").hide();
						$(".Pesawat").hide();
						$(".Airport").hide();
						$(".Debit").hide();
						$(".Kredit").show();
						$(".JadwalPenerbangan").hide();
						$(".Kursi").hide();
						$(".Pesanan").hide();    
					}
					else if($(this).html()=="Jadwal Penerbangan"){
						$(".Customer").hide();
						$(".Airline").hide();
						$(".Pesawat").hide();
						$(".Airport").hide();
						$(".Debit").hide();
						$(".Kredit").hide();
						$(".JadwalPenerbangan").show();
						$(".Kursi").hide();
						$(".Pesanan").hide();    
					}
				}
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
</script>
</head>
<body>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Popper.JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
	<!-- Bootstrap JS -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
	<div class="wrapper">
		<!-- Sidebar -->
		<nav id="sidebar">
			<div class="sidebar-header">
				<img src="assets/logo_company.png" class="brand_logo" alt="Logo">
			</div>

			<ul class="list-unstyled components">
				<li>
					<a href="#" name="Customer" class="filter">Customer</a>
				</li>
				<li>
					<a href="#" name="Airline" class="filter">Airline</a>
				</li>
				<li>
					<a href="#" name="Pesawat" class="filter">Pesawat</a>
				</li>
				<li>
					<a href="#" name="Airport" class="filter">Airport</a>
				</li>
				<li class="dropdown">
					<a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle toogle filter">Bank</a>
					<ul class="collapse list-unstyled" id="pageSubmenu">
						<li>
							<a href="#" name="Bank Debit">Debit</a>
						</li>
						<li>
							<a href="#" name="Bank Kredit">Kredit</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#" name="Jadwal Penerbangan" class="filter">Jadwal Penerbangan</a>
				</li>
                <!-- <li>
                    <a href="#" name="Kursi">Kursi</a>
                </li>
                <li>
                    <a href="#" name="Pesanan">Pesanan</a>
                </li> -->
            </ul>
            <form action="logout.php" method="post">
            	<button type="submit" class="btn btn-primary logOut">Log Out</button>
            </form>
        </nav>
    </div>
    <div class="container" style="margin-left:300px;">
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
									<!-- <li>
										<time datetime="2014-07-20">
											<span class="day">13.00</span>
											<span class="strip">--------------</span>
											<span class="month">15.00</span>
											<span class="time">ALL DAY</span>
										</time>
										<img alt="Independence Day" src="assets/logo airlines/airasia.jpg" />
										<div class="col-sm-5 info">
											<h2 class="title">SBY - CGK</h2>
											<p class="desc">From: Juanda (SBY) <br> To: Soekarno-Hatta (CGK) <br> <b> Flight No: QZ-801 </b> </p>
										</div>
										<div class="harga">
											<p style="padding-top:45px; padding-right:5px; font-size: 16pt;">1.096.000IDR</p>
										</div>
										<div class="social">
											<ul>
												<li class="facebook" style="width:20%; visibility: hidden;"><a href="#facebook" disabled></a></li>
												<li class="facebook" style="width:20%; visibility: hidden;"><a href="#facebook" disabled></a></li>
												<li class="facebook" style="width:20%;"><a href="#facebook"><span class="fa fa-check-circle"></span></a></li>
												<li class="facebook" style="width:20%; visibility: hidden;"><a href="#facebook" disabled></a></li>
												<li class="facebook" style="width:20%; visibility: hidden;"><a href="#facebook" disabled></a></li>
											</ul>
										</div>
									</li> -->

									
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	</html>