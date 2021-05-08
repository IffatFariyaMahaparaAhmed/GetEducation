<?php


    session_start();
    unset($_SESSION['tutor']);
    session_destroy();
    header('location: ../index.php');

?>