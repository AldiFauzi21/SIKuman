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

session_start();
if(!isset($_SESSION["email_pasien"])){
	header("Location: Masuk.php");
}else if($_SESSION["email_pasien"] == ""){
	header("Location: Masuk.php");
}

$id_pasien=$_SESSION["id_pasien"];
$pasien=query("SELECT * FROM pasien WHERE id_pasien ='$id_pasien'")[0];
$_SESSION["password"]=$pasien["password_P"];


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
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style/profil.css">


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></s  cript>


  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body background="image/foto3.jpg">

  <header>
    
<!--Navbar-->
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


    <br>
    <br>
    <br>
    <br>
    <br>

     <div class="foto">
        <img src="<?= $pasien["foto_P"] ?>"width="200px" height="200px">
      </div>


    <div align="left" class="bio">

      <p>NIK : <span style="font-family: Verdana, Geneva, sans-serif; letter-spacing: normal;"> <?= $pasien["NIK_P"]; ?></p> 
      <p>NAMA : <span style="font-family: Verdana, Geneva, sans-serif; letter-spacing: normal;"> <?= $pasien["nama_P"]; ?></p>
      <p>JENIS KELAMIN : <span style="font-family: Verdana, Geneva, sans-serif; letter-spacing: normal;"> <?= $pasien["kelamin_P"]; ?></p>
      <p>TTL : <span style="font-family: Verdana, Geneva, sans-serif; letter-spacing: normal;"> <?= $pasien["ttl_P"]; ?></p> 
      <p>ALAMAT : <span style="font-family: Verdana, Geneva, sans-serif; letter-spacing: normal;"> <?= $pasien["alamat_P"]; ?></p>


    </div>

    <div align="left" class="bio2">
      <p>PEKERJAAN : <span style="font-family: Verdana, Geneva, sans-serif; letter-spacing: normal;"> <?= $pasien["pekerjaan"]; ?> </p>
      <p>EMAIL : <span style="font-family: Verdana, Geneva, sans-serif; letter-spacing: normal;"> <?= $pasien["email_P"]; ?></p>
      <p>NO.HP : <span style="font-family: Verdana, Geneva, sans-serif; letter-spacing: normal;"> <?= $pasien["no_hpP"]; ?></p>
    </div>  -->

    <div class="button1">
       <button class="btn btn-primary"><a href="hapusprofil.php?id_pasien=<?= $pasien["id_pasien"]; ?>" style="color: white;" onclick="return confirm('Apakah anda yakin?')">Hapus</a></button>
      </div>

      <div class="button2">
        <button class="btn btn-primary"><a href="editprofil.php?id_pasien=<?= $pasien["id_pasien"]; ?>" style="color: white;">Edit</a></button>
      </div>
      <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>