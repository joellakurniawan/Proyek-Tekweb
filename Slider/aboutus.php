<?php
	session_start();
	include "connect.php";
	if(isset($_POST['show'])){
		$id = $_SESSION['iduser']; 
		$sql='SELECT * FROM `customers` WHERE id_customer='.$id.'';
		$result=mysqli_query($con, $sql);
        $a = [];
		while($row=mysqli_fetch_array($result)){
			array_push($a, $row);
            $_SESSION['idprofile']=$row[0];
		}
        echo json_encode($a);
		exit();
	}
    if(isset($_POST['update_profile'])){
        $id = $_SESSION['idprofile'];
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $nohp = $_POST['nohp'];
        $query = mysqli_query($con, "UPDATE customers SET username_customer='$username',password_customer='$password',email_customer='$email',nohp_customer='$nohp',fullname_customer='$fullname' WHERE id_customer=$id");
        echo($id);
        echo($fullname);
        echo($username);
        echo($password);
        echo($email);
        echo($nohp);
        exit();
    }
?>
<!DOCTYPE html>
<html> 
<head>
	<title>Jesselland's Travel</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- BOOTSTRAP HEADER -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css"> PENGECILAN HURUF !!!!!-->

	<!-- IONRANGESLIDER CSS buat pilih range -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>

	<!-- JQUERY -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- IONRANGESLIDER JS buat pilih range -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>

	<!-- DATEPICKER -->
	<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
	<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />


	<!-- LOADING FONTS AND ICONS -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400%7CRaleway:600%2C400" rel="stylesheet" property="stylesheet" type="text/css" media="all">
	<link rel="stylesheet" type="text/css" href="fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

	<!-- CSS SLIDER -->
	<link rel="stylesheet" type="text/css" href="css/settings.css">
	<link rel="stylesheet" type="text/css" href="css-sliders2.css">
	<link rel="stylesheet" type="text/css" href="css/search.css">

	<!-- CSS -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
	<link rel="stylesheet" type="text/css" href="css/style2.css">

	<!-- JAVASCRIPT SLIDER -->
	<script type="text/javascript" src="js/jquery.themepunch.tools.min.js"></script>
	<script type="text/javascript" src="js/jquery.themepunch.revolution.min.js"></script>

	<!-- BOOTSTRAP FOOTER -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->

	<!-- TYPEAHEAD JAVASCRIPT buat search -->
	<script type="text/javascript" src="js/typeahead.bundle.js"></script>
	 <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	table {
            text-align: center;
        }
        .table-title .add-new {
            height: 30px;
            font-weight: bold;
            font-size: 12px;
            text-shadow: none;
            min-width: 100px;
            border-radius: 50px;
            line-height: 13px;
        }
        table.table td a {
            cursor: pointer;
            display: inline-block;
            margin: 0 5px;
            min-width: 24px;
        }
        table.table td a.add {
            color: #27C46B;
        }
        table.table td a.edit {
            color: #FFC107;
        }
        table.table td a.delete {
            color: #E34724;
        }
        table.table td .update {
            display: none;
        }
        table.table td .add {
            display: none;
        }
        table.table td a.add i {
            font-size: 24px;
            margin-right: -1px;
            position: relative;
            top: 3px;
        }
        table.table .form-control {
            height: 32px;
            line-height: 32px;
            box-shadow: none;
            border-radius: 2px;
        }
        table.table .form-control.error {
            border-color: #f50000;
        }
        .team-section{
        	overflow: hidden;
        	text-align: center;
        	background: #e2f7ff;
        	font-family: sans-serif;
        	padding: 60px;
        }
        .team-section h1{
        	text-transform: uppercase;
        	margin-top: 60px;
        	color: white;
        	font-size: 40px;
        }
        .border{
        	display: block;
        	margin: auto;
        	width: 160px;
        	height: 3px;
        	background: #3498db;
        	margin-bottom: 40px;
        }
        .ps{
        	margin-bottom: 40px;
        }
        .ps a{
        	display: inline-block;
        	margin: 0 30px;
        	width: 160px;
        	height: 160px;
        	overflow: hidden;
        	border-radius: 50%;
        }
        .ps a img{
            width: 100%;
        	filter: grayscale(100%);
        	transition: 0.4s all;
        }
        .ps a:hover > img{
        	filter:none;
        }
        .section{
        	width: 600px;
        	margin: auto;
        	font-size: 20px;
        	color: white;
        	text-align: justify;
        	height: 0;
        	overflow: hidden;
        }
        .section:target{
        	height: auto;
        }
        .name{
        	display: block;
        	margin-bottom: 30px;
        	text-align: center;
        	text-transform: uppercase;
        	font-size: 22px;
        }
