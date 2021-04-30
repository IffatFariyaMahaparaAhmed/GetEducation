<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 4/4/2021
 * Time: 11:07 PM
 */

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

    <section class="slider">
        <div class="slide_section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="col-md-7 col-sm-12 float-left">
                            <h2 class="text-white font-weight-bold font-italic d-none d-lg-block" style="font-size: 70px; font-weight: 700; text-shadow: 5px 5px 3px #000; margin-top:150px"><span style="color:yellow;">Get</span> <br/>
                                <span style="margin-left: 42px; color: red;">Education</span>
                            </h2>
                        </div>
                        <div class="col-md-5 col-sm-12 float-left " style="margin-top: 50px">
                            <div class="card mb-5 mt-5" style="border-color: #040507;">
                                <div class="card-header" style="background-color: green">
                                    <h5 class="text-capitalize text-white text-center">Contact With us</h5>
                                </div>
                                <div class="card-body" style="background-color: #040507">
                                    <?php
                                    if (isset($_POST['btn']))
                                    {
                                        $name    = $_POST['name'];
                                        $phone   = $_POST['phone'];
                                        $email   = $_POST['email'];
                                        $message = $_POST['message'];


                                        if ($name && $phone && $email && $message)
                                        {
                                            $date = date('Y-m-d');
                                            $sql_msg = "INSERT INTO public_msg (name, phone, email, message, date) VALUES ('$name', '$phone', '$email', '$message', '$date')";
                                            $res_msg = mysqli_query($connect, $sql_msg);

                                            echo "<span class='text-white'>Message Sent Successful</span>";
                                        }
                                    }
                                    ?>
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name" placeholder="Enter Full Name" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="phone" placeholder="Enter Your Phone Number" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" placeholder="Write Your Message" name="message" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-success float-right" name="btn" value="Send Now">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="course" style="background-color: #d4edda">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h5 class="text-center mt-4" style="font-size: 40px">Our Popular Courses</h5>

                    <?php

                        $get_course = "SELECT * FROM courses LIMIT 6"; // fetch all courses
                        $res_course = mysqli_query($connect, $get_course); // connect with query and database

                        while ($course = mysqli_fetch_assoc($res_course)){?>
                            <div class="col-md-4 col-sm-12 mt-4 mb-5 float-left">
                                <div class="card box">
                                    <div class="image-box">
                                        <img src="images/<?php echo $course['course_image'];?>">
                                    </div>
                                    <div class="card-body">
                                        <p class="font-weight-bold"><?php echo $course['course_name'];?></p>
                                        <label>Course Price :
                                            <span class="ml-3">
                                               <?php
                                               if ($course['course_status'] == '1') {

                                                   if ($course['course_price'] == true){
                                                       echo number_format($course['course_price'],2).' '.'T.K';
                                                   }
                                               }else{
                                                   echo "<span class='text-success'>Free Course</span>";
                                               }
                                               ?>
                                            </span>
                                        </label><br/>
                                        <div class="text-justify">
                                            <?php
                                            $course_id = $course['course_id'];
                                            $desc = $course['course_description'];
                                            $strcut = substr($desc,0,150);
                                            $desc = substr($strcut, 0, strrpos($strcut, ' ')).'....'.'<a href="course_dtls.php?course='.$course_id.'" class="text-decoration-none">Read More</a>';
                                            echo $desc;
                                            ?>
                                        </div>
                                        <br/>
                                        <div class="text-center">
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>

                                            <br/>
                                            <label>
                                                <?php
                                                // get average
                                                    $query = "SELECT ROUND(AVG(rating),1) as averageRating FROM post_rating WHERE postid='$course[course_id]'";
                                                    $avgresult = mysqli_query($connect,$query) or die(mysqli_error());
                                                    $fetchAverage = mysqli_fetch_array($avgresult);
                                                    $averageRating = $fetchAverage['averageRating'];

                                                    $sql2 ="SELECT postid, COUNT(userid) AS USER FROM post_rating WHERE postid =  '$course[course_id]'";
                                                    $user = mysqli_query($connect, $sql2);
                                                    $get_user = mysqli_fetch_assoc($user);

                                                    if($averageRating <= 0){
                                                        $averageRating = "No rating yet.";
                                                 }
                                                ?>
                                                <span class="font-weight-bold " id='avgrating_<?php echo $postid; ?>'><?php echo $averageRating; ?> Based on <?php echo $get_user['USER']?> user</span>
                                            </label>
                                            <br/>
                                            <label>
                                                <a href="course_dtls.php?course=<?php echo $course['course_id'];?>" class="btn btn-info  mt-2">View More</a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    ?>
                </div>
                <div class="col-md-12 col-sm-12 mb-5">
                    <div class="text-center">
                        <a href="course.php" class="btn btn-primary">View All Courses</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="trainer" style="background-color: #fcf8e3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h3 class="text-center mt-5 mb-5">Our Trainers</h3>

                    <?php
                        $get_tutor = $connect->query("SELECT * FROM users WHERE  role = 'tutor' AND approve = '0' LIMIT 6");

                    while ($tutor = mysqli_fetch_assoc($get_tutor)){?>

                        <div class="col-md-3 col-sm-12 float-left mt-3 mb-5">
                            <div class="card box">
                                <div class="image-box">
                                    <img src="images/<?php echo $tutor['image'];?>">
                                </div>
                                <div class="card-body">
                                    <h5 class="text-center text-capitalize"><a href="trainer.php?user=<?php echo $tutor['user_id'];?>"><?php echo $tutor['first_name'].' '.$tutor['last_name'];?></a></h5>
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
