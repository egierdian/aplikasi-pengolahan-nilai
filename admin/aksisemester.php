<?php

include '../konfigurasi/konfig.php';

if ($_GET['aksi'] == 'tambah') {
    $smt = $_POST['semester'];
    $thn = $_POST['tahun'];
    $status = $_POST['status'];
    //query
    $querytambah =  mysqli_query($koneksi, "INSERT INTO semester(semester, tahun_ajaran,status) VALUES ('$smt','$thn','$status')");

    if ($querytambah) {
        # code redicet setelah insert ke index
        header("location:semester.php");
    } else {
        echo "ERROR, tidak berhasil " . mysqli_error($koneksi);
    }
}
// Hapus
if ($_GET['aksi'] == 'hapus') {
    $id_semester = $_GET['id'];

    //query hapus
    $querydelete = mysqli_query($koneksi, "DELETE FROM semester WHERE ID = '$id_semester'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:semester.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }
}

if ($_GET['aksi'] == 'edit') {
    $id_semester = $_GET['id'];
    $smt = $_POST['semester'];
    $thn = $_POST['tahun'];
    $status = $_POST['status'];
    $querydelete = mysqli_query($koneksi, "UPDATE semester SET semester = '$smt', tahun_ajaran = '$thn', status='$status' WHERE ID = '$id_semester'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:semester.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }
}

?>