<?php
	$id ="12-19-20";
	$keterangan="";
	if (substr_count($id, '-')==1){
		$keterangan="1transit";
	}
	else if (substr_count($id, '-')==2){
		$keterangan="2transit";
	}
	else{
		$keterangan="langsung";
	}
	echo $keterangan;
?>