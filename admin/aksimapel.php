<?php

include '../konfigurasi/konfig.php';

if ($_GET['aksi'] == 'tambah') {
    $mapel = $_POST['pelajaran'];
    //query
    $querytambah =  mysqli_query($koneksi, "INSERT INTO mapel(mata_pelajaran) VALUES ('$mapel')");

    if ($querytambah) {
        # code redicet setelah insert ke index
        header("location:mapel.php");
    } else {
        echo "ERROR, tidak berhasil " . mysqli_error($koneksi);
    }
}
// Hapus
if ($_GET['aksi'] == 'hapus') {
    $id_mapel = $_GET['id'];

    //query hapus
    $querydelete = mysqli_query($koneksi, "DELETE FROM mapel WHERE ID = '$id_mapel'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:mapel.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }
}

if ($_GET['aksi'] == 'edit') {
    $id_mapel = $_GET['id'];
    $mapel = $_POST['pelajaran'];
    //query hapus
    $querydelete = mysqli_query($koneksi, "UPDATE mapel SET mata_pelajaran = '$mapel' WHERE ID = '$id_mapel'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:mapel.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }
}

?>