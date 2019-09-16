<?php
	include "../connect.php";
	session_start();
	if (!isset($_SESSION['iduser']) || !isset($_SESSION['idjdpenerbangan'])){
		header("Location:../main.php");
	}
	$keterangan="";
	if (substr_count($_SESSION['idjdpenerbangan'], '-')==1){
		$keterangan="1transit";
	}
	else if (substr_count($_SESSION['idjdpenerbangan'], '-')==2){
		$keterangan="2transit";
	}
	else{
		$keterangan="langsung";
	}
	if(isset($_POST['showpemesan'])){
		$sql = "SELECT * FROM customers WHERE id_customer=".$_SESSION['iduser']."";
		$result = mysqli_query($con,$sql);
		while($row=mysqli_fetch_array($result)){
			echo '<div class="row">
					<h5 class="info-text"> Data Pemesan </h5>
					<div class="col-sm-4 col-sm-offset-1">
						<div class="picture-container">
							<div class="picture">
								<img src="assets/img/default-avatar.jpg" class="picture-src" id="wizardPicturePreview" title="" />
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Full Name </label>
							<input name="fullname" type="text" class="form-control fullname" value="'.$row['fullname_customer'].'" disabled>
						</div>
						<div class="form-group">
							<label>Phone Number </label>
							<input name="nohp" type="number" class="form-control phonenumber" value="'.$row['nohp_customer'].'" disabled>
						</div>
					</div>
					<div class="col-sm-10 col-sm-offset-1">
						<div class="form-group">
							<label>Email <small>(e-ticket akan dikirim ke email ini)</small></label>
							<input name="email" type="email" class="form-control email" value="'.$row['email_customer'].'" disabled>
						</div>
					</div>
				</div>
				<hr>';
		}
		exit();
	}
	if(isset($_POST['showpenumpang'])){
		$counter = 1;
		while ($counter <= (int)$_SESSION['jumlahpassengers']){
			echo '<div class="row">
					<h5 class="info-text"> Data Penumpang '.$counter.' </h5>
					<div class="col-sm-10 col-sm-offset-1">
						<div class="form-group">
							<label>Full Name <small>(isi sesuai KTP/Paspor/SIM)</small></label>
							<input name="firstname'.$counter.'" type="text" class="form-control '.$counter.'" placeholder="Nama Lengkap" required />
						</div>
					</div>
				</div>
				<hr>';
			$counter = $counter + 1;
		}
		exit();
	}
	if(isset($_POST['confirmkredit'])){
		$sql="SELECT * FROM bank_kredit WHERE nomor_kartu='".$_POST['nomor_kartu']."' AND nama_pemilik='".$_POST['nama_kartu']."' AND tanggal_valid='".$_POST['valid_kartu']."' AND tiga_digit='".$_POST['tiga_digit']."'";
		$result=mysqli_query($con,$sql);
		if(mysqli_num_rows($result) == 1){
			if ($keterangan == "langsung"){
				$sql2 = "SELECT harga FROM jadwal_penerbangan WHERE id_jdpenerbangan=".$_SESSION['idjdpenerbangan']."";
				$result2=mysqli_query($con,$sql2);
				$hasil=mysqli_fetch_array($result2);
				$total= (int)$hasil[0] * (int)$_SESSION['jumlahpassengers'];
				$sql2="INSERT INTO pesanan VALUES (NULL, NULL, ".$total.", ".$_SESSION['iduser'].", ".$_SESSION['idjdpenerbangan'].", ".$_SESSION['jumlahpassengers'].")";
				mysqli_query($con,$sql2);
			}
			else if ($keterangan == "1transit"){
				$arr = explode("-", $_SESSION['idjdpenerbangan'], 2);
				for ($i=0;$i<2;$i++){
					$sql2 = "SELECT harga FROM jadwal_penerbangan WHERE id_jdpenerbangan=".$arr[$i]."";
					$result2=mysqli_query($con,$sql2);
					$hasil=mysqli_fetch_array($result2);
					$total= (int)$hasil[0] * (int)$_SESSION['jumlahpassengers'];
					$sql2="INSERT INTO pesanan VALUES (NULL, NULL, ".$total.", ".$_SESSION['iduser'].", ".$arr[$i].", ".$_SESSION['jumlahpassengers'].")";
					mysqli_query($con,$sql2);
				}
			}
			else if ($keterangan == "2transit"){
				$arr = explode("-", $_SESSION['idjdpenerbangan'], 3);
				for ($i=0;$i<3;$i++){
					$sql2 = "SELECT harga FROM jadwal_penerbangan WHERE id_jdpenerbangan=".$arr[$i]."";
					$result2=mysqli_query($con,$sql2);
					$hasil=mysqli_fetch_array($result2);
					$total= (int)$hasil[0] * (int)$_SESSION['jumlahpassengers'];
					$sql2="INSERT INTO pesanan VALUES (NULL, NULL, ".$total.", ".$_SESSION['iduser'].", ".$arr[$i].", ".$_SESSION['jumlahpassengers'].")";
					mysqli_query($con,$sql2);
				}
			}
			$total = (int)$_SESSION['hargatiket'] * (int)$_SESSION['jumlahpassengers'];
			$sql2="UPDATE bank_kredit SET tagihan=tagihan+".$total." WHERE nomor_kartu='".$_POST['nomor_kartu']."' AND nama_pemilik='".$_POST['nama_kartu']."' AND tanggal_valid='".$_POST['valid_kartu']."' AND tiga_digit='".$_POST['tiga_digit']."'";
			mysqli_query($con,$sql2);
			echo 'SUCCESS!';
			unset($_SESSION['lokasiawal']);
			unset($_SESSION['bandaraawal']);
			unset($_SESSION['lokasitujuan']);
			unset($_SESSION['bandaratujuan']);
			unset($_SESSION['jumlahpassengers']);
			unset($_SESSION['tanggalberangkat']);
			unset($_SESSION['idjdpenerbangan']);
		}
		else{
			echo 'Data Kartu Kredit tidak valid!';
		}
		exit();
	}
	if(isset($_POST['confirmdebit'])){
		$sql="SELECT * FROM bank_debit WHERE nomor_kartu='".$_POST['nomor_kartu']."' AND nama_pemilik='".$_POST['nama_kartu']."' AND tanggal_valid='".$_POST['valid_kartu']."'";
		$result=mysqli_query($con,$sql);
		if(mysqli_num_rows($result) == 1){
			
			if ($keterangan == "langsung"){
				$sql2 = "SELECT harga FROM jadwal_penerbangan WHERE id_jdpenerbangan=".$_SESSION['idjdpenerbangan']."";
				$result2=mysqli_query($con,$sql2);
				$hasil=mysqli_fetch_array($result2);
				$total= (int)$hasil[0] * (int)$_SESSION['jumlahpassengers'];
				$sql2="INSERT INTO pesanan VALUES (NULL, NULL, ".$total.", ".$_SESSION['iduser'].", ".$_SESSION['idjdpenerbangan'].", ".$_SESSION['jumlahpassengers'].")";
				mysqli_query($con,$sql2);
			}
			else if ($keterangan == "1transit"){
				$arr = explode("-", $_SESSION['idjdpenerbangan'], 2);
				for ($i=0;$i<2;$i++){
					$sql2 = "SELECT harga FROM jadwal_penerbangan WHERE id_jdpenerbangan=".$arr[$i]."";
					$result2=mysqli_query($con,$sql2);
					$hasil=mysqli_fetch_array($result2);
					$total= (int)$hasil[0] * (int)$_SESSION['jumlahpassengers'];
					$sql2="INSERT INTO pesanan VALUES (NULL, NULL, ".$total.", ".$_SESSION['iduser'].", ".$arr[$i].", ".$_SESSION['jumlahpassengers'].")";
					mysqli_query($con,$sql2);
				}
			}
			else if ($keterangan == "2transit"){
				$arr = explode("-", $_SESSION['idjdpenerbangan'], 3);
				for ($i=0;$i<3;$i++){
					$sql2 = "SELECT harga FROM jadwal_penerbangan WHERE id_jdpenerbangan=".$arr[$i]."";
					$result2=mysqli_query($con,$sql2);
					$hasil=mysqli_fetch_array($result2);
					$total= (int)$hasil[0] * (int)$_SESSION['jumlahpassengers'];
					$sql2="INSERT INTO pesanan VALUES (NULL, NULL, ".$total.", ".$_SESSION['iduser'].", ".$arr[$i].", ".$_SESSION['jumlahpassengers'].")";
					mysqli_query($con,$sql2);
				}
			}
			$total = (int)$_SESSION['hargatiket'] * (int)$_SESSION['jumlahpassengers'];
			$sql2="UPDATE bank_debit SET saldo=saldo-".$total." WHERE nomor_kartu='".$_POST['nomor_kartu']."' AND nama_pemilik='".$_POST['nama_kartu']."' AND tanggal_valid='".$_POST['valid_kartu']."'";
			mysqli_query($con,$sql2);
			echo 'SUCCESS!';
			unset($_SESSION['lokasiawal']);
			unset($_SESSION['bandaraawal']);
			unset($_SESSION['lokasitujuan']);
			unset($_SESSION['bandaratujuan']);
			unset($_SESSION['jumlahpassengers']);
			unset($_SESSION['tanggalberangkat']);
			unset($_SESSION['idjdpenerbangan']);
		}
		else{
			echo 'Data Kartu Debit tidak valid!';
		}
		exit();
	}
	if(isset($_POST['confirmsaldo'])){
		$sql="SELECT * FROM customers WHERE id_customer=".$_SESSION['iduser']."";
		$result=mysqli_query($con,$sql);
		$hasil = mysqli_fetch_array($result);
		$saldocustomer = $hasil['saldo'];
		$totall = (int)$_SESSION['hargatiket'] * (int)$_SESSION['jumlahpassengers'];
		if ($saldocustomer >= $totall){
			if ($keterangan == "langsung"){
				$sql2 = "SELECT harga FROM jadwal_penerbangan WHERE id_jdpenerbangan=".$_SESSION['idjdpenerbangan']."";
				$result2=mysqli_query($con,$sql2);
				$hasil=mysqli_fetch_array($result2);
				$total= (int)$hasil[0] * (int)$_SESSION['jumlahpassengers'];
				$sql2="INSERT INTO pesanan VALUES (NULL, NULL, ".$total.", ".$_SESSION['iduser'].", ".$_SESSION['idjdpenerbangan'].", ".$_SESSION['jumlahpassengers'].")";
				mysqli_query($con,$sql2);
			}
			else if ($keterangan == "1transit"){
				$arr = explode("-", $_SESSION['idjdpenerbangan'], 2);
				for ($i=0;$i<2;$i++){
					$sql2 = "SELECT harga FROM jadwal_penerbangan WHERE id_jdpenerbangan=".$arr[$i]."";
					$result2=mysqli_query($con,$sql2);
					$hasil=mysqli_fetch_array($result2);
					$total= (int)$hasil[0] * (int)$_SESSION['jumlahpassengers'];
					$sql2="INSERT INTO pesanan VALUES (NULL, NULL, ".$total.", ".$_SESSION['iduser'].", ".$arr[$i].", ".$_SESSION['jumlahpassengers'].")";
					mysqli_query($con,$sql2);
				}
			}
			else if ($keterangan == "2transit"){
				$arr = explode("-", $_SESSION['idjdpenerbangan'], 3);
				for ($i=0;$i<3;$i++){
					$sql2 = "SELECT harga FROM jadwal_penerbangan WHERE id_jdpenerbangan=".$arr[$i]."";
					$result2=mysqli_query($con,$sql2);
					$hasil=mysqli_fetch_array($result2);
					$total= (int)$hasil[0] * (int)$_SESSION['jumlahpassengers'];
					$sql2="INSERT INTO pesanan VALUES (NULL, NULL, ".$total.", ".$_SESSION['iduser'].", ".$arr[$i].", ".$_SESSION['jumlahpassengers'].")";
					mysqli_query($con,$sql2);
				}
			}
			$sql2="UPDATE customers SET saldo=saldo-".$totall." WHERE id_customer=".$_SESSION['iduser']."";
			mysqli_query($con,$sql2);
			echo 'SUCCESS!';
			unset($_SESSION['lokasiawal']);
			unset($_SESSION['bandaraawal']);
			unset($_SESSION['lokasitujuan']);
			unset($_SESSION['bandaratujuan']);
			unset($_SESSION['jumlahpassengers']);
			unset($_SESSION['tanggalberangkat']);
			unset($_SESSION['idjdpenerbangan']);
		}
		else {
			echo 'Saldo Tidak Mencukupi!';
		}
		exit();
	}
	if(isset($_POST['insertpenumpang'])){
		$sql = "SELECT MAX(id_pesanan) FROM pesanan";
		$result = mysqli_query($con,$sql);
		$hasil = mysqli_fetch_array($result);
		$idpesanan = (int)$hasil[0];
		$sql = "INSERT INTO penumpang VALUES (NULL, '".$_POST['nama_penumpang']."', ".$idpesanan.")";
		mysqli_query($con, $sql);
		exit();
	}
	if(isset($_POST['summarypenerbangan'])){
		if ($keterangan == "langsung"){
			$sql = "SELECT * FROM jadwal_penerbangan WHERE id_jdpenerbangan=".$_SESSION['idjdpenerbangan']."";
			$result = mysqli_query($con,$sql);
			$hasil = mysqli_fetch_array($result);
			echo '<tr><th scope="row">Rute Penerbangan: </th> <td class="rutepenerbangan">'.$hasil['lokasi_awal'].'-'.$hasil['lokasi_tujuan'].'</td></tr>';
			echo '<tr><th scope="row">Tanggal: </th><td class="tanggalpenerbangan">'.$hasil['tanggal_penerbangan'].'</td></tr>';
			echo '<tr><th scope="row">Jam: </th> <td class="jampenerbangan">'.$hasil['jam_berangkat'].'</td></tr>';
		}
		else if ($keterangan == "1transit"){
			$arr = explode("-", $_SESSION['idjdpenerbangan'], 2);
			for ($i=0;$i<2;$i++){
				$sql = "SELECT * FROM jadwal_penerbangan WHERE id_jdpenerbangan=".$arr[$i]."";
				$result = mysqli_query($con,$sql);
				$hasil = mysqli_fetch_array($result);
				echo '<tr><th scope="row">Rute Penerbangan: </th> <td class="rutepenerbangan">'.$hasil['lokasi_awal'].'-'.$hasil['lokasi_tujuan'].'</td></tr>';
				echo '<tr><th scope="row">Tanggal: </th><td class="tanggalpenerbangan">'.$hasil['tanggal_penerbangan'].'</td></tr>';
				echo '<tr><th scope="row">Jam: </th> <td class="jampenerbangan">'.$hasil['jam_berangkat'].'</td></tr>';
			}
		}
		else if ($keterangan == "2transit"){
			$arr = explode("-", $_SESSION['idjdpenerbangan'], 3);
			for ($i=0;$i<3;$i++){
				$sql = "SELECT * FROM jadwal_penerbangan WHERE id_jdpenerbangan=".$arr[$i]."";
				$result = mysqli_query($con,$sql);
				$hasil = mysqli_fetch_array($result);
				echo '<tr><th scope="row">Rute Penerbangan: </th> <td class="rutepenerbangan">'.$hasil['lokasi_awal'].'-'.$hasil['lokasi_tujuan'].'</td></tr>';
				echo '<tr><th scope="row">Tanggal: </th><td class="tanggalpenerbangan">'.$hasil['tanggal_penerbangan'].'</td></tr>';
				echo '<tr><th scope="row">Jam: </th> <td class="jampenerbangan">'.$hasil['jam_berangkat'].'</td></tr>';
			}
		}
		exit();
	}
	if(isset($_POST['showsaldo'])){
		$sql="SELECT saldo FROM customers WHERE id_customer=".$_SESSION['iduser']."";
		$result=mysqli_query($con,$sql);
		$hasil=mysqli_fetch_array($result);
		echo '<div class="form-group">
				<label>Saldo Anda <small>(saat ini)</small></label>
				<input name="saldo" type="text" class="form-control saldo" placeholder="Nomor Kartu" value="'.$hasil[0].'" disabled>
			</div>';
		exit();
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png" />
	<link rel="icon" type="image/png" href="assets/img/favicon.png" />
	<title>Pembayaran</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

	<!-- Canonical SEO -->
    <link rel="canonical" href="https://www.creative-tim.com/product/paper-bootstrap-wizard"/>

	<!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/css/paper-bootstrap-wizard.css" rel="stylesheet" />

	<!-- Fonts and Icons -->
    <link href="https://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
	<link href="assets/css/themify-icons.css" rel="stylesheet">
	</head>

	<body>
	    <!--   Big container   -->
	    <div class="container">
	        <div class="row">
		        <div class="col-sm-8 col-sm-offset-2">
		            <!--      Wizard container        -->
		            <div class="wizard-container">

		                <div class="card wizard-card" data-color="orange" id="wizardProfile">
		                    <form action="" method="">
		                <!--        You can switch " data-color="orange" "  with one of the next bright colors: "blue", "green", "orange", "red", "azure"          -->

		                    	<div class="wizard-header text-center">
		                        	<h3 class="wizard-title">Booking Detail</h3>
									<p class="category">This information will let us know more about you.</p>
		                    	</div>

								<div class="wizard-navigation">
									<div class="progress-with-circle">
									     <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="3" style="width: 21%;"></div>
									</div>
									<ul>
			                            <li>
											<a href="#orang" data-toggle="tab" class="orang">
												<div class="icon-circle">
													<i class="ti-user"></i>
												</div>
												Penumpang
											</a>
										</li>
			                            <li>
											<a href="#pembayaran" data-toggle="tab" class="pembayaran">
												<div class="icon-circle">
													<i class="ti-money"></i>
												</div>
												Pembayaran
											</a>
										</li>
			                            <li>
											<a href="#summary" data-toggle="tab" class="summary">
												<div class="icon-circle">
													<i class="ti-map"></i>
												</div>
												Finish
											</a>
										</li>
			                        </ul>
								</div>
		                        <div class="tab-content">
		                            <div class="tab-pane" id="orang">
		                            	
		                            </div>
		                            <div class="tab-pane" id="pembayaran">
		                                <h5 class="info-text"> Pilih Metode Pembayaran </h5>
		                                <div class="row">
		                                	<input type='button' class='col-md-4 btn btn-fill btn-warning btn-wd kartukredit' name='kartukredit' value='Kartu Kredit' />
		                                	<input type='button' class='col-md-4 btn btn-default btn-wd kartudebit' name='kartudebit' value='Kartu Debit' />
		                                	<input type='button' class='col-md-4 btn btn-default btn-wd saldo' name='saldo' value='Saldo' />
		                                </div>
		                                <hr>
		                                <div class="row">
											<div class="col-sm-10 col-sm-offset-1" id="kartukredit">
												<div class="form-group">
													<label>Nomor Kartu Kredit <small>(16 digit)</small></label>
													<input name="nomor" type="text" class="form-control nomorkredit" placeholder="Nomor Kartu" required />
												</div>
												<div class="form-group">
													<label>Valid Date <small>(yyyy-mm-dd)</small></label>
													<input name="tgl" type="text" class="form-control validkredit" placeholder="Berlaku Hingga" required />
												</div>
												<div class="form-group">
													<label>CVC/CVV <small>(3 digit terakhir di belakang kartu Anda)</small></label>
													<input name="digit" type="text" class="form-control 3kredit" placeholder="CVC/CVV" required />
												</div>
												<div class="form-group">
													<label>Nama Pemegang Kartu <small>(sesuai dengan yang tertera di kartu)</small></label>
													<input name="nama" type="text" class="form-control namakredit" placeholder="Nama Lengkap" required />
												</div>
											</div>
											<div class="col-sm-10 col-sm-offset-1 disabled" id="kartudebit">
												<div class="form-group">
													<label>Nomor Kartu Debit <small>(16 digit)</small></label>
													<input name="nomor" type="text" class="form-control nomordebit" placeholder="Nomor Kartu" required />
												</div>
												<div class="form-group">
													<label>Valid Date <small>(yyyy-mm-dd)</small></label>
													<input name="tgl" type="text" class="form-control validdebit" placeholder="Berlaku Hingga" required />
												</div>
												<div class="form-group">
													<label>Nama Pemegang Kartu <small>(sesuai dengan yang tertera di kartu)</small></label>
													<input name="nama" type="text" class="form-control namadebit" placeholder="Nama Lengkap" required />
												</div>
											</div>
											<div class="col-sm-10 col-sm-offset-1 disabled" id="saldo">
												
											</div>
										</div>
		                            </div>
		                            <div class="tab-pane" id="summary">
		                                <div class="row">
		                                    <div class="col-sm-12">
		                                        <h5 class="info-text"> Purchase Summary </h5>
		                                        <table class="table table-striped">
												  <tbody>
												    <tr>
												      <th scope="row">Pemesan: </th>
												      <td class="pemesan">
												      	<?php
												      		$sql="SELECT * FROM customers WHERE id_customer=".$_SESSION['iduser']."";
												      		$result=mysqli_query($con,$sql);
												      		$hasil=mysqli_fetch_array($result);
												      		echo $hasil['fullname_customer']." (".$hasil['email_customer'].")";
												      	?>
												      </td>
												    </tr>
												    <tr>
												      <th scope="row">Penumpang: </th>
												      <td class="penumpang"> </td>
												    </tr>
												    <tr>
												      <th scope="row">Nomor Kartu: </th>
												      <td class="nomorkartu"> </td>
												    </tr>
												    <tr id="penerbangan">
												    	<th colspan=2><u>PENERBANGAN</u></th>
												    </tr>
												    
												 	<tr>
												      <th scope="row">Total Pembayaran: </th>
												      <th class="total">
												      	<?php
												      		if($_SESSION['reschedule']==1){
												      			$totalharga = (int)$_SESSION['hargatiket'] * (int)$_SESSION['jumlahpassengers'];
												      			$totalharga = $totalharga + 15000;
												      			echo "".number_format($totalharga,0,',','.')."IDR";
												      			$_SESSION['reschedule']==2;
												      		}
												      		else{
												      			$totalharga = (int)$_SESSION['hargatiket'] * (int)$_SESSION['jumlahpassengers'];
												      			echo "".number_format($totalharga,0,',','.')."IDR";
												      		}
												      		
												      	?>
												      </th>
												    </tr>
												  </tbody>
												</table>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                        <div class="wizard-footer">
		                            <div class="pull-right">
		                                <input type='button' class='btn btn-next btn-fill btn-warning btn-wd next' name='next' value='Next' />
		                                <input type='button' class='btn btn-finish btn-fill btn-success btn-wd confirm' data-toggle="modal" data-target="#exampleModal" name='confirm' value='Confirm' />
		                            </div>
		                            <div class="pull-left">
		                                <input type='button' class='btn btn-previous btn-default btn-wd' name='previous' value='Previous' />
		                            </div>
		                            <div class="clearfix"></div>
		                        </div>
		                    </form>
		                </div>
		            </div> <!-- wizard container -->
		        </div>
	    	</div><!-- end row -->
		</div> <!--  big container -->

		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h5 class="modal-title" id="exampleModalLabel"></h5>
					</div>
					<div class="modal-body">
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" id="purchase">Purchase</button>
						<button type="button" class="btn btn-secondary cancelbutton" data-dismiss="modal">Cancel</button>
					</div>
				</div>
			</div>
		</div>

	    <div class="footer">
	        <div class="container text-center">
	            Made with <i class="fa fa-heart heart"></i> by Joella, Jessica A, and Andhika.</a>
	        </div>
	    </div>
</body>

	<!--   Core JS Files   -->
	<script src="assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="assets/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>

	<!--  Plugin for the Wizard -->
	<script src="assets/js/demo.js" type="text/javascript"></script>
	<script src="assets/js/paper-bootstrap-wizard.js" type="text/javascript"></script>

	<!--  More information about jquery.validate here: https://jqueryvalidation.org/	 -->
	<script src="assets/js/jquery.validate.min.js" type="text/javascript"></script>
	<script>
		$( document ).ready(function() {
			showpemesan();
			showpenumpang();
			summarypenerbangan();
			showsaldo();
			var kartu="kredit";
		    $(".next").click(function(){
		    	refresh(kartu);
		    });
		    $(".orang").click(function(){
		    	refresh(kartu);
		    });
		    $(".pembayaran").click(function(){
		    	refresh(kartu);
		    });
		    $(".summary").click(function(){
		    	refresh(kartu);
		    });
		    $(".kartukredit").click(function(){
		    	kartu="kredit";
		    	$(this).removeClass("btn-next btn-fill btn-warning btn-default");
		    	$(".kartudebit").removeClass("btn-next btn-fill btn-warning btn-default");
		    	$(".saldo").removeClass("btn-next btn-fill btn-warning btn-default");
		    	$(this).addClass("btn-next btn-fill btn-warning");
		    	$("#kartukredit").removeClass("disabled");
		    	$("#kartudebit").addClass("disabled");
		    	$("#saldo").addClass("disabled");
		    });
		   	$(".kartudebit").click(function(){
		   		kartu="debit";
		    	$(this).removeClass("btn-next btn-fill btn-warning btn-default");
		    	$(".kartukredit").removeClass("btn-next btn-fill btn-warning btn-default");
		    	$(".saldo").removeClass("btn-next btn-fill btn-warning btn-default");
		    	$(this).addClass("btn-next btn-fill btn-warning");
		    	$("#kartudebit").removeClass("disabled");
		    	$("#kartukredit").addClass("disabled");
		    	$("#saldo").addClass("disabled");
		    });
		    $(".saldo").click(function(){
		   		kartu="saldo";
		    	$(this).removeClass("btn-next btn-fill btn-warning btn-default");
		    	$(".kartukredit").removeClass("btn-next btn-fill btn-warning btn-default");
		    	$(".kartudebit").removeClass("btn-next btn-fill btn-warning btn-default");
		    	$(this).addClass("btn-next btn-fill btn-warning");
		    	$("#saldo").removeClass("disabled");
		    	$("#kartukredit").addClass("disabled");
		    	$("#kartudebit").addClass("disabled");
		    });
		    $(".confirm").click(function(){
		    	if (kartu=="kredit"){
		    		var nomorkartu = $(".nomorkredit").val();
		    		var namakartu = $(".namakredit").val();
		    		var validkartu = $(".validkredit").val();
		    		var tigadigit = $(".3kredit").val();
		    		$.ajax({
						url : "index.php",
						type : "POST",
						async : false,
						cache : false,
						data : {
							confirmkredit : 1,
							nomor_kartu : nomorkartu,
							nama_kartu : namakartu,
							tiga_digit : tigadigit,
							valid_kartu : validkartu
						},
						success: function(result){
							$(".modal-body").html(result);
							if (result == "SUCCESS!"){
								$(".modal-footer").html('<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location.href=\'../main.php\'">OK</button>');
								var counter = <?php echo $_SESSION['jumlahpassengers']; ?>;
						    	for (var i = 1; i <= counter; i++) {
						    		var clas="."+i;
						    		var value=$(clas).val();
						    		var idpesanan=$(".idpesanan").val();
						    		$.ajax({
										url : "index.php",
										type : "POST",
										async : false,
										cache : false,
										data : {
											insertpenumpang : 1,
											nama_penumpang : value,
											id_pesanan : idpesanan
										},
										success: function(result){
										}
									});
						    	}
							}
							else {
								$(".modal-footer").html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Coba Lagi</button>');
							}
						}
					});
		    	}
		    	else if (kartu=="debit"){
		    		var nomorkartu = $(".nomordebit").val();
		    		var namakartu = $(".namadebit").val();
		    		var validkartu = $(".validdebit").val();
		    		$.ajax({
						url : "index.php",
						type : "POST",
						async : false,
						cache : false,
						data : {
							confirmdebit : 1,
							nomor_kartu : nomorkartu,
							nama_kartu : namakartu,
							valid_kartu : validkartu
						},
						success: function(result){
							$(".modal-body").html(result);
							if (result == "SUCCESS!"){
								$(".modal-footer").html('<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location.href=\'../main.php\'">OK</button>');
								var counter = <?php echo $_SESSION['jumlahpassengers']; ?>;
						    	for (var i = 1; i <= counter; i++) {
						    		var clas="."+i;
						    		var value=$(clas).val();
						    		var idpesanan=$(".idpesanan").val();
						    		$.ajax({
										url : "index.php",
										type : "POST",
										async : false,
										cache : false,
										data : {
											insertpenumpang : 1,
											nama_penumpang : value,
											id_pesanan : idpesanan
										},
										success: function(result){
											alert(result);
										}
									});
						    	}
							}
							else {
								$(".modal-footer").html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Coba Lagi</button>');
							}
						}
					});
		    	}
		    	else if (kartu=="saldo"){
		    		$.ajax({
						url : "index.php",
						type : "POST",
						async : false,
						cache : false,
						data : {
							confirmsaldo : 1
						},
						success: function(result){
							$(".modal-body").html(result);
							if (result == "SUCCESS!"){
								$(".modal-footer").html('<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location.href=\'../main.php\'">OK</button>');
								var counter = <?php echo $_SESSION['jumlahpassengers']; ?>;
						    	for (var i = 1; i <= counter; i++) {
						    		var clas="."+i;
						    		var value=$(clas).val();
						    		var idpesanan=$(".idpesanan").val();
						    		$.ajax({
										url : "index.php",
										type : "POST",
										async : false,
										cache : false,
										data : {
											insertpenumpang : 1,
											nama_penumpang : value,
											id_pesanan : idpesanan
										},
										success: function(result){
											alert(result);
										}
									});
						    	}
							}
							else {
								$(".modal-footer").html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Coba Lagi</button>');
							}
						}
					});
		    	}
		    	
		    });
		});
		function showpemesan(){
			$.ajax({
				url : "index.php",
				type : "POST",
				async : false,
				cache : false,
				data : {
					showpemesan : 1
				},
				success: function(result){
					$("#orang").html(result);
				}
			});
		}
		function showpenumpang(){
			$.ajax({
				url : "index.php",
				type : "POST",
				async : false,
				cache : false,
				data : {
					showpenumpang : 1
				},
				success: function(result){
					$("#orang").append(result);
				}
			});
		}
		function refresh(kartu){
			$(".penumpang").html("");
		    	var counter = <?php echo $_SESSION['jumlahpassengers']; ?>;
		    	for (var i = 1; i <= counter; i++) {
		    		var clas="."+i;
		    		var value=$(clas).val();
		    		if (i==counter){
		    			$(".penumpang").append(value);
		    		}
		    		else{
		    			$(".penumpang").append(value+" | ");	
		    		}
		    	}
		    	if (kartu=="kredit"){
		    		var value = $(".nomorkredit").val() + " (a/n " + $(".namakredit").val() + ")";
		    		$(".nomorkartu").html(value);
		    	}
		    	else if(kartu="debit"){
		    		var value = $(".nomordebit").val() + " (a/n " + $(".namadebit").val() + ")";
		    		$(".nomorkartu").html(value);
		    	}
		}
		function summarypenerbangan(){
			$.ajax({
				url : "index.php",
				type : "POST",
				async : false,
				cache : false,
				data : {
					summarypenerbangan : 1
				},
				success: function(result){
					$("#penerbangan").after(result);
				}
			});
		}
		function showsaldo(){
			$.ajax({
				url : "index.php",
				type : "POST",
				async : false,
				cache : false,
				data : {
					showsaldo : 1
				},
				success: function(result){
					$("#saldo").html(result);
				}
			});
		}
	</script>
</html>
