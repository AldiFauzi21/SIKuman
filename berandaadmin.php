<?php 
session_start();
if(!isset($_SESSION["email_admin"])){
	header("Location: Masuk.php");
}else if($_SESSION["email_admin"] == ""){
	header("Location: Masuk.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sistem Kesehatan Umum</title>
	<link rel="stylesheet" type="text/css" href="style/berandaadmin.css ">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<meta name="viewport" content="width=device=width, initial-scale=1.0"/>
</head>
<body>
	<header>
		
		<div class="main ">
			<!-- <style type="text/css"></style> -->
			<ul>
				<img src="image/logo_terang.png" height="40" position="left" class="zoom" alt="LOGO SIKUMAN">
				<li><a href="berandaadmin.php" class="active">Beranda</a></li>
				<li><a href="tentangkami.html">Tentang Kami</a></li>
				<li><a href="dpu.html">Daftar Pertanyaan Umum</a></li>
				<li><a href="grafik/grafikPenyakitProv.php">Infografi</a></li>
				<li><a href="informasipasien.php">Informasi</a></li>
				<li><a href="daftardokterper.php">Daftar Dokter</a></li>	
				<li><a href="daftarpasienper.php">Daftar Pasien</a></li>	
				<li><a href="Masuk.php">Keluar</a></li>				

			</ul>
			<br>
			
		</div>

		<div class="title">
			<h1>SIKUMAN</h1>
			<h4>Kesehatan Anda Lebih Penting</h4>
			<br><br><br><br>
			<h4>Selamat Datang</h4><br>
			<h4><?= $_SESSION["nama_admin"] ?></h4>
		</div>

		<!-- <div class="search-box"> -->
			<!-- <input class="search-txt" type="text" name="" placeholder="type to search"> -->
			<!-- <a class="search-btn" href="#"> -->
				<!-- <i class="fa fa-search" aria-hidden="true"></i> -->
			<!-- </a> -->
			<!-- </div> -->
		
	</header>

</body>
</html>