</style>
</head>
<script>
        $(document).ready(function(){
            //$("#searchflight").click();
            //alert($(".pill-1 a").html());
            showdata();
            $(document).on("click", "#update", function(){
                if($(this).html()=="Edit"){
                    $('#fullname').removeAttr("disabled");
                    $('#username').removeAttr("disabled");
                    $('#password').removeAttr("disabled");
                    $('#email').removeAttr("disabled");
                    $('#nohp').removeAttr("disabled");
                    //$('.pesanan').attr("disabled","false");
                    $(this).html("Update");
                }
                else if($(this).html()=="Update"){
                    $('#fullname').attr("disabled","true");
                    $('#username').attr("disabled","true");
                    $('#password').attr("disabled","true");
                    $('#email').attr("disabled","true");
                    $('#nohp').attr("disabled","true");
                    $.ajax({
                        url : "profile.php",
                        type : "POST",
                        async : false,
                        cache : false,
                        data : {
                            update_profile : 1,
                            fullname:$('#fullname').val(),
                            username:$('#username').val(),
                            password:$('#password').val(),
                            email:$('#email').val(),
                            nohp:$('#nohp').val()
                        },
                        success: function(result){
                        }
                    });
                    $(this).html("Edit");
                }
            });
            $(document).on("click", ".gambar", function(){
            	$('#gambar1').css("filter","grayscale(100%)");
            	$('#gambar2').css("filter","grayscale(100%)");
            	$('#gambar3').css("filter","grayscale(100%)");
            	$(this).css("filter","none");
            });
        });
        function showdata(){
			$.ajax({
				url : "profile.php",
				type : "POST",
				async : false,
				cache : false,
				data : {
					show : 1
				},
                dataType: "json",
				success: function(result){
                    $('#fullname').val(result[0].fullname_customer);
                    $('#username').val(result[0].username_customer);
                    $('#password').val(result[0].password_customer);
                    $('#email').val(result[0].email_customer);
                    $('#nohp').val(result[0].nohp_customer);
					$('.pesanan').html(result);
				}
			});
                    $('#fullname').attr("disabled","true");
                    $('#username').attr("disabled","true");
                    $('#password').attr("disabled","true");
                    $('#email').attr("disabled","true");
                    $('#nohp').attr("disabled","true");
                    $('.pesanan').attr("disabled","true");
        };
        function tdpicker(){
            $('.datepicker').datepicker({
                uiLibrary: 'bootstrap4', showRightIcon: false,format: 'yyyy-mm-dd'
            });
            $('input.jambrangkat').timepicker({
                format: 'HH.MM'
            });
            $('input.jamtiba').timepicker({
                format: 'HH.MM'
            });
        };
