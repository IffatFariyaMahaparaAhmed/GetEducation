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

    <section class="banner_course">
        <div class="banner_section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <?php
                            if (isset($_GET['course_id']))
                            {
                                $course_id = $_GET['course_id'];

                                $get_course_data = $connect->query("SELECT * FROM courses WHERE course_id = '$course_id'");

                                $data = mysqli_fetch_assoc($get_course_data);
                            }
                        ?>
                        <h1 class="text-center" style="font-size: 48px; font-weight: 600; margin-top: 150px; color: white">Enroll Course</h1>
                        <p class="text-center" style="font-size: 20px; color: white">Home <i class="fa fa-arrow-right"></i> Courses</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="course" style="background-color: white">
        <div class="container">
            <div class="row">
                <div class="col-md-10 mx-auto mt-5 mb-5">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            if (isset($_POST['btn']))
                            {
                                $corse    = $_POST['course_id'];
                                $price    = $_POST['payment'];
                                $user_id  = $_POST['user_id'];

                                $code = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0,6);

                                $buy_date = date('Y-m-d');

                                $sqlCheck = "SELECT * FROM enroll_course, users, courses WHERE enroll_course.user_id = '$user_data[user_id]' AND enroll_course.course_id = '$course_id' ";
                                $result = mysqli_query($connect, $sqlCheck);
                                $count = mysqli_num_rows($result);

                                if ($count > 0){
                                    $_SESSION['exist'] = 'You All ready Buy This Course ';
                                }else{
                                    $buy = $connect->query("INSERT INTO enroll_course (course_id, user_id, payment, course_code, buy_date, status) VALUES ('$corse', '$user_id', '$price', '$code', '$buy_date', '1')");

                                    $id = mysqli_insert_id($connect);
                                    if ($buy)
                                    {
                                        $_SESSION['last_id'] = $id;
                                        $_SESSION['success'] = 'Course Buy Success';
                                        echo "<script>document.location.href='code.php?last_id=$id'</script>";
                                    }else{
                                        echo "Error: ".mysqli_error($connect);
                                    }
                                }

                            }
                            ?>
                            <?php
                            if(isset($_SESSION['exist'])){
                                echo "
                                    <div class='alert alert-danger alert-dismissible' id='login_msg' style='background-color: red; color: white'>
                                          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                          <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['exist']."
                                    </div>
                                 ";
                                unset($_SESSION['exist']);
                            }
                            ?>
                            <form action="" method="post">
                                <div class="form-group col-md-6 float-left">
                                    <label>Name: </label>
                                    <input type="text" hidden name="user_id" value="<?php echo $user_data['user_id'];?>">
                                    <input type="text" hidden name="course_id" value="<?php echo $data['course_id'];?>">
                                    <input type="text" hidden name="payment" value="<?php echo $data['course_price'];?>">

                                    <input type="text" value="<?php echo $user_data['first_name'].' '.$user_data['last_name'];?>" disabled class="form-control text-capitalize">
                                </div>
                                <div class="form-group col-md-6 float-left">
                                    <label>Email: </label>
                                    <input type="text" value="<?php echo $user_data['email'];?>" disabled class="form-control">
                                </div>
                                <div class="form-group col-md-6 float-left">
                                    <label>Course Name: </label>
                                    <input type="text" value="<?php echo $data['course_name'];?>" disabled class="form-control text-capitalize">
                                </div>
                                <div class="form-group col-md-6 float-left">
                                    <label>Course Price: </label>
                                    <input type="text" value="<?php echo number_format($data['course_price'],2);?>" disabled class="form-control text-capitalize">
                                </div>
                                <div class="form-group col-md-6 float-left">
                                    <label></label>
                                    <?php
                                        $sqlCheck = "SELECT * FROM enroll_course, users, courses WHERE enroll_course.user_id = '$user_data[user_id]' AND enroll_course.course_id = '$course_id' ";
                                        $result = mysqli_query($connect, $sqlCheck);
                                        $count = mysqli_num_rows($result);

                                    if ($count > 0){
                                      echo '<a class="btn btn-danger btn-block text-white"> All Ready Enrolled</a>';
                                    }else{
                                        echo '<a target="_blank" href="bkas.php?pay_now='.$data['course_id'].'" class="btn btn-success btn-block"> Enroll Now</a>';
                                    }
                                    ?>
                                </div>
                            </form>
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


