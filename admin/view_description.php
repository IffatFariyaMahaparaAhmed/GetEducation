<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 3/30/2021
 * Time: 3:38 PM
 */
    session_start();
    require_once "../php/db_connect.php";

    //view forum description
    if (isset($_POST['forum_id'])){
        $id = $_POST['forum_id'];

        $sql = "SELECT * FROM discussion_forum WHERE forum_id = $id";
        $res = mysqli_query($connect, $sql);

        $row = mysqli_fetch_assoc($res);

        echo json_encode($row);
    }

    //view news description
    if (isset($_POST['news_id'])){
        $news_id = $_POST['news_id'];

        $sql_news = "SELECT * FROM news WHERE news_id = $news_id";
        $res_news = mysqli_query($connect, $sql_news);

        $row = mysqli_fetch_assoc($res_news);

        echo json_encode($row);
    }

    if (isset($_POST['success_story_id'])){
        $id = $_POST['success_story_id'];

        $sql = "SELECT * FROM success_story WHERE success_story_id = $id";
        $res = mysqli_query($connect, $sql);

        $row = mysqli_fetch_assoc($res);

        echo json_encode($row);
    }

    //delete news
    if (isset($_GET['news'])){
        $news_id = $_GET['news'];

        $delete = $connect->query("DELETE FROM news WHERE news_id = $news_id");

        if ($delete){
            $_SESSION['success'] = 'Delete Success';

            echo "<script>document.location.href='manage_news.php'</script>";
        }
    }