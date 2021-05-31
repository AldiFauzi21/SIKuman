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
		<h2>Tensi Darah</h2>
	</center>


	<?php 
	include 'koneksi.php';
	?>

	<div style="width: 800px;margin: 0px auto;">
		<canvas id="myChart"></canvas>
	</div>

	<br/>
	<br/>

	<table border="1">
		<thead>
			<tr>
				<th>No</th>
				<th>Hipotensi</th>
				<th>Normal</th>
				<th>Hipertensi</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$no = 1;
			$data = mysqli_query($koneksi,"SELECT * FROM rekap_medis");
			while($d=mysqli_fetch_array($data)){
				?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $d['Hipotensi']; ?></td>
					<td><?php echo $d['Normal']; ?></td>
					<td><?php echo $d['Hipertensi']; ?></td>
									</tr>
				<?php 
			}
			?>
		</tbody>
	</table>
<!--https://obattradisionaltekanandarahtinggi.wordpress.com/2013/05/30/obat-tradisional-tekanan-darah-tinggi/ -->

	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'line',
		
			data: {
				labels: ["Hipotensi", "Normal", "Hipertensi"],
				datasets: [{
					label: '',
					data: [
					<?php 
					$jumlah_hipotensi = mysqli_query($koneksi,"SELECT * FROM rekap_medis WHERE Hipotensi='Ya'");
					echo mysqli_num_rows($jumlah_hipotensi);
					?>, 
					<?php 
					$jumlah_normal = mysqli_query($koneksi,"SELECT * FROM rekap_medis WHERE Normal='Ya'");
					echo mysqli_num_rows($jumlah_normal);
					?>, 
					<?php 
					$jumlah_hipertensi = mysqli_query($koneksi,"SELECT * FROM rekap_medis WHERE Hipertensi='Ya'");
					echo mysqli_num_rows($jumlah_hipertensi);
					?>
					],
					backgroundColor: [
					'rgba(240, 240, 240, 0.2)',
					'rgba(240, 240, 240, 0.2)',
					'rgba(240, 240, 240, 0.2)',
					'rgba(240, 240, 240, 0.2)'
					],
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)'
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