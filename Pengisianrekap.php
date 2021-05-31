<?php 
// require 'functions.php';
include 'config.php';

session_start();

if(!isset($_SESSION["email_dokter"])){
	header("Location: logindokter.php");
}else if($_SESSION["email_dokter"] == ""){
	header("Location: logindokter.php");
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
function isi($data) {
	global $conn;
	date_default_timezone_set('Asia/Singapore');
	$tgl_rekap = date("Y-m-d h:i:s");
	$id_pasien =  $_SESSION["id_pasien"];
	$id_dokter =  $_SESSION["id_dokter"];
	$RS = htmlspecialchars($data["RS"]);
	$penyakit = htmlspecialchars($data["penyakit"]);
	$jenis_obat = htmlspecialchars($data["jenis_obat"]);
	$aturan_obat = htmlspecialchars($data["aturan_obat"]);
	$BB = htmlspecialchars($data["BB"]);
	$keluhan = htmlspecialchars($data["keluhan"]);
	$sistolik = htmlspecialchars($data["sistolik"]);
	$diastolik = htmlspecialchars($data["diastolik"]);


	//query insert data
	$query = "INSERT INTO rekap_medis
				VALUES
				('', '$tgl_rekap', '$RS', $id_pasien, $id_dokter, '$penyakit', '$jenis_obat', '$aturan_obat', '$BB', '$keluhan', '$sistolik', '$diastolik' )
				";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}
//cek apakah tombol submit sudah ditekan
if ( isset($_POST["SAVE"]) ) {

		// cek keberhasilan
 		if ( isi($_POST) > 0 ) {
 			echo "
 				<script>
 					alert('data berhasil ditambahkan');
 					document.location.href = 'rekap.php';
 				</script>
 			";
 		} else {
 			echo "
 				<script>
 					alert('data gagal ditambahkan');
 					document.location.href = 'rekap.php';
 				</script>
 			";
 		}

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Rekap Medis</title>
	<link rel="stylesheet" type="text/css" href="style/Pengisianrekap.css ">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<!--Navbar-->
             <nav class="navbar fixed-top navbar-expand-lg" style="background-color: #e3f2fd;">
                  <div class="container">
                      <img src="image/logo_gelap.png" width="30" height="30" class="d-inline-block align-top" alt="">
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
		
<br><br><br><br><br>
	<h1 class="rekap">CATATAN MEDIS PASIEN</h1>
	<form action="" method="post">
	<table class="tabeli">
		<tr>
		
		<!-- 	<th>ID Dokter</th> -->
			<th>Berat Badan</th>
			<th colspan="2">Tekanan Darah</th>
			<th>Keluhan</th>
			<th>Diagnosa Penyakit</th>
		</tr>

		<tr>
			<td>
				<input type="number" step="0.01" type="text" name="BB" id="BB" placeholder="Berat Badan" required>
			</td>
			<td>
				<input type="number" step="0.01" type="text" name="sistolik" id="sistolik" placeholder="Sistolik" required>
			</td>
			<td>
				<input type="number" step="0.01" type="text" name="diastolik" id="diastolik" placeholder="Diastolik" required>
			</td>
			<td>
				<table><textarea  name="keluhan" id="keluhan" placeholder="Keluhan" required></textarea></table>
			</td>
			<td>
				<table><input type="text" name="penyakit" id="penyakit" placeholder="Diagnosa" required> </table>
			</td>		
		</tr>

	</table>
	<table class="tabeli">
		<tr>
		
		<!-- 	<th>ID Dokter</th> -->
			<th>Rumah Sakit</th>
			<th>Obat</th>
			<th>Aturan Obat</th>
		</tr>

		<tr>
			<td>
				<input type="text" name="RS" id="RS" placeholder="Nama Rumah Sakit" required>
			</td>
			<td>
				<input type="text" name="jenis_obat" id="jenis_obat" placeholder="Obat" required>
			</td>
			<td>
				<input type="text" name="aturan_obat" id="aturan_obat" placeholder="Aturan" required>
			</td>
			
		</tr>

	</table>
	<br>
	<div class="button">
		<button type="submit" name="SAVE">SAVE</button>
	</div>
</form>
<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>