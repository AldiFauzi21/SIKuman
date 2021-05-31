<?php  
include 'config.php';
// require 'functions.php';
session_start();
if(!isset($_SESSION["email_pasien"])){
	header("Location: Masuk.php");
}else if($_SESSION["email_pasien"] == ""){
	header("Location: Masuk.php");
}

function query($query){
	global $conn;
	$result=mysqli_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}

//$id_rekap=$_SESSION["id_rekap"];
$id_pasien=$_SESSION["id_pasien"];
// $id_dokter=$_SESSION["id_dokter"];
$rekap=query("SELECT * FROM rekap_medis WHERE id_pasien = $id_pasien");

// $pasien = query("SELECT nama_P FROM pasien WHERE id_pasien = $id_pasien");
// $nama_pasien=$_SESSION["nama_pasien"];

// $id_dokter=$_SESSION["id_dokter"];
// $dokter=query("SELECT nama_D FROM dokter WHERE id_dokter IN(SELECT id_dokter FROM rekap_medis WHERE id_dokter = $id_dokter)");

?>


<!DOCTYPE html>
<html>
<head>
	<title>Rekap Medis</title>
	<script type="text/javascript" src="Chart.js"></script>
	<link rel="stylesheet" type="text/css" href="style/rekap.css ">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>
<body>

	<div class="main ">
			
			<ul>
				<li><a href="berandapasien.php">Beranda</a></li>
				<li><a href="tentangkami">Tentang Kami</a></li>
				<li><a href="#">Daftar Pertanyaan Umum</a></li>
				<li><a href="#" class="active">Rekap</a></li>
				<li><a href="#">Informasi</a></li>
				<li><a href="daftardokterper.php">Daftar Dokter</a></li>
				<li><a href="profil.php">Profil</a></li>

			</ul> 
		</div>

		<br>
		<br>
		<br>
	<?php 
		$sql = $conn->query("SELECT * FROM pasien WHERE id_pasien = $id_pasien");
		$data=$sql->fetch_assoc();

			$ttl_P = $data['ttl_P'];

			$umur = new DateTime($ttl_P);
			$sekarang = new DateTime();
			$usia = $sekarang->diff($umur);
	 ?>
	 <?php 
				include 'config.php';
				$result = mysqli_query($conn, "SELECT * FROM rekap_medis WHERE id_pasien = $id_pasien ORDER BY tgl_rekap DESC LIMIT 14");
				$i = mysqli_num_rows($result);
				$provinsi = mysqli_fetch_assoc($result);
				$label = "";
				$data = "";
				foreach ($result as $prov) {
					$data.=$prov["id_pasien"];
					$label.='"';
					$label.=$prov["tgl_rekap"];
					$label.='"';
					if($i>1){
						$label.=',';
						$data.=',';
					}
					$i--;
				}
				var_dump($label);
				var_dump($data);
			?>
	<h4 class="rekap">Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $_SESSION["nama_pasien"]; ?></h4>
	<h4 class="rekap">Usia&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $usia->y."&nbsp"."Tahun" ?></h4>
	<h4 class="rekap">Golongan Darah&nbsp;: <?= $data['Goldar']; ?></h4>

	<table class="tabeli">
	<form action="" method="post">
	<div class="tambah">	
	<p> <a href="logindokter.php"> <b style="color: #0000FF">Tambah Rekap Medis</a></b>
	</div>
	<br>
	<br>
	<br>
	<h1 class="rekap">REKAP MEDIS PASIEN</h1>
	<div style="width: 1200px; margin: 1px auto;">
		<canvas id="myChart"></canvas>
	</div>
	<table class="tabeli">
		<tr>
			<th>No.</th>
			<th>Tanggal Rekap</th>
			<!-- <th>Nama Pasien</th> -->
			<th>Nama Dokter</th>
			<th>Rumah Sakit</th>
			<th>Penyakit</th>
			<th>Obat</th>
			<th>Keterangan Obat</th>
		</tr>

		<?php $i = 1; ?>
	<?php foreach ( $rekap as $row ) : ?>
		

		<tr>
			<td><?= $i; ?></td>
			<td><?= $row["tgl_rekap"]; ?></td>
			<!-- <td><?= $_SESSION["nama_pasien"]; ?></td> -->
			<td><?php $id_dokter = $row["id_dokter"];
				$dokter=query("SELECT * FROM dokter WHERE id_dokter = $id_dokter")[0];
				echo $dokter["nama_D"]; ?></td>
			
			<td><?= $row["RS"]; ?></td>
			<td><?= $row["penyakit"]; ?></td>
			<td><?= $row["jenis_obat"]; ?></td>
			<td><?= $row["aturan_obat"]; ?></td>
		</tr>
	<?php $i++; ?>

	<?php endforeach; ?>
	</table>
	<br>
</form>
<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			<?php 
				include 'config.php';
				$result = mysqli_query($conn, "SELECT * FROM rekap_medis WHERE id_pasien = $id_pasien ORDER BY tgl_rekap DESC LIMIT 14");
				$i = mysqli_num_rows($result);
				$provinsi = mysqli_fetch_assoc($result);
				$label = "";
				$data = "";
				foreach ($result as $prov) {
					$data.=$prov["id_rekap"];
					$label.='"';
					$label.=$prov["tgl_rekap"];
					$label.='"';
					if($i>1){
						$label.=',';
						$data.=',';
					}
					$i--;
				}
			?>
			type: 'line',
		
			data: {
				labels: [
				<?= $label;?>
				],
				datasets: [{
					label: '',
					data: [
					<?= $data;?>
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
</body>
</html>