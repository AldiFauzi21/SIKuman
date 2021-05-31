<?php

	//header("location:sikuman/auth.php");
	header("location:BerandaAfter.php");

?>

SELECT nama_mahasiswa FROM mahasiswa WHERE nim IN ( SELECT nim FROM kartu_studi WHERE no_kartu IN (SELECT no_kartu FROM hasil_studi GROUP BY no_kartu HAVING AVG(ip) > 3.5)AND nim LIKE '%019%');