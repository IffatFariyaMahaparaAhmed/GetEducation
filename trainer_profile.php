<?php

?>
<?php

?>
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
                    <?php
                        if ($_GET['user']){
                            $id = $_GET['user'];

                            $sql = $connect->query("SELECT * FROM users WHERE user_id = '$id'");

                            $data = mysqli_fetch_assoc($sql);
                        }
                    ?>
                    <h1 class="text-center text-capitalize" style="font-size: 48px; font-weight: 600; margin-top: 150px; color: white"><?php echo $data['first_name'].' '.$data['last_name'];?> Profile</h1>
                    <p class="text-center" style="font-size: 20px; color: white">Home <i class="fa fa-arrow-right"></i> Trainer Profile</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="trainer" style="background-color: whitesmoke">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 mt-5 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-uppercase text-info"><?php echo $data['first_name'];?> <?php echo $data['last_name'];?> <span class="text-dark text-capitalize"> Profile</span> </h4>
                        </div>
                        <div class="card-body">
                            <div class="col-md-4 col-sm-12 float-left">
                                <img src="images/<?php echo $data['image'];?>" style="height: 344px; width: 100%">
                            </div>
                            <div class="col-md-8 col-sm-12 float-left">
                                <div class="table-responsive">
                                    <table class="table table-bordered" style="background-color: blue; color: white">
                                        <tr>
                                            <td class="text-center"> Name</td>
                                            <td class="text-center text-capitalize" style="background-color: white; color: black; border: 1px solid black; border-left: none"><?php echo $data['first_name']?> <?php echo $data['last_name']?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"> Email</td>
                                            <td class="text-center" style="background-color: white; color: black; border: 1px solid black; border-left: none"><?php echo $data['email']?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"> Phone</td>
                                            <td class="text-center" style="background-color: white; color: black; border: 1px solid black; border-left: none"><?php echo $data['phone']?></td>

                                        </tr>
                                        <tr>
                                            <td class="text-center"> Address</td>
                                            <td class="text-center" style="background-color: white; color: black; border: 1px solid black; border-left: none"><?php echo $data['address']?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">Gender </td>
                                            <td class="text-center" style="background-color: white; color: black; border: 1px solid black; border-left: none"><?php echo $data['gender']?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">Date Of Birth </td>
                                            <td class="text-center" style="background-color: white; color: black; border: 1px solid black; border-left: none"><?php echo date('d-M-Y', strtotime($data['date_of_birth']))?></td>
                                        </tr>

                                        <tr>
                                            <td class="text-center">Current Institute </td>
                                            <td class="text-center" style="background-color: white; color: black; border: 1px solid black; border-left: none"><?php echo $data['institute']?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">Join Date </td>
                                            <td class="text-center" style="background-color: white; color: black; border: 1px solid black; border-left: none"><?php echo date('d-M-Y', strtotime($data['join_date']))?></td>
                                        </tr>

                                        <tr>
                                            <td class="text-center">Course Taken </td>
                                            <td class="text-center" style="background-color: white; color: black; border: 1px solid black; border-left: none">
                                                <?php
                                                  $course_taken = $connect->query("SELECT * FROM users, courses WHERE courses.user_id = users.user_id AND users.user_id = '$id'");

                                                  while ($course = mysqli_fetch_assoc($course_taken)){?>
                                                      <span><?php echo $course['course_name'].',';?></span>
                                                <?php }
                                                ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
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


