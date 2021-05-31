<?php 

// koneksi ke database
include'config.php';
	var_dump($_FILES);
	if(isset($_POST['daftar']) && !empty($_FILES['foto_P'])){
		$email_P=strtolower(stripcslashes($_POST["email_P"]));
		if(registrasi() > 0 ){
			$gambar_P = upload($email_P);
			echo "<script>
			alert('Anda sudah terdaftar!');
			</script>";
		} else {
			echo mysql_error($conn);
		}
	}
function query ($query){
	global $conn ;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}
function registrasi(){
	global $conn;
	$nama_P = strtolower(stripcslashes($_POST["nama_P"]));
	$NIK_P = strtolower(stripcslashes($_POST["NIK_P"]));
	$email_P = strtolower(stripcslashes($_POST["email_P"]));
	$alamat_P = strtolower(stripcslashes($_POST["alamat_P"]));
	$no_hpP = strtolower(stripcslashes($_POST["no_hpP"]));
	$Goldar = strtolower(stripcslashes($_POST["Goldar"]));
	$kelamin_P = strtolower(stripcslashes($_POST["kelamin_P"]));
	$status = strtolower(stripcslashes($_POST["status"]));
	$pekerjaan = strtolower(stripcslashes($_POST["pekerjaan"]));
	$ttl_P = strtolower(stripcslashes($_POST["ttl_P"]));
	$id_kota = strtolower(stripcslashes($_POST["id_kota"]));
	// $fname = strtolower(stripcslashes($data["fname"]));
	// $lname = strtolower(stripcslashes($data["lname"]));
	$password_P =  $_POST["password_P"];
	$password2 =  $_POST["password2"];
	// $password_P = mysqli_real_escape_string($conn, $data["password_P"]);
	// $password2 = mysqli_real_escape_string($conn, $data["password2"]);
	
	
	// cek username sudah ada atau belum
	$result = mysqli_query($conn, "SELECT id_pasien FROM pasien WHERE email_P = '$email_P'");

	if( mysqli_fetch_assoc($result)){
		echo "<script>
				alert('username sudah terdaftar!')
			  </script>";
			  return false;
	}
	// cek konfirmasi password
	if( $password_P !== $password2) {
		
		echo "<script>
				alert('password tidak sesuai dengan password sebelumnya!');
				</script>";
		return false;
	}
	// enkripsi password
	$password_P = password_hash($password_P, PASSWORD_DEFAULT);
	// tambah use baru
mysqli_query($conn, "INSERT INTO pasien VALUES ('', '$nama_P', '$password_P', '-', '$NIK_P', '$email_P', '$alamat_P', '$no_hpP', '$Goldar', '$kelamin_P', '$status', '$pekerjaan', $ttl_P, $id_kota)");

	return mysqli_affected_rows($conn);
}
function upload($email_P) {
		global $conn;
		$namaFile=$_FILES['foto_P'] ['name'];
		$ukuranFile=$_FILES['foto_P'] ['size'];
		$error=$_FILES['foto_P'] ['error'];
		$tmpName=$_FILES['foto_P'] ['tmp_name'];
		
		//cek apakah tidak ada gambar yang diupload
		if( $error===4) {//4=pesan error tidak ada gambar yg diupload
			echo "<script>
					alert('Pilih gambar terlebih dahulu!');
				 </script>";
			return 0;	 
		}
		//cek apakah yang diupload adalah gambar
		$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
		$ekstensiGambar = explode ('.', $namaFile);
		echo "<script>
					alert(".$namaFile.");
				 </script>";
		$ekstensiGambar = strtolower(end($ekstensiGambar));
		if( in_array($ekstensiGambarValid ,$ekstensiGambar ) ) {
			echo "<script>
					alert('File yang anda unggah bukan gambar!');
				 </script>";
			return 0;	 
		}
		
		//cek jika ukuran terlalu besar KENAPA DIA NGGAK MAU MUNCUUUL kayanya karena upload fotonya masih gagal deh
		if( $ukuranFile > 10000000000 ) {
			echo "<script>
					alert('Ukuran gambar terlalu besar!');
				 </script>";
			return 0;		 
		} else {
		
		//lolos pengecekan, gambar siap diupload
		//generate nama gambar baru
		$namaFileBaru=uniqid(); 
		$namaFileBaru .='.';
		$namaFileBaru .= $ekstensiGambar;
		$direct = "sikuman/image/profil_pasien/".$namaFileBaru;
		
		//$lokasi = $tmpName.$ekstensiGambar;

		$query = "UPDATE pasien SET
					foto_P='$direct'
				WHERE email_P='$email_P'
				 ";
		mysqli_query ($conn, $query);


		move_uploaded_file($tmpName, $direct);
		return mysqli_affected_rows($conn);
		}
	}
?>