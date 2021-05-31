<?php
//koneksi ke database
include 'config.php';
date_default_timezone_set('Asia/Singapore');

function query($query){
	global $conn;
	$result=mysqli_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}

function unggah($judul, $instansi, $id) {
	
	global $conn; // sehingga pada tambah.php tidak perlu lagi koneksi karena koneksinya sudah dilakukan di dalam function
	// $cek=mysqli_query($conn,"SELECT * from informasi where judul='$judul' and instansi = '$instansi'");
	// if(mysqli_num_rows($cek)>0){
	// 	header("location:UpInfo.php?pesan=gagal");
	// } else {
		$tanggal = date("Y-m-d");

		$isi = $judul . ".txt";
		
		$query = "INSERT INTO informasi (judul, isi, id_administrator, tanggal, instansi)
				 VALUES
				 ('$judul', '$isi', '$id', '$tanggal', '$instansi')
				 ";
		mysqli_query ($conn, $query);
		
		return mysqli_affected_rows($conn);
	// }
}
function sunting($judul, $instansi, $id) {
	
	global $conn; //konek ke database
	// ambil semua data yang diinputkan oleh user
	// $nama_lengkap = htmlspecialchars($data["nama_lengkap"]);
	// $email = htmlspecialchars($data["email"]);
	// $no_hp_wa = htmlspecialchars($data["no_hp_wa"]);
	//cek apakah user pilih gambar baru atau tidak
	//sekalipun hanya merubah satu data, tapi yang terjadi di belakang layar adalah semua datanya ditimpa
	$tanggal = date("Y-m-d");
		$isi = $judul . ".txt";

		$query = "UPDATE informasi SET
					judul='$judul',
					isi='$isi',
					tanggal='$tanggal',
					instansi = '$instansi'
				WHERE id_informasi='$id'
				 ";
		mysqli_query ($conn, $query); //menjalankan query-nya
		
		return mysqli_affected_rows($conn);	//return angka ketika ada data yang berhasil diupdate di database
}

function tambah($data) {
	
	global $conn; // sehingga pada tambah.php tidak perlu lagi koneksi karena koneksinya sudah dilakukan di dalam function
	$nama_lengkap = htmlspecialchars($data["nama_lengkap"]); // karena sudah masukkan $data sebagai parameter, kita tidak akan lagi menggunakan $_post, karena $_post nya nanti dikirim di functionnya dan ditangkap oleh $data kemudian dimasukkan ke dalam variabel
	$email = htmlspecialchars($data["email"]); //sebelum dimasukkan ke variabel yang sebelah kiri, kita jalankan sebuah function dulu ang namanya htmlspecialchars(string) lalu kita masukkan datanya ke dalam function tsb, jadi ketika user mengetikkan sesuatu akan masuk dulu ke function ini, nanti dia diolah sedemikian rupa supaya gak langsung menampilkan elemen htmlnya seperti tadi
	$alamat = htmlspecialchars($data["alamat"]);
	$no_hp_wa = htmlspecialchars($data["no_hp_wa"]);
	$kata_sandi = htmlspecialchars($data["kata_sandi"]);
	
	//upload gambar
	$gambar=upload(); //jika function upload berhasil, akan melakukan 2 hal, yaitu akan mengupload gambar dan akan mengirimkan nama gambar ke $gambar, kalau gagal tidak ada nama yang dikirimkan
	if( !$gambar){
		return false;
	}
	
	
	$query = "INSERT INTO pengguna
			 VALUES
			 ('', '$nama_lengkap', '$email', '$alamat', '$no_hp_wa', '$kata_sandi', '$gambar')
			 ";
	mysqli_query ($conn, $query);
	
	return mysqli_affected_rows($conn);	
}

function hapus($email) { // membuat function yang namanya hapus yang menerima id, id dikirimkan dari halaman hapus kemudian masuk ke sini
	global $conn;
	mysqli_query($conn, "DELETE FROM pengguna WHERE email='$email'");

	return mysqli_affected_rows($conn); 
}
function dropinfo($id) { // membuat function yang namanya hapus yang menerima id, id dikirimkan dari halaman hapus kemudian masuk ke sini
	global $conn;
	mysqli_query($conn, "DELETE FROM informasi WHERE id_informasi='$id'");

	return mysqli_affected_rows($conn); 
}
function hapusriwayat($id) { // membuat function yang namanya hapus yang menerima id, id dikirimkan dari halaman hapus kemudian masuk ke sini
	global $conn;
	mysqli_query($conn, "DELETE FROM pengguna_memasukkan WHERE id_pengguna='$id'");
	
	return mysqli_affected_rows($conn); 
}
function hapusbaca($id) { // membuat function yang namanya hapus yang menerima id, id dikirimkan dari halaman hapus kemudian masuk ke sini
	global $conn;
	mysqli_query($conn, "DELETE FROM membaca WHERE id_pengguna='$id'");
	
	return mysqli_affected_rows($conn); 
}
function hapusbacainfo($id) { // membuat function yang namanya hapus yang menerima id, id dikirimkan dari halaman hapus kemudian masuk ke sini
	global $conn;
	mysqli_query($conn, "DELETE FROM membaca WHERE id_informasi='$id'");
	
	return mysqli_affected_rows($conn); 
}

