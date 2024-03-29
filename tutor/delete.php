<?php




    session_start();
    require_once '../php/db_connect.php';

    if (!isset($_SESSION['tutor'])){
        header('Location: ../index.php');
    }

    //delete course
    if (isset($_GET['delete_quiz_qsn_id'])){
        $quiz_qsn_id = $_GET['delete_quiz_qsn_id'];
        $qsn_id = $_GET['qsn_id'];
        $deleteQuery = "DELETE FROM `quiz_qsn` WHERE `quiz_qsn_id` = '$quiz_qsn_id'";

        $result_qsn = mysqli_query($connect, $deleteQuery);

        if ($result_qsn) {
            $_SESSION['success'] = 'QuiZ Question Deleted Successful';
            echo "<script>document.location.href='view_qsn.php?qsn=$qsn_id'</script>";
        } else {
            $_SESSION['error'] = 'QuiZ Question delete Failed';

            echo "<script>document.location.href='view_qsn.php?qsn=$qsn_id'</script>";
        }
    }
    if (isset($_GET['course']))
    {
        $course_id = $_GET['course'];

        $delete_course = $connect->query("DELETE FROM courses WHERE course_id = '$course_id'");

        if ($delete_course){
            $_SESSION['success'] = 'Course Delete Successful...!!';
            header('Location: manage-course.php');
        }else{
            $_SESSION['error'] = 'Course Fee Added Failed...!!';
            header('Location: manage-course.php');
        }
    }

    //delete course file
    if (isset($_GET['course_file']))
    {
        $redirect_page = $_SESSION['page_id'];

        $file_id = $_GET['course_file'];

        $delte_file = $connect->query("DELETE FROM course_files WHERE course_file_id = '$file_id'");

        if ($delte_file){
            $_SESSION['success'] = 'Course FIle Delete Successful...!!';
            echo "<script>document.location.href='manage-course-file.php?file=$redirect_page'</script>";
        }else{
            $_SESSION['error'] = 'Course File Delete Failed...!!';
            echo "<script>document.location.href='manage-course-file.php?file=$redirect_page'</script>";
        }
    }

    //delete course video
    if (isset($_GET['course_video']))
    {
        $redirect_page = $_SESSION['page_id'];

        $video_id = $_GET['course_video'];

        $delete_video = $connect->query("DELETE FROM course_video WHERE course_video_id = '$video_id'");

        if ($delete_video){
            $_SESSION['success'] = 'Course Video Delete Successful...!!';
            echo "<script>document.location.href='manage-video.php?video=$redirect_page'</script>";
        }else{
            $_SESSION['error'] = 'Course Video Delete Failed...!!';
            echo "<script>document.location.href='manage-video.php?video=$redirect_page'</script>";
        }
    }

    //delete wuiz
    if (isset($_GET['quiz']))
    {
        $quiz_id = $_GET['quiz'];

        $delete_quiz = $connect->query("DELETE FROM quiz_sub WHERE quiz_id = '$quiz_id'");

        if ($delete_quiz){
            $_SESSION['success'] = 'Quiz Delete Successful...!!';
            echo "<script>document.location.href='manage_quiz.php'</script>";
        }else{
            $_SESSION['error'] = 'Quiz Delete Failed...!!';
            echo "<script>document.location.href='manage_quiz.php'</script>";
        }
    }