<?php  
include 'config.php';
// require 'functions.php';
session_start();
if(!isset($_SESSION["email_pasien"])){
	header("Location: Masuk.php");
}else if($_SESSION["email_pasien"] == ""){
	header("Location: Masuk.php");
}
$_SESSION["email_dokter"] = "";
$_SESSION["nama_dokter"] = "";
$_SESSION["id_dokter"] = "";
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
$rekap=query("SELECT * FROM rekap_medis WHERE id_pasien = $id_pasien ORDER BY tgl_rekap DESC LIMIT 20");

// $pasien = query("SELECT nama_P FROM pasien WHERE id_pasien = $id_pasien");
// $nama_pasien=$_SESSION["nama_pasien"];

// $id_dokter=$_SESSION["id_dokter"];
// $dokter=query("SELECT nama_D FROM dokter WHERE id_dokter IN(SELECT id_dokter FROM rekap_medis WHERE id_dokter = $id_dokter)");

?>


<!DOCTYPE html>
<html>
<head>
	<title>Rekap Medis</title>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<link rel="stylesheet" type="text/css" href="style/cssregis.css">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

	<script type="text/javascript" src="grafik/Chart.js"></script>
	<link rel="stylesheet" type="text/css" href="style/rekap.css ">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>
<body>

	<nav class="navbar fixed-top navbar-expand-lg" style="background-color: #297aa8;">
                  <div class="container">
                      <img src="image/logo_terang.png" width="30" height="30" class="d-inline-block align-top" alt="">
                    <a class="navbar-brand" href="auth.php">SIKUMAN</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                      <a class="nav-link" href="auth.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="tentangkami.html">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="dpu.html">Daftar Pertanyaan Umum</a>
                    </li>
                    <?php if(isset($_SESSION["id_pasien"])){
                      if($_SESSION["id_pasien"]!=""){
                        echo "<li class='nav-item'>";
                        echo "<a class='nav-link' href='rekap.php'>Rekap Medis</a>";
                        echo "</li>";
                      }
                    }
                    ?>
                    <li class="nav-item">
                      <a class="nav-link" href="daftardokterper.php">Daftar Dokter</a>
                    </li>
                    <?php if(isset($_SESSION["id_admin"])){
                      if($_SESSION["id_admin"]!=""){
                        echo "<li class='nav-item'>";
                        echo "<a class='nav-link' href='daftarpasienper.php'>Daftar Pasien</a>";
                        echo "</li>";
                      }
                    }
                    ?>
                    <?php if($_SESSION["id_pasien"]!="" || $_SESSION["id_admin"]!=""){
                        echo "<li class='nav-item'>";
                        echo "<a class='nav-link' href='informasipasien.php'>Informasi</a>";
                        echo "</li>";
                    }
                    ?>
                    <?php if($_SESSION["id_pasien"]!="" || $_SESSION["id_admin"]!=""){
                        echo "<li class='nav-item'>";
                        echo "<a class='nav-link' href='grafik/grafikPenyakitProv.php'>Infografi</a>";
                        echo "</li>";
                    }
                    ?>
                    <?php if(isset($_SESSION["id_pasien"])){
                      if($_SESSION["id_pasien"]!=""){
                        echo "<li class='nav-item'>";
                        echo "<a class='nav-link' href='profil.php'>Profil</a>";
                        echo "</li>";
                      }
                    }
                    ?>
                  </ul>
                    </div>
                  </nav>
                </div>
                  </nav>
	<?php 
		$sql = $conn->query("SELECT * FROM pasien WHERE id_pasien = $id_pasien");
		$data=$sql->fetch_assoc();

			$ttl_P = $data['ttl_P'];

			$umur = new DateTime($ttl_P);
			$sekarang = new DateTime();
			$usia = $sekarang->diff($umur);
	 ?>
	 <br>
	 <br>
	 <br>
	 <br>
	<a href="logindokter.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" style="background-color: #297aa8 ; border-color: #297aa8; font-size: 11pt; " autocomplete="on">Tambah Rekap Medis</a>
	<br>
	<h1 class="rekap" style="color: grey;">REKAPITULASI MEDIS PASIEN</h1>
	<br>
	<br>
	<h5 class="rekap">Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $_SESSION["nama_pasien"]; ?></h5>
	<h5 class="rekap">Usia&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $usia->y."&nbsp"."Tahun "?><?= $usia->m."&nbsp"."Bulan "?><?= $usia->d."&nbsp"."Hari"?></h5>
	<h5 class="rekap">Golongan Darah&nbsp;&nbsp;&nbsp;&nbsp;: <?= $data['Goldar']; ?></h5>
	<div class="row">
			<div class="col-lg-5">
	<h3 class="rekap">Grafik Berat Badan (Kilogram)</h3>
	<br>
	<div style="width: 550px; margin: 1px auto;">
		<canvas id="grafikBeratBadan"></canvas>
	</div>
	<h1 class="rekap">Grafik Tekanan Darah</h1>
	<br>
	<h3 class="rekap">Sistolik (mmHg)</h3>
	<br>
	<div style="width: 550px; margin: 1px auto;">
		<canvas id="grafikSistolik"></canvas>
	</div>
	<h3 class="rekap">Diastolik (mmHg)</h3>
	<br>
	<div style="width: 550px; margin: 1px auto;">
		<canvas id="grafikDiastolik"></canvas>
	</div>
	<br>
