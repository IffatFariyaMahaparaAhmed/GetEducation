<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 4/6/2021
 * Time: 10:52 PM
 */
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

<section class="course" style="background-color: #F9F9FF">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <h3 class="text-center mt-5 mb-5">Successful Story</h3>

                <?php
                    $sql = $connect->query("SELECT * FROM users, success_story WHERE success_story.user_id = users.user_id AND success_story.post_status = '0'");

                    while ($row = mysqli_fetch_assoc($sql)){?>
                        <div class="col-md-6 col-sm-12 float-left mb-5">
                            <div class="card">
                                <img src="images/<?php echo $row['success_image'];?>" class="card-img-top" style="height: 300px; width: 100%">
                                <div class="card-body">
                                    <h3><a class="link_success" href="full_success.php?success=<?php echo $row['success_story_id'];?>"><?php echo $row['title'];?></a></h3>
                                    <p class="text-justify">
                                        <?php
                                            $succes_id = $row['success_story_id'];
                                            $desc = $row['description'];
                                            $strcut = substr($desc,0,400);
                                            $desc = substr($strcut, 0, strrpos($strcut, ' ')).'....'.'<a href="full_success.php?success='.$succes_id.'" class="text-decoration-none">Read More</a>';
                                            echo $desc;
                                        ?>
                                    </p>
                                </div>
                                <div class="card-footer">
                                    <a class="text-center btn btn-primary float-right" href="full_success.php?success=<?php echo $row['success_story_id'];?>">View More</a>
                                </div>
                            </div>
                        </div>
                <?php }?>
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





