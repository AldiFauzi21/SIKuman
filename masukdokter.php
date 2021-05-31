<?php 
include 'config.php';

session_start();
$_SESSION["email_dokter"] = "";
$_SESSION["nama_dokter"] = "";
$_SESSION["id_dokter"] = "";

if ( isset($_POST["MasukD"]) ) {

	$email_D = $_POST["email_D"];
	$password_D = $_POST["password_D"];

	$result = mysqli_query($conn, " SELECT * FROM dokter WHERE email_D = '$email_D' AND password_D = '$password_D' ");

	//cek username
	$error = false;
  $row = mysqli_fetch_assoc($result);
	if ( mysqli_num_rows($result) === 1) {

      $_SESSION["email_dokter"] = $row["email_D"];
      $_SESSION["nama_dokter"] = $row["nama_D"];
      $_SESSION["id_dokter"] = $row["id_dokter"];

      //header("Location: Pengisianrekap.php");
		// set session
			
		exit;
	}
	$error = true;

}

?>



<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="style/dokterlogin.css">
</head>
<body>
  <div class="login">

  	<?php if(isset($error)&&$error) : ?>
		<p style="color: red; font-style: italic;">E-mail atau kata sandi anda salah!</p> 
	<?php endif ; ?> 

    <img src="image/avatar.png" class="avatar">
    
    <h1>MASUK DOKTER</h1>
    <form action="" method="POST">
      <p>Nama Pengguna </p><?=var_dump($_SESSION["email_dokter"]);?><?=var_dump($row);?><?=var_dump($result);?>
      <input type="text" name="Nama Pengguna" placeholder="Masukkan Nama">
      <p>Password</p>
      <input type="Password" name="Kata Sandi" placeholder="Masukkan Kata Sandi">
      <a href="Pengisianrekap.php"> <input type="button" name="MasukD"> 
      <!-- <button type="submit" name="Masuk">Masuk</button> -->
      <a href="#">Lupa Kata Sandi</a> 
    </form>
  </div>
</body>
</html>