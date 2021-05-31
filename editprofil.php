<?php
include 'config.php';

session_start();
if(!isset($_SESSION["email_pasien"])){
	header("Location: Masuk.php");
}else if($_SESSION["email_pasien"] == ""){
	header("Location: Masuk.php");
}

//ambil data di URL
$id_pasien = $_GET["id_pasien"];

$pasien=query("SELECT * FROM pasien WHERE id_pasien = $id_pasien")[0];



function query($query){
	global $conn;
	$result=mysqli_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}

function edit($data, $id) {
	global $conn;

	// ambil data dari tiap elemen dalam form
	$nama_P = htmlspecialchars($data["nama_P"]);
	$password_P = htmlspecialchars($data["password_P"]);
	$NIK_P = htmlspecialchars($data["NIK_P"]);
	$email_P = htmlspecialchars($data["email_P"]);
	$alamat_P = htmlspecialchars($data["alamat_P"]);
	$no_hpP = htmlspecialchars($data["no_hpP"]);
	$Goldar = htmlspecialchars($data["Goldar"]);
	$kelamin_P = htmlspecialchars($data["kelamin_P"]);
	$status = htmlspecialchars($data["status"]);
	$pekerjaan = htmlspecialchars($data["pekerjaan"]);
	$ttl_P = htmlspecialchars($data["ttl_P"]);
	$foto_P = htmlspecialchars($data["foto_P"]);
	$id_kota = htmlspecialchars($data["id_kota"]);


	$query = "UPDATE pasien SET 
				email_P = '$email_P',
				no_hpP = '$no_hpP',
				pekerjaan = '$pekerjaan'
				WHERE id_pasien = $id
			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
	var_dump($query);
}

if ( isset($_POST["simpan"]) ) {

	if ( edit($_POST, $id_pasien) > 0 ) {
		$_SESSION["email_pasien"]=htmlspecialchars($_POST["email_P"]);
		echo "
		<script>
			alert('data berhasil diubah!');
			document.location.href = 'profil.php';		
		</script>
		";
	}
	else {
		echo "
		<script>
			alert('data gagal diubah!');
			document.location.href = 'profil.php';
		</script>
		";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Profil Anda</title>
  <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="owlcarousel/assets/owl.carousel.min.css"> -->
    <!-- <link rel="stylesheet" href="owlcarousel/assets/owl.theme.default.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css">    
    <link rel="stylesheet" href="style/css/style.css">

    <!--My CSS-->
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style/profilinput.css">


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
  <header>
<!--   	 <?php 
    // var_dump($pasien); ?> -->
    
<!--Navbar-->
             <nav class="navbar fixed-top navbar-expand-lg" style="background-color: #297aa8;">
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

    <br>
    <br>
    <br>
    <br>
    <br>
<div class="jumbotron jumbotron-fluid">
<div class="container">
<form action="" method="POST">
	<br>
    <br>
    <br>
    <br>
    <br>
     <input type="hidden" name="id_pasien" value="<?= $pasien["id_pasien"]; ?>">
     <input type="hidden" name="foto_P" value="<?= $pasien["foto_P"]; ?>">
     <input type="hidden" name="id_kota" value="<?= $pasien["id_kota"]; ?>">
     <input type="hidden" name="Goldar" value="<?= $pasien["Goldar"]; ?>">
      <input type="hidden" name="Goldar" value="<?= $pasien["password_P"]; ?>">
    <div align="left" class="bio">
      <p class="d"c>PEKERJAAN  :<input type="text" name="pekerjaan" id="pekerjaan" required value="<?= $pasien["pekerjaan"]; ?>"></p>
      <p class="i"c>EMAIL :<input type="text" name="email_P" id="email_P" required value="<?= $pasien["email_P"]; ?>"></p>
      <p class="j">NO.HP :<input type="text" name="no_hpP" id="no_hpP" required value="<?= $pasien["no_hpP"]; ?>"> </p>
    </div> 
<br><br><br><br><br><br>
    <div class="button1">
        <button class="btn btn-primary">Hapus</button>
      </div>
      <div class="button2">
        <button class="btn btn-primary" type="submit" name="simpan">Save</button>
      </div>
</form>
</div></div>
<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>