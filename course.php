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
                    <h1 class="text-center" style="font-size: 48px; font-weight: 600; margin-top: 150px; color: white">Popular Courses</h1>
                    <p class="text-center" style="font-size: 20px; color: white">Home <i class="fa fa-arrow-right"></i> Courses</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="course" style="background-color: white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <h5 class="text-center mt-4" style="font-size: 40px">Our Popular Courses</h5>
                <div class="mt-5 mb-4">
                    <?php
                    if (isset($_POST['search']))
                    {
                        $searchKey = $_POST['src'];
                        $sql_s = $connect->query( "SELECT * FROM courses, users WHERE  (course_name LIKE '%".$searchKey."%') AND courses.user_id = users.user_id ORDER BY course_name ASC");

                        $rows = $sql_s->num_rows;

                    }
                    ?>
                    <form action="" method="post">
                        <div class="form-group input-group col-md-6 col-sm-12 float-right">
                            <input type="text" name="src" placeholder="Search Course Here..." class="form-control" REQUIRED value="<?php if ($_POST){
                                echo $_POST['src'];} ?>">
                            <button type="submit" name="search" class="btn btn-success"><i class="fa fa-search"></i> Search Course</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-12 col-sm-12">

                <?php
                    if (isset($_POST['search'])== true) {
                        if ($rows > 0) {
                            while ($course_search = mysqli_fetch_assoc($sql_s)) {
                                ?>
                                <div class="col-md-4 col-sm-12 mt-4 mb-5 float-left">
                                    <div class="card box">
                                        <div class="image-box">
                                            <img src="images/<?php echo $course_search['course_image']; ?>">
                                        </div>
                                        <div class="card-body">
                                            <p class="font-weight-bold"><?php echo $course_search['course_name']; ?></p>
                                            <label>Course Price :
                                                <span class="ml-3">
                                               <?php
                                               if ($course_search['course_status'] == '1') {

                                                   if ($course_search['course_price'] == true) {
                                                       echo number_format($course_search['course_price'], 2) . ' ' . 'T.K';
                                                   }
                                               } else {
                                                   echo "<span class='text-success'>Free Course</span>";
                                               }
                                               ?>
                                            </span>
                                            </label><br/>
                                            <div class="text-justify">
                                                <?php
                                                $course_id = $course_search['course_id'];
                                                $desc = $course_search['course_description'];
                                                $strcut = substr($desc, 0, 150);
                                                $desc = substr($strcut, 0, strrpos($strcut, ' ')) . '....' . '<a href="course_dtls.php?course=' . $course_id . '" class="text-decoration-none">Read More</a>';
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
                                                    $query = "SELECT ROUND(AVG(rating),1) as averageRating FROM post_rating WHERE postid='$course_search[course_id]'";
                                                    $avgresult = mysqli_query($connect, $query) or die(mysqli_error());
                                                    $fetchAverage = mysqli_fetch_array($avgresult);
                                                    $averageRating = $fetchAverage['averageRating'];

                                                    $sql2 = "SELECT postid, COUNT(userid) AS USER FROM post_rating WHERE postid =  '$course_search[course_id]'";
                                                    $user = mysqli_query($connect, $sql2);
                                                    $get_user = mysqli_fetch_assoc($user);

                                                    if ($averageRating <= 0) {
                                                        $averageRating = "No rating yet.";
                                                    }
                                                    ?>
                                                    <span class="font-weight-bold "
                                                          id='avgrating_<?php echo $postid; ?>'><?php echo $averageRating; ?>
                                                        Based on <?php echo $get_user['USER'] ?> user</span>
                                                </label>
                                                <br/>
                                                <label>
                                                    <a href="course_dtls.php?course=<?php echo $course_search['course_id']?>" class="btn btn-info  mt-2">View More</a>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        } else {
                            echo "<span class='text-danger font-weight-bold p-4'>Course Not Found....Try Agin...!</span>";
                        }
                    }else{
                        $get_course = "SELECT * FROM courses"; // fetch all courses
                        $res_course = mysqli_query($connect, $get_course); // connect with query and database


                      while ($course = mysqli_fetch_assoc($res_course)){?>
                          <div class="col-md-4 col-sm-12 mt-4 mb-5 float-left">
                              <div class="card box" >
                                  <div class="image-box">
                                      <img src="images/<?php echo $course['course_image']; ?>">
                                  </div>
                                  <div class="card-body" style="height: 350px">
                                      <p class="font-weight-bold"><?php echo $course['course_name']; ?></p>
                                      <label>Course Price :
                                          <span class="ml-3">
                                               <?php
                                               if ($course['course_status'] == '1') {

                                                   if ($course['course_price'] == true) {
                                                       echo number_format($course['course_price'], 2) . ' ' . 'T.K';
                                                   }
                                               } else {
                                                   echo "<span class='text-success'>Free Course</span>";
                                               }
                                               ?>
                                            </span>
                                      </label><br/>
                                      <div class="text-justify">
                                          <?php
                                          $course_id = $course['course_id'];
                                          $desc = $course['course_description'];
                                          $strcut = substr($desc, 0, 150);
                                          $desc = substr($strcut, 0, strrpos($strcut, ' ')) . '....' . '<a href="course_dtls.php?course=' . $course_id . '" class="text-decoration-none">Read More</a>';
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
                                              $avgresult = mysqli_query($connect, $query) or die(mysqli_error());
                                              $fetchAverage = mysqli_fetch_array($avgresult);
                                              $averageRating = $fetchAverage['averageRating'];

                                              $sql2 = "SELECT postid, COUNT(userid) AS USER FROM post_rating WHERE postid =  '$course[course_id]'";
                                              $user = mysqli_query($connect, $sql2);
                                              $get_user = mysqli_fetch_assoc($user);

                                              if ($averageRating <= 0) {
                                                  $averageRating = "No rating yet.";
                                              }
                                              ?>
                                              <span class="font-weight-bold "
                                                    id='avgrating_<?php echo $postid; ?>'><?php echo $averageRating; ?>
                                                  Based on <?php echo $get_user['USER'] ?> user</span>
                                          </label>
                                          <br/>
                                          <label>
                                              <a href="course_dtls.php?course=<?php echo $course['course_id']?>" class="btn btn-info  mt-2">View More</a>
                                          </label>
                                      </div>
                                  </div>
                              </div>
                          </div>
                        <?php  }
                    }
                ?>
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

