<?php
session_start();
include "header.php";
include "connect.php";
	// if(isset($_POST['login'])){
	// 	$username = $_POST['username'];
	// 	$password = $_POST['password'];
	// 	$query = mysqli_query($con, "SELECT * FROM admin WHERE username='$username' and password='$password'");
	// 	$hasil = mysqli_fetch_array($query);
	// 	if(mysqli_num_rows($query) == 1){
	// 		echo 'yes';
	// 	}
	// 	else{
	// 		echo 'no';
	// 	}
	// 	exit();
	// }
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>

<body style="margin: 0; padding: 0; align-items: center; justify-content: center;">
	<?php
	include "navbar.php";
	include "sliders.html";
	?>

    <script>
        $(document).ready(function(){
            //$("#searchflight").click();
            //alert($(".pill-1 a").html());
            let dropdown = $('.city-from');
            dropdown.empty();
            dropdown.append('<option selected="true" disabled>Choose City</option>');
            dropdown.prop('selectedIndex', 0);

            let dropdown2 = $('.city-to');
            dropdown2.empty();
            dropdown2.append('<option selected="true" disabled>Choose City</option>');
            dropdown2.prop('selectedIndex', 0);

            const url = 'airports.json';

            // Populate dropdown with list of provinces
            $.getJSON(url, function (data) {
              $.each(data, function (key, entry) {
                dropdown.append($('<option></option>').attr('name', entry.code).text(entry.city));
                dropdown2.append($('<option></option>').attr('name', entry.code).text(entry.city));
            })
          });
            $(".city-from").select2( {
                placeholder: "Select Country",
            } );
            $(".city-to").select2( {
                placeholder: "Select Country",
            } );
        });

    </script>

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

<div class="searching">
    <div class="container search-container">
        <br>
        <h2>Search for Cheap Flights</h2>
        <div class="tabbable">
         <ul class="nav nav-pills nav-sm nav-no-br mb10" role="tablist">
          <li class="pill-1 rt"><a class="nav-link active" href="#flight-search-1" data-toggle="pill" role="tab" style="color: black;">Round Trip</a></li>
          <li class="pill-1 ow"><a class="nav-link" href="#flight-search-2" data-toggle="pill" role="tab" style="color: black;">One Way</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade in active show" id="flight-search-1">
            <form class="search-form" action="filterrt2.php" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <label>From</label>
                        <select class="city-from" style="width: 100%;" name="rt_lokasiawal"></select>
                    </div>
                    <div class="col-md-6">
                        <label>To</label>
                        <select class="city-to" style="width: 100%;" name="rt_lokasitujuan"></select>
                    </div>
                </div>
                <div class="input-daterange" data-date-format="M d, D">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group form-group-lg form-group-icon-left"><i class="far fa-calendar-alt input-icon input-icon-highlight"></i>
                                <label>Departing</label>
                                <input name="rt_tanggalberangkat" class="form-control datepicker1" name="start" type="text">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group form-group-lg form-group-icon-left"><i class="far fa-calendar-alt input-icon input-icon-highlight"></i>
                                <label>Returning</label>
                                <input name="rt_tanggalpulang" class="form-control datepicker2" name="end" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-lg form-group-select-plus" id="foobar">
                                <label>Passengers</label>
                                <select name="rt_passengers" class="form-control">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option selected="selected">4</option>
                                    <option>5</option>
                                    <option>6</option>
                                    <option>7</option>
                                    <option>8</option>
                                    <option>9</option>
                                    <option>10</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <button class="btn btn-primary btn-lg" type="submit" style="color: black;" value="sfrt">Search for Flights</button>
            </form>
        </div>

        <div class="tab-pane fade" id="flight-search-2">
            <form class="search-form" action="filterow2.php" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <label>From</label>
                        <select class="city-from" style="width: 100%;" name="ow_lokasiawal"></select>
                    </div>
                    <div class="col-md-6">
                        <label>To</label>
                        <select class="city-to" style="width: 100%;" name="ow_lokasitujuan"></select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-group-lg form-group-icon-left"><i class="far fa-calendar-alt input-icon input-icon-highlight"></i>
                            <label>Departing</label>
                            <input name="ow_tanggalberangkat" class="date-pick form-control datepicker3" data-date-format="M d, D" type="text">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-lg form-group-select-plus">
                            <label>Passengers</label>
                            <select  name="ow_passengers" class="form-control">
                             <div class="select-items">
                                 <option><div>1</div></option>
                                 <option><div>2</div></option>
                                 <option><div>3</div></option>
                                 <option selected="selected"><div>4</div></option>
                                 <option><div>5</div></option>
                                 <option><div>6</div></option>
                                 <option><div>7</div></option>
                                 <option><div>8</div></option>
                                 <option><div>9</div></option>
                                 <option><div>10</div></option>
                             </div>
                         </select>
                     </div>
                 </div>
             </div>
             <br>
             <button class="btn btn-primary btn-lg" type="submit" style="color: black;" value="sfrt">Search for Flights</button>
         </form>
     </div>

 </div> 
</div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
       $('.datepicker1').datepicker({
        uiLibrary: 'bootstrap4', showRightIcon: false, format: 'yyyy-mm-dd'
    });
       $('.datepicker2').datepicker({
        uiLibrary: 'bootstrap4', showRightIcon: false, format: 'yyyy-mm-dd'
    });
       $('.datepicker3').datepicker({
        uiLibrary: 'bootstrap4', showRightIcon: false, format: 'yyyy-mm-dd'
    });
   })
</script>
  <div class="footer">
      <div class="text-center">
          Made with <i class="fa fa-heart heart"></i> by Joella, Jessica A, and Andhika.</a>
      </div>
  </div>
</body>
</html>
