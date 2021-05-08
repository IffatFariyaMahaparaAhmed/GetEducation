<?php

session_start();
if (!isset($_SESSION['user'])){
    header('Location: ../index.php');
}

require_once 'php/db_connect.php';

$sql = $connect->query("SELECT * FROM users WHERE email = '$_SESSION[user]'");

$user_data = mysqli_fetch_assoc($sql);

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
    <link href="tutor/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>

<!--nav bar-->
<section class="menu_bar">
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark m-0 p-0" >
        <?php include "nav.php";?>
    </nav>
</section>


<section class="course" style="background-color: white">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto mt-5 mb-5">
                <div class="card">
                    <div class="card-header">
                        <?php
                        if ($_GET['last_id']){
                            $pay_id = $_GET['last_id'];

                            $get_pay_data = $connect->query("SELECT * FROM enroll_course WHERE enroll_id = '$pay_id'");

                            $data = mysqli_fetch_assoc($get_pay_data);
                        }

                        if (isset($_POST['btn']))
                        {
                            $bkas_number  = $_POST['bkas_number'];

                            $update_pay = $connect->query("UPDATE enroll_course SET bkas_number = '$bkas_number', payment_by = 'Bkas' WHERE enroll_id = '$pay_id'");

                            if ($update_pay){
                                $_SESSION['success'] = 'Enrolled Course Success';
                                echo "<script>document.location.href='code.php?last_id=$pay_id'</script>";
                            }else{
                                echo "Error: ".mysqli_error($connect);
                            }

                        }

                        if (isset($_POST['cancel'])){

                            $cancel    = "DELETE FROM enroll_course WHERE enroll_id = $pay_id";
                            $cance_res = mysqli_query($connect, $cancel);

//                            $_SESSION['error'] = 'Enrolled Failed....!';

                            echo "<script>document.location.href='course.php'</script>";
                        }

                        ?>
                        <img src="images/bkas.png" class="card-img-top" style="height: 100px; width: 100%">
                    </div>
                    <div class="card-body" style="background-color: #E3106D;">
                        <p class="mt-5 text-center text-white">Bkash Check Out</p>
                        <div class="col-md-8 mx-auto">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label class="text-white">Enter Bkas Number</label>

                                    <input type="text" name="bkas_number" class="form-control" placeholder="01711111111">

                                </div>
                                <div class="form-group">
                                    <input type="checkbox"> <span class="text-white ml-2">I Agree To The Term And Condition</span>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn col-md-5 p-1" value="Submit" name="btn" style="background-color: #B6195E; color: white">
                                    <input type="submit" class="btn col-md-5 p-1" value="Cancel" name="cancel" style="background-color: #B6195E; color: white">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="fotter bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <p class="text-center text-white pt-1" style="font-size: 14px">This site is Copy Wright By &copy;<b> <i> GetEducation</i></b></p>
            </div>
        </div>
    </div>
</section>
<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>




