<?php

include '../konfigurasi/konfig.php';

if ($_GET['aksi'] == 'tambah') {
    $id_pengguna = $_POST['id_pengguna'];
    $nama = $_POST['nama'];
    $password = $_POST['password'];
    $hak = $_POST['hak_akses'];
    //query
    $querytambah =  mysqli_query($koneksi, "INSERT INTO pengguna (ID, nama, password, hak_akses) VALUES ('$id_pengguna','$nama','$password','$hak')");

    if ($querytambah) {
        # code redicet setelah insert ke index
        header("location:pengguna.php");
    } else {
        echo "ERROR, tidak berhasil " . mysqli_error($koneksi);
    }
}
// Hapus
if ($_GET['aksi'] == 'hapus') {
    $id_pengguna = $_GET['id'];

    //query hapus
    $querydelete = mysqli_query($koneksi, "DELETE FROM pengguna WHERE ID = '$id_pengguna'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:pengguna.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }
}

if ($_GET['aksi'] == 'edit') {
    $id_pengguna = $_GET['id'];
    $nama = $_POST['nama'];
    $password = $_POST['password'];
    $hak = $_POST['hak_akses'];
    $querydelete = mysqli_query($koneksi, "UPDATE pengguna SET nama = '$nama', password = '$password', hak_akses = '$hak' WHERE ID = '$id_pengguna'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:pengguna.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }
}

?>