
<!DOCTYPE html>
<html>
<head>
	<title>Rekap Medis</title>
	<link rel="stylesheet" type="text/css" href="rekap.css ">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<script>

<?php foreach($adm as $row) : ?>
window.onload = function() {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title: {
		text: "Tensi Darah"
	},
	axisX: {
		title: "Time"
	},
	axisY: {
		title: "Percentage",
		suffix: "%"
	},
	data: [{
		type: "bar",
		name: "Tensi Darah",
		connectNullData: true,
		//nullDataLineDashType: "solid",
		xValueType: "dateTime",
		xValueFormatString: "DD MMM hh:mm TT",
		yValueFormatString: "#,##0.##\"%\"",
		dataPoints: [
			{ x: 1501048673000, y: 35.939 },
			{ x: 1501052273000, y: 45.896 },
			{ x: 1501055873000, y: 56.625 },
			{ x: 1501059473000, y: 26.003 },
			{ x: 1501063073000, y: 20.376 },
			{ x: 1501066673000, y: 19.774 },
			{ x: 1501070273000, y: 23.508 },
			{ x: 1501073873000, y: 18.577 },
			{ x: 1501077473000, y: 15.918 },
			{ x: 1501081073000, y: null }, // Null Data
			{ x: 1501084673000, y: 10.314 },
			{ x: 1501088273000, y: 10.574 },
			{ x: 1501091873000, y: 14.422 },
			{ x: 1501095473000, y: 18.576 },
			{ x: 1501099073000, y: 22.342 },
			{ x: 1501102673000, y: 22.836 },
			{ x: 1501106273000, y: 23.220 },
			{ x: 1501109873000, y: 23.594 },
			{ x: 1501113473000, y: 24.596 },
			{ x: 1501117073000, y: 31.947 },
			{ x: 1501120673000, y: 31.142 }
		]
	}]
});
chart.render();

}
<?php endforeach; ?>
</script>
</head>
<body>
<?php 
require 'functions.php';
$adm = query("SELECT * FROM admin ORDER BY id DESC");

tombol cari di klik
if ( isset($_POST["cari"]) ) { 
	$adm = cari($_POST["keyword"]);
}

?>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>
</html>