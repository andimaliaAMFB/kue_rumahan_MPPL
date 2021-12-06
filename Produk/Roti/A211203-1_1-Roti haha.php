<?php
	include '../../config.try.php';
	$db = new database();

	session_start();

	if ((!isset($_SESSION['username'])) && (!isset($_SESSION['password'])) && (!isset($_SESSION['kode_akun']))  ) {
	    $username = "";
	    $password = "";
	    $kode_akun = "";
	}
	else
	{
		$username = $_SESSION['username'];
	    $kode_akun = $_SESSION['kode_akun'];
	    $i = substr($kode_akun, 0,1);
	    if($i == "A"){
	    	$type_akun = "ADMIN";
	    }
	    elseif($i == "M"){
	    	$type_akun = "MEMBER";
	    }
	}
	$kode_produk = substr($_SERVER['REQUEST_URI'], 24,11);

	if (isset($_POST['beli'])) {

		echo "<script>alert('".$username."')</script>";
		if ($username != "") {
			$kode_kategori = $db->getProdukSpesifik($kode_produk,"kode_kategori");
			$nama = $db->getProdukSpesifik($kode_produk,"nama");
			$stok = $db->getProdukSpesifik($kode_produk,"stok");
			$hargasatuan = $db->getProdukSpesifik($kode_produk,"harga");
			$kadaluarsa = $db->getProdukSpesifik($kode_produk,"kadaluarsa");

			echo "<script>alert('".$kode_kategori.$nama.$stok.$hargasatuan.$kadaluarsa."')</script>";
			
			echo "<script>alert('stok - jumlahbeli = ".$stok." - ".$_POST['jumlah']."')</script>";
			$stok=$stok-$_POST['jumlah'];
			echo "<script>alert('stok - jumlahbeli = ".$stok."')</script>";

			$db->updateProduk($kode_produk,$kode_kategori,$nama,$stok,$hargasatuan,$kadaluarsa);
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://getbootstrap.com/docs/5.1/dist/css/bootstrap.min.css">
</head>
<body>
	<h1>Kue Rumahan</h1>
	<?php 
	if (!$username == "") {
		echo "<h3>Hello ".$username."</h3>";
		echo "<h5>".$type_akun."</h5>";
	}
	?>

	<!-- LOG Button -->
		<?php
		if ($username == "") {
			?><a href="../../login.try.php" class="btn btn-info text-white">Login</a><?php
		}
		else
		{
			?><a href="../../logout.try.php" class="btn btn-danger text-white">Logout</a><?php
		}
		?>
	<!-- END LOG Button -->

	<!-- tampil produk -->
	<hr>
	<?php 
  	foreach ($db->getProdukSpesifik($kode_produk,"all") as $produk) {
  		$Nama_Produk = $produk['Nama_Produk'];
  		$stok = $produk['stok'];
  		$harga = $produk['hargasatuan'];
  	}
  	?>
	<form action="" method="POST">
		<div class="row mx-auto text-center">
			<div class="card col-sm-4 ms-auto" style="width: 18rem;">
	  			<img src="..." class="card-img-top" alt="...">
	  			<div class="card-body">
		  		  	<h5 class="card-title"><?php echo$Nama_Produk?></h5>
		  		  	<p class="card-text">Stok tersedia <?php echo$stok?></p>
		  		  	<p class="card-text">Rp.<?php echo$harga?> per Satuan</p>
	  		  		

	  		  		<div class="input-group mb-3">
	  		  			<label for="jumlah" class="input-group-text">Jumlah </label>
	  		  			<input type="number" name="jumlah" class="form-control" value="0" min="0">
	  		  		</div>
	  			</div>
			</div>
			<div class="card col-sm-6 me-auto" id="formAlamat">
				<div class="input-group mb-3">
					<input type="text" name="alamat" class="form-control" placeholder="Alamat Pengiriman">
				</div>
				
				<button class="btn btn-primary" role="button" type="submit" name="beli" id="beli">Beli</button>
			</div>
		</div>
	</form>
</body>
</html>