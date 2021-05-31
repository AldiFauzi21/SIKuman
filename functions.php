<?php 
// koneksi ke database
// $conn = mysqli_connect("localhost", "root", "", "sibicoid_sikuman");
include 'config.php';
//menampilkan data dari tabel
function query($query) {
	global $conn;

	$result = mysqli_query($conn, $query);
	$rows = [];
	while ( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}


function tambah($data) {
	global $conn;

	$tgl_info = htmlspecialchars($data["tgl_info"]);
	$id_admin = htmlspecialchars($data["id_admin"]);
	$judul = htmlspecialchars($data["judul"]);
	$isi_informasi = htmlspecialchars($data["isi_informasi"]);

	$foto_info = upload();
	if ( !$foto_info ) {
		return false;
	}


	//query insert data
	$query = "INSERT INTO informasi 
				VALUES 
			  ('', '$foto_info', '$tgl_info', '$id_admin', '$judul', '$isi_informasi')
			";
	mysqli_query($conn, $query);


	return mysqli_affected_rows($conn);

}

function upload() {

	$namaFile = $_FILES['foto_info']['name'];
	$ukuranFile = $_FILES['foto_info']['size'];

	$error = $_FILES['foto_info']['error'];
	$tmpName = $_FILES['foto_info']['tmp_name'];

	// cek apakah tidak ada gambar yang di upload
	if ( $error === 4 ) {
		echo "<script>

				alert('Pilih gambar terlebih dahulu!');

			</script>";
		return false;
	}

	// cek apakah yang diupload adalah gambar

	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile); //untuk memecah string menjadi array

	$ekstensiGambar = strtolower(end($ekstensiGambar));

	// if ( in_array($ekstensiGambar, $ekstensiGambarValid) ) {
	if ( in_array($ekstensiGambarValid, $ekstensiGambar) ) {
		echo "<script>

				alert('Yang anda upload bukan gambar!');

			</script>";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if ( $ukruanFile > 1044070 ){
			echo "<script>

				alert('ukuran gambar terlalu besar!');

			</script>";
		return false;
	}

	// lolos pengecekan, gambar siap diupload
	move_uploaded_file($tmpName, 'images/'.$namaFile);

	return $namaFile;

}

function hapus($id_info) {
	global $conn;
	mysqli_query($conn, "DELETE FROM informasi where id_info=$id_info");

	return mysqli_affected_rows($conn);
}

function edit($data) {
	global $conn;

	$id_info = $data["id_info"];
	$foto_info = htmlspecialchars($data["foto_info"]);
	$tgl_info = htmlspecialchars($data["tgl_info"]);
	$id_admin = htmlspecialchars($data["id_admin"]);
	$judul = htmlspecialchars($data["judul"]);
	$isi_informasi = htmlspecialchars($data["isi_informasi"]);

	//query insert data
	$query = "UPDATE informasi SET
			  foto_info = '$foto_info',
			  tgl_info = '$tgl_info',
			  id_admin = '$id_admin',
			  judul = '$judul',
			  isi_informasi = '$isi_informasi'
			  WHERE id_info = $id_info
			";
	mysqli_query($conn, $query);


	return mysqli_affected_rows($conn);
}

function cari($keyword) {
	$query = "SELECT * FROM informasi 
				WHERE 
			   isi_informasi LIKE '%$keyword%' OR
			   tgl_info LIKE '%$keyword%'
			";

	return query($query); 
}