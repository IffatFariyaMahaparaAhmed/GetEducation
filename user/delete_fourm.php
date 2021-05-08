<?php

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

    //view Success story description
    if (isset($_POST['success_story_id'])){
        $success_id = $_POST['success_story_id'];

        $sql = "SELECT * FROM success_story WHERE success_story_id = $success_id";
        $res = mysqli_query($connect, $sql);

        $row = mysqli_fetch_assoc($res);

        echo json_encode($row);
    }

    //delete forum
    if (isset($_GET['forum'])){
        $forum_id = $_GET['forum'];

        $delete = $connect->query("DELETE FROM discussion_forum WHERE forum_id = $forum_id");

        if ($delete){
            $_SESSION['success'] = 'Delete Success';

            echo "<script>document.location.href='my_post.php'</script>";
        }
    }

    //delete success story
    if (isset($_GET['success'])){
        $susc_id = $_GET['success'];

        $delete = $connect->query("DELETE FROM success_story WHERE success_story_id = $susc_id");

        if ($delete){
            $_SESSION['success'] = 'Delete Success';

            echo "<script>document.location.href='manage_post.php'</script>";
        }
    }