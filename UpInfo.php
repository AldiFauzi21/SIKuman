<?php
  session_start();
  require 'functions.php';
  include 'config.php';
  if(isset ($_POST ['unggah'])) {
    if(
      empty($_POST['judul'])
      || empty($_POST['instansi'])
     || empty($_POST['isi'])
      || empty($_FILES['gambar'])
    ) {
      echo "<script>alert('Anda belum melengkapi data');</script>";
    }else{
    $email=$_SESSION["useremail"];
    //echo "<script>alert('email');</script>";
    //echo "<div  class='alert'>",$email,"</div>";
    //var_dump($id_pengguna);
    //query data pengguna berdasarkan id
    $admin=query("SELECT * FROM administrator WHERE email='$email'")[0];
    //echo "<script>alert('query');</script>";
    $id=$admin['id_administrator'];
    //echo "<script>alert('id');</script>";
    $judul=$_POST['judul'];
    //echo "<script>alert('judul');</script>";
    $isi=$_POST['isi'];
    //echo "<script>alert('isi');</script>";
    $instansi=$_POST['instansi'];
    //echo "<script>alert('intansi');</script>";
    
    $infokom=fopen("informasi/$judul.txt", 'w');

    //fwrite($infokom, "dibuat : ${tanggal}");

    fwrite($infokom, "${isi}");
    fclose($infokom);
    if(unggah($judul, $instansi, $id)>0)
    {if(upload($judul, $instansi)>0){
          header("location:Infokom.php");
        } else {
          $drop=query("SELECT * FROM informasi WHERE judul='$judul' and instansi='$Instansi'")[0];
          $dropid=$drop['id_informasi'];
          header("location:dropinfo.php?id_info=$dropid");
        }
      }
    }
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
    <!--My CSS-->

    <style>
      section{
        min-height: 420px; 
      }
      .alert{
    background: #e44e4e;
    color: white;
    padding: 10px;
    text-align: center;
    border:1px solid #b32929;
  }
    </style>




    <title>Unggah Informasi</title>
  </head>
  <body class="mt-5">
 
    <!--Navbar-->
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <img src="img/f.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
                <a class="navbar-brand" href="AuthBeranda.php">SIBI.CO.ID</a>
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
              
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                      <a class="nav-link" href="BerandaAfter.php">Beranda </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="Tentang.html">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Infokom.php">Informasi</a>
                      </li>
                    <li class="nav-item">
                      <a class="nav-link" href="KamusDaring.php">Kamus Daring</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="Faq.html">Daftar Pertanyaan Umum</a>
                    </li>
                  </ul>
                </div>
              </nav>
<!--Unggah Informasi-->
<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <?php 
            if(isset($_GET['pesan'])){
              if($_GET['pesan']=="gagal"){
                echo "<div  class='alert'>Maaf, judul ini pernah digunakan sebelumnya <br> Mohon untuk menggunakan judul lainnya!</div>";
                //echo "<div  class='alert'>Status WA : ",$_SESSION['WhatsApp']," <br> alamat : ",$_SESSION['test'],"</div>";
              }
              else{
                echo "<h4 class='display-4'>Unggah Informasi</h4>";
              }
            }else{
                echo "<h4 class='display-4'>Unggah Informasi</h4>";
            }
          ?>
          <!--Judul-->
          <div class="form-group">
            <form action="" method="POST" enctype="multipart/form-data">
              <label for="judul">Judul</label>
                <input type="text" name="judul" class="form-control"  placeholder="Judul Informasi">
              </div>

              <!--Text Area-->
              <div class="form-group">
                <label for="isi">Isi</label>
                    <textarea class="form-control" name="isi" rows="10" placeholder="Isi Informasi"></textarea>
                  </div>

                  <!--Instansi-->
                  <div class="form-group">
                    <label for="instansi">Instansi</label>
                        <input type="text" name="instansi" class="form-control" placeholder="Instansi Anda">
                      </div>

                      <!--Upload gambar-->
                                    
                        <div class="form-group">
                          <label for="upload">Pilih gambar untuk diupload</label>
                          <input type="file" class="form-control-file" name="gambar" >
                        </div>
                        <button type="submit" name="unggah" class="btn btn-primary">Unggah</button><a href="Infokom.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" style="background-color: #DC143C ; border-color: #DC143C; font-size: 11pt; " autocomplete="on">Kembali</a>
                  </form></div></div></div>

   <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>