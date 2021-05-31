<?php 
include'config.php';
$provinsi = mysqli_query($conn, "SELECT * FROM provinsi ");
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

			<div class="col-lg-3"></div>

			<div class="col-lg-6">
				<div id="ui">
					
						<form action="regis.php" method="GET" class="form-inline my-2 my-lg-0">
							
							<h1>Anda berasal dari provinsi mana?</h1>
							<br><br>
            			    <label>Provinsi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>	
								<select class="form-control" name="provinsi">
									<option>
										<?php
										 $i=1;foreach( $provinsi as $row ) :?>
									<option value="<?= $row["id_prov"]; ?>">
										<?= $row["nama_prov"]; ?>
									</option>
		              				<?php $i++; ?>
									<?php endforeach; ?>
									</option>
								</select>
							
						<button class="btn btn-primary btn-lg btn-block" type="submit" name="butprov">Pilih</button>
						<?php
						if(isset($_GET['error'])){
							if($_GET['error']=="pass"){
								echo "<center><h5>Konfirmasi kata sandi tidak sesuai</h5></center>";
							}else if($_GET['error']=="admin"){
								echo "<center><h5>E-mail tersebut sudah terdaftar sebagai administrator</h5></center>";
							}else if($_GET['error']=="pasien"){
								echo "<center><h5>E-mail tersebut sudah terdaftar sebagai pasien</h5></center>";
							}
						}
						?>

					</form>

				</div>
			</div>
			<div class="col-lg-3"></div>



		</div>
		

	</div>
</body>
</html>