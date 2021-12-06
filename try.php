<?php
	include 'config.try.php';
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
			?><a href="login.try.php" class="btn btn-info text-white">Login</a><?php
		}
		else
		{
			?><a href="logout.try.php" class="btn btn-danger text-white">Logout</a><?php
		}
		?>
	<!-- END LOG Button -->

	<!-- tampil produk -->
	<hr>
	
	<div class="card col-sm-10 mx-auto text-center">
		<div class="card-header"><h3>Produk</h3></div>
		<table class="table table-hover"> 
			<thead class="thead-light">
				<tr>
					<td>No</td>
					<td>Nama</td>
					<td>Harga Satuan</td>
					<td>Nama Toko</td>
					<td>Keterangan</td>
				</tr>
			</thead>
			<tbody>
			<?php 
			$no = 1;
			foreach ($db->getProduk() as $produk) {
				?>
				<tr>
					<td><?php echo $no;?></td>
					<td style="cursor:pointer" onclick="location.href='Produk/<?php echo$produk['Nama_Kategori']."/".substr($produk['Kode_Produk'], 0,11)."-".$produk['Nama_Produk']?>.php'"><?php echo$produk['Nama_Produk']?></td>
					<td><?php echo$produk['hargasatuan']?></td>
					<td style="cursor:pointer" onclick="location.href='Toko/<?php echo$produk['nama_toko']?>'"><?php echo$produk['nama_toko']?></td>
					<td>
						<?php
							if ($kode_akun == $produk['Kode_akun']) {?>
								<a href="edit.try.php" class="btn btn-warning text-white">Edit</a>
								<a href="delete.try.php" class="btn btn-danger text-white">Hapus</a>
							<?php
							}
							else{?>
								<a href="#" class="btn btn-warning text-white disabled">Edit</a>
								<a href="#" class="btn btn-danger text-white disabled">Hapus</a>
							<?php
							}
						?>
					</td>
				</tr>
				<?php
				$no++;
			} ?>
			</tbody>
		</table>
	</div>
	
</body>
</html>