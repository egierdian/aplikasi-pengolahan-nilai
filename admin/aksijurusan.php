<?php

include '../konfigurasi/konfig.php';

if ($_GET['aksi'] == 'tambah') {
    $jurusan = $_POST['jurusan'];
    //query
    $querytambah =  mysqli_query($koneksi, "INSERT INTO jurusan(nama_jurusan) VALUES ('$jurusan')");

    if ($querytambah) {
        # code redicet setelah insert ke index
        header("location:jurusan.php");
    } else {
        echo "ERROR, tidak berhasil " . mysqli_error($koneksi);
    }
}
// Hapus
if ($_GET['aksi'] == 'hapus') {
    $id_jurusan = $_GET['id'];

    //query hapus
    $querydelete = mysqli_query($koneksi, "DELETE FROM jurusan WHERE ID = '$id_jurusan'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:jurusan.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }
}

if ($_GET['aksi'] == 'edit') {
    $id_jurusan = $_GET['id'];
    $nama_jurusan = $_POST['jurusan'];
    //query hapus
    $querydelete = mysqli_query($koneksi, "UPDATE jurusan SET nama_jurusan = '$nama_jurusan' WHERE ID = '$id_jurusan'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:jurusan.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }
}

?>