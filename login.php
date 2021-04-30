<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 3/20/2021
 * Time: 2:53 PM
 */
    session_start();
    require_once 'php/db_connect.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GetEducation</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body style="background-color: #96a2b4">
<section class="menu_bar">
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark m-0 p-0" >
        <?php include "nav.php";?>
    </nav>
</section>
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto mt-5 mb-5">
                <div class="card mt-5">
                    <div class="card-header bg-info">
                        <h3 class="text-center text-white">User Login</h3>
                    </div>
                    <div class="card-body">
                        <?php

                        global  $connect;

                        if (isset($_POST['btn'])) {
                            $email = $_POST['email'];
                            $password = $_POST['password'];

                            $has = hash('md5', $password);
                            if ($email == ''){
                                echo "<span class='text-danger'>Please Enter Email</span><br/>";
                            } elseif ($password == ''){
                                echo "<span class='text-danger'>Please Enter Password</span><br/>";
                            }else{

                                $sql = "SELECT * FROM users WHERE email ='$email' AND password = '$has' AND status = '0'";

                                $result = mysqli_query($connect, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    $data = mysqli_fetch_assoc($result);

                                    if ($data['role'] == 'user') {
                                        $_SESSION['user'] = $data['email'];
                                        echo "<script>document.location.href='user/index.php'</script>";
                                    } elseif ($data['role'] == 'admin') {
                                        $_SESSION['admin'] = $data['email'];
                                        echo "<script>document.location.href='admin/index.php'</script>";
                                    } elseif ($data['role'] == 'tutor') {
                                        $_SESSION['tutor'] = $data['email'];
                                        echo "<script>document.location.href='tutor/index.php'</script>";
                                    }
                                }else {
                                    echo "<span class='text-danger'>User Name Or Password Doesn't match or Blocked by admin</span>";
                                }
                            }
                        }

                        ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" placeholder="Enter Email" class="form-control" value="<?php if ($_POST) {
                                    echo $_POST['email'];
                                }?>">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" placeholder="Enter Password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label></label>
                                <input type="submit" name="btn"  class="btn btn-success col-4" value="Login">
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <span class="float-right">New user? <a href="registration.php">Registration Here</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="fotter bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <p class="text-center text-white pt-1" style="font-size: 14px">This site is Copyright By &copy;<b> <i> GetEducation</i></b></p>
                </div>
            </div>
        </div>
    </section>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

</body>
</html>
