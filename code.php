<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 4/7/2021
 * Time: 4:09 PM
 */
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

<section class="banner_course">
    <div class="banner_section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h1 class="text-center" style="font-size: 48px; font-weight: 600; margin-top: 150px; color: white">Course Code</h1>
                    <p class="text-center" style="font-size: 20px; color: white">Home <i class="fa fa-arrow-right"></i> Courses</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="course" style="background-color: white">
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto mt-2 mb-5">
                <div class="card mt-5 mb-4">
                    <div class="card-body">
                        <?php
                        if (isset($_GET['last_id']))
                        {
                            $last_id = $_GET['last_id'];

                            $get_code = $connect->query("SELECT * FROM enroll_course WHERE enroll_id = '$last_id'");

                            $code = mysqli_fetch_assoc($get_code);
                        }
                        ?>
                            <?php
                            if(isset($_SESSION['success'])){
                                echo "
                                    <div class='alert alert-success alert-dismissible'>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        <h6><i class='icon fa fa-check'></i> Success!</h6>".$_SESSION['success']."
                                    </div>
                                ";
                                unset($_SESSION['success']);
                            }
                        ?>

                        <h5 class="display-3 text-black text-center">Thank you!</h5>
                        <h4 class="text-center p-5">Your 6 Digit Course Code IS: <span class="text-info"><?php echo $code['course_code'];?></span></h4>
                        <p class="float-right text-danger font-weight-bold">[ N.B: Please Don't Forget Your Course Code ]</p>
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



