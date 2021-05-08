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
                <div class="col-md-12 col-sm-12 mt-5 mb-5">
                    <div class="col-md-8 col-sm-12  float-left">
                        <div class="card">
                            <div class="card-header">
                                <?php
                                if ($_GET['forum']){
                                    $id = $_GET['forum'];

                                    $_SESSION['page'] = $id;

                                    $sql = $connect->query("SELECT * FROM users, discussion_forum WHERE discussion_forum.post_by = users.user_id AND discussion_forum.forum_id = '$id'");

                                    $data = mysqli_fetch_assoc($sql);
                                }
                                ?>
                                <h3><?php echo $data['title'];?></h3>
                            </div>
                            <div class="card-body">
                                <div class="font-italic p-2">
                                    <p class="text-capitalize"><i class="fa fa-user" style="color: blue;"> Post By : </i> <?php echo $data['first_name'].' '.$data['last_name'];?> <span class="float-right" style="color: blue;"><i class="fa fa-calendar"></i> Post Date: <span class="text-dark"><?php echo @date('d-M-Y', strtotime($data['post_date']))?></span></span></p>
                                </div>
                                <hr/>
                                <div class="text-justify" style="line-height: 30px; font-weight: 400">
                                    <p>
                                        <?php echo $data['description'] ?>
                                    </p>
                                </div>
                            </div>
                            <div class="card-footer">
                                <?php
                                //check user login or not and get total like
                                if (!isset($_SESSION['user'])){
                                    echo "<a href='user/like_unlike2.php?like=$data[forum_id]'><button type='button'  name='like' class='btn btn-success btn-sm'><i class='fas fa-thumbs-up'></i></button></a>";
                                    $sql_like_1 = "SELECT like_unlike, SUM(like_unlike) as TotaLike_1 FROM fourm_like_unlike WHERE fourm_like_unlike.fourm_id = $data[forum_id]";
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
                                                                fourm_like_unlike.fourm_id = '$data[forum_id]' AND 
                                                                fourm_like_unlike.user_id = $user_data[user_id]";

                                    $res_like_unlike = mysqli_query($connect, $like_unlike);

                                    $count = mysqli_fetch_assoc($res_like_unlike);

                                    if ($count == true) {
                                        if ($count['like_unlike'] == '0') {
                                            echo "<a href='user/like_unlike2.php?unlike_up=$data[forum_id]'><button type='button'  name='like' class='btn btn-success btn-sm'><i class='fas fa-thumbs-up'></i></button></a>";
                                        } else {
                                            echo "<a href='user/like_unlike2.php?unlike=$data[forum_id]'><button type='button'  name='like' class='btn btn-success btn-sm'><i class='fas fa-thumbs-down'></i></button></a>";
                                        }
                                    } elseif ($count !== true) {
                                        echo "<a href='user/like_unlike2.php?like=$data[forum_id]'><button type='button'  name='like' class='btn btn-success btn-sm'><i class='fas fa-thumbs-up'></i></button></a>";
                                    }


                                    $sql_like = "SELECT like_unlike, SUM(like_unlike) as TotaLike FROM fourm_like_unlike WHERE fourm_like_unlike.fourm_id = $data[forum_id]";
                                    $res_like = mysqli_query($connect, $sql_like);

                                    $totla_like = mysqli_fetch_assoc($res_like);

                                    if ($totla_like['TotaLike'] == 0) {
                                        echo "<span> 0 Like</span>";
                                    } else {
                                        echo "<span> $totla_like[TotaLike] Like</span>";
                                    }

                                }
                                ?>
                                <span class="float-right" style="color: blue;">
                                    <?php
                                    $sql_comment_count = $connect->query("SELECT comment, COUNT(comment) as TotalComment FROM forum_comment WHERE forum_comment.forum_id = '$id'");

                                    $total_comment = mysqli_fetch_assoc($sql_comment_count);

                                    if ($total_comment['TotalComment'] == 0) {
                                        echo "<span> 0 Comment</span>";
                                    } else {
                                        echo "<span> $total_comment[TotalComment] Comment</span>";
                                    }
                                    ?>
                                </span>
                                <hr/>
                                <div class="form-group">
                                    <?php
                                    if (isset($_SESSION['user']) == true){
                                        $sql = $connect->query("SELECT * FROM users WHERE email = '$_SESSION[user]'");

                                        $user = mysqli_fetch_assoc($sql);
                                    }elseif (isset($_SESSION['tutor']) == true){
                                        $sql = $connect->query("SELECT * FROM users WHERE email = '$_SESSION[tutor]'");

                                        $user = mysqli_fetch_assoc($sql);
                                    }elseif (isset($_SESSION['admin']) == true){
                                        $sql = $connect->query("SELECT * FROM users WHERE email = '$_SESSION[admin]'");

                                        $user = mysqli_fetch_assoc($sql);
                                    }else{
                                    }

                                    ?>
                                    <?php
                                    $get_comment = $connect->query("SELECT * FROM users, forum_comment WHERE forum_comment.user_id = users.user_id AND forum_comment.forum_id = '$id'");
                                    while ($blog_comment = mysqli_fetch_assoc($get_comment)){?>
                                        <div class="">
                                            <p><img src="images/<?php echo $blog_comment['image']?>" style="height: 45px; width: 45px; border-radius: 50%"></p>
                                            <div style="padding: 10px;height: auto;background-color: #F0F2F5;width: 90%;border-radius: 10px;margin-left: 56px;margin-top: -54px;font-family: inherit;">
                                                <label class="font-weight-bold text-dark text-capitalize"><?php echo $blog_comment['first_name']?> <?php echo $blog_comment['last_name']?></label>
                                                <p class="text-justify"><?php echo $blog_comment['comment']?></p>
                                            </div>
                                        </div>
                                    <?php }?>
                                    <br/>
                                    <?php
                                    if (isset($_POST['btn_comment'])){
                                        $forum_id = $_POST['forum_id'];
                                        $user_id = $_POST['user_id'];
                                        $comment = $_POST['comment'];

                                        $add_comment = $connect->query("INSERT INTO forum_comment (forum_id, user_id, comment) VALUES ('$forum_id', '$user_id', '$comment')");

                                        echo "<script>document.location.href='full_fourm.php?forum=$id'</script>";
                                    }
                                    ?>
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <input type="text" hidden name="forum_id" value="<?php echo $data['forum_id'];?>">
                                            <input type="text" hidden name="user_id"  value="<?php echo $user['user_id'];?>">
                                            <textarea class="form-control" name="comment" placeholder="Write Your Comment..." style="height: 50px; "></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="btn_comment" class="btn btn-primary float-right mr-3" value="Comment">
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12 float-left mb-5">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="text-center">More Post</h3>
                                <?php
                                $all_blog = $connect->query("SELECT * FROM discussion_forum, users WHERE discussion_forum.post_by = users.user_id ORDER BY discussion_forum.forum_id DESC LIMIT 5");
                                ?>
                            </div>
                            <?php
                            while ($row = mysqli_fetch_assoc($all_blog)){?>
                                <div class="card-body" style="border-bottom: 1px solid silver">
                                    <p style="text-align: justify; padding: 3px; margin-top: -40p%">
                                        <span class="font-weight-bold"><?php echo $row['title']?></span><br/>
                                        <span style="font-size: 12px; color: darkred;">Posted On <?php echo date('M, d, Y', strtotime($row['post_date']))?> By <?php echo $row['first_name']?></span><br/>
                                        <?php
                                        $forum_id = $row['forum_id'];
                                        $desc = $row['description'];
                                        $strcut = substr($desc,0,200); // after 430 word full content will not seen
                                        $desc = substr($strcut, 0, strrpos($strcut, ' ')).'....'.'<a href="full_fourm.php?forum='.$forum_id.'" class="text-decoration-none">Read More</a>';
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





