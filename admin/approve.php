<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 3/29/2021
 * Time: 5:45 PM
 */

require_once '../php/db_connect.php';

if (isset($_GET['status'])){
    $status1 = $_GET['status']; // decleare variable

    $sql = "SELECT * FROM users WHERE user_id='$status1'"; // select all students

    $result = mysqli_query($connect, $sql);

    while ($row = mysqli_fetch_object($result)){
        $status_var = $row->approve;

        if ($status_var == '0'){
            $status_state = 1;
        }else{
            $status_state = 0;
        }
        $update = "UPDATE users SET approve = '$status_state' WHERE user_id = '$status1'";

        $res = mysqli_query($connect, $update);

        if ($res){
            header('Location: manage-tutor.php');
        }else{
            echo  mysqli_error($res);
        }
    }
}

?>
