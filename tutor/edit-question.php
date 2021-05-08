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
                <li class="breadcrumb-item active">Edit Questions</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-10 mx-auto mt-2 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h3>Edit Question</h3>
                            <?php
                            if (isset($_GET['quiz'])){
                                $id = $_GET['quiz'];

                                //$sql_course = $connect->query("SELECT * FROM quiz_sub WHERE course_id = '$id'");
                                $sql_course = $connect->query("SELECT * FROM `quiz_qsn` WHERE qsn_id = '$id'");

                                $data = mysqli_fetch_all($sql_course);
//                                print_r($data);
                            }
//                            if (isset($_GET['course']))
//                            {
//                                $id = $_GET['course'];
//
//                                $sql_course = $connect->query("SELECT * FROM quiz_sub WHERE course_id = '$id'");
//
//                                $data = mysqli_fetch_assoc($sql_course);
//                            }
                            ?>
                        </div>
                        <div class="card-body">
                            <div>
                                <?php
                                if(isset($_SESSION['error'])){
                                    echo "
                                        <div class='alert alert-danger alert-dismissible'>
                                          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                          <h4><i class='icon fa fa-warning'></i> Error!</h4>
                                          ".$_SESSION['error']."
                                        </div>
                                      ";
                                    unset($_SESSION['error']);
                                }
                                if(isset($_SESSION['success'])){
                                    echo "
                                        <div class='alert alert-success alert-dismissible'>
                                          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                          <h4><i class='icon fa fa-check'></i> Success!</h4>
                                          ".$_SESSION['success']."
                                        </div>
                                      ";
                                    unset($_SESSION['success']);
                                }
                                ?>
                            </div>
                            <!--<form action="" method="post">
                                <div class="form-group">
                                    <label>How Many Question Are You Want To Add</label>
                                    <input type="number" min="1" max="30" name="num" placeholder="Enter Number Of Question You Want To Add..." class="form-control">
                                    <label for="" class="text-sm-right text-muted font-weight-bold">You can add maximum 30 question.</label>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-info" name="submit" value="Submit">
                                </div>
                            </form>-->
                        </div>
                        <div class="card-body">
                            <?php
                            //if (isset($_POST['submit'])){
                            //$num = $_POST['num'];
                            $loopLength = count($data);
                            for ($i=0; $i < $loopLength; $i++){

                            ?>
                            <form action="add_query.php" method="post">
                                <h6 class="">Question <?php echo $i+1;?> :-</h6>
                                <hr style="border: 1px solid black"/>
                                <div class="form-group input-group">
                                    <div class="col-md-2 p-2">
                                        <label>Question: </label>
                                    </div>
                                    <input type="text"  hidden name="quiz_qsn_id[]"  value="<?php echo $data[$i][0];?>" class="form-control">
                                    <input type="text"  hidden name="qsn_id[]"  value="<?php echo $data[$i][1];?>" class="form-control">

                                    <input type="text" name="qsn[]" placeholder="Enter Question" class="form-control"  value="<?php echo $data[$i][2]; ?>">
                                </div>
                                <div class="form-group input-group  p-2">
                                    <div class="col-md-2">
                                        <label>Option A: </label>
                                    </div>
                                    <input type="text" name="option_one[]" placeholder="Enter Option A" class="form-control" value="<?php echo $data[$i][3]; ?>">
                                </div>
                                <div class="form-group input-group  p-2">
                                    <div class="col-md-2">
                                        <label>Option B: </label>
                                    </div>
                                    <input type="text" name="option_tow[]" placeholder="Enter Option B" class="form-control" value="<?php echo $data[$i][4]; ?>">
                                </div>
                                <div class="form-group input-group  p-2">
                                    <div class="col-md-2">
                                        <label>Option C: </label>
                                    </div>
                                    <input type="text" name="option_three[]" placeholder="Enter Option C" class="form-control" value="<?php echo $data[$i][5]; ?>">
                                </div>
                                <div class="form-group input-group  p-2">
                                    <div class="col-md-2">
                                        <label>Option D: </label>
                                    </div>
                                    <input type="text" name="option_four[]" placeholder="Enter Option D" class="form-control" value="<?php echo $data[$i][6]; ?>">
                                </div>
                                <div class="form-group input-group  p-2">
                                    <div class="col-md-2">
                                        <label>Correct Answer: </label>
                                    </div>
                                    <input type="text" name="ans[]" placeholder="Correct Answer" class="form-control" value="<?php echo $data[$i][7]; ?>">
                                </div>
                                <?php }
//}?>
                                <input type="submit" class="btn btn-success" name="update_question" value="Update Now">
                                <div class="form-group">
                                    <?php
//                                    if (isset($_POST['submit'])) {
//                                        $num = $_POST['num'];
//                                        if ($num != '') {
//                                            echo '<input type="submit" class="btn btn-success" name="qz" value="Add Now">';
//                                        }
//                                    }
                                    ?>

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

