<?php  
include 'config.php';

function query($query){
	global $conn;
	$result=mysqli_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}

$pasien = query("SELECT * FROM pasien INNER JOIN kota ON pasien.id_kota = kota.id_kota INNER JOIN provinsi ON  kota.id_prov = provinsi.id_prov");


?>

<!DOCTYPE html>
<html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<title>Beranda</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style/daftarpasien2.css">
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
	<nav>
		<input type="checkbox" id="check">
		<label for="check" class="checkbtn">
			<i class="fas fa-bars"></i>
		</label>
		
		<div class="main ">
			
			<ul>
				<li><a href="#">Beranda</a></li>
				<li><a href="#">Tentang Kami</a></li>
				<li><a href="#">Daftar Pertanyaan Umum</a></li>
				<li><a href="#">Rekap</a></li>
				<li><a href="#">Informasi</a></li>
				<li><a href="#">Infografi</a></li>
				<li><a href="#">Daftar Dokter</a></li>
			</ul> 
		</div>
	</nav>



	<h1 class="rekap">DAFTAR PASIEN</h1>
	<table class="tabeli">
			<tr>
			<th>No</th>
			<th>Nama Pasien</th>
			<!-- <th>Alamat</th> -->
			<th>Nomor Handphone</th>
			<th>Provinsi</th>
		</tr>

		<?php $i = 1; ?>
		<?php foreach( $pasien as $row ) : ?>

		<tr>
			<td><?= $i; ?></td>
			<!-- <td><img src="images/<?= $row["foto_P"] ?>" width="100"></td> -->
			<td><?= $row["nama_P"]; ?></td>
			<!-- <td><?= $row["alamat_P"]; ?></td> -->
			<td><?= $row["no_hpP"]; ?></td>
			<td><?= $row["nama_prov"]; ?></td> 
			<!-- <td><?= $row["RS_D"]; ?></td> -->
		</tr>

		<?php $i++;  ?>
		<?php endforeach; ?>
		

	</table>
</body>
