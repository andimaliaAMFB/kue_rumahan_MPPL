<?php
	class Database
	{
		var $host = "localhost";
		var $username = "root";
		var $password = "";
		var $database = "kue_rumahan";
		var $koneksi = "";

		function __construct()
		{
			$this->koneksi = mysqli_connect($this->host, $this->username, $this->password,$this->database);
			if (mysqli_connect_errno()){
				echo "Koneksi database gagal : " . mysqli_connect_error();
				echo "<script>alert('Koneksi database gagal : ')</script>" . mysqli_connect_error();
			}
		}


		function cekAkun($username,$password,$typecek){
			$sql = "SELECT * FROM member WHERE username='$username' AND password='$password'";
			$result = mysqli_query($this->koneksi, $sql);
			
			//echo "<script>alert('CEK ".$username." dan ".$password."')</script>";
			echo mysqli_error($this->koneksi);
			//echo "<script>alert('CEK ".$typecek." AKUN MEMBER')</script>";
			
			if ($result->num_rows > 0) {
				$row = mysqli_fetch_assoc($result);
				switch ($typecek) {
					case "username":
						echo "<script>alert('Username Akun ini adalah".$row['username']." dari akun [`MEMBER`]')</script>";
						return $row['username'];
						break;
					case "password":
						return $row['password'];
						break;
					case "login":
						$_SESSION['username'] = $row['username'];
						$_SESSION['password'] = $row['password'];
						$_SESSION['kode_akun'] = $row['kode_member'];
						header("Location:try.php");
						break;
				}
			}
			else
			{
				echo "<script>alert('Woops! Username ini tidak ada di data [`MEMBER`].')</script>";
				//echo "<script>alert('CEK ".$typecek." AKUN ADMIN')</script>";
				

				$sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
				$result = mysqli_query($this->koneksi, $sql);
				
				if ($result->num_rows > 0) {
					$row = mysqli_fetch_assoc($result);
					switch ($typecek) {
						case "username":
							echo "<script>alert('Username Akun ini adalah".$row['username']." dari akun [`ADMIN`]')</script>";
							return $row['username'];
							break;
						case "password":
							return $row['password'];
							break;
						case "login":
							$_SESSION['username'] = $row['username'];
							$_SESSION['password'] = $row['password'];
							$_SESSION['kode_akun'] = $row['kode_admin'];
							header("Location:try.php");
							break;
					}
				}
				else
					echo "<script>alert('Woops! Username ini tidak ada di data [`ADMIN`].')</script>";
			}
		}

		function registrasiMember($nama,$alamat,$tl,$jeniskelamin,$username,$password){

			$sqlcek = "SELECT kode_member, 
							LENGTH(kode_member), 
							SUBSTRING(kode_member,3,10) as tanggalBuat, 
							CAST(SUBSTRING(kode_member,14,6) AS INT) as noUrut
						FROM member 
							WHERE SUBSTRING(kode_member,3,10) = CURRENT_DATE
							ORDER by tanggalbuat ASC, noUrut ASC, LENGTH(kode_member) DESC";

			$resultcek = mysqli_query($this->koneksi, $sqlcek);
			echo mysqli_error($this->koneksi);

			
			$kode_nourut = 0;
			while ($row = mysqli_fetch_array($resultcek)){
					$hasil[] = $row;
					$kode_nourut = (int)$row['noUrut'];//get biggest number from today
			}
			//echo $kode_nourut."<br>"; //cek nilai $kode_nourut
			$kode_nourut++;
			//echo $kode_nourut; //cek nilai $kode_nourut after +1
			
			
			$sql = "INSERT INTO member(kode_member, nama, alamat, ttl, jeniskelamin, username, password) 
					VALUES ('M-".date("Y-m-d")."-".$kode_nourut."','$nama','$alamat','$tl','$jeniskelamin','$username','$password');";
			$result = mysqli_query($this->koneksi, $sql);
			if ($result) {
				echo "<script>alert('Wow! User Registration for [`MEMBER`] Completed.')</script>";
			}
			else {
				echo "<script>alert('Woops! Something Wrong Went.')</script>";
			}
			
		}

		function registrasiAdmin($nama,$alamat,$tl,$jeniskelamin,$nama_toko,$username,$password){

			$sqlcek = "SELECT kode_admin, 
							LENGTH(kode_admin), 
							SUBSTRING(kode_admin,3,10) as tanggalBuat, 
							CAST(SUBSTRING(kode_admin,14,6) AS INT) as noUrut
						FROM admin 
							WHERE SUBSTRING(kode_admin,3,10) = CURRENT_DATE
							ORDER by tanggalbuat ASC, noUrut ASC, LENGTH(kode_admin) DESC";

			$resultcek = mysqli_query($this->koneksi, $sqlcek);
			echo mysqli_error($this->koneksi);

			
			$kode_nourut = 0;
			while ($row = mysqli_fetch_array($resultcek)){
					$hasil[] = $row;
					$kode_nourut = (int)$row['noUrut'];//get biggest number from today
			}
			//echo $kode_nourut."<br>"; //cek nilai $kode_nourut
			$kode_nourut++;
			//echo $kode_nourut; //cek nilai $kode_nourut after +1
			
			
			$sql = "INSERT INTO admin(kode_admin, nama, alamat, ttl, jeniskelamin, nama_toko, username, password) 
					VALUES ('A-".date("Y-m-d")."-".$kode_nourut."','$nama','$alamat','$tl','$jeniskelamin','$nama_toko','$username','$password');";
			$result = mysqli_query($this->koneksi, $sql);
			if ($result) {
				echo "<script>alert('Wow! User Registration for [`ADMIN`] Completed.')</script>";
			}
			else {
				echo "<script>alert('Woops! Something Wrong Went.')</script>";
			}
			
		}

		function getProduk(){
			$sql = "SELECT kategori.nama as Nama_Kategori,
							admin.kode_admin as Kode_akun,
							produk.kode_produk as Kode_Produk, 
							produk.nama as Nama_Produk,
							produk.stok,
							produk.hargasatuan,
    						produk.kadaluarsa,
							admin.nama_toko 
					FROM (((`dijual` INNER JOIN produk) INNER JOIN admin) INNER JOIN kategori)
					WHERE ((dijual.kode_produk = produk.kode_produk) AND (dijual.kode_admin=admin.kode_admin) AND (produk.kode_kategori = kategori.kode_kategori)) 
					GROUP BY dijual.kode_produk";
			$result = mysqli_query($this->koneksi, $sql);
			while ($row = mysqli_fetch_array($result)){
				$hasil[] = $row;
			}
			return $hasil;
			
		}
		function getProdukSpesifik($kode_produk,$typecek){
			$sql = "SELECT *,kategori.nama as Nama_Kategori,
							admin.kode_admin as Kode_akun,
							produk.kode_produk as Kode_Produk, 
							produk.nama as Nama_Produk,
							produk.stok,
							produk.hargasatuan,
    						produk.kadaluarsa,
							admin.nama_toko 
					FROM (((`dijual` INNER JOIN produk) INNER JOIN admin) INNER JOIN kategori)
					WHERE ((dijual.kode_produk = produk.kode_produk) AND (dijual.kode_admin=admin.kode_admin) AND (produk.kode_kategori = kategori.kode_kategori) AND (dijual.kode_produk = '$kode_produk'))
					GROUP BY dijual.kode_produk";
			$result = mysqli_query($this->koneksi, $sql);
			while ($row = mysqli_fetch_array($result)){
				switch ($typecek) {
					case "all":
						$hasil[] = $row;
						break;

					case "kode_akun":
						return $row['Kode_akun'];
						break;
					case "kode":
						return $row['Kode_Produk'];
						break;
					case "kode_kategori":
						return $row['kode_kategori'];
						break;
					case "nama":
						return $row['Nama_Produk'];
						break;
					case "stok":
						return $row['stok'];
						break;
					case "harga":
						return $row['hargasatuan'];
						break;
					case "kadaluarsa":
						return $row['kadaluarsa'];
						break;
					case "toko":
						return $row['nama_toko'];
						break;
					case "kategori":
						return $row['nama'];
						break;
					
					default:
						echo "<script>alert('Woops! Something Wrong Went.')</script>";
						break;
				}
				if ($typecek == "all") {
					return $hasil;
				}
			}
		}
		function updateProduk($kode_produk,$kode_kategori,$nama,$stok,$hargasatuan,$kadaluarsa){
			 $sql = "UPDATE `produk` 
			 		SET `kode_kategori`='$kode_kategori',
			 			`nama`='$nama',
			 			`stok`=$stok,
			 			`hargasatuan`=$hargasatuan,
			 			`kadaluarsa`='$kadaluarsa' 
			 		WHERE kode_produk = '$kode_produk'";
			$result = mysqli_query($this->koneksi, $sql);
			if ($result) {
				echo "<script>alert('Wow! Update Produk Completed.')</script>";
			}
			else {
				echo "<script>alert('Woops! Something Wrong Went.')</script>";
			}
		}
	}
?>