</div>
<div class="col-lg-6">
	<h3 class="rekap">CATATAN MEDIS</h3>
	<table class="tabeli">
		<tr>
			<th>Tanggal</th>
			<!-- <th>Nama Pasien</th> -->
			<th>Nama Dokter</th>
			<th>Rumah Sakit</th>
			<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Keluhan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
			<th>Penyakit</th>
			<th>Obat</th>
		</tr>

		<?php $i = 1; ?>
	<?php foreach ( $rekap as $row ) : ?>
		

		<tr>
			<td><?= date("j F Y (g:i)", strtotime($row["tgl_rekap"]));?></td>
			<!-- <td><?= $_SESSION["nama_pasien"]; ?></td> -->
			<td><?php $id_dokter = $row["id_dokter"];
				$dokter=query("SELECT * FROM dokter WHERE id_dokter = $id_dokter")[0];
				echo $dokter["nama_D"]; ?></td>
			
			<td><?= $row["RS"]; ?></td>
			<td width="15"><?= $row["keluhan"]; ?></td>
			<td><?= $row["penyakit"]; ?></td>
			<td><?= $row["jenis_obat"]; ?> (<?= $row["aturan_obat"]; ?>)</td>
		</tr>
	<?php $i++; ?>

	<?php endforeach; ?>
	</table>
	<br>
</form>
</div>
<script>
		var ctx = document.getElementById("grafikBeratBadan").getContext('2d');
		var myChart = new Chart(ctx, {
			<?php 
				include 'config.php';
				$result = mysqli_query($conn, "SELECT * FROM rekap_medis WHERE id_pasien = $id_pasien ORDER BY tgl_rekap ASC LIMIT 20");
				$i = mysqli_num_rows($result);
				$provinsi = mysqli_fetch_assoc($result);
				$label = "";
				$data = "";
				foreach ($result as $prov) {
					$data.=$prov["BB"];
					$label.='"';
					$label.=date("g:i", strtotime($prov["tgl_rekap"]));
					$label.="/";
					$label.=date("j F", strtotime($prov["tgl_rekap"]));
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
							beginAtZero:false
						}
					}]
				}
			}
		});
	</script>
	<script>
		var ctx = document.getElementById("grafikSistolik").getContext('2d');
		var myChart = new Chart(ctx, {
			<?php 
				include 'config.php';
				$result = mysqli_query($conn, "SELECT * FROM rekap_medis WHERE id_pasien = $id_pasien ORDER BY tgl_rekap ASC LIMIT 20");
				$i = mysqli_num_rows($result);
				$provinsi = mysqli_fetch_assoc($result);
				$label = "";
				$data = "";
				foreach ($result as $prov) {
					$data.=$prov["sistolik"];
					$label.='"';
					$label.=date("g:i", strtotime($prov["tgl_rekap"]));
					$label.="/";
					$label.=date("j F", strtotime($prov["tgl_rekap"]));
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
							beginAtZero:false
						}
					}]
				}
			}
		});
	</script>
	<script>
		var ctx = document.getElementById("grafikDiastolik").getContext('2d');
		var myChart = new Chart(ctx, {
			<?php 
				include 'config.php';
				$result = mysqli_query($conn, "SELECT * FROM rekap_medis WHERE id_pasien = $id_pasien ORDER BY tgl_rekap ASC LIMIT 20");
				$i = mysqli_num_rows($result);
				$provinsi = mysqli_fetch_assoc($result);
				$label = "";
				$data = "";
				foreach ($result as $prov) {
					$data.=$prov["diastolik"];
					$label.='"';
					$label.=date("g:i", strtotime($prov["tgl_rekap"]));
					$label.="/";
					$label.=date("j F", strtotime($prov["tgl_rekap"]));
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
							beginAtZero:false
						}
					}]
				}
			}
		});
	</script>
	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>