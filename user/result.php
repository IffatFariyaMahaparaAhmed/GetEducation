<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 3/27/2021
 * Time: 11:58 AM
 */
?>

<?php include "front/header.php"; ?>

<body id="page-top">

<?php include "front/nav.php";?>



<div id="wrapper">
    <?php include "front/sidebar.php";?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Your Result</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 col-sm-12 mt-2">
                    <div class="card">
                        <div class="card-header">
                            <h3>Your Result</h3>
                        </div>
                        <div class="card-body text-center">
                            <?php

                            if ($_GET['result']){
                                $qsn = $_GET['result'];

                                $sql = $connect->query("SELECT * FROM user_ans, quiz_qsn WHERE user_ans.qsn_id = quiz_qsn.quiz_qsn_id AND user_ans.student_id = '$user_data[user_id]' AND user_ans.subject_id = '$qsn'");


                                $result = mysqli_fetch_assoc($sql);

//                                $get_ans = $connect->query("SELECT * FROM user_ans WHERE ");
                            }


                            if ($sql == true){
                                $mark = 1;
//                                        for ($mark = 0; $mark<; $mark++){
//                                            echo $mark++;
//                                        }

                            }else{
                                if ($sql == false){
                                    $mark = 0;
                                }
                            }

                            while ($row = mysqli_fetch_assoc($sql)){?>
                                <?php
                                $total = $mark++;
                                ?>
                            <?php }

                            echo '<p class="font-weight-bold text-success">Your Correct Ans IS : '.$total.'</p>';

                            $sql2 = "SELECT COUNT(ans) AS Count FROM user_ans WHERE student_id = '$user_data[user_id]'";
                            $res2 = mysqli_query($connect, $sql2);
                            $row = mysqli_fetch_assoc($res2);
                            ?>

                            <p class="text-danger font-weight-bold">Total Number Of Question's : <?php echo $row['Count'];?></p>

                            <h3 class="text-success"> And Total Mark IS: <?php echo $total;?> Out of <?php echo $row['Count'];?></h3>

                            <?php
                                if (isset($_POST['ans_delete'])) {

                                    $delete = $connect->query("DELETE FROM user_ans WHERE student_id = $user_data[user_id]");

                                    echo "<script>document.location.href='correct_ans.php?correct_ans=$qsn'</script>";
                                }
                            ?>
                            <form action="" method="post">
                                <button name="ans_delete" type="submit" class="btn btn-primary mt-3"> <i class="fa fa-eye"></i> View Correct Answer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <?php include "front/sub_footer.php";?>
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->


<?php include "front/footer.php";?>

</body>
</html>

