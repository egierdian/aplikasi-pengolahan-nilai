<?php
    if(!isset($_SESSION['guru'])){
        header("location:../index.php");
        session_destroy();
    }
?>