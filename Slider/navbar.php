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
