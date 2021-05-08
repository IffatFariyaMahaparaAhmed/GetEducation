<?php


session_start();
include_once 'php/db_connect.php';
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
                    <h1 class="text-center" style="font-size: 48px; font-weight: 600; margin-top: 150px; color: white">Trainer</h1>
                    <p class="text-center" style="font-size: 20px; color: white">Home <i class="fa fa-arrow-right"></i> Trainer</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="trainer" style="background-color: whitesmoke">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <h3 class="text-center mt-5 mb-5">Our Trainers</h3>

                <?php
                $get_tutor = $connect->query("SELECT * FROM users WHERE  role = 'tutor' AND approve = '0'");

                while ($tutor = mysqli_fetch_assoc($get_tutor)){?>

                    <div class="col-md-3 col-sm-12 float-left mt-3 mb-5">
                        <div class="card box">
                            <div class="image-box">
                                <img src="images/<?php echo $tutor['image'];?>">
                            </div>
                            <div class="card-body">
                                <h5 class="text-center text-capitalize"><a href="trainer_profile.php?user=<?php echo $tutor['user_id'];?>"><?php echo $tutor['first_name'].' '.$tutor['last_name'];?></a></h5>
                            </div>
                        </div>
                    </div>
                <?php }?>
            </div>
            <div class="col-md-12 col-sm-12 mb-5">
                <div class="text-center">
                    <a href="trainer.php" class="btn btn-primary">View All Trainers</a>
                </div>
            </div>
        </div>
    </div>
</section>


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