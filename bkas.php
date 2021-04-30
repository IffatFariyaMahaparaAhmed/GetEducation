<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 4/7/2021
 * Time: 4:30 PM
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


<section class="course" style="background-color: white">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto mt-5 mb-5">
                <div class="card">
                    <div class="card-header">
                        <?php
                            if ($_GET['pay_now']){
                                $course_id = $_GET['pay_now'];

                                $get_course_data = $connect->query("SELECT * FROM courses WHERE course_id = '$course_id'");

                                $data = mysqli_fetch_assoc($get_course_data);
                            }
                            if (isset($_POST['btn']))
                            {
                                $corse    = $_POST['course_id'];
                                $price    = $_POST['payment'];
                                $user_id  = $_POST['user_id'];

                                $code = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0,6);

                                $buy_date = date('Y-m-d');

                                $buy = $connect->query("INSERT INTO enroll_course (course_id, user_id, payment, course_code, buy_date, status) VALUES ('$corse', '$user_id', '$price', '$code', '$buy_date', '1')");

                                $id = mysqli_insert_id($connect);
                                if ($buy)
                                {
                                    $_SESSION['last_id'] = $id;
                                    echo "<script>document.location.href='next_pay.php?last_id=$id'</script>";
                                }else{
                                    echo "Error: ".mysqli_error($connect);
                                }

                            }
                            ?>
                        <img src="images/bkas.png" class="card-img-top" style="height: 100px; width: 100%">
                    </div>
                    <div class="card-body" style="background-color: #E3106D;">
                        <p class="mt-5 text-center text-white">Bkash Check Out</p>
                        <div class="col-md-8 mx-auto">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label class="text-white">Amount</label>
                                    <input type="text" hidden name="user_id" value="<?php echo $user_data['user_id'];?>">
                                    <input type="text" hidden name="course_id" value="<?php echo $data['course_id'];?>">
                                    <input type="text" hidden name="payment" value="<?php echo $data['course_price'];?>">

                                    <input type="text" disabled name="payment" class="form-control" value="<?php echo $data['course_price'];?>">
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



