<?php
	session_start();
	if(isset($_SESSION['id_pasien'])){	
		if($_SESSION['id_pasien']!=""){
			header("location:http://sibi.if.unram.ac.id/sikuman/berandapasien.php");
		}else if(isset($_SESSION['id_admin'])){
			if($_SESSION['id_admin']==""){
				header("location:http://sibi.if.unram.ac.id/sikuman/Masuk.php");
			}else{
				header("location:http://sibi.if.unram.ac.id/sikuman/berandaadmin.php");
			}
		} else {
			header("location:http://sibi.if.unram.ac.id/sikuman/Masuk.php");
		}
	}else{
		header("location:http://sibi.if.unram.ac.id/sikuman/Masuk.php");
	}
?>