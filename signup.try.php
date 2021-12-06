<?php 
	include 'config.try.php';
	$db = new database();

	session_start();

	error_reporting(0);

	if ( (isset($_SESSION['username'])) && (isset($_SESSION['password'])) ) {
	    header("Location:try.php");
	}

	if (isset($_POST['logmember'])) {
		$nama = $_POST['nama'];
		$alamat = $_POST['alamat'];
		$tl = $_POST['tl'];
		$jeniskelamin = $_POST['jeniskelamin'];
		$username = $_POST['username'];
		$password = md5($_POST['password']);

		$db->registrasiMember($nama,$alamat,$tl,$jeniskelamin,$username,$password);
	}
	elseif (isset($_POST['logadmin'])) {
		$nama = $_POST['nama'];
		$alamat = $_POST['alamat'];
		$tl = $_POST['tl'];
		$jeniskelamin = $_POST['jeniskelamin'];
		$nama_toko = $_POST['nama_toko'];
		$username = $_POST['username'];
		$password = md5($_POST['password']);

		$db->registrasiAdmin($nama,$alamat,$tl,$jeniskelamin,$nama_toko,$username,$password);
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<h1>Kue Rumahan</h1>

	<div id="list-login">
	  <a href="#" class="list-group-item list-group-item-action active" aria-current="true" onclick="AdminLog()">Admin</a>
	  <a href="#" class="list-group-item list-group-item-action" onclick="MemberLog()">Member</a>
	</div>

	<form action="" method="POST" id="submitAdmin" style="display: none;">
		<table>
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td>
					<input type="text" name="nama" id="nama" placeholder="Nama lengkap">
				</td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>:</td>
				<td>
					<textarea name="alamat" id="alamat" placeholder="Alamat"></textarea>
				</td>
			</tr>
			<tr>
				<td>Tanggal Lahir</td>
				<td>:</td>
				<td>
					<input type="date" name="tl" id="tl" placeholder="Tanggal Lahir">
				</td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td>:</td>
				<td>
					<label for="L">Laki-laki</label>
					<input type="radio" name="jeniskelamin" id="L" value="L"><br>
					<label for="P">Perempuan</label>
					<input type="radio" name="jeniskelamin" id="P" value="P">
				</td>
			</tr>
			<tr>
				<td>Nama Toko</td>
				<td>:</td>
				<td>
					<input type="text" name="nama_toko" id="nama_toko" placeholder="Nama Toko">
				</td>
			</tr>
			<tr>
				<td>Username</td>
				<td>:</td>
				<td>
					<input type="text" name="username" id="username" placeholder="Username">
				</td>
			</tr>
			<tr>
				<td>Password</td>
				<td>:</td>
				<td>
					<input type="password" name="password" id="password" placeholder="Password">
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<input type="submit" name="logadmin" id="submit">
				</td>
			</tr>
		</table>
	</form>

	<form action="" method="POST" id="submitMember">
		<table>
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td>
					<input type="text" name="nama" id="nama" placeholder="Nama lengkap">
				</td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>:</td>
				<td>
					<textarea name="alamat" id="alamat" placeholder="Alamat"></textarea>
				</td>
			</tr>
			<tr>
				<td>Tanggal Lahir</td>
				<td>:</td>
				<td>
					<input type="date" name="tl" id="tl" placeholder="Tanggal Lahir">
				</td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td>:</td>
				<td>
					<label for="L">Laki-laki</label>
					<input type="radio" name="jeniskelamin" id="L" value="L"><br>
					<label for="P">Perempuan</label>
					<input type="radio" name="jeniskelamin" id="P" value="P">
				</td>
			</tr>
			<tr>
				<td>Username</td>
				<td>:</td>
				<td>
					<input type="text" name="username" id="username" placeholder="Username">
				</td>
			</tr>
			<tr>
				<td>Password</td>
				<td>:</td>
				<td>
					<input type="password" name="password" id="password" placeholder="Password">
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<input type="submit" name="logmember" id="submit">
				</td>
			</tr>
		</table>
	</form>
	<p>Sudah Punya Akun? Login <a href="login.try.php">Disini</a></p>
</body>
</html>

<script>
	function AdminLog(){
		document.getElementById('submitAdmin').style.display = "block";
		document.getElementById('submitMember').style.display = "none";
	}
	function MemberLog(){
		document.getElementById('submitAdmin').style.display = "none";
		document.getElementById('submitMember').style.display = "block";
	}
</script>