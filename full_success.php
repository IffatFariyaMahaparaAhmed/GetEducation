<?php

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

<section class="succes">
    <div class="sucess_section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h1 class="text-center" style="font-size: 48px; font-weight: 600; margin-top: 150px; color: white">Success Story</h1>
                    <p class="text-center" style="font-size: 20px; color: white">Home <i class="fa fa-arrow-right"></i> Success Story</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="course" style="background-color: white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 mt-5 mb-5">
                <div class="col-md-8 col-sm-12  float-left">
                    <div class="card">
                            <?php
                            if ($_GET['success']){
                                $id = $_GET['success'];

                                $sql = $connect->query("SELECT * FROM users, success_story WHERE success_story.user_id = users.user_id AND success_story.success_story_id = '$id'");

                                $data = mysqli_fetch_assoc($sql);
                            }
                            ?>
                            <img src="images/<?php echo $data['success_image']?>" style="height: 300px; width: 100%" class="card-img-top">
                        <div class="card-body">
                            <h3><?php echo $data['title'];?></h3>
                            <div class="font-italic p-2">
                                <p class="text-capitalize"><i class="fa fa-user" style="color: blue;"> Post By : </i> <img src="images/<?php echo $data['image'];?>" style="height: 50px; width: 50px; border-radius: 50%"> <?php echo $data['first_name'].' '.$data['last_name'];?> <span class="float-right" style="color: blue;"><i class="fa fa-calendar"></i> Post Date: <span class="text-dark"><?php echo @date('d-M-Y', strtotime($data['post_date']))?></span></span></p>
                            </div>
                            <hr/>
                            <div class="text-justify" style="line-height: 30px; font-weight: 400">
                                <p>
                                    <?php echo $data['description'] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12 float-left mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center">More Post</h3>
                            <?php
                            //get all post
                            $all_blog = $connect->query("SELECT * FROM users, success_story WHERE success_story.user_id = users.user_id AND success_story.post_status = '0' LIMIT 5");
                            ?>
                        </div>
                        <?php
                        while ($row = mysqli_fetch_assoc($all_blog)){?>
                            <div class="card-body" style="border-bottom: 1px solid silver">
                                <img class="float-left" src="images/<?php echo $row['success_image'];?>"  style="height: 100px; width: 100px; margin: 9px">
                                <p style="text-align: justify; padding: 3px; margin-top: -40p%">
                                    <span class="font-weight-bold"><?php echo $row['title'];?></span><br/>
                                    <?php
                                    $blog_id = $row['success_story_id'];
                                    $desc = $row['description'];
                                    $strcut = substr($desc,0,150);
                                    $desc = substr($strcut, 0, strrpos($strcut, ' ')).'....'.'<a href="full_success.php?success='.$blog_id.'" class="text-decoration-none">Read More</a>';
                                    echo $desc;
                                    ?>
                                </p>
                            </div>
                        <?php }?>

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