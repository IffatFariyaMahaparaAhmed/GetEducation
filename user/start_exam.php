<?php

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
                <li class="breadcrumb-item active">Start Your Quiz Exam</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 col-sm-12 mt-2 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <?php
                                if (isset($_GET['qsn_id']))
                                {
                                    $id  = $_GET['qsn_id'];

                                    $get_sub_name = $connect->query("SELECT * FROM quiz_qsn, quiz_sub, courses WHERE quiz_qsn.qsn_id = quiz_sub.quiz_id AND quiz_sub.course_id = courses.course_id AND quiz_qsn.qsn_id = '$id'");
                                    $sub_name = mysqli_fetch_assoc($get_sub_name);
                                }
                            ?>
                            <h3><?php echo $sub_name['course_name'];?> Quiz</h3>
                        </div>
                        <div class="card-body">
                            <?php
                            //exam
                            if (isset($_POST['exam_submit'])){

                                foreach ($_POST['ans'] as $ans_id => $qsn) {

                                    $subject_id  = $_POST['subject_id'] [$ans_id];
                                    $student_id  = $_POST['student_id'] [$ans_id];
                                    $qsn_id      = $_POST['qsn_id'] [$ans_id];
                                    $ans         = $_POST['ans'] [$ans_id];

                                    $sql_exam = "INSERT INTO user_ans (subject_id, student_id, qsn_id, ans) VALUES ('$subject_id', '$student_id', '$qsn_id', '$ans')";
                                    $exam_res = mysqli_query($connect, $sql_exam);

                                    if ($exam_res) {
                                        $_SESSION['success'] = 'Successful';

                                        echo "<script>document.location.href='result.php?result=$id'</script>";
                                    } else {
                                        $_SESSION['error'] = 'Failed';

                                        echo "<script>document.location.href='result.php?result=$id'</script>";
                                    }

                                }
                            }

                            ?>
                            <form action="" method="post" class="ml-4">
                                <?php
//                                echo $_SESSION['qsn_id'];
                                ?>
                                <?php $i =1;
                                $get_qsn = $connect->query("SELECT * FROM quiz_qsn, quiz_sub, courses WHERE quiz_qsn.qsn_id = quiz_sub.quiz_id AND quiz_sub.course_id = courses.course_id AND quiz_qsn.qsn_id = '$id'");

                                while ($data = mysqli_fetch_assoc($get_qsn)){?>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Question <?php echo $i++;?>: <?php echo $data['qsn'];?> </label>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" hidden name="subject_id[]" value="<?php echo $data['qsn_id'];?>">
                                        <input type="text" hidden name="student_id[]" value="<?php echo $user_data['user_id'];?>">
                                        <input type="text" hidden name="qsn_id[]" value="<?php echo $data['quiz_qsn_id'];?>">

                                       A) <input type="checkbox" name="ans[]" value="<?php echo $data['option_one']?>"> <?php echo $data['option_one']?> <br/>
                                       B) <input type="checkbox" name="ans[]" value="<?php echo $data['option_tow']?>"> <?php echo $data['option_tow']?> <br/>
                                       C) <input type="checkbox" name="ans[]" value="<?php echo $data['option_three']?>"> <?php echo $data['option_three']?> <br/>
                                       D) <input type="checkbox" name="ans[]" value="<?php echo $data['option_four']?>"> <?php echo $data['option_four']?>
                                    </div>
                                <?php }?>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-success" name="exam_submit" value="Submit">
                                </div>
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

