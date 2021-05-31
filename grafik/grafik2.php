<?php 
	include'config.php';
	$nama_penyakit = mysqli_query($conn, "SELECT DISTINCT penyakit FROM rekap_medis");
	$penyakit = $_GET["penyakit"];
?>
<!DOCTYPE html>
<html>
<head>
	<title>sikuman</title>
	<script type="text/javascript" src="Chart.js"></script>
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
	<center>
		<h1>Infografi</h1>
	</center>
	<form action="" method="GET" class="form-inline my-2 my-lg-0">
							
							<br><br>
            			    <label>Penyakit &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>	
								<select class="form-control" name="penyakit">
									<option>
										<?php foreach( $nama_penyakit as $row ) :?>
									<option value="<?= $row["penyakit"]; ?>">
										<?= $row["penyakit"]; ?>
									</option>
									<?php endforeach; ?>
									</option>
								</select>
							
						<button class="btn btn-primary btn-lg btn-block" type="submit" name="butprov">Pilih</button>
					</form>
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
					$hitung = mysqli_query($conn, "SELECT * FROM rekap_medis WHERE penyakit = '$penyakit' AND id_pasien IN(SELECT id_pasien FROM pasien WHERE id_kota IN(SELECT id_kota FROM kota WHERE id_prov = $id))");
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
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
</body>
</html>