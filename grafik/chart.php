<?php 
$conn = mysqli_connect("localhost", "root", "", "sibicoid_sikuman");

$nama_barang = $conn -> query("SELECT * FROM tensi_darah");
$stock_barang = $conn -> query("SELECT * FROM tensi_darah");

$jumlah_nama_barang = mysqli_num_rows($nama_barang);

$jumlah_stock_barang = mysqli_num_rows($stock_barang);


?>