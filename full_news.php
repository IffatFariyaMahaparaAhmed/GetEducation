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

<section class="fourm">
    <div class="forum_section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h1 class="text-center" style="font-size: 48px; font-weight: 600; margin-top: 150px; color: white">News</h1>
                    <p class="text-center" style="font-size: 20px; color: white">Home <i class="fa fa-arrow-right"></i>News</p>
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
                        <div class="card-header">
                            <?php
                            if ($_GET['news']){
                                $id = $_GET['news'];

                                $sql = $connect->query("SELECT * FROM news WHERE news_id = '$id'");

                                $data = mysqli_fetch_assoc($sql);
                            }
                            ?>
                            <img src="images/<?php echo $data['image'];?>" class="card-img-top" style="height: 300px; width: 100%">
                        </div>
                        <div class="card-body">
                            <h3><?php echo $data['title'];?></h3>
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
                            //get all news
                            $all_blog = $connect->query("SELECT * FROM news LIMIT 5");
                            ?>
                        </div>
                        <?php
                        while ($row = mysqli_fetch_assoc($all_blog)){?>
                            <div class="card-body" style="border-bottom: 1px solid silver">
                                <p style="text-align: justify; padding: 3px; margin-top: -40p%">
                                    <span class="font-weight-bold"><?php echo $row['title']?></span><br/>
                                    <span style="font-size: 12px; color: darkred;">Posted On <?php echo date('M, d, Y', strtotime($row['post_date']))?></span><br/>
                                    <?php
                                    $forum_id = $row['news_id'];
                                    $desc = $row['description'];
                                    $strcut = substr($desc,0,200); // after 430 word full content will not seen
                                    $desc = substr($strcut, 0, strrpos($strcut, ' ')).'....'.'<a href="full_news.php?news='.$forum_id.'" class="text-decoration-none">Read More</a>';
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






