<?php
include 'config.php';

// session_start();

// if ( !isset($_SESSION["login"]) ) {
// 	header("Location: loginadmin.php");
// 	exit;
// }

function hapus($id_pasien) {
	global $conn;
	mysqli_query($conn, "DELETE FROM pasien where id_pasien=$id_pasien");

	return mysqli_affected_rows($conn);
} 

$id_pasien = $_GET["id_pasien"];

if ( hapus($id_pasien) > 0 ) {
	echo "
		<script>
			alert('data berhasil dihapus');
			document.location.href = 'regis.php';
		</script>
		";
	}
	else {
		echo "
		<script>
			alert('data gagal dihapus');
			document.location.href = 'regis.php';
		</script>
		";
	}


?>