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

    //delete forum
    if (isset($_GET['forum'])){
        $forum_id = $_GET['forum'];

        $delete = $connect->query("DELETE FROM discussion_forum WHERE forum_id = $forum_id");

        if ($delete){
            $_SESSION['success'] = 'Delete Success';

            echo "<script>document.location.href='my_post.php'</script>";
        }
    }