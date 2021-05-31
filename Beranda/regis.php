<?php 
include'config.php';
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
	$nama_P = strtoupper(stripcslashes($_POST["nama_P"]));
	$NIK_P = strtoupper(stripcslashes($_POST["NIK_P"]));
	$email_P = $_POST["email_P"];
	$alamat_P = strtoupper(stripcslashes($_POST["alamat_P"]));
	$no_hpP = strtoupper(stripcslashes($_POST["no_hpP"]));
	$Goldar = strtoupper(stripcslashes($_POST["Goldar"]));
	$kelamin_P = strtoupper(stripcslashes($_POST["kelamin_P"]));
	$status = strtoupper(stripcslashes($_POST["status"]));
	$pekerjaan = strtoupper(stripcslashes($_POST["pekerjaan"]));
	$ttl_P = date('Y-m-d',strtotime($_POST['ttl_P']));
	$id_kota = strtoupper(stripcslashes($_POST["id_kota"]));
	// $fname = strtoupper(stripcslashes($data["fname"]));
	// $lname = strtoupper(stripcslashes($data["lname"]));
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
mysqli_query($conn, "INSERT INTO pasien VALUES ('', '$nama_P', '$password_P', '-', '$NIK_P', '$email_P', '$alamat_P', '$no_hpP', '$Goldar', '$kelamin_P', '$status', '$pekerjaan', '$ttl_P', $id_kota)");

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
		$direct = "image/profil_pasien/".$namaFileBaru;
		
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
	$id=$_GET["provinsi"];
	$kota= query("SELECT * FROM kota WHERE id_prov = $id ");
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Pendaftran</title>
<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<link rel="stylesheet" type="text/css" href="style/cssregis.css">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body>

	<div class="main ">
		<ul>
			<li><a href="#">Beranda</a></li>
			<li><a href="#">Tentang Kami</a></li>
			<li><a href="#">Daftar Pertanyaan Umum</a></li>
			<li><a href="#">Inforgrafi</a></li>
			<li><a href="#" class="active">Masuk</a></li>
		</ul> 
	</div>
	<br>
	<br>
	<br>
	<div class="container">

		<div class="row">

			<div class="col-lg-5">
				<div id="ui">
						<form action="" method="POST" enctype="multipart/form-data" class="form-inline my-2 my-lg-0">
							<br><br>
            			    <label>Kota/Kabupaten &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>	
								<select class="form-control" name="id_kota">
									<option>
										<?php
										 $i=1;foreach( $kota as $row ) :?>
									<option value="<?= $row["id_kota"]; ?>">
										<?= $row["nama_kota"]; ?>
									</option>
		              				<?php $i++; ?>
									<?php endforeach; ?>
									</option>
								</select>
						</div>					
						<div class="row">
							<div class="col-lg-6">
								<label>Nomor Induk Kependudukan</label>
								<input type="text" name="NIK_P" class="form-control" placeholder="Nomor Induk Kependudukan">
							</div>

							<div class="col-lg-6">
								<label>E-mail</label>
								<input type="text" name="email_P" class="form-control" placeholder="E-mail Anda">
							</div>
							
						</div>

						<label>Nama Lengkap</label>
						<input type="text" name="nama_P" class="form-control" placeholder="Nama Lengkap Anda">
						<label>Tanggal Lahir</label>
						<input class="form-control" name="ttl_P" type="date" id="example-date-input">
						<div class="row">
							<div class="col-lg-6">
								<label>Jenis Kelamin</label>
								<select class="form-control" name="kelamin_P">
									<option value="Laki-Laki">Laki-Laki</option>
									<option value="Perempuan">Perempuan</option>
								</select>
								
							</div>
							<div class="col-lg-6">								
								<label>Golongan Darah</label>

								<select class="form-control" name="Goldar">
									<option value="A">A</option>
									<option value="B">B</option>
									<option value="AB">AB</option>
									<option value="O">O</option>
								</select>
							</div>							
						</div>
			</div>
			<div class="col-lg-1"></div>
			<div class="col-lg-5">
				<div id="ui">
						<div class="row">
							<div class="col-lg-6">
								<label>Status</label>

								<select class="form-control" name="status">
									<option value="Sudah Menikah">Sudah Menikah</option>
									<option value="Belum Menikah">Belum Menikah</option>
								</select>
								
							</div>
							<div class="col-lg-6">								
								<label>Pekerjaan</label>

								<input type="text" name="pekerjaan" class="form-control" placeholder="Pekerjaan Anda">
							</div>							
						</div>
						<label>Alamat</label>
						<input type="text" name="alamat_P" class="form-control" placeholder="Alamat Anda">
						<label>Nomor Telepon Seluler</label>
						<input type="text" name="no_hpP" class="form-control" placeholder="Nomor Telepon Seluler Anda">
						<div class="row">
							<div class="col-lg-6">
								<label>Kata Sandi</label>
								<input type="password" name="password_P" class="form-control" placeholder="Kata Sandi Anda">
							</div>

							<div class="col-lg-6">
								<label>Konfirmasi Kata Sandi</label>
								<input type="password" name="password2" class="form-control" placeholder="Konfirmasi Kata Sandi Anda">
							</div>
							
						</div>
						<div class="form-group">
                          <label for="foto_P">Gambar Wajah Anda</label>
                          <input type="file" class="form-control-file" name="foto_P" >
                        </div>
						<br>

						<!-- <input type="submit" name="Daftar" value="Daftar" class="btn btn-primary btn-block btn-lg"> -->
						<button class="btn btn-primary btn-lg btn-block" type="submit" name="daftar">Daftar</button>

					</form>

				</div>
			</div>



		</div>
		

	</div>
</body>
</html>