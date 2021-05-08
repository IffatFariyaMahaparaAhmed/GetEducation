<?php


require_once '../php/db_connect.php';

if (isset($_GET['status'])){
    $status1 = $_GET['status']; // decleare variable

    $sql = "SELECT * FROM quiz_sub WHERE quiz_id='$status1'"; // select all quiz

    $result = mysqli_query($connect, $sql);

    while ($row = mysqli_fetch_object($result)){
        $status_var = $row->status;

        if ($status_var == '0'){
            $status_state = 1;
        }else{
            $status_state = 0;
        }
        $update = "UPDATE quiz_sub SET status = '$status_state' WHERE quiz_id = '$status1'";

        $res = mysqli_query($connect, $update);

        if ($res){
            header('Location: manage_quiz.php');
        }else{
            echo  mysqli_error($res);
        }
    }
}

?>
