<?php
	include "connect.php";
	if(isset($_POST['maskapai'])){
		$query = mysqli_query($con, "SELECT * FROM airlines");
		while($row=mysqli_fetch_assoc($query)){
			echo '<input class="form-check-input" type="checkbox" value="'.$row['kode_airlines'].'"> '.$row['nama_airlines'].' <br>';
		}
		exit();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>FILTER</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=|Roboto+Sans:400,700|Playfair+Display:400,700">

	<link rel="stylesheet" href="css2/bootstrap.min.css">
	<link rel="stylesheet" href="css2/animate.css">
	<link rel="stylesheet" href="css2/owl.carousel.min.css">
	<link rel="stylesheet" href="css2/aos.css">
	<link rel="stylesheet" href="css2/bootstrap-datepicker.css">
	<link rel="stylesheet" href="css2/jquery.timepicker.css">
	<link rel="stylesheet" href="css2/fancybox.min.css">

	<link rel="stylesheet" href="fonts2/ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="fonts2/fontawesome/css/font-awesome.min.css">

	<!-- Theme Style -->
	<link rel="stylesheet" href="css2/style.css">

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />

	<script>
		function showmaskapai(){
			$.ajax({
				url: "filter.php",
				type: "POST",
				data: {
					maskapai : 1
				},
				success: function(result){
					$(".listmaskapai").html(result);
				}
			});
		}
		$(document).ready(function(){
			showmaskapai();
		});
	</script>

	<style>
	.filter {

	}
	.hasil {
		
	}
	.card-link {
		color: black;
	}
	.card-body {
		background-color: #d2e8f2;
	}
	.tab-content {
		background-color: #eaeced;
	}
	</style>



</head>
<body class="fixed">
	<?php 
	include "navbar.html"; ?>
	<nav>
		<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
			<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">PILIH PENERBANGAN BERANGKAT</a>
			<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">PILIH PENERBANGAN PULANG</a>
			<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">KONFIRMASI PEMBELIAN</a>
		</div>
	</nav>
	<div class="tab-content" id="nav-tabContent">
		<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
			<section class="ftco-section">
				<div class="row">
					<div class="col-lg-9 order-lg-last ftco-animate hasil">
						<h4> Result </h4>
						<div class="container">
							<div class="site-block-half d-block d-lg-flex bg-white" data-aos="fade" data-aos-delay="100" style="padding: -100px;">
								<img src='assets/logo airlines/sriwijayaair.jpg' style="width:130px; height:130px; padding-top: 30px; padding-left: 30px;">
								<div class="text">
									<div style="background-color:#d2e8f2; width: 70px; height: 50px;">
										<p style="font-size:25px; line-height: 65%;"><b>13.00</b> <p style="font-size: 15px; line-height: 55%;"> SUB </p></p>
									</div>
									<div style="background-color:#d2e8f2; width: 70px; height: 50px; margin-left: 160px; margin-top: -50px;">
										<p style="font-size:25px; line-height: 65%;"><b>13.00</b> <p style="font-size: 15px; line-height: 55%;"> SUB </p></p>
									</div>
									<div style="background-color:#d2e8f2; width: 170px; height: 50px; margin-left: 500px; margin-top: -50px;">
										<span class="text-primary" style="font-size: 30px;">$199</span> <span class="text-uppercase letter-spacing-2">/ per pax</span>
									</div>
								</div>
							</div>
							<div class="site-block-half d-block d-lg-flex bg-white" data-aos="fade" data-aos-delay="100" style="padding: -100px;">
								<img src='assets/logo airlines/lionair.jpg' style="width:100px; height:100px; vertical-align: middle;">
								<div class="text">
									<div style="background-color:#d2e8f2; width: 70px; height: 50px;">
										<p style="font-size:25px; line-height: 65%;"><b>13.00</b> <p style="font-size: 15px; line-height: 55%;"> SUB </p></p>
									</div>
									<div style="background-color:#d2e8f2; width: 70px; height: 50px; margin-left: 160px; margin-top: -50px;">
										<p style="font-size:25px; line-height: 65%;"><b>13.00</b> <p style="font-size: 15px; line-height: 55%;"> SUB </p></p>
									</div>
									<div style="background-color:#d2e8f2; width: 170px; height: 50px; margin-left: 500px; margin-top: -50px;">
										<span class="text-primary" style="font-size: 30px;">$199</span> <span class="text-uppercase letter-spacing-2">/ per pax</span>
									</div>
								</div>
							</div>

						</div>
					</div>
					<div class="col-lg-3 sidebar ftco-animate filter">
						<h4> Filter </h4>
						<div id="accordion">
							<div class="card">
								<div class="card-header">
									<a class="card-link" data-toggle="collapse" href="#collapseOne">
										<b>Waktu</b>
									</a>
								</div>
								<div id="collapseOne" class="collapse show">
									<div class="card-body">
										<div class="form-check">
											<label class="form-check-label">
												<input class="form-check-input" type="checkbox" value="subuh"> 00.00-06.00 <br>
												<input class="form-check-input" type="checkbox" value="pagi"> 06.00-12.00 <br>
												<input class="form-check-input" type="checkbox" value="siang"> 12.00-18.00 <br>
												<input class="form-check-input" type="checkbox" value="malam"> 18.00-24.00 <br>
											</label>
										</div>
									</div>
								</div>
							</div>

							<div class="card">
								<div class="card-header">
									<a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
										<b> Maskapai </b>
									</a>
								</div>
								<div id="collapseTwo" class="collapse show">
									<div class="card-body">
										<div class="form-check">
											<label class="form-check-label listmaskapai">
												
											</label>
										</div>
									</div>
								</div>
							</div>

							<div class="card">
								<div class="card-header">
									<a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
										Collapsible Group Item #3
									</a>
								</div>
								<div id="collapseThree" class="collapse show">
									<div class="card-body">
										Lorem ipsum..
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</section>
		</div>
		<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...profile</div>
		<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...contact</div>
	</div>

	<script src="js2/jquery-3.3.1.min.js"></script>
	<script src="js2/jquery-migrate-3.0.1.min.js"></script>
	<script src="js2/popper.min.js"></script>
	<script src="js2/bootstrap.min.js"></script>
	<script src="js2/owl.carousel.min.js"></script>
	<script src="js2/jquery.stellar.min.js"></script>
	<script src="js2/jquery.fancybox.min.js"></script>


	<script src="js2/aos.js"></script>

	<script src="js2/bootstrap-datepicker.js"></script> 
	<script src="js2/jquery.timepicker.min.js"></script> 



	<script src="js2/main.js"></script>

</body>
</html>
