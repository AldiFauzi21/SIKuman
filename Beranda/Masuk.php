<?php 

session_start();
require 'functions.php';

if( isset($_POST["Login"]) ) {
	$username = $_POST["email_P"];	
	$password = $_POST["password_P"];
// $username = $_POST["username"];
		// $password = $_POST["password"];

		$result = mysqli_query($conn, "SELECT * FROM pasien WHERE email_P = '$email_P'");
	// cek username
	if( mysqli_num_rows($result) === 1) {
		// cek password
		$row = mysqli_fetch_assoc($result);
		if( password_verify($password, $row["password_P"]) ) {
			// set session
			$_SESSION["Login"] = true;
			
			header("Location: BerandaPengunjung.html");
			exit;
		}
	}
	$error = true;
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="style/style_login.css">
</head>
<body>
	<div class="login">

	<?php if(isset($error)) : ?>
		<p style="color: red; font-style: italic;">email atau password salah</p> 
	<?php endif ; ?> 

		<img src="image/avatar.png" class="avatar">
		<h1>SILAHKAN LOGIN</h1>
		<form action="" method="post">
		<form>
			<p>Masukan Email Anda</p>
			<input type="text" name="email_P" placeholder="Masukkan Email">
			<p>Masukan Kata Sandi</p>
			<input type="Password" name="Kata Sandi" placeholder="Masukkan Kata Sandi">
			<input type="Submit" name="Login" value="Login">
			<a href="#">Lupa Kata Sandi</a> 
		</form>
	</div>
</body>
</html>