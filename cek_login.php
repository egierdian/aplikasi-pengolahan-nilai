<?php
// mengaktifkan session php
session_start();
 
// menghubungkan dengan koneksi
include 'konfigurasi/konfig.php';

$idp = $_POST['id_pengguna'];
$password = $_POST['password'];
$pas = md5($password);
// $hak_akses = $_POST['hak_akses'];

// menyeleksi data user dengan username dan password yang sesuai
$result = mysqli_query($koneksi,"SELECT * FROM pengguna where ID='$idp' and password='$password'");

$cek = mysqli_num_rows($result);

if($cek > 0) {
	$data = mysqli_fetch_assoc($result);
	if($data['hak_akses']=='admin'){
		//menyimpan session user, nama, status dan id login
		$_SESSION['ID'] = $data['ID'];
		$_SESSION['nama'] = $data['nama'];
		$_SESSION['admin'] = "true";
		header("location:admin/index.php");
	}
	else if($data['hak_akses']=='guru'){
		//menyimpan session user, nama, status dan id login
		$_SESSION['ID'] = $data['ID'];
		$_SESSION['nama'] = $data['nama'];
		$_SESSION['guru'] = "true";
		header("location:guru/index.php");
	}
	else if($data['hak_akses']=='siswa'){
		//menyimpan session user, nama, status dan id login
		$_SESSION['ID'] = $data['ID'];
		$_SESSION['nama'] = $data['nama'];
		$_SESSION['siswa'] = "true";
		header("location:siswa/index.php");
	}else {
		header("location:index.php?pesan=Gagal");
	}
} else {
    header("location:index.php?pesan=Gagal");
}
?>