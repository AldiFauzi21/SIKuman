<?php
session_start();
require 'functions.php';
include 'config.php';
if(isset($_SESSION['id_admin'])){
  if($_SESSION['id_admin']!=""){
    $idadmin=$_SESSION['id_admin'];
  } else{
  $idadmin="no";
  }
} else{
  $idadmin="no";
}
$pengguna = query("SELECT * FROM informasi ORDER BY id_info DESC LIMIT 12");
//jika tombol cari diklik, kita akan timpa $pengguna dengan data pengguna sesuai dengan pencariannya
if ( isset($_POST["pencarian"]) ) {//post karena methodnya post, yang mau dicek adalah tombol cari berdasrkan name yg ditulis di form
  $keyword = $_POST["pencarian"];
  $pengguna= query(" SELECT * FROM informasi 
        WHERE
       judul LIKE '%$keyword%' OR
       tgl_info LIKE '%$keyword%' ORDER BY id_info DESC LIMIT 12
       ");
  //jadi nanti $pengguna akan berisi data hasil pencarian dari function cari, lalu function cari ini mendapatkan data dari apapun yang diketikkan pengguna
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        section{
          min-height: 420px; 
        }
        .add{
    color: grey;
    padding: 10px;
    text-align: left;
    font-size: 10pt;
  }
  .mini {
          transition: transform .2s; /* Animation */
          margin: 0 auto;
          width: 75%;
        }

        .mini:hover {
          transform: scale(1.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
        }
      </style>
      <title>Informasi</title>
    </head>
    <body class="mt-5">
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

<!--Info Komunitas-->
<div class="jumbotron jumbotron-fluid">
    <div class="container">
                  <div class="row">
                    <div class='com-ms'>
                        <h1 class="display-4">Informasi Medis</h1>
                    <form action="" method="post" class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-10" name="pencarian" type="search" placeholder="Pencarian" aria-label="Search">
                      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" >Cari</button>
                      <?php
                        if(isset($_SESSION['id_admin'])){
                          if($_SESSION['id_admin']!=""){
                            echo "<a href='UpInfo.php' class='btn btn-primary btn-lg active' role='button' aria-pressed='true' style='background-color: #00C957 ; border-color: #00C957; font-size: 11pt;'  autocomplete='on'>Unggah Informasi</a>";
                          }
                        }
                      ?>
                    </form>
                    </div>
                </div>
                </div>
    <div class="container">

<div class="container">
  <div class="row">
  <?php foreach( $pengguna as $row ) : ?>
  <div class="col-sm">
    <div class="card" style="width: 15rem;">
      <a href="baca.php?id_info=<?= $row["id_info"];?>"><img src="<?php if ($row['foto_info' ]==null){echo 'img/picture13.png';}else{echo $row['foto_info'];} ?>" class="card-img-top" alt="Gambar tidak bisa dimuat"></a>
      <div class="card-body">
      <h5 class="card-title"><?php echo $row["judul" ]; ?></h5>
      <p class="card-text">
        <div class="d-flex bd-highlight">
          <div class='p-2 bd-highlight'>
        </div>
        </div>
        <center><p class="add"><?= date("j F Y", strtotime($row["tgl_info"]));?></p></center>
      </p>
    </div>
    </div>
  </div><hr>
  <?php endforeach; ?>
        </div>
       </div> 
    </div>
  </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>