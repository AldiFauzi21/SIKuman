<?php 
session_start();
if(isset($_SESSION["email_admin"])){
	if($_SESSION["email_admin"]!=""){
		header("Location: berandaadmin.php");
	}elseif (isset($_SESSION["email_pasien"])) {
		if($_SESSION["email_pasien"]!=""){
			header("Location: berandapasien.php");
		}else{
			header("Location: BerandaPengunjung.html");
		}
	}else{
		header("Location: BerandaPengunjung.html");
	}
}else{
	header("Location: BerandaPengunjung.html");
}
?>