<?php

  session_start();

  if(

    !isset($_SESSION['status'])

  ){

    if(($_SESSION['status']!="Pengguna")&&($_SESSION['status']!="Administrator")){

        header("location:Daftar.php?pesan=disallowed");}

  }

   // include composer autoloader

    require_once __DIR__ . '/stemming/Sastrawi/vendor/autoload.php';

    // create stemmer

    // cukup dijalankan sekali saja, biasanya didaftarkan di service container

    $stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();

    $stemmer  = $stemmerFactory->createStemmer();

    // stem

    //$sentence = 'Perekonomian Indonesia sedang dalam pertumbuhan yang membanggakan';

    //$output   = $stemmer->stem($sentence);

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

      .add{

    color: grey;

    padding: 10px;

    text-align: left;

    font-size: 10pt;

  }

.zoom {

  padding: 50px;

  transition: transform .2s; /* Animation */

  width: 250px;

  height: 200px;

  margin: 0 auto;

}

.zoom:hover {

  transform: scale(1.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */

}

        section{

          min-height: 420px; 

       }

      </style>

      <title>Kamus Daring</title>

    </head>

    <body class="mt-5">

     <!--Navbar-->

     <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">

        <div class="container">

            <img src="img/f.png" width="30" height="30" class="d-inline-block align-top" alt="">

            <a class="navbar-brand" href="BerandaAfter.php">SIBI.CO.ID</a>

           <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

                  <span class="navbar-toggler-icon"></span>

               </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                  <ul class="navbar-nav mr-auto">

                   <li class="nav-item ">

                      <a class="nav-link" href="BerandaAfter.php">Beranda </a>

                    </li>

                    <li class="nav-item">

                     <a class="nav-link" href="Tentang.html">Tentang Kami</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" href="Infokom.php">Informasi</a>

                      </li>

                    <li class="nav-item active">

                      <a class="nav-link" href="KamusDaring.php">Kamus Daring</a>

                    </li>

                    <li class="nav-item">

                      <a class="nav-link" href="Faq.html">Daftar Pertanyaan Umum</a>

                    </li>

                  </ul>

              </nav>

            </div>

          </nav>

    <!--Kamus Daring-->

    <div class="jumbotron jumbotron-fluid">

        <div class="container" >

            <h5 class="display-4"><b>Kamus Daring</h5></b>

            <p>Gunakan Kata anda dengan Bijak</p>

            <!--Search Area-->

            <form action="" method="post" class="form-inline my-2 my-lg-0">

                <input class="form-control mr-sm-10" name="kata" type="search" placeholder="Masukkan Kalimat Anda!" aria-label="Search">

                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" >Cari</button>

                <label class="add" for="kata">Untuk sebuah frasa, silahkan kedua kata digabungkan<br>agar makna tercapai seperti : "terimakasih".<br></label>
                <label class="add" for="kata">Untuk nama orang benda atau tempat<br>tulislah dengan huruf kapital agar dieja.<br>Jika nama kamu bintang, tulislah : nama saya BINTANG.</label>
              </form>
              <div class="container">
                <div class="row">
          <?php
            include'config.php';
            date_default_timezone_set('Asia/Singapore');
            if(isset($_POST['kata'])){
              $email=$_SESSION['useremail'];
              if($_SESSION['status']=="Pengguna"){
                $history= "SELECT * from pengguna where email='$email'";
              } else if($_SESSION['status']=="Administrator"){
                $history= "SELECT * from administrator where email='$email'";
              } else {
                header("location:Login.php");
              }
              $exec=mysqli_query($conn, $history);
              $out=mysqli_fetch_array($exec);
              if($_SESSION['status']=="Pengguna"){
                $id_pengguna=$out['id_pengguna'];
              } else if($_SESSION['status']=="Administrator"){
                $id_administrator=$out['id_administrator'];
              }
              $kalimat=$_POST['kata'];
              $date=date("Y-m-d h:i:s");
              $word=explode(' ',$kalimat);
              for ($j = 0; $j < count($word); $j++) {
                if (ctype_upper($word[$j])) {
                  $kata=str_split($word[$j]);
                } else {
                  $word[$j] = strtolower($word[$j]);
                  if(word[$j]=="belas"){
                  	$j++;
                  }
                  $word[$j] = preg_replace('/[^A-Za-z-\-]/', '', $word[$j]);
                  $fix = $stemmer->stem($word[$j]);
                  if($fix!=$word[$j]){
                    $dasar = $word[$j];
                    $pemotong = "";
                    $awal = $fix[0];
                    $tanda = $awal.$dasar[0];
                    $batas = strlen($fix)-1;
                    //echo $tanda;
                    //echo $batas;
                    if($tanda=="km"||$tanda=="qm"||$tanda=="sm"){
                    //echo $dasar[4];
                      if(($dasar[4]=="a")||($dasar[4]=="i")||($dasar[4]=="u")||($dasar[4]=="e")||($dasar[4]=="o")){
                        //echo $dasar[4];
                        $pemotong = substr($fix,1,$batas);
                      //echo $pemotong;
                          $fix = $pemotong;
                        }
                    } else if($tanda=="tm"||$tanda=="pm"){
                    	//echo $dasar[3];
                      if(($dasar[3]=="a")||($dasar[3]=="i")||($dasar[3]=="u")||($dasar[3]=="e")||($dasar[3]=="o")){
                        //echo $dasar[3];
                        $pemotong = substr($fix,1,$batas);
                          //echo $pemotong;
                          $fix = $pemotong;
                        }
                    }
                    //echo $fix[0];
                    //echo $dasar[0];
                  	//echo $word[$j]." -> ".$fix;
                    $coba = "pre".$word[$j];
                    $pecah = explode($fix,$coba);
                    //echo " -> ".$pecah[0]."+".$fix."+".$pecah[1];
                    if($fix==$pemotong){
                    	$fix = $awal.$pemotong;
                    }
                    if($word[($j-1)]=="belas"){
                    	$fix="satu+puluh+".$fix;
                    }
                    if($fix=="sebelas"){
                    	$fix="satu+puluh+satu";
                    }
                    if($pecah[1]=='-'){
                    	$pecah[1]=$pecah[2];
                      	$fix = $fix."+".$fix;
                    }
                    if($pecah[0]=="pre"){
                    	$bentuk = ($fix);
                    } else if($pecah[0]=="premen"){
                    	$bentuk = "men-+".$fix;
                    } else if($pecah[0]=="premem"){
                    	$bentuk = "mem-+".$fix;
                    } else if($pecah[0]=="premeng"){
                    	$bentuk = "meng-+".$fix;
                    } else if($pecah[0]=="preme"){
                    	$bentuk = "me-+".$fix;
                    } else if($pecah[0]=="premeny"){
                    	$bentuk = "meny-+".$fix;
                    } else if($pecah[0]=="premenge"){
                    	$bentuk = "menge-+".$fix;
                    } else if($pecah[0]=="prepen"){
                    	$bentuk = "pen-+".$fix;
                    } else if($pecah[0]=="prepem"){
                    	$bentuk = "pem-+".$fix;
                    } else if($pecah[0]=="prepeng"){
                    	$bentuk = "peng-+".$fix;
                    } else if($pecah[0]=="prepe"){
                    	$bentuk = "pe-+".$fix;
                    } else if($pecah[0]=="prepeny"){
                    	$bentuk = "peny-+".$fix;
                    } else if($pecah[0]=="prepenge"){
                    	$bentuk = "penge-+".$fix;
                    } else if($pecah[0]=="preper"){
                    	$bentuk = "per-+".$fix;
                    } else if($pecah[0]=="preber"){
                    	$bentuk = "ber-+".$fix;
                    } else if($pecah[0]=="preter"){
                    	$bentuk = "ter-+".$fix;
                    } else if($pecah[0]=="preke"){
                    	$bentuk = "ke-+".$fix;
                    } else if($pecah[0]=="prese"&&$fix=="puluh"){
                    	$bentuk = "satu+".$fix;
                    } else if($pecah[0]=="prese"){
                    	$bentuk = "se-+".$fix;
                    } else if($pecah[0]=="predi"){
                    	$bentuk = "di-+".$fix;
                    } else if($pecah[0]=="preke"){
                    	$bentuk = "ke-+".$fix;
                    } else if($pecah[0]=="prememper"){
                    	$bentuk = "mem-+per-+".$fix;
                    } else if($pecah[0]=="premember"){
                    	$bentuk = "mem-+ber-+".$fix;
                    } else if($pecah[0]=="prekeber"){
                    	$bentuk = "ke-+ber-+".$fix;
                    } if($pecah[1]=="i"){
                    	$bentuk .= "+-i";
                    } else if($pecah[1]=="an"){
                    	$bentuk .= "+-an";
                    } else if($pecah[1]=="kan"){
                    	$bentuk .= "+-kan";
                    } else if($pecah[1]=="nya"){
                    	$bentuk .= "+-nya";
                    } else if($pecah[1]=="mu"){
                    	$bentuk .= "+-mu";
                    } else if($pecah[1]=="ku"){
                    	$bentuk .= "+-ku";
                    } else if($pecah[1]=="inya"){
                    	$bentuk .= "+-i+-nya";
                    } else if($pecah[1]=="imu"){
                    	$bentuk .= "+-i+-mu";
                    } else if($pecah[1]=="iku"){
                    	$bentuk .= "+-i+-ku";
                    } else if($pecah[1]=="annya"){
                    	$bentuk .= "+-an+-nya";
                    } else if($pecah[1]=="anmu"){
                    	$bentuk .= "+-an+-mu";
                    } else if($pecah[1]=="anku"){
                    	$bentuk .= "+-an+-ku";
                    } else if($pecah[1]=="kannya"){
                    	$bentuk .= "+-kan+-nya";
                    } else if($pecah[1]=="kanmu"){
                    	$bentuk .= "+-kan+-mu";
                    } else if($pecah[1]=="kanku"){
                    	$bentuk .= "+-kan+-ku";
                    } else if($pecah[1]=="lah"){
                    	$bentuk .= "+-lah";
                    } else if($pecah[1]=="ilah"){
                    	$bentuk .= "+-i+-lah";
                    } else if($pecah[1]=="kanlah"){
                    	$bentuk .= "+-kan+-lah";
                    } else if($pecah[1]=="anlah"){
                    	$bentuk .= "+-an+-anlah";
                    } else if($pecah[1]=="kah"){
                    	$bentuk .= "+-kah";
                    } else if($pecah[1]=="kankah"){
                    	$bentuk .= "+-kan+-kah";
                    } else if($pecah[1]=="ikah"){
                    	$bentuk .= "+-i+-kah";
                    } else if($pecah[1]=="ankah"){
                    	$bentuk .= "+-an+-kah";
                    } else if($pecah[1]=="tah"){
                    	$bentuk .= "+-tah";
                    } else if($pecah[1]=="in"){
                    	$bentuk .= "+-kan";
                    }
                    $fix = $bentuk;
                  }
                	$kata = explode('+',$fix);
                }
                for ($i = 0; $i < count($kata); $i++) {

                  if(($kata[$i]=="")||($kata[$i]==" ")||($kata[$i]==".")||($kata[$i]==",")||($kata[$i]=="?")||($kata[$i]=="/")||($kata[$i]=="'")||($kata[$i]=='"')||($kata[$i]=="(")||($kata[$i]==")")||($kata[$i]=="*")||($kata[$i]=="&")||($kata[$i]=="^")||($kata[$i]=="%")||($kata[$i]=="+")||($kata[$i]=="-")||($kata[$i]=="_")||($kata[$i]=="=")||($kata[$i]=="$")||($kata[$i]=="#")||($kata[$i]=="@")||($kata[$i]=="!")){
                    $i++;
                  }                  
                  $sql="SELECT gambar from gambar_sibi where id_gambar=(SELECT id_gambar from kata where kata='$kata[$i]')";
                  $history="SELECT id_kata from kata where kata='$kata[$i]'";
                  $exct=mysqli_query($conn, $history);
                  $output=mysqli_fetch_array($exct);
                  $id_kata=$output['id_kata'];
                  $execute=mysqli_query($conn, $sql);
                  $hasil=mysqli_fetch_array($execute);
                  $gambar=$hasil['gambar'];
                  if($_SESSION['status']=="Pengguna"){
                    $input="INSERT INTO pengguna_memasukkan (id_kata, tanggal, id_pengguna) VALUES ('$id_kata', '$date', '$id_pengguna');";
                  } else if($_SESSION['status']=="Administrator"){
                    $input="INSERT INTO administrator_memasukkan (id_kata, tanggal, id_administrator) VALUES ('$id_kata', '$date', '$id_administrator');";
                  }
                  if($gambar!=""&&isset($gambar)){
                    echo "<div class='col-sm'><div class='card'><h5>$kata[$i]</h5><img class='zoom' src=images/sibi/$gambar></div></div>";
                    $date=date("Y-m-d h:i:s");
                    $counter++;
                    if ($conn->query($input) === FALSE) {
                      echo "Error$ " . $input . "<br>" . $conn->error;
                    }
                  }
                  else{
                    echo "<h5>$kata[$i]</h5>";
                    echo "<h1>(</h1>";
                    $miss=str_split($kata[$i]);
                    for ($c = 0; $c < count($miss); $c++) {
                    if(($miss[$i]=="")||($miss[$i]==" ")||($miss[$i]==".")||($miss[$i]==",")||($miss[$i]=="?")||($miss[$i]=="/")||($miss[$i]=="'")||($miss[$i]=='"')||($miss[$i]=="(")||($miss[$i]==")")||($miss[$i]=="*")||($miss[$i]=="&")||($miss[$i]=="^")||($miss[$i]=="%")||($miss[$i]=="$")||($miss[$i]=="#")||($miss[$i]=="@")||($miss[$i]=="!")||($miss[$i]=="-")||($miss[$i]=="_")||($miss[$i]=="=")||($miss[$i]=="+")){
						$i++;
                  }
                      $sql="SELECT gambar from gambar_sibi where id_gambar=(SELECT id_gambar from kata where kata='$miss[$c]')";
                      $history="SELECT id_kata from kata where kata='$miss[$c]'";
                      $exct=mysqli_query($conn, $history);
                      $output=mysqli_fetch_array($exct);
                      $id_kata=$output['id_kata'];
                      $execute=mysqli_query($conn, $sql);
                      $hasil=mysqli_fetch_array($execute);
                      $gambar=$hasil['gambar'];
                      if($_SESSION['status']=="Pengguna"){
                        $input="INSERT INTO pengguna_memasukkan (id_kata, tanggal, id_pengguna) VALUES ('$id_kata', '$date', '$id_pengguna');";
                      } else if($_SESSION['status']=="Administrator"){
                        $input="INSERT INTO administrator_memasukkan (id_kata, tanggal, id_administrator) VALUES ('$id_kata', '$date', '$id_administrator');";
                      }
                      if($gambar!=""&&isset($gambar)){
                        echo "<div class='col-sm'><div class='card'><h5>$miss[$c]</h5><img class='zoom' src=images/sibi/$gambar></div></div>";
                        $date=date("Y-m-d h:i:s");
                        $counter++;
                        if ($conn->query($input) === FALSE) {
                            echo "Error$ " . $input . "<br>" . $conn->error;
                        }
                      }
                      else{
                        echo "<script>alert('Kata tidak ditemukan!')</script>";
                      }
                    }
                    echo "<h1>)</h1>";
                 }
                }
             }
            }
        ?>
       </div></div></div>
        </div>
        </div>
      </div>
      <center><footer style="font-size: 10pt; color: grey;">
    <p>copyright. sibi.co.id</p>
    </footer></center>
    <!-- Optional JavaScript -->
   <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>