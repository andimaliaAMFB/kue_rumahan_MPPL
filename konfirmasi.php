<?php
	include 'config.php';
	$db = new database();

	session_start();
	if ((!isset($_SESSION['username'])) && (!isset($_SESSION['password'])) && (!isset($_SESSION['kode_akun']))  ) {
	    $username = "";
	    $password = "";
	    $kode_akun = "";
	    $date = date("Y-m-d H:i:s");
	    // echo $date."<br>".date("Y-m-d H:i:s");
	}
	else
	{
		$username = $_SESSION['username'];
	    $kode_akun = $_SESSION['kode_akun'];
	    $password = $_SESSION['password'];
	    $i = substr($kode_akun, 0,1);
	    if($i == "A"){
	    	$type_akun = "ADMIN";
	    }
	    elseif($i == "M"){
	    	$type_akun = "MEMBER";
	    }
	}
	$kode_produk = $_GET['kode_produk'];
	$jam_transaksi = "";
	$jam_pembayaran = "";
	$jumlah_beli = 0;
	$lokasi = "";
	// echo $kode_produk;

	if (isset($_POST['submitdata'])) {
		if ($username != "") {
			$jam_transaksi = date("Y-m-d H:i:s");
			$jumlah_beli = $_POST['jumlah'];
			$lokasi = $_POST['lokasiterima'];
			$_SESSION['jam_transaksi'] = $jam_transaksi;
			$_SESSION['jumlah_beli'] = $jumlah_beli;
			$_SESSION['lokasi'] = $lokasi;
		}

	}
	if ((isset($_SESSION['jam_transaksi'])) && (isset($_SESSION['jumlah_beli'])) && (isset($_SESSION['lokasi']))  ) {
	    echo "<script>alert('jam_transaksi = ".$_SESSION['jam_transaksi'].", jumlah_beli = ".$_SESSION['jumlah_beli'].", lokasi = ".$_SESSION['lokasi']."')</script>";
	}

	if (isset($_POST['toBeli'])) {

		// echo "<script>alert('".$username.", ".$password.", ".$kode_akun."')</script>";
		if ($username != "") {
			$kode_kategori = $db->getProdukSpesifik($kode_produk,"kode_kategori");
			$kode_penjual = $db->getProdukSpesifik($kode_produk,"kode_akun");
			$nama = $db->getProdukSpesifik($kode_produk,"nama");
			$stok = $db->getProdukSpesifik($kode_produk,"stok");
			$hargasatuan = $db->getProdukSpesifik($kode_produk,"harga");
			$kadaluarsa = $db->getProdukSpesifik($kode_produk,"kadaluarsa");
			$jam_pembayaran = date('Y-m-d H:i:s', strtotime($jam_transaksi. ' + 2 days'));
			$jam_transaksi = $_SESSION['jam_transaksi'];
			$jumlah_beli = $_SESSION['jumlah_beli'];
			$lokasi = $_SESSION['lokasi'];

			$kode_akun = $db->getAkun($username,$password,"kode_akun");


			$stok=$stok-$jumlah_beli;
			// echo "<script>alert('UPDATE `produk` SET `kode_kategori`=".$kode_kategori.",`nama`=".$nama.",`stok`=".$stok.",`hargasatuan`=".$hargasatuan.",`kadaluarsa`=".$kadaluarsa."WHERE kode_produk = ".$kode_produk."')</script>";
			$db->updateProduk($kode_produk,$kode_kategori,$nama,$stok,$hargasatuan,$kadaluarsa);

			
			// echo "<script>alert('INSERT INTO orderkue(waktu_pemesanan, waktu_pembayaran, kode_member, status, komentar, alamat) VALUES (".$jam_transaksi.",".$jam_pembayaran.",".$kode_akun.",Sedang Diantar,NULL,".$lokasi.")')</script>";
			$db->insertOrderKue($jam_transaksi,$jam_pembayaran,$kode_akun,"Sedang Diantar",NULL,$lokasi);

			

			// echo "<script>alert('SELECT kode_order, LENGTH(kode_order), waktu_pemesanan FROM `orderkue` ORDER BY kode_order DESC, waktu_pemesanan DESC LIMIT 1')</script>";
			$kode_order = $db->getOrderKue("lastId");


			echo "<script>alert('INSERT INTO `orderkuedetail`(`kode_order`, `kode_produk`, `kode_admin`, `jumlahBeli`, `hargasatuan`) VALUES (".$kode_order.",".$kode_produk.",".$kode_penjual.",".$jumlah_beli.",".$hargasatuan.")')</script>";
			$db->insertOrderKueDetail($kode_order,$kode_produk,$kode_penjual,$jumlah_beli,$hargasatuan);
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Kue Rumahan</title>
	<link rel="stylesheet" type="text/css" href="Style/style.css">
	<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet'>
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

	<?php 
  	foreach ($db->getProdukSpesifik($kode_produk,"all") as $produk) {
  		$kode_order = $produk['kode_order'];

  		$Nama_Produk = $produk['Nama_Produk'];
  		$stok = $produk['stok'];
  		$harga = $produk['hargasatuan'];
  		$populer = $produk['populer'];
  		$bykdibeli = $produk['banyakDiBeli'];

  		$Nama_Toko = $produk['nama_toko'];
  		$alamat = $produk['alamat'];
  	}
  	?>

	<nav class="navbar justify-content-start align-items-center">
		<button class="d-flex btn ms-3"style="cursor:pointer" onclick="location.href='produk.php?kode_produk=<?php echo $kode_produk ?>'">
			<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-left mx-3" viewBox="0 0 16 16">
			  	<path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
			</svg>
			<h3 class="m-0">Konfirmasi Pembayaran</h3>
		</button>
		
	</nav>
	<div class="content produk">
		<div class="deskripsi utama bg-col1 p-3">
			
			<div class="deskripsi-produk" style="border-radius: 10px;">
				<div class="m-3 d-flex justify-content-between align-items-center">
					<button class="btn d-flex align-items-center">
						<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-shop me-3" viewBox="0 0 16 16">
						  	<path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/>
						</svg>
						<p style="font-size: 48px; margin: 0;"><?php echo $Nama_Toko?></p>
					</button>
					<p class="text-end card-text text-muted" style="font-size:24px;"><?php echo $kode_produk."-".$kode_order ?></p>
					
				</div>
				<div class="normal-card card mb-3 px-3 " style="min-height:250px; height: 250px; border: 0; border-radius: 10px;">

				  	<div class="row g-0">
					    <div class="col-md-4">
					      	<img src="..." class="img-fluid rounded-start" alt="...">
					    </div>
					    <div class="col-md-8">
					      	<div class="card-body justify-content-between align-items-center ">
					      		<div class="d-flex justify-content-between align-items-center mb-3">
					      			<h3 class="card-title judulProduk"><?php echo $Nama_Produk?></h3>
					      		</div>
						        
						        <p class="card-text">
						        	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#FFC700" class="bi bi-star-fill" viewBox="0 0 16 16">
						        	  <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
						        	</svg>
						        	<?php echo $bykdibeli?> Terjual
					        	</p>
						        <p class="card-text">
						        	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
						        	  <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
						        	</svg>
						        	Pengiriman dari <?php echo $alamat ?>
					        	</p>
						        <p class="card-text">
						        	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tag-fill" viewBox="0 0 16 16">
						        	  <path d="M2 1a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l4.586-4.586a1 1 0 0 0 0-1.414l-7-7A1 1 0 0 0 6.586 1H2zm4 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
						        	</svg>
					        		<b>Rp. <?php echo $harga?></b>
					        	</p>
					      	</div>
					    </div>
				  	</div>
				</div>
			</div>
		</div>



		<form action="" method="POST" id="pesan" >
			<div class="bg-col2 justify-content-between align-items-center w-50 mx-auto p-3 ">
				<div class="form-content">
					<div class="p-3">
						<div class="form-input  my-3">
							<input class="form form-control" type="text" name="lokasiterima" placeholder="Lokasi Penerima">
						</div>
						<div class="form-input input-group mb-3">
							<label for="jumlah" class="input-group-text bg-col2">Jumlah </label>
							<input type="number" name="jumlah" class="form form-control" value="0" min="0">
						</div>
					</div>
					<div class="text-center mb-3">
						<button class="btn bg-col1 konfirmasi" name="submitdata" id="submitdata" onclick="submitdata()" type="submitdata">Konfirmasi</button>
					</div>
				</div>
				
			</div>
		</form>

		<div class="text-center mb-3" id="toKonfirmasi" >
			<button class="btn bg-col2 konfirmasi" name="toKonfirmasi" id="toKonfirmasi" onclick="toKonfirmasi()" type="submit">Selanjutnya</button>
		</div>
		
		
		<div id="konfirmasi" style="display:none">
			<div class="justify-content-between align-items-center w-50 mx-auto p-3
			">
				<div class="bg-col2 p-3">

					<div class="mx-3">
						<div class="row justify-content-between px-3">
							<div class="col align-items-center py-1 mb-0">
								<h3>Tanggal Transaksi</h3>
								<p><?php echo $jam_transaksi;?></p>
							</div>
							<div class="col text-end align-items-center py-1 mb-0">
								<h3>Batas Akhir</h3>
								<p><?php echo date('Y-m-d H:i:s', strtotime($jam_transaksi. ' + 2 days'));?></p>
							</div>
						</div>
					</div>
				</div>


				<div class="bg-col1 p-3">
					<table class="table table-borderless">
						<tr>
							<td>Total Produk dibeli</td>
							<td class="text-end"><?php echo $jumlah_beli?></td>
						</tr>
						<tr>
							<td>Total Harga Produk</td>
							<td class="text-end">Rp. <?php echo $harga*$jumlah_beli?></td>
						</tr>
					</table>
				</div>

				<div class="d-flex text-center my-3 justify-content-center">
					<button class="btn bg-col1 text-black konfirmasi" name="toPesan" id="toPesan" onclick="toPesan()" type="submit">Batal</button>
					<form action="" method="POST">
						<button class="btn bg-col2 text-black konfirmasi" name="toBeli" id="toBeli" type="submit">Konfirmasi</button>
					</form>
					
				</div>
			</div>
			
		</div>
		
		

	</div>

	
</body>
</html>

<script>
	function submitdata(){
		decument.getElementById('toKonfirmasi').style.display = "block";
	}
	function toKonfirmasi(){
		document.getElementById('konfirmasi').style.display = "block";
		document.getElementById('pesan').style.display = "none";
		document.getElementById('toKonfirmasi').style.display = "none";
	}
	function toPesan(){
		document.getElementById('konfirmasi').style.display = "none";
		document.getElementById('pesan').style.display = "block";
		document.getElementById('toKonfirmasi').style.display = "block";
	}
</script>