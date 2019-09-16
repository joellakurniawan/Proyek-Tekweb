<?php
	include "connect.php";
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
</head>
<body>
<div class="container" style="padding: 50px;">
	<form action="upload.php" method="post" enctype="multipart/form-data">
	  <div class="form-group row">
	  <label for="inputNama" class="col-sm-2 col-form-label">Nama Airline</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" name="inputNama" placeholder="Nama Airline">
	    </div>
	  </div>
	  <div class="form-group row">
	    <label for="inputKode" class="col-sm-2 col-form-label">Kode</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" name="inputKode" placeholder="Kode">
	    </div>
	  </div>
	  <div class="form-group row">
	  <label for="inputFoto"class="col-sm-2 col-form-label">Foto</label>
	  	<input type="file" name="fileToUpload" id="fileToUpload">
	  </div>
	  <button type="submit" class="btn btn-primary" value="Upload Image" name="submit" width=auto>Submit</button>
	</form>
	</div>
</body>
</html>