</script>
<body style="margin: 0; padding: 0; align-items: center; justify-content: center;">
	<nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
	    <a class="navbar-brand" href="main.php">Jesselland's Travel</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
	    <div class="collapse navbar-collapse" id="navcol-1">
		    <ul class="navbar-nav mr-auto">
		        <li class="nav-item" role="presentation"><a class="nav-link" href="main.php"><i class="fas fa-home"></i> Home</a></li>
		        <?php
		        	if(isset($_SESSION['username'])){
		        		echo('<li class="nav-item" role="presentation"><a class="nav-link" href="my_booking.php"><i class="far fa-bookmark"></i> My Booking</a></li>');
		        		echo('<li class="nav-item" role="presentation"><a class="nav-link" href="profile.php"><i class="fas fa-user"></i> Profile</a></li>');
		        	}
		        ?>
		        <!-- <li class="nav-item" role="presentation"><a class="nav-link" href="#"><i class="fas fa-coins"></i> Currency</a></li> -->
		        <li class="nav-item" role="presentation"><a class="nav-link" href="aboutus.php"><i class="far fa-address-card"></i> Contact Us</a></li>
		    </ul>
		    <span class="navbar-text actions">
		    	<?php
			        if(isset($_SESSION['iduser'])){
			    ?>
			        <h5> Hello, <b>
			            <?php
			                echo ($_SESSION['username']);
			            	// $message = $_SESSION['username'];
			            	// echo "<script type='text/javascript'>alert('$message');</script>";
			            ?> </b> &nbsp;&nbsp;
			       		<a class="btn btn-light action-button" href="logout.php">Log Out</a>
			        </h5>
			    <?php
			        }
			        else {
			        	?>
			        	<a href="#myModalLog" data-toggle="modal" class="login">Log In</a>
		    			<a class="btn btn-light action-button" href="#myModalSign" data-toggle="modal">Sign Up</a>
			        	<?php
			        }
			    ?>
		    </span>
		</div>
	</nav>
        <!-- The Modal Login -->
    <div class="modal hide fade" id="myModalLog" style="background-color: rgba(254,254,254,0.5);">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-body">
               <div class="d-flex justify-content-center">
                  <div class="brand_logo_container" style="top: -60px; position: absolute;">
                   <img src="assets/logo_company.png" class="brand_logo" alt="Logo">
               </div>
           </div>
           <button type="button" class="close" data-dismiss="modal">&times;</button><br>
           <!-- <h4 class="modal-title"> Login</h4><br> -->
           <div class="container">
            <br>
            <form action="checkAdmin.php" method="post">
              <div class="form-group">
               <span class="fa fa-user icon" style="position: absolute; padding: 10px;"></span>
               <input type="text" class="form-control" id="logUsr" name="logUsername" placeholder="Username" style="text-indent: 20px;">
           </div>
           <div class="form-group">
               <span class="fas fa-lock" style="position: absolute; padding: 10px;"></span>
               <input type="password" class="form-control" id="logPwd" name="logPassword" placeholder="Password" style="text-indent: 20px;">
           </div>
           <button type="submit" class="btn btn-primary" style="background-color: #68d8d8; border-color: #66D7D7;" id="login">Login</button>
       </form>
   </div>
   <br>
</div>
</div>
</div>
</div>

<!-- The Modal SignUp -->
<div class="modal hide fade" id="myModalSign" style="background-color: rgba(254,254,254,0.5);">
 <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
      <div class="modal-body">
       <div class="d-flex justify-content-center">
          <div class="brand_logo_container" style="top: -60px; position: absolute;">
           <img src="assets/logo_company.png" class="brand_logo" alt="Logo">
       </div>
   </div>
   <button type="button" class="close" data-dismiss="modal">&times;</button><br>
   <!-- <h4 class="modal-title"> Login</h4><br> -->
   <div class="container">
    <br>
    <form action="signup.php" method="POST">
      <div class="form-group">
       <span class="fa fa-user icon" style="position: absolute; padding: 10px;"></span>
       <input type="text" class="form-control" id="usr" name="username" placeholder="Username" style="text-indent: 20px;">
   </div>
   <div class="form-group">
       <span class="fas fa-lock" style="position: absolute; padding: 10px;"></span>
       <input type="password" class="form-control" id="pwd" name="password" placeholder="Password" style="text-indent: 20px;">
   </div>
   <div class="form-group">
       <span class="fas fa-lock" style="position: absolute; padding: 10px;"></span>
       <input type="password" class="form-control" id="confPwd" name="confPassword" placeholder="Confirm Password" style="text-indent: 20px;">
   </div>
   <button type="submit" class="btn btn-primary" style="background-color: #68d8d8; border-color: #66D7D7;" id="signup">Sign Up</button>
</form>
</div>
<br>
</div>
</div>
</div>
</div>
	<div class="team-section">
		<h1 style="color: black;">Our Team</h1>
		<span class="border"></span>
		<div class="ps">
			<a href="#p1"><img class="gambar" id="gambar1" src="joella.jpg" ></a>
			<a href="#p2"><img class="gambar" id="gambar2" src="jessica.jpg" ></a>
			<a href="#p3"><img class="gambar" id="gambar3" src="andhika.jpg" ></a>
		</div>
		<div class="section" id="p1">
			<span class="name" style="color: black;">Joella</span>
			<span class="border"></span>
			<p style="text-align: center;color: black;">
				C14170052
			</p>
		</div>
		<div class="section" id="p2">
			<span class="name" style="color: black;">Jessica Athalia</span>
			<span class="border"></span>
			<p style="text-align: center;color: black;">
				C14170066
			</p>
		</div>
		<div class="section" id="p3">
			<span class="name" style="color: black;">Andhika Evantia Irawan</span>
			<span class="border"></span>
			<p style="text-align: center;color: black;">
				C14170085
			</p>
		</div>
	</div>
	<div class="footer">
        <div class="container text-center">
            Made with <i class="fa fa-heart heart"></i> by Joella, Jessica A, and Andhika.</a>
        </div>
    </div>
</body>
</html>
