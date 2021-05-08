<?php

    session_start();
    require_once '../php/db_connect.php';

    if (!isset($_SESSION['user'])){
        header('Location: ../index.php');
    }

    //active enroll course
    if (isset($_POST['active_course'])) {
        $course_code = $_POST['course_code'];

        $sql = "SELECT * FROM enroll_course WHERE course_code = '$course_code'";

        $result = mysqli_query($connect, $sql);

        if (mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_assoc($result);

            if ($data['course_code'] == $course_code){
                $update = $connect->query("UPDATE enroll_course SET status = '0' WHERE course_code = '$course_code'");

                if ($update){
                    $_SESSION['success'] = 'Course Active Success';
                    echo "<script>document.location.href='my_course.php'</script>";
                }

            }

        }else{
            $_SESSION['error'] = 'Wrong Course Code'.mysqli_error($connect);
            echo "<script>document.location.href='my_course.php'</script>";
        }
    }