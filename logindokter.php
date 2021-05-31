<?php  
// require 'functions.php';
include 'config.php';
session_start();
$_SESSION["email_dokter"] = "";
$_SESSION["nama_dokter"] = "";
$_SESSION["id_dokter"] = "";

if ( isset($_POST["login"]) ) {

  $email_D = $_POST["email_D"];
  $password_D = $_POST["password_D"];

  $result = mysqli_query($conn, " SELECT * FROM dokter WHERE email_D = '$email_D' AND password_D = '$password_D' ");

  $row = mysqli_fetch_assoc($result);
  if ( mysqli_num_rows($result) === 1) {
    $_SESSION["email_dokter"] = $row["email_D"];
      $_SESSION["nama_dokter"] = $row["nama_D"];
      $_SESSION["id_dokter"] = $row["id_dokter"];

    header("Location: Pengisianrekap.php");
    exit;


  }

}



?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="style/logindokter.css">
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
  <form action="" method="POST">
  <p class="judul">LOGIN DOKTER</p>
  <div class="login">
    <img src="image/avatar.png" class="avatar">
    <h1>SILAHKAN LOGIN</h1>
    <form>
      <p>Nama Pengguna</p>
      <input type="text" name="email_D" placeholder="Masukkan Email Dokter">
      <p>Password</p>
      <input type="Password" name="password_D" placeholder="Masukkan Kata Sandi">
      <input type="Submit" name="login">
      <a href="#">Lupa Kata Sandi</a> 
    </form>
  </div>
  <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>