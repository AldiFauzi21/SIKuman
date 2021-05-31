<?php
	session_start();
	include'config.php';
	if(isset($_POST['fullname'])
		&&isset($_POST['email'])
		&&isset($_POST['nmr'])
		&&isset($_POST['prov'])
		&&isset($_POST['kota'])
		&&isset($_POST['alamat'])
		&&isset($_POST['pass'])
		&&isset($_POST['pass2'])
		&&(strlen($_POST['pass'])>=5)
		&&(strlen($_POST['pass'])<=35)
		&&(strlen($_POST['kota'])>3)
		&&(strlen($_POST['prov'])>3)
		&&(strlen($_POST['nmr'])>9)
		&&(strlen($_POST['nmr'])<16)
	){
		$name=$_POST['fullname'];
		$_SESSION['nama']=$name;
		// $name = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_STRING);
		// $_SESSION['nama']=$_POST['fullname'];
		$email=$_POST['email'];
		$_SESSION['useremail']=$email;
		// $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
		// $_SESSION['useremail']=$_POST['email'];
		$prov=$_POST['prov'];
		$_SESSION['prov']=$prov;
		// $prov = filter_input(INPUT_POST, 'prov', FILTER_SANITIZE_STRING);
		// $_SESSION['prov']=$_POST['prov'];
		$kota=$_POST['kota'];
		$_SESSION['kota']=$kota;
		// $kota = filter_input(INPUT_POST, 'kota', FILTER_SANITIZE_STRING);
		// $_SESSION['kota']=$_POST['kota'];
		$almt=$_POST['alamat'];
		$_SESSION['alamat']=$almt;
		// $almt = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);
		// $_SESSION['alamat']=$_POST['alamat'];
		$phone=$_POST['nmr'];
		$_SESSION['phone']=$phone;
		// $phone = filter_input(INPUT_POST, 'nmr', FILTER_SANITIZE_STRING);
		// $_SESSION['phone']=$_POST['nmr'];
		// Password
		$password=$_POST['pass'];
		$password2=$_POST['pass2'];
		// $password = password_hash($_POST["pass"], PASSWORD_DEFAULT);
		// $password2 = password_hash($_POST["pass2"], PASSWORD_DEFAULT);
		$alamat=$almt.", ".$kota.", ".$prov;
		//$_SESSION['test']=$alamat;
		$sql = "INSERT INTO pengguna (nama_lengkap, email, alamat, no_hp_wa, kata_sandi) VALUES ('$name', '$email', '$alamat', '$phone', '$password');";
		$sqluser=mysqli_query($conn,"SELECT * from pengguna where email='$email'");
		$sqladmin=mysqli_query($conn,"SELECT * from administrator where email='$email'");
		if (($name!="")
			&&($email!="")
			&&($alamat!="")
			&&($phone!="")
			&&($password!="")
			// &&(strlen($password)>=5)&&(strlen($password)<=35)
			// &&(strlen($kota)>3)&&(strlen($prov)>3)
			&&($password==$password2)
			// &&(strlen($phone)>9)&&(strlen($phone)<16)
		) {
			if(mysqli_num_rows($sqluser)>0){
				$_SESSION['WhatsApp']="no";
				header("location:Daftar.php?pesan=gagal");
			}
			else if(mysqli_num_rows($sqladmin)>0){
				$_SESSION['WhatsApp']="no";
				header("location:Daftar.php?pesan=gagal");
			}
			else{
				if ($conn->query($sql) === TRUE) {
				$_SESSION['status']="Pengguna";
				header("location:BerandaAfter.php?pesan=masuk");
				} else {
				    echo "Error$ " . $sql . "<br>" . $conn->error;
				}
			}
		}else{
			$_SESSION['WhatsApp']="no";
			header("location:Daftar.php");
		}
	}else{
	header("location:Daftar.php");
}
?>