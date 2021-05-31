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
	include 'config.php';
	?>

	<div style="width: 800px;margin: 0px auto;">
		<canvas id="myChart"></canvas>
	</div>

	<br/>
	<br/>
<!--https://obattradisionaltekanandarahtinggi.wordpress.com/2013/05/30/obat-tradisional-tekanan-darah-tinggi/ -->

	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'line',
		
			data: {
				labels: ["Hipotensi", "Normal", "Hipertensi"],
				datasets: [{
					label: '',
					data: [1,2,3],
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