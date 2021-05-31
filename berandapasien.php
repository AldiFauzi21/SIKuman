<?php 
session_start();
if(!isset($_SESSION["email_pasien"])){
	header("Location: Masuk.php");
}else if($_SESSION["email_pasien"] == ""){
	header("Location: Masuk.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Informasi Pasien</title>
	<link rel="stylesheet" type="text/css" href="style/informasi.css ">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<meta name="viewport" content="width=device=width, initial-scale=1.0"/>
</head>
<body>
	<header>
		
		<div class="main ">
			<ul>
				<li><a href="berandapasien.php" class="active">Beranda</a></li>
				<li><a href="tentangkami.html">Tentang Kami</a></li>
				<li><a href="dpu.html">Daftar Pertanyaan Umum</a></li>
				<li><a href="rekap.php">Rekap</a></li>
				<li><a href="daftardokterper.php">Daftar Dokter</a></li>
				<li><a href="informasipasien.php" >Informasi</a></li>
				<li><a href="grafik/grafikPenyakitProv.php">Infografi</a></li>
				<li><a href="profil.php">Profil</a></li>
				<li><a href="Masuk.php">Keluar</a></li>
			</ul> 
			<br>
			<img src="image/logo_terang.png" height="40" class="zoom" alt="LOGO SIKUMAN">
		</div>

		<div class="title">
			<h1>SIKUMAN</h1>
			<h4>Kesehatan Anda Lebih Penting</h4>
			<br><br><br><br>
			<h4>Selamat Datang</h4><br>
			<h4><?= $_SESSION["nama_pasien"] ?></h4>
		</div>

		<!-- <div class="search-box"> -->
			<!-- <input class="search-txt" type="text" name="" placeholder="type to search"> -->
			<!-- <a class="search-btn" href="#"> -->
				<!-- <i class="fa fa-search" aria-hidden="true"></i> -->
			<!-- </a> -->
			<!-- </div> -->
			<br><br><br>