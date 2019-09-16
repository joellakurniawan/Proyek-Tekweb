<?php
	session_start();
	include "connect.php";
	if(!isset($_SESSION['username']) ){
		header('Location:main.php');
	}
	if(isset($_POST['show'])){
		$id = $_SESSION['iduser']; 
		$sql='SELECT * FROM `pesanan` p JOIN jadwal_penerbangan jp ON p.id_jdpenerbangan = jp.id_jdpenerbangan JOIN pesawat ps ON jp.id_pesawat = ps.id_pesawat JOIN airlines ai ON ai.id_airlines = ps.id_airlines WHERE id_customer='.$id.'';
		$result=mysqli_query($con, $sql);
		while($row=mysqli_fetch_array($result)){
			echo '
            <tr>
            <td class="'.$row['id_pesanan'].'">'.$row['tanggal_penerbangan'].'</td>
            <td>'.$row['jam_berangkat'].'</td>
            <td>'.$row['jam_tiba'].'</td>
            <td>'.$row['lokasi_awal'].'</td>
            <td>'.$row['lokasi_tujuan'].'</td>
            <td>'.$row['jumlah_passenger'].'</td>
            <td>'.$row['nama_airlines'].'</td>
            <td>
            <a class="add addPesanan" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
            <a class="update updatePesanan" title="Search" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
            <a class="edit" title="Reschedule" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
            <a class="delete" title="Cancel Order" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
            </td>
            </tr>
            ';
		}
		exit();
	}
	if(isset($_POST['delete_table'])){
        $id = $_POST['id'];
        $sql='SELECT * FROM `pesanan` p JOIN jadwal_penerbangan jp ON p.id_jdpenerbangan = jp.id_jdpenerbangan JOIN pesawat ps ON jp.id_pesawat = ps.id_pesawat JOIN airlines ai ON ai.id_airlines = ps.id_airlines WHERE id_pesanan='.$id.'';
        $result=mysqli_query($con, $sql);
        $row=mysqli_fetch_array($result);
        //echo($row['total_biaya']);
        $query = mysqli_query($con, "UPDATE customers SET saldo=saldo+".$row['total_biaya']." WHERE id_customer=".$row['id_customer']."");
        $query = mysqli_query($con, "DELETE FROM penumpang WHERE id_pesanan=$id");
        $query = mysqli_query($con, "DELETE FROM pesanan WHERE id_pesanan=$id");
        exit();
    }
    if(isset($_POST['update_pesanan'])){
        $id = $_POST['id'];
        $tanggal_penerbangan = $_POST['tanggal_penerbangan'];
        $jam_berangkat = $_POST['jam_berangkat'];
        $jam_tiba = $_POST['jam_tiba'];
        $lokasi_awal = $_POST['lokasi_awal'];
        $lokasi_tujuan = $_POST['lokasi_tujuan'];
        $jumlah_passenger = $_POST['jumlah_passenger'];
        $nama_airlines = $_POST['nama_airlines'];
        // echo($id);
        // echo($tanggal_penerbangan.$jam_berangkat.$jam_tiba.$lokasi_awal.$lokasi_tujuan.$jumlah_passenger.$nama_airlines);
        $_SESSION['id_pesanan']=$id;
        $_SESSION['tanggal_penerbangan']=$tanggal_penerbangan;
        $_SESSION['jam_berangkat']=$jam_berangkat;
        $_SESSION['jam_tiba']=$jam_tiba;
        $_SESSION['lokasi_awal']=$lokasi_awal;
        $_SESSION['lokasi_tujuan']=$lokasi_tujuan;
        $_SESSION['jumlah_passenger']=$jumlah_passenger;
        $_SESSION['nama_airlines']=$nama_airlines;
        $_SESSION['reschedule']=1;
        $sql='SELECT * FROM `pesanan` p JOIN jadwal_penerbangan jp ON p.id_jdpenerbangan = jp.id_jdpenerbangan JOIN pesawat ps ON jp.id_pesawat = ps.id_pesawat JOIN airlines ai ON ai.id_airlines = ps.id_airlines WHERE id_pesanan='.$id.'';
        $result=mysqli_query($con, $sql);
        $row=mysqli_fetch_array($result);
        //echo($row['total_biaya']);
        $query = mysqli_query($con, "UPDATE customers SET saldo=saldo+".$row['total_biaya']." WHERE id_customer=".$row['id_customer']."");
        $query = mysqli_query($con, "DELETE FROM penumpang WHERE id_pesanan=$id");
        $query = mysqli_query($con, "DELETE FROM pesanan WHERE id_pesanan=$id");
        $query = mysqli_query($con, "UPDATE airlines SET nama_airlines='$nama', kode_airlines='$kode', foto_airlines='$foto' WHERE id_airlines=$id");
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
    <link href="pembayaran/assets/css/themify-icons.css" rel="stylesheet">

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
</style>
</head>
<script>
        $(document).ready(function(){
            //$("#searchflight").click();
            //alert($(".pill-1 a").html());
            showdata();
            $(document).on("click", ".edit", function(){
            	var counter = 0;
                $(this).parents("tr").find("td:not(:last-child)").each(function(){
                	if(counter == 0){
                		$(this).html('<input type="text" class="datepicker form-control tgl" width="150" value="' + $(this).text() + '">');	
                	}
                    counter++;
                });
                table = $(this).parents("table").attr("id");
                $(this).parents("tr").find(".update"+table+", .edit").toggle();
                btn = ".add-"+table;
                $(btn).attr("disabled", "disabled");
                tdpicker();
            });
            $(document).on("click", ".delete", function(){
                id = $(this).closest('tr').children('td:first').attr('class');
                table = $(this).parents("table").attr("id");
                $(this).parents("tr").remove();
                btn = ".add-"+table;
                $(btn).removeAttr("disabled");
                table = table.toLowerCase();
                $.ajax({
                    url : "my_booking.php",
                    type : "POST",
                    async : false,
                    cache : false,
                    data : {
                        delete_table : 1,
                        table : table,
                        id : id
                    },
                    success: function(result){
                    	alert(result);
                    }
                });
            }); 
            $(document).on("click", ".updatePesanan", function(){
                id = $(this).closest('tr').children('td:first').attr('class');
                var empty = false;
                var input = $(this).parents("tr").find('input[type="text"]');
                input.each(function(){
                    if(!$(this).val()){
                        $(this).addClass("error");
                        empty = true;
                    } else{
                        $(this).removeClass("error");
                    }
                });
                $(this).parents("tr").find(".error").first().focus();
                var arr = [];
                var counter = 0;
                //alert(arr[0]);
                if(!empty){
                	input.each(function(){
                        arr[counter] = $(this).val();
                        counter++;
                        $(this).parent("td").html($(this).val());
                        //alert($(this).parent("td").html());
                	});
                	counter = 0;
                	$(this).closest('tr').children('td').each(function(){
                		if(counter != 0){
                			arr[counter]= $(this).html();	
                		}
                		counter++;
                       // alert($(this).html());
                	});
                	// alert(arr[0]);
                	// alert(arr[1]);
                	// alert(arr[2]);
                	// alert(arr[3]);
                	// alert(arr[4]);
                	// alert(arr[5]);
                	// alert(arr[6]);
                    $(this).parents("tr").find(".updatePesanan, .edit").toggle();
                    $.ajax({
                        url : "my_booking.php",
                        type : "POST",
                        async : false,
                        cache : false,
                        data : {
                            update_pesanan : 1,
                            id : id,
                            tanggal_penerbangan: arr[0],
                            jam_berangkat:arr[1],
                            jam_tiba:arr[2],
                            lokasi_awal:arr[3],
                            lokasi_tujuan: arr[4],
                            jumlah_passenger: arr[5],
                            nama_airlines: arr[6]
                        },
                        success: function(result){
                        	window.location= "http://lkmm-td.petra.ac.id/Slider/filterow2.php";
                        }
                    });
                    showdata();
                }       
            });
        });
        function showdata(){
			$.ajax({
				url : "my_booking.php",
				type : "POST",
				async : false,
				cache : false,
				data : {
					show : 1
				},
				success: function(result){
					$('.pesanan').html(result);
				}
			});
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
	<div class="container" style="background-color: #fff;margin-top: 20px; grid-template-columns:repeat(); ">
		<h1>My Ticket</h1>
		<div class="table-wrapper">
                <div class="table-title">
                </div><br>
                <table class="table table-bordered tablePesanan table-hover" id="Pesanan">
                    <thead>
                        <tr>
                            <th>Tanggal Penerbangan</th>
                            <th>Jam Berangkat</th>
                            <th>Jam Tiba</th>
                            <th>Lokasi Awal</th>
                            <th>Lokasi Tujuan</th>
                            <th>Jumlah Penumpang</th>
                            <th>Nama Airlines</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="pesanan"> 
                    </tbody>
                </table>
            </div>
            <br>
	</div>
    <div class="footer">
        <div class="container text-center">
            Made with <i class="fa fa-heart heart"></i> by Joella, Jessica A, and Andhika.</a>
        </div>
    </div>
</body>
</html>