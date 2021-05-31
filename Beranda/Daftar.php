<?php
  session_start();
  include 'config.php';
  if(!isset($_SESSION['nama'])){
    $_SESSION['nama']="";
  }
  if(!isset($_SESSION['useremail'])){
    $_SESSION['useremail']="";
  }
  if(!isset($_SESSION['phone'])){
    $_SESSION['phone']="";
  }
  if(!isset($_SESSION['WhatsApp'])){
    $_SESSION['WhatsApp']="no";
  }
  if(!isset($_SESSION['prov'])){
    $_SESSION['prov']="";
  }
  if(!isset($_SESSION['kota'])){
    $_SESSION['kota']="";
  }
  if(!isset($_SESSION['alamat'])){
    $_SESSION['alamat']="";
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
  .conf{
    background: #00C957 ;
    color: white;
    padding: 10px;
    text-align: center;
    border:1px solid #00C957  ;
  }
  .add{
    color: grey;
    padding: 10px;
    text-align: left;
    font-size: 10pt;
  }
  .warn{
    color: red;
    padding: 10px;
    text-align: left;
    font-size: 10pt;
    max-height: 5pt;
  }
  .form-check-label{
    font-size: 10pt;
  }
    </style>
    <title>Daftar</title>
  </head>
  <body class="mt-5">
    <!--Navbar-->
    <script type="text/javascript">
      function batastamu(){
        alert("Maaf, anda belum terdaftar");
      }
    </script>
    <script type="text/javascript">
      function hilang(idbox,idtext){
        var checkBox = document.getElementById(idbox);
        var text = document.getElementById(idtext);
        if (checkBox.checked == true){
          text.style.display = "none";
        } else {
           text.style.display = "block";
        }
      }
    </script>
    <script type="text/javascript">
  function validasi_form_input(){
    var konfirmasi = confirm("Apakah anda yakin dengan data diri anda?");
    if(konfirmasi === true) {
      var nama = document.getElementById("nama").value;
      var email = document.getElementById("email").value;
      var prov = document.getElementById("prov").value;
      var kota = document.getElementById("kota").value;
      var alamat = document.getElementById("alamat").value;
      var phone = document.getElementById("nmr").value;
      var WhatsApp = document.getElementById("WhatsApp");
      var password = document.getElementById("pass").value;
      var password2 = document.getElementById("pass2").value;
      var text = "";
      if (nama==""&&email==""&&phone==""&&prov==""&&kota==""&&alamat==""&&password==""&&password2==""){
        alert('Anda belum mengisi apapun');
      }
      else{
        if (nama == ""){
          text += "- Nama lengkap \n";
        }
        if (email == ""){
          text += "- E-mail \n";
        }
        if (phone == ""){
          text += "- Telepon Seluler\n";
        } else {
          if ((phone.length < 10)||(phone.length>15)){
            alert('Pastikan bahwa nomor telepon seluler anda sudah benar!');
          }
          if (WhatsApp.checked == false){
            alert('Diharapkan untuk memasukkan nomor telepon seluler yang sudah terhubung dengan akun WhatsApp anda!');
          }
          // if else (WhatsApp.checked == true) {
          //     WA = "yes";
          //   }
        }
        if (prov == ""){
          text += "- Provinsi \n";
        } else {
          if (prov.length < 4){
            alert('Mohon untuk tidak menggunakan singkatan pada data provinsi anda!');
          }
        }
        if (kota == ""){
          text += "- Kota/Kabupaten \n";
        } else {
          if (kota.length < 4){
            alert('Mohon untuk tidak menggunakan singkatan pada data kota atau kabupaten anda!');
          }
        }
        if (alamat == ""){
          text += "- Alamat \n";
        }
        if (password == ""){
          text += "- Kata Sandi \n";
        } else {
          if (password.length < 5){
            alert('Kata sandi minimal 5 karakter');
          }
          if (password.length > 35){
            alert('Kata sandi anda terlalu panjang, mohon untuk menggunakan kata sandi yang mudah anda ingat!');
          }
        }
        if (nama==""||email==""||phone==""||prov==""||kota==""||alamat==""||password==""){
          alert('Anda belum mengisi : \n'+ text);
        }
        if (password2 == ""){
          alert('Anda belum mengonfirmasi kata sandi anda');
        } else {
          if (password != password2){
            alert('Konfirmasi kata sandi anda salah');
          }
        }
      }
    }
  }
</script>
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <img src="img/f.png" width="30" height="30" class="d-inline-block align-top" alt="">
                <a class="navbar-brand" href="Beranda.html">SIBI.CO.ID</a>
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
              
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                      <a class="nav-link" href="Beranda.html">Beranda</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="Tentang.html">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Infokom.php">Informasi</a>
                      </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#" tabindex="-1" onclick="batastamu()">Kamus Daring</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="Faq.html">Daftar Pertanyaan Umum</a>
                    </li>
                  </ul>
                </div>
              </nav>
            </div>
              </nav>
<!--Sign up-->
                <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                        <?php 
                          if(isset($_GET['pesan'])){
                            if($_GET['pesan']=="gagal"){
                              echo "<div  class='alert'>Maaf, e-mail yang anda masukkan sudah terdaftar.<br> Mohon untuk menggunakan e-mail lain!</div>";
                              //echo "<div  class='alert'>Status WA : ",$_SESSION['WhatsApp']," <br> alamat : ",$_SESSION['test'],"</div>";
                            }
                            else if($_GET['pesan']=="disallowed"){
                              echo "<div  class='conf'>Maaf, anda belum terdaftar untuk mengakses fitur kamus daring. <br> Silahkan mendaftar terlebih dahulu!</div>";
                            }
                            else{
                              echo "<h4 class='display-4'>Buat akun SIBI.co.id</h4>";
                            }
                          }else{
                              echo "<h4 class='display-4'>Buat akun SIBI.co.id</h4>";
                          }
                        ?>
                          <div class="container">
                                  <form action="input.php" method="POST">
                                    <div class="form-group">
                                        <label for="nama">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama" name="fullname" value="<?php echo $_SESSION['nama'];?>" placeholder="Nama Lengkap Anda">
                                      </div>  
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                          <label for="email">E-mail</label>
                                          <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['useremail'];?>" placeholder="Alamat E-mail Anda">
                                        </div>
                                        <div class="form-group col-md-6">
                                          <label for="nmr">Telepon Seluler</label>
                                          <input class="form-control" id = "nmr" type="text" name="nmr" value="<?php echo $_SESSION['phone'];?>" placeholder="Nomor Telepon Seluler Anda">
                                        </div>
                                      </div>
                                      <div class="form-row">
                                        <div class="form-group col-md-6">
                                          <input class="form-check-input" type="checkbox" id="WhatsApp" onclick="hilang('WhatsApp','WhatsAppwarn')">
                                          <label class="form-check-label" for="WhatsApp">
                                            Nomor saya sudah terhubung dengan WhatsApp
                                            <br><br>
                                          </label>
                                        </div>
                                          <div class="form-group col-md-6">
                                          <p class="warn" id="WhatsAppwarn" style="display: block;">
                                            Pastikan  nomor anda sudah terhubung dengan akun WhatsApp anda!<br> Tekan tombol kotak di samping!
                                          </p>
                                        </div>
                                      </div>
                                      <div class="form-row">
                                        <div class="form-group col-md-6">
                                          <label for="prov">Provinsi</label>
                                          <input type="text" id="prov" name="prov" class="form-control" value="<?php echo $_SESSION['prov'];?>"placeholder="Provinsi Anda"><label class="add" for="pass">
                                            Hindari penggunaan singkatan!
                                          </label>
                                        </div>
                                        <div class="form-group col-md-6">
                                          <label for="kota">Kota/Kabupaten</label>
                                          <input type="text" id="kota" name="kota" value="<?php echo $_SESSION['kota'];?>"class="form-control"placeholder="Kota/Kabupaten Anda">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control" id = "alamat" name="alamat" value="<?php echo $_SESSION['alamat'];?>" placeholder="Alamat Anda">
                                      </div>
                                      <div class="form-row">
                                        <div class="form-group col-md-6">
                                          <label for="pass">Kata Sandi</label>
                                          <input type="password" class="form-control" id="pass" name="pass" placeholder="Kata Sandi Anda"><label class="add" for="pass">
                                            Gunakan 5 sampai 35 karakter!
                                          </label>
                                        </div>
                                        <div class="form-group col-md-6">
                                          <label for="pass2">Konfirmasi Kata Sandi</label>
                                          <input type="password" class="form-control" id="pass2" name="pass2" placeholder="Konfirmasi Kata Sandi Anda">
                                        </div>
                                      </div>
                                      <button type="submit" class="btn btn-primary" onclick="validasi_form_input()">Daftar</button>
                                    </form>
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