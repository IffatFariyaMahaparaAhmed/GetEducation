<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 3/29/2021
 * Time: 3:51 PM
 */


    session_start();
    require_once '../php/db_connect.php';
    //check user login or not
    if (!isset($_SESSION['tutor'])){
        header('Location: ../login.php');
    }

    //get user data
    $sql = "SELECT * FROM users WHERE email = '$_SESSION[tutor]'";
    $res = mysqli_query($connect, $sql);

    $userdata = mysqli_fetch_assoc($res);

    //check user like or not

    if (isset($_GET['like'])){
        $blog_id = $_GET['like'];

        $user_id = $userdata['user_id'];

        $sql = "SELECT * FROM discussion_forum WHERE forum_id = $blog_id"; // collect blog data
        $res = mysqli_query($connect, $sql);

        $like = "INSERT INTO fourm_like_unlike (user_id, fourm_id, like_unlike) VALUES ('$user_id', '$blog_id', '1')"; //insert like unlike value in database
        $res = mysqli_query($connect, $like);

        header('Location: fourm_page.php');
    }


    //check unlike or not
    if (isset($_GET['unlike'])){
        $blog_id2 = $_GET['unlike'];

        $user_id2 = $userdata['user_id'];

        $sql2 = "SELECT * FROM discussion_forum WHERE forum_id = $blog_id2";
        $res2 = mysqli_query($connect, $sql2);

        $like = "UPDATE fourm_like_unlike SET like_unlike = '0' WHERE fourm_id = '$blog_id2' AND user_id = '$user_id2'"; //update like unlike data
        $res = mysqli_query($connect, $like);

        header('Location: fourm_page.php');
    }

    if (isset($_GET['unlike_up'])){
        $blog_id3 = $_GET['unlike_up'];

        $user_id3 = $userdata['user_id'];

        $sql3 = "SELECT * FROM discussion_forum WHERE forum_id = $blog_id3";
        $res3 = mysqli_query($connect, $sql3);

        $like = "UPDATE fourm_like_unlike SET like_unlike = '1' WHERE fourm_id = '$blog_id3' AND user_id = '$user_id3'"; //update like unlike data
        $res = mysqli_query($connect, $like);

        header('Location: fourm_page.php');
    }


?>