function ubah($fullname,$useremail,$nmr) { //function ubah, sama seperti tambah, menerima $data, yakni variabel untuk menampung data post yang dikirimkan
	global $conn; //konek ke database
	// ambil semua data yang diinputkan oleh user
	// $nama_lengkap = htmlspecialchars($data["nama_lengkap"]);
	// $email = htmlspecialchars($data["email"]);
	// $no_hp_wa = htmlspecialchars($data["no_hp_wa"]);
	$nama_lengkap = $fullname;
	$email = $useremail;
	$no_hp_wa = $nmr;
	//cek apakah user pilih gambar baru atau tidak
	//sekalipun hanya merubah satu data, tapi yang terjadi di belakang layar adalah semua datanya ditimpa
	if(($nama_lengkap!="")&&($email!="")&&($no_hp_wa!="")&&(strlen($no_hp_wa)>9)&&(strlen($no_hp_wa)<16)){
		$query = "UPDATE pengguna SET
					nama_lengkap='$nama_lengkap',
					email='$email',
					no_hp_wa='$no_hp_wa'
				WHERE email='$email'
				 ";
		mysqli_query ($conn, $query); //menjalankan query-nya
		
		return mysqli_affected_rows($conn);	//return angka ketika ada data yang berhasil diupdate di database
	}
	else{
		return 0;
	}
}
function ubahalamat($alamat,$email) { //function ubah, sama seperti tambah, menerima $data, yakni variabel untuk menampung data post yang dikirimkan
	global $conn; //konek ke database
	// ambil semua data yang diinputkan oleh user
	// $nama_lengkap = htmlspecialchars($data["nama_lengkap"]);
	// $email = htmlspecialchars($data["email"]);
	// $no_hp_wa = htmlspecialchars($data["no_hp_wa"]);
	//cek apakah user pilih gambar baru atau tidak
	//sekalipun hanya merubah satu data, tapi yang terjadi di belakang layar adalah semua datanya ditimpa
		$query = "UPDATE pengguna SET
					alamat='$alamat'
				WHERE email='$email'
				 ";
		mysqli_query ($conn, $query); //menjalankan query-nya
		
		return mysqli_affected_rows($conn);	//return angka ketika ada data yang berhasil diupdate di database
}
function ubahsandi($pass,$email) { //function ubah, sama seperti tambah, menerima $data, yakni variabel untuk menampung data post yang dikirimkan
	global $conn; //konek ke database
	// ambil semua data yang diinputkan oleh user
	// $nama_lengkap = htmlspecialchars($data["nama_lengkap"]);
	// $email = htmlspecialchars($data["email"]);
	// $no_hp_wa = htmlspecialchars($data["no_hp_wa"]);
	//cek apakah user pilih gambar baru atau tidak
	//sekalipun hanya merubah satu data, tapi yang terjadi di belakang layar adalah semua datanya ditimpa
		$query = "UPDATE pengguna SET
					kata_sandi='$pass'
				WHERE email='$email'
				 ";
		mysqli_query ($conn, $query); //menjalankan query-nya
		
		return mysqli_affected_rows($conn);	//return angka ketika ada data yang berhasil diupdate di database
}

function cari($keyword) { //dari index dikirim $_post["keyword"] dan ditangkap oleh $keyword
	$query=" SELECT * FROM pengguna 
				WHERE
			 nama_lengkap LIKE '%$keyword%' OR
			 email LIKE '%$keyword%' OR
			 alamat LIKE '%$keyword%' OR
			 no_hp_wa LIKE '%$keyword%'
			 "; 
	return query ($query); // query menghasilkan assoc array dari query, jadi kita memanggil function yang udah dibuat di dalam function baru

}
function cari2($keyword) { //dari index dikirim $_post["keyword"] dan ditangkap oleh $keyword
	$query=" SELECT * FROM administrator 
				WHERE
			 nama_lengkap LIKE '%$keyword%' OR
			 email LIKE '%$keyword%' OR
			 alamat LIKE '%$keyword%' OR
			 no_hp_wa LIKE '%$keyword%' OR
			 nik LIKE '%$keyword%' OR
			 keterangan LIKE '%$keyword%'
			 "; 
	return query ($query); // query menghasilkan assoc array dari query, jadi kita memanggil function yang udah dibuat di dalam function baru
}
function cariinfo($keyword) { //dari index dikirim $_post["keyword"] dan ditangkap oleh $keyword
	$query=" SELECT * FROM informasi ORDER BY id_informasi
				WHERE
			 judul LIKE '%$keyword%' OR
			 tanggal LIKE '%$keyword%' OR
			 instansi LIKE '%$keyword%' 
			 "; 
	return query ($query); // query menghasilkan assoc array dari query, jadi kita memanggil function yang udah dibuat di dalam function baru

}

// nyimpen file di databasenya gak pake blob, file itu tempatnya di dalam directory, bukan di dalam database
// file akan diupload ke dalam directory, sedangkan yang akan di-insert ke database adalah tetap nama filenya (nama gambar akan disimpan ke dalam database sbg string)

	function upload($judul, $instansi) {
		global $conn;
		$namaFile=$_FILES['gambar'] ['name'];
		$ukuranFile=$_FILES ['gambar'] ['size'];
		$error=$_FILES ['gambar'] ['error'];
		$tmpName=$_FILES ['gambar'] ['tmp_name'];
		
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
		
		$ekstensiGambar = strtolower(end($ekstensiGambar));
		if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
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
		$direct = "informasi/images/".$namaFileBaru;
		
		//$lokasi = $tmpName.$ekstensiGambar;

		$query = "UPDATE informasi SET
					gambar='$direct'
				WHERE judul='$judul' and instansi='$instansi'
				 ";
		mysqli_query ($conn, $query);


		move_uploaded_file($tmpName, $direct);
		
		
	
		return mysqli_affected_rows($conn);
		}
	}
?>