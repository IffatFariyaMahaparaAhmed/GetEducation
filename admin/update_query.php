<?php


    session_start();
    require_once '../php/db_connect.php';

    if (!isset($_SESSION['tutor'])){
        header('Location: ../index.php');
    }

//    course
    if (isset($_POST['course_id'])){
        $course_id   = $_POST['course_id'];

        $sql = "SELECT * FROM courses WHERE course_id = '$course_id'";
        $res = mysqli_query($connect, $sql);

        $m_data = mysqli_fetch_assoc($res);

        echo json_encode($m_data);
    }

    //add course fee
    if (isset($_POST['add_price'])){
        $course_id  = $_POST['course_id'];
        $price       = $_POST['course_price'];

        if ($price){

            $add_price     = "UPDATE courses SET course_price = '$price' WHERE course_id = $course_id";
            $res_add_price = mysqli_query($connect, $add_price);

            $_SESSION['success'] = 'Course Fee Added successfully';

            header('Location: manage-course.php');
        }else{
            $_SESSION['error'] = 'Course Fee Added Failed...!!';

            header('Location: manage-course.php');
        }
    }

    //update course data
    if (isset($_POST['update_course'])){
        $course_id  = $_POST['course_id'];
        $course_name       = $_POST['course_name'];
        $course_status       = $_POST['course_status'];
        $course_price       = $_POST['course_price'];
        $course_image       = $_POST['course_image'];
        $course_description       = $_POST['course_description'];

        if ($course_name){

            if($course_image != null || $course_image != '' ){
                $add_price     = "UPDATE courses SET course_name = '$course_name', 
            course_status = '$course_status', 
            course_price = '$course_price', 
            course_image = '$course_image',
            course_description = '$course_description' WHERE course_id = $course_id";
            }else{
                $add_price     = "UPDATE courses SET course_name = '$course_name', 
                course_price = '$course_price', 
            course_status = '$course_status', 
            course_description = '$course_description' WHERE course_id = $course_id";
            }

            $res_add_price = mysqli_query($connect, $add_price);

            $_SESSION['success'] = 'Course Data Update successfully';

            header('Location: manage-course.php');
        }else{
            $_SESSION['error'] = 'Course Data Update Failed...!!';

            header('Location: manage-course.php');
        }
    }
?>

