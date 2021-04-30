<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 4/7/2021
 * Time: 2:44 PM
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
    <link href="tutor/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link href="jquery-bar-rating-master/dist/themes/fontawesome-stars.css" rel="stylesheet" type='text/css'>
    <link href="jquery-bar-rating-master/dist/themes/fontawesome-stars.css" rel="stylesheet" type='text/css'>
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
                            if (isset($_GET['course'])){
                                $course_id = $_GET['course'];

                                $courses = $connect->query("SELECT * FROM courses, users WHERE courses.user_id = users.user_id AND courses.course_id = '$course_id'");
                                $course = mysqli_fetch_assoc($courses);
                            }
                        ?>
                        <h1 class="text-center" style="font-size: 48px; font-weight: 600; margin-top: 150px; color: white"><?php echo $course['course_name'];?></h1>
                        <p class="text-center" style="font-size: 20px; color: white">Home <i class="fa fa-arrow-right"></i> Courses</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="course" style="background-color: white">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-sm-12 float-left">
                    <div class="card mt-5 mb-5">
                        <img src="images/<?php echo $course['course_image'];?>" class="card-img-top" style="height: 300px; width: 100%">
                    </div>

                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true" style="background-color: honeydew"><span class="ml-3 text-dark font-weight-bold">Description </span> </a>
                            <a class="nav-item nav-link" id="nav-file-tab" data-toggle="tab" href="#nav-file" role="tab" aria-controls="nav-file" aria-selected="false" style="background-color: floralwhite"> <span class="ml-3 text-dark font-weight-bold">  File</span></a>
                            <a class="nav-item nav-link" id="nav-video-tab" data-toggle="tab" href="#nav-video" role="tab" aria-controls="nav-video" aria-selected="false" style="background-color: floralwhite"> <span class="ml-3 text-dark font-weight-bold">  Video</span></a>
                            <a class="nav-item nav-link" id="nav-rate-tab" data-toggle="tab" href="#nav-rate" role="tab" aria-controls="nav-rate" aria-selected="false" style="background-color: floralwhite"> <span class="ml-3 text-dark font-weight-bold">  Rating</span></a>
                        </div>
                    </nav>
                    <div class="tab-content mb-5" id="nav-tabContent" style="box-shadow:  0px 0px 14px #888888;">

                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="card-body" style="background-color: honeydew">
                                <p class="text-justify">
                                    <?php echo $course['course_description'];?>
                                </p>
                            </div>
                        </div>


                        <div class="tab-pane fade" id="nav-file" role="tabpanel" aria-labelledby="nav-file-tab">
                            <div id="accordion">
                                <?php
                                if ($course['course_status'] == '1')
                                {?>
                                    <?php
                                    $get_file = $connect->query("SELECT * FROM course_files WHERE course_id = '$course_id'");

                                    $i = 1;
                                    while ($files = mysqli_fetch_assoc($get_file)){?>
                                        <div class="card">
                                            <div class="card-header" id="heading<?php echo $files['course_file_id']?>">
                                                <h5 class="mb-0 ">
                                                    <button class="btn btn-link text-decoration-none" data-toggle="collapse" data-target="#collapse<?php echo $files['course_file_id']?>" aria-expanded="true" aria-controls="collapseOne">
                                                        <span class="float-left"><?php echo $i++;?>. <?php echo $files['title']?></span>
                                                    </button>
                                                    <button class="btn btn-link text-decoration-none float-right" data-toggle="collapse" data-target="#collapse<?php echo $files['course_file_id']?>" aria-expanded="true" aria-controls="collapseOne">
                                                        <i class="fa fa-arrow-circle-down float-right"></i>
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="collapse<?php echo $files['course_file_id']?>" class="collapse" aria-labelledby="heading<?php echo $files['course_file_id']?>" data-parent="#accordion">
                                                <div class="card-body text-center">
                                                    <i class="fa fa-download text-info"></i> <a class="text-decoration-none" href=""><?php echo $files['filename']?> </a> <sup class="text-danger font-weight-bold">Buy First</sup>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }?>
                                <?php } else{?>
                                    <?php
                                    $get_file = $connect->query("SELECT * FROM course_files WHERE course_id = '$course_id'");

                                    $i = 1;
                                    while ($files = mysqli_fetch_assoc($get_file)){?>
                                        <div class="card">
                                            <div class="card-header" id="heading<?php echo $files['course_file_id']?>">
                                                <h5 class="mb-0 ">
                                                    <button class="btn btn-link text-decoration-none" data-toggle="collapse" data-target="#collapse<?php echo $files['course_file_id']?>" aria-expanded="true" aria-controls="collapseOne">
                                                        <span class="float-left"><?php echo $i++;?>. <?php echo $files['title']?></span>
                                                    </button>
                                                    <button class="btn btn-link text-decoration-none float-right" data-toggle="collapse" data-target="#collapse<?php echo $files['course_file_id']?>" aria-expanded="true" aria-controls="collapseOne">
                                                        <i class="fa fa-arrow-circle-down float-right"></i>
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="collapse<?php echo $files['course_file_id']?>" class="collapse" aria-labelledby="heading<?php echo $files['course_file_id']?>" data-parent="#accordion">
                                                <div class="card-body text-center">
                                                    <i class="fa fa-download text-info"></i> <a class="text-decoration-none" target="_blank" href="../upload_file/<?php echo $files['filename']?>"><?php echo $files['filename']?> </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }?>
                                <?php }

                                ?>

                            </div>
                        </div>

                        <div class="tab-pane fade" id="nav-video" role="tabpanel" aria-labelledby="nav-video-tab">
                            <div id="accordion_2">

                                <?php
                                if ($course['course_status'] == '1'){?>
                                    <?php
                                    $get_video = $connect->query("SELECT * FROM course_video WHERE course_id = '$course_id'");

                                    $i = 1;
                                    while ($videos = mysqli_fetch_assoc($get_video)){?>
                                        <div class="card">
                                            <div class="card-header" id="heading_vid<?php echo $videos['course_video_id']?>">
                                                <h5 class="mb-0 ">
                                                    <button class="btn btn-link text-decoration-none" data-toggle="collapse" data-target="#collapse_vid<?php echo $videos['course_video_id']?>" aria-expanded="true" aria-controls="collapseTow">
                                                        <span class="float-left"><?php echo $i++;?>. <?php echo $videos['title']?></span>
                                                    </button>
                                                    <button class="btn btn-link text-decoration-none float-right" data-toggle="collapse" data-target="#collapse_vid<?php echo $videos['course_video_id']?>" aria-expanded="true" aria-controls="collapseTow">
                                                        <i class="fa fa-arrow-circle-down float-right"></i>
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="collapse_vid<?php echo $videos['course_video_id']?>" class="collapse" aria-labelledby="heading_vid<?php echo $videos['course_video_id']?>" data-parent="#accordion_2">
                                                <div class="card-body text-center">
                                                    <i class="fa fa-play-circle text-info"></i> <a class="text-decoration-none"><?php echo $videos['name']?> </a><sup class="text-danger font-weight-bold">Buy First</sup>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }  ?>
                                <?php }else{?>
                                    <?php
                                    $get_video = $connect->query("SELECT * FROM course_video WHERE course_id = '$course_id'");

                                    $i = 1;
                                    while ($videos = mysqli_fetch_assoc($get_video)){?>
                                        <div class="card">
                                            <div class="card-header" id="heading_vid<?php echo $videos['course_video_id']?>">
                                                <h5 class="mb-0 ">
                                                    <button class="btn btn-link text-decoration-none" data-toggle="collapse" data-target="#collapse_vid<?php echo $videos['course_video_id']?>" aria-expanded="true" aria-controls="collapseTow">
                                                        <span class="float-left"><?php echo $i++;?>. <?php echo $videos['title']?></span>
                                                    </button>
                                                    <button class="btn btn-link text-decoration-none float-right" data-toggle="collapse" data-target="#collapse_vid<?php echo $videos['course_video_id']?>" aria-expanded="true" aria-controls="collapseTow">
                                                        <i class="fa fa-arrow-circle-down float-right"></i>
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="collapse_vid<?php echo $videos['course_video_id']?>" class="collapse" aria-labelledby="heading_vid<?php echo $videos['course_video_id']?>" data-parent="#accordion_2">
                                                <div class="card-body text-center">
                                                    <i class="fa fa-play-circle text-info"></i> <a class="text-decoration-none" target="_blank" href="<?php echo $videos['location']?>"><?php echo $videos['name']?> </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }?>
                                <?php } ?>
                            </div>
                        </div>


                        <div class="tab-pane fade" id="nav-rate" role="tabpanel" aria-labelledby="nav-rate-tab">
                            <div class="card-body text-center">
                                <?php
                                if (!isset($_SESSION['user'])) {
                                    ?>
                                    <div class="post tece">
                                        <div class="post-action text-center">
                                            <!-- Rating -->
                                            <select class='rating''>
                                            <option value="1" >1</option>
                                            <option value="2" >2</option>
                                            <option value="3" >3</option>
                                            <option value="4" >4</option>
                                            <option value="5" >5</option>
                                            </select>
                                        </div>
                                    </div>
                                    <?php
                                    $query = "SELECT ROUND(AVG(rating),1) as averageRating FROM post_rating WHERE postid=".$course_id;
                                    $avgresult = mysqli_query($connect,$query) or die(mysqli_error());
                                    $fetchAverage = mysqli_fetch_array($avgresult);
                                    $averageRating = $fetchAverage['averageRating'];

                                    $sql2 ="SELECT postid, COUNT(userid) AS USER FROM post_rating WHERE postid =  '$course_id'";
                                    $user = mysqli_query($connect, $sql2);
                                    $get_user = mysqli_fetch_assoc($user);

                                    if($averageRating <= 0){
                                        $averageRating = "No rating yet.";
                                    } ?>
                                    <span class="font-weight-bold text-center" id='avgrating_<?php echo $postid; ?>'><?php echo $averageRating; ?> Based on <?php echo $get_user['USER']?> user</span>
                                    <?php
                                }else{
                                    $sql = "SELECT * FROM users WHERE email = '$_SESSION[user]'";
                                    $res = mysqli_query($connect, $sql);

                                    $user_data = mysqli_fetch_assoc($res);

                                    $userid = $user_data['user_id'];

                                    if (isset($_GET['course'])){
                                        $id = $_GET['course'];

                                        $query = "SELECT * FROM courses WHERE course_id = $course_id";
                                        $result = mysqli_query($connect,$query);

                                        while($row = mysqli_fetch_array($result)){
                                            $postid = $row['course_id'];
//                                                    $title = $row['first_name'];
//                                                    $content = $row['email'];


                                            // User rating
                                            $query = "SELECT * FROM post_rating WHERE postid=".$postid." and userid=".$userid;
                                            $userresult = mysqli_query($connect,$query) or die(mysqli_error());
                                            $fetchRating = mysqli_fetch_array($userresult);

                                            if ($fetchRating !== '0'){
                                            }else{
                                                $rating = $fetchRating['rating'];

                                            }

                                            // get average
                                            $query = "SELECT ROUND(AVG(rating),1) as averageRating FROM post_rating WHERE postid=".$postid;
                                            $avgresult = mysqli_query($connect,$query) or die(mysqli_error());
                                            $fetchAverage = mysqli_fetch_array($avgresult);
                                            $averageRating = $fetchAverage['averageRating'];

                                            $sql2 ="SELECT postid, COUNT(userid) AS USER FROM post_rating WHERE postid = $course_id";
                                            $user = mysqli_query($connect, $sql2);
                                            $get_user = mysqli_fetch_assoc($user);

                                            if($averageRating <= 0){
                                                $averageRating = "No rating yet.";
                                            }
                                            ?>
                                            <div class="post">
                                                <div class="post-action text-center">
                                                    <!-- Rating -->
                                                    <select class='rating' id='rating_<?php echo $postid; ?>' data-id='rating_<?php echo $postid; ?>'>
                                                        <option value="1" >1</option>
                                                        <option value="2" >2</option>
                                                        <option value="3" >3</option>
                                                        <option value="4" >4</option>
                                                        <option value="5" >5</option>
                                                    </select>
                                                    <div style='clear: both;'></div>
                                                    <span class="text-center" id='avgrating_<?php echo $postid; ?>'><?php echo $averageRating; ?> Based On <?php echo $get_user['USER']?> User</span>

                                                    <!-- Set rating -->
                                                    <script type='text/javascript'>
                                                        $(document).ready(function(){
                                                            $('#rating_<?php echo $postid; ?>').barrating('set',<?php echo $rating; ?>);
                                                        });

                                                    </script>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </div>

                        </div>



                    </div>
                </div>
                <div class="col-md-5 col-sm-12 float-left">
                    <h2 class="mt-5">
                        <?php
                            if (isset($_POST['btn_login'])){
                               echo "<span class='text-danger'>Please Login First....!</span>";
                            }
                        ?>
                    </h2>

                    <div class="table-responsive mt-5 mb-5">
                        <table class="table tab-pane table-hover">
                            <tr style="height: 50px; background-color: aliceblue;">
                                <th>Tutor Name </th>
                                <td><span class="float-right text-capitalize text-danger"><?php echo $course['first_name'].' '.$course['last_name'];?></span></td>
                            </tr>

                            <tr style="height: 50px; background-color: aliceblue;">
                                <th style="border-top: 1px solid silver">Course Fee </th>
                                <td style="border-top: 1px solid silver;">
                                    <span class="float-right ">
                                        <?php
                                            if ($course['course_status'] == '1') {

                                                if ($course['course_price'] == true){
                                                    echo number_format($course['course_price'],2).' '.'T.K';
                                                }
                                            }else{
                                                echo "<span class='text-success'>Free Course</span>";
                                            }?>
                                    </span>
                                </td>
                            </tr>

                            <tr style="height: 50px; background-color: aliceblue;">
                                <th style="border-top: 1px solid silver">Total Files </th>
                                <td style="border-top: 1px solid silver"><span class="float-right  text-dark">
                                        <?php
                                            $total_file = $connect->query("SELECT course_id, COUNT(course_id) AS total_file FROM course_files WHERE course_id = '$course[course_id]'");
                                            $total_files = mysqli_fetch_assoc($total_file);

                                            echo $total_files['total_file'].' '.'Files & ';

                                            $total_video = $connect->query("SELECT course_id, COUNT(course_id) AS total_videos FROM course_video WHERE course_id = '$course[course_id]'");
                                            $total_videos = mysqli_fetch_assoc($total_video);

                                            echo $total_videos['total_videos'].' '.'Video Tutorial';
                                        ?>
                                    </span>
                                </td>
                            </tr>

                            <tr style="height: 50px; background-color: aliceblue;">
                                <th style="border-top: 1px solid silver">Rating </th>
                                <td style="border-top: 1px solid silver"><span class="float-right  text-dark">
                                    <?php
                                        $query = "SELECT ROUND(AVG(rating),1) as averageRating FROM post_rating WHERE postid=".$course_id;
                                        $avgresult = mysqli_query($connect,$query) or die(mysqli_error());
                                        $fetchAverage = mysqli_fetch_array($avgresult);
                                        $averageRating = $fetchAverage['averageRating'];

                                        $sql2 ="SELECT postid, COUNT(userid) AS USER FROM post_rating WHERE postid =  '$course_id'";
                                        $user = mysqli_query($connect, $sql2);
                                        $get_user = mysqli_fetch_assoc($user);

                                        if($averageRating <= 0){
                                            $averageRating = "No rating yet.";
                                        }
                                    ?>
                                    <span class="font-weight-bold" id='avgrating_<?php echo $postid; ?>'><?php echo $averageRating; ?> Based on <?php echo $get_user['USER']?> user</span>
                                    </span>
                                </td>
                            </tr>
                        </table>
                        <tr>
                            <td>
                                <?php
                                if (!isset($_SESSION['user']))
                                    {
                                        echo '
                                            <form action="" method="post">
                                               <input type="submit" name="btn_login" class="btn btn-dark btn-block" value=" Enroll Course ">
                                            </form>';
                                    }else{
                                        echo '<a href="enroll_course.php?course_id='.$course_id.'" class="btn btn-dark btn-block">Enroll Course</a>';
                                    }
                                ?>

                            </td>
                        </tr>

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
    <script src="jquery-bar-rating-master/dist/jquery.barrating.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            $('.rating').barrating({
                theme: 'fontawesome-stars',
                onSelect: function(value, text, event) {

                    // Get element id by data-id attribute
                    var el = this;
                    var el_id = el.$elem.data('id');

                    // rating was selected by a user
                    if (typeof(event) !== 'undefined') {

                        var split_id = el_id.split("_");

                        var postid = split_id[1];  // postid

                        // AJAX Request
                        $.ajax({
                            url: 'rating_ajax.php',
                            type: 'post',
                            data: {postid:postid,rating:value},
                            dataType: 'json',
                            success: function(data){
                                // Update average
                                var average = data['averageRating'];
                                $('#avgrating_'+postid).text(average);
                            }
                        });
                    }
                }
            });
        });

    </script>
</body>
</html>

