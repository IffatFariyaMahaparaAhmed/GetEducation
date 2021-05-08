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
                    <h1 class="text-center" style="font-size: 48px; font-weight: 600; margin-top: 150px; color: white">Discussion Forum</h1>
                    <p class="text-center" style="font-size: 20px; color: white">Home <i class="fa fa-arrow-right"></i> Discussion Forum</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="course" style="background-color: white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <h3 class="text-center mt-5 mb-5">Discussion Forum</h3>

                <?php
                //get all forum data
                 $sql = "SELECT * FROM users, discussion_forum WHERE discussion_forum.post_by = users.user_id AND discussion_forum.status = '0'";
                 $res = mysqli_query($connect, $sql);

                while ($row = mysqli_fetch_assoc($res)){?>
                    <div class="col-md-6 col-sm-12 mt-5 mb-5 float-left">
                        <div class="card" style="height: 400px;">
                            <div class="card-body">
                                <h4 class="font-weight-bold"><a href="full_fourm.php?forum=<?php echo $row['forum_id'];?>" class="text-decoration-none"><?php echo $row['title']?></a></h4>
                                <div class="font-italic p-2">
                                    <p class="text-capitalize"><i class="fa fa-user" style="color: blue;"> Post By : </i> <?php echo $row['first_name'].' '.$row['last_name'];?> <span class="float-right" style="color: blue;"><i class="fa fa-calendar"></i> Post Date: <span class="text-dark"><?php echo @date('d-M-Y', strtotime($row['post_date']))?></span></span></p>
                                </div>

                                <div class="p-2">
                                    <p class="text-justify">
                                        <?php
                                        $forum_id = $row['forum_id'];
                                        $desc = $row['description'];
                                        $strcut = substr($desc,0,400);
                                        $desc = substr($strcut, 0, strrpos($strcut, ' ')).'....'.'<a href="full_fourm.php?forum='.$forum_id.'" class="text-decoration-none">Read More</a>';
                                        echo $desc;
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <div class="card-footer">
                                <?php
                                //check user login or not and get total like
                                if (!isset($_SESSION['user'])){
                                    echo "<a href='user/like_unlike.php?like=$row[forum_id]'><button type='button'  name='like' class='btn btn-success btn-sm'><i class='fas fa-thumbs-up'></i></button></a>";
                                    $sql_like_1 = "SELECT like_unlike, SUM(like_unlike) as TotaLike_1 FROM fourm_like_unlike WHERE fourm_like_unlike.fourm_id = $row[forum_id]";
                                    $res_like_1 = mysqli_query($connect, $sql_like_1);

                                    $totla_like_1 = mysqli_fetch_assoc($res_like_1);

                                    if ($totla_like_1['TotaLike_1'] == 0) {
                                        echo "<span> 0 Like</span>";
                                    } else {
                                        echo "<span> $totla_like_1[TotaLike_1] Like</span>";
                                    }

                                }else {
                                    //get total like
                                    $sql = "SELECT * FROM users WHERE email = '$_SESSION[user]'";
                                    $res = mysqli_query($connect, $sql);

                                    $user_data = mysqli_fetch_assoc($res);

                                    $like_unlike = "SELECT * FROM fourm_like_unlike, users, discussion_forum WHERE 
                                                                fourm_like_unlike.fourm_id = '$row[forum_id]' AND 
                                                                fourm_like_unlike.user_id = $user_data[user_id]";

                                    $res_like_unlike = mysqli_query($connect, $like_unlike);

                                    $count = mysqli_fetch_assoc($res_like_unlike);

                                    if ($count == true) {
                                        if ($count['like_unlike'] == '0') {
                                            echo "<a href='user/like_unlike.php?unlike_up=$row[forum_id]'><button type='button'  name='like' class='btn btn-success btn-sm'><i class='fas fa-thumbs-up'></i></button></a>";
                                        } else {
                                            echo "<a href='user/like_unlike.php?unlike=$row[forum_id]'><button type='button'  name='like' class='btn btn-success btn-sm'><i class='fas fa-thumbs-down'></i></button></a>";
                                        }
                                    } elseif ($count !== true) {
                                        echo "<a href='user/like_unlike.php?like=$row[forum_id]'><button type='button'  name='like' class='btn btn-success btn-sm'><i class='fas fa-thumbs-up'></i></button></a>";
                                    }


                                    $sql_like = "SELECT like_unlike, SUM(like_unlike) as TotaLike FROM fourm_like_unlike WHERE fourm_like_unlike.fourm_id = $row[forum_id]";
                                    $res_like = mysqli_query($connect, $sql_like);

                                    $totla_like = mysqli_fetch_assoc($res_like);

                                    if ($totla_like['TotaLike'] == 0) {
                                        echo "<span> 0 Like</span>";
                                    } else {
                                        echo "<span> $totla_like[TotaLike] Like</span>";
                                    }

                                }
                                ?>
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




