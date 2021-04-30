<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 4/9/2021
 * Time: 12:35 PM
 */

    require_once '../php/db_connect.php';

    if (isset($_GET['status'])){
        $status1 = $_GET['status']; // decleare variable

        $sql = "SELECT * FROM success_story WHERE success_story_id='$status1'"; // select all students

        $result = mysqli_query($connect, $sql);

        while ($row = mysqli_fetch_object($result)){
            $status_var = $row->post_status;

            if ($status_var == '0'){
                $status_state = 1;
            }else{
                $status_state = 0;
            }
            $update = "UPDATE success_story SET post_status = '$status_state' WHERE success_story_id = '$status1'";

            $res = mysqli_query($connect, $update);

            if ($res){
                header('Location: manage_story.php');
            }else{
                echo  mysqli_error($res);
            }
        }
    }

?>
