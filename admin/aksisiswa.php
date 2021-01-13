<?php

include '../konfigurasi/konfig.php';

if ($_GET['aksi'] == 'tambah') {
    $npm = $_POST['npm'];
    $id_jurusan = $_POST['id_jurusan'];
    $nama = $_POST['nama'];
    $jk = $_POST['jk'];
    $alamat = $_POST['alamat'];
    //query
    $querytambah =  mysqli_query($koneksi, "INSERT INTO siswa(npm, ID_jurusan, nama, jk, alamat) VALUES ('$npm','$id_jurusan','$nama','$jk','$alamat')");

    if ($querytambah) {
        # code redicet setelah insert ke index
        header("location:siswa.php");
    } else {
        echo "ERROR, tidak berhasil " . mysqli_error($koneksi);
    }
}
// Hapus
if ($_GET['aksi'] == 'hapus') {
    $npm = $_GET['npm'];

    //query hapus
    $querydelete = mysqli_query($koneksi, "DELETE FROM siswa WHERE npm = '$npm'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:siswa.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }
}

if ($_GET['aksi'] == 'edit') {
    $npm = $_GET['npm'];
    $id_jurusan = $_POST['id_jurusan'];
    $nama = $_POST['nama'];
    $jk = $_POST['jk'];
    $alamat = $_POST['alamat'];
    $querydelete = mysqli_query($koneksi, "UPDATE siswa SET ID_jurusan = '$id_jurusan', nama = '$nama', jk='$jk' , alamat='$alamat' WHERE npm = '$npm'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:siswa.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }
}

?>