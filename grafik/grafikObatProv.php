<?php
session_start();
	include'config.php';
	$provinsi = mysqli_query($conn, "SELECT * FROM provinsi ");
	$jenis_obat = mysqli_query($conn, "SELECT DISTINCT jenis_obat FROM rekap_medis");
	$obat = $_GET["penyakit"];
?>
<!DOCTYPE html>
<html>
<head>
	<title>sikuman</title>
	<script type="text/javascript" src="Chart.js"></script>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
	body{
		font-family: roboto;
	}

	table{
		margin: 0px auto;
	}
	</style>
	<!--Navbar-->
             <nav class="navbar fixed-top navbar-expand-lg" style="background-color: #e3f2fd;">
                  <div class="container">
                      <img src="logo_gelap.png" width="30" height="30" class="d-inline-block align-top" alt="">
                    <a class="navbar-brand" href="Kembali.php">SIKUMAN</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                      <a class="nav-link" href="Kembali.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="http://sibi.if.unram.ac.id/sikuman/tentangkami.html">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="http://sibi.if.unram.ac.id/sikuman/dpu.html">Daftar Pertanyaan Umum</a>
                    </li>
                    <?php if(isset($_SESSION["id_pasien"])){
                      if($_SESSION["id_pasien"]!=""){
                        echo "<li class='nav-item'>";
                        echo "<a class='nav-link' href='http://sibi.if.unram.ac.id/sikuman/rekap.php'>Rekap Medis</a>";
                        echo "</li>";
                      }
                    }
                    ?>
                    <li class="nav-item">
                      <a class="nav-link" href="http://sibi.if.unram.ac.id/sikuman/daftardokterper.php">Daftar Dokter</a>
                    </li>
                    <?php if(isset($_SESSION["id_admin"])){
                      if($_SESSION["id_admin"]!=""){
                        echo "<li class='nav-item'>";
                        echo "<a class='nav-link' href='http://sibi.if.unram.ac.id/sikuman/daftarpasienper.php'>Daftar Pasien</a>";
                        echo "</li>";
                      }
                    }
                    ?>
                    <?php if($_SESSION["id_pasien"]!="" || $_SESSION["id_admin"]!=""){
                        echo "<li class='nav-item'>";
                        echo "<a class='nav-link' href='http://sibi.if.unram.ac.id/sikuman/informasipasien.php'>Informasi</a>";
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
                        echo "<a class='nav-link' href='http://sibi.if.unram.ac.id/sikuman/profil.php'>Profil</a>";
                        echo "</li>";
                      }
                    }
                    ?>
                  </ul>
                    </div>
                  </nav>
                  <br><br><br><br>
	<center>
		<h1>Infografi</h1>
	</center>
	<form action="" method="GET" class="form-inline my-2 my-lg-0">
							
							<div class="input-group">
            			    <label>Obat &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>	
								<select class="custom-select" id="inputGroupSelect04" name="penyakit">
									<option>
										<?php foreach( $jenis_obat as $row ) :?>
									<option value="<?= $row["jenis_obat"]; ?>">
										<?= $row["jenis_obat"]; ?>
									</option>
									<?php endforeach; ?>
									</option>
								</select>
							
						<div class="input-group-append">
							    <button class="btn btn-outline-secondary" type="submit">Pilih</button>
							  </div></div>
					</form>
					<form action="grafikObatKota.php" method="GET" class="form-inline my-2 my-lg-0">
							<div class="input-group">
            			    <label>Provinsi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>	
								<select class="custom-select" id="inputGroupSelect04" name="provinsi">
									<option>
										<?php
										 $i=1;foreach( $provinsi as $row ) :?>
									<option value="<?= $row["id_prov"]; ?>">
										<?= $row["nama_prov"]; ?>
									</option>
		              				<?php $i++; ?>
									<?php endforeach; ?>
									</option>
								</select>
							
						<div class="input-group-append">
							    <button class="btn btn-outline-secondary" type="submit">Pilih</button>
							  </div></div>

					</form>
<br>
<a href="grafikPenyakitProv.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" style="background-color: #297aa8 ; border-color: #297aa8; font-size: 11pt; " autocomplete="on">Infografi Penyakit</a>
<a href="Kembali.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" style="background-color: #DC143C ; border-color: #DC143C; font-size: 11pt; " autocomplete="on">Kembali</a>
	<div style="width: 1200px; margin: 1px auto;">
		<canvas id="myChart"></canvas>
	</div>
	<br/>
	<br/>

<!--https://obattradisionaltekanandarahtinggi.wordpress.com/2013/05/30/obat-tradisional-tekanan-darah-tinggi/ -->

	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			<?php 
				include 'config.php';
				$result = mysqli_query($conn, "SELECT * FROM provinsi");
				$i = mysqli_num_rows($result);
				$provinsi = mysqli_fetch_assoc($result);
				$label = "";
				foreach ($result as $prov) {
					$id =$prov["id_prov"];
					$hitung = mysqli_query($conn, "SELECT * FROM rekap_medis WHERE jenis_obat = '$obat' AND id_pasien IN(SELECT id_pasien FROM pasien WHERE id_kota IN(SELECT id_kota FROM kota WHERE id_prov = $id))");
					$jumlah = mysqli_num_rows($hitung);
					$data.=$jumlah;
					$label.='"';
					$label.=$prov["nama_prov"];
					$label.='"';
					if($i>1){
						$label.=',';
						$data.=',';
					}
					$i--;
				}
			?>
			type: 'bar',
		
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