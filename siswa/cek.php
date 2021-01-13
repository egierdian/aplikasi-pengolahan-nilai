<?php
    if(!isset($_SESSION['siswa'])){
        header("location:../index.php");
        session_destroy();
    }
?>