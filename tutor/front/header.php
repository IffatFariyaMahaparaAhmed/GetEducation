<?php
    session_start();
    if (!isset($_SESSION['tutor'])){
        header('Location: ../index.php');
    }

    require_once '../php/db_connect.php';

    $sql = $connect->query("SELECT * FROM users WHERE email = '$_SESSION[tutor]'");

    $user_data = mysqli_fetch_assoc($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GetEducation</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->

    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="../assets/style/main.css" rel="stylesheet">
    <link href="../images/logo.JPG" rel="icon"/>

</head>