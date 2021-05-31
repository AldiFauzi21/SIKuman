<?php 
session_start();
include 'config.php';
// require 'regis.php';
$_SESSION["email_admin"] = "";
$_SESSION["nama_admin"] = "";
$_SESSION["id_admin"] = "";
$_SESSION["email_pasien"] = "";
$_SESSION["nama_pasien"] = "";
$_SESSION["id_pasien"] = "";
if( isset($_POST["Submit"]) ) {
	$email = mysqli_real_escape_string($conn,$_POST["email_P"]);	
	$password = mysqli_real_escape_string($conn,$_POST["password_P"]);
	
// $username = $_POST["username"];
		// $password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM pasien WHERE email_P = '$email'");
	// cek username
	$error = false;
	if( mysqli_num_rows($result) === 1) {
		// cek password
		$row = mysqli_fetch_assoc($result);
		$password = md5($password);
		if( $password == $row["password_P"] ) {
			// set session
			$_SESSION["email_pasien"] = $row["email_P"];
			$_SESSION["nama_pasien"] = $row["nama_P"];
			$_SESSION["id_pasien"] = $row["id_pasien"];
			
			header("Location: berandapasien.php");
			exit;
		}
	}
	$result = mysqli_query($conn, "SELECT * FROM administrator WHERE email_A = '$email'");
	// cek username
	$error = false;
	if( mysqli_num_rows($result) === 1) {
		// cek password
		$row = mysqli_fetch_assoc($result);
		if( $password == $row["password_A"] ) {
			// set session
			$_SESSION["email_admin"] = $row["email_A"];
			$_SESSION["nama_admin"] = $row["nama_A"];
			$_SESSION["id_admin"] = $row["id_admin"];
			
			header("Location: berandaadmin.php");
			exit;
		}
	}
	$error = true;
}
?>
<!DOCTYPE html>
<html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<title>Beranda</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="login3.css">
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
	<!-- <img src="image/latar1.jpg" position="background-image"> -->
	<!-- <style> body {
	font-family: montserrat;
	background-image: ("image/latar1.jpg");
	background-size: cover;
	height: calc(100vh - 80px);
}
	
</style> -->
	<nav>
		<input type="checkbox" id="check">
		<label for="check" class="checkbtn">
			<i class="fas fa-bars"></i>
		</label>
		<img src="image/logo_terang.png" align="left" top ="" height="40" class="zoom" alt="LOGO SIKUMAN">
		<ul>
				
			
			
			<!-- <img src="image/logo_terang.png" align="left" height="40" class="zoom" alt="LOGO SIKUMAN"> -->
			<li><a href="BerandaPengunjung.html">Beranda</a></li>
			<li><a href="tentangkami.html">Tentang Kami</a></li>
			<li><a href="dpu.html">Daftar Pertanyaan Umum</a></li>
			<!-- <li><a href="daftardokterper.php">Daftar Dokter</a></li> -->
		</ul>

	</nav>

		<div class="login">

		<?php if(isset($error)&&$error) : ?>
		<p style="color: red; font-style: italic;">E-mail atau kata sandi anda salah!</p> 
		<?php endif ; ?> 


		<!-- <img src="image/avatar.png" class="avatar" position> -->
		
		<h1>SILAHKAN LOGIN</h1>
		<form action="" method="post">
			<p>Email Anda</p>
			<input type="text" name="email_P" placeholder="Masukkan Email Anda">
			<p>Password Anda</p>
			<input type="Password" name="password_P" placeholder="Masukkan Kata Sandi">
			<input type="Submit" name="Submit" value="Login">
			<a href="#">Lupa Kata Sandi</a> 
		</form>
	</div>
</body>
</html>