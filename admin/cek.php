<?php
    if(!isset($_SESSION['admin'])){
        header("location:../index.php");
        session_destroy();
    }
?>