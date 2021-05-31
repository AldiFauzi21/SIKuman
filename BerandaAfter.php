<?php
  session_start();
  include 'config.php';
  if(($_SESSION['status']=="")||(!isset($_SESSION['status']))){
    header("location: Login.php");
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
    <!-- <link rel="stylesheet" href="owlcarousel/assets/owl.carousel.min.css"> -->
    <!-- <link rel="stylesheet" href="owlcarousel/assets/owl.theme.default.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css">    
    <link rel="stylesheet" href="style/css/style.css">

    <!--My CSS-->

    <style>
      section{
        min-height: 420px; 
      }
      .conf{
    background: #00C957 ;
    color: white;
    padding: 10px;
    text-align: center;
    border:1px solid #00C957  ;
  }
    </style>
    <title>sibi</title>
  </head>
  <body class="mt-5">
  <script type="text/javascript">
    function logout(){
      var konfirmasi = confirm("Apakah anda yakin ingin keluar?");
      if(konfirmasi === true) {
        window.location.href="logout.php";
      }
    }
  </script>
    <!--Navbar-->
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <img src="img/f.png" width="30" height="30" class="d-inline-block align-top" alt="">
                <?php 
                  if(isset($_GET['pesan'])){
                    if($_GET['pesan']=="masuk"){
                      echo "<div  class='conf'>Selamat Datang Pengguna Baru</div>";
                    } else {
                    echo "<a class='navbar-brand' href='BerandaAfter.php'>SIBI.CO.ID</a>";
                    }
                  } else {
                    echo "<a class='navbar-brand' href='BerandaAfter.php'>SIBI.CO.ID</a>";
                  }
                ?> 
                
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
              
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                      <a class="nav-link" href="BerandaAfter.php">Beranda <span class="sr-only">(current)</span></a>
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
                  <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <?php 
                            if(isset($_SESSION['status'])){
                              if($_SESSION['status']=="Administrator"){
                                echo "Data Administrator";
                              }
                              else if($_SESSION['status']=="Pengguna"){
                                echo "Profil Pengguna";
                              }
                              else{
                                echo "Error! Session salah";
                              }
                            }
                            else{
                              echo "Error! Session kosong";
                            }
                           ?>                          
                        </button>
                        <a class="dropdown-menu" aria-labelledby="dropdownMenu2">
                          <button id="khusus"class="dropdown-item" type="button" onclick="window.location.href='<?php echo$_SESSION['status']; ?>Profil.php'">
                          <?php 
                            if(isset($_SESSION['status'])){
                              if($_SESSION['status']=="Administrator"){
                                echo "Data Pengguna";
                              }
                              else if($_SESSION['status']=="Pengguna"){
                                echo "Profil Anda";
                              }
                              else{
                                echo "Error! Session salah";
                              }
                            }
                            else{
                              echo "Error! Session kosong";
                            }
                           ?></button>
                           <button id="khusus"class="dropdown-item" type="button" onclick="window.location.href='<?php echo$_SESSION['status']; ?>Data.php'">
                          <?php 
                            if(isset($_SESSION['status'])){
                              if($_SESSION['status']=="Administrator"){
                                echo "Data Administrator";
                              }
                              else if($_SESSION['status']=="Pengguna"){
                                echo "Pengaturan Profil";
                              }
                              else{
                                echo "Error! Session salah";
                              }
                            }
                            else{
                              echo "Error! Session kosong";
                            }
                           ?></button>
                          <button class="dropdown-item" type="button" onclick="logout()">Keluar</button>
                        </a>
                      </div>
                  </div>
              </nav>
            </div>
              </nav>
<!--Jumbotron-->
<!--<div class="bd-example">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="img/b.jpg" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h5>Selamat Datang</h5>
                <p>SIBI.CO.ID</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="img/e.jpg" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h5>Salah Satu Sistem Pembelajaran</h5>
                <p>Agar dapat mendapatkan jaringan sosial yang lebih luas</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="img/2.jpg" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h5>Satukan Suara</h5>
                <p>Antara teman dengar dan teman tuli</p>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>-->

<div id="owl-example" class="owl-carousel">
  <div class="owl-slide" style="background-image:url('img/b.jpg')">
		<center><div class="owl--text">
		  SELAMAT DATANG DI WEBSITE SANG PENEMBUS BATAS</div>
	  </div></center>
    <div class="owl-slide">
    <div class="owl-slide" style="background-image:url('img/e.jpg')">
      <div class="owl--text">
      SIBI.CO.ID merupakan Website Sistem Pembelajaran Bahasa Isyarat Indonesia
      Satukan Suara Dengan Teman Tuli </div>
  	</div>
	  </div>
</div>




   <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
    
    <script>
    $(document).ready(function() {
      $("#owl-example").owlCarousel({
          navigation : true, 
          slideSpeed : 300,
          paginationSpeed : 400,
          singleItem: true,
          pagination: false,
          rewindSpeed: 500
      });
    });
    </script>

  </body>
</html>