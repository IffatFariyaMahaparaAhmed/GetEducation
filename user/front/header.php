<?php
    session_start();
    if (!isset($_SESSION['user'])){
        header('Location: ../index.php');
    }

    require_once '../php/db_connect.php';

    $sql = $connect->query("SELECT * FROM users WHERE email = '$_SESSION[user]'");

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
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="icon" href="../images/<?php echo $user_data['image']?>">
    <link href="jquery-bar-rating-master/dist/themes/fontawesome-stars.css" rel="stylesheet" type='text/css'>
    <link href="jquery-bar-rating-master/dist/themes/fontawesome-stars.css" rel="stylesheet" type='text/css'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

</head>