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
                <li class="breadcrumb-item active">Buy Course</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 col-sm-12 mt-2">
                    <div class="card">
                        <div class="card-header">
                            <?php
                                if (isset($_GET['course']))
                                {
                                    $course_id = $_GET['course'];

                                    $get_course_data = $connect->query("SELECT * FROM courses WHERE course_id = '$course_id'");

                                    $data = mysqli_fetch_assoc($get_course_data);
                                }
                            ?>
                            <h3>Buy Course</h3>
                        </div>
                        <div class="card-body">
                            <?php
                                if (isset($_POST['btn']))
                                {
                                    $corse    = $_POST['course_id'];
                                    $price    = $_POST['payment'];
                                    $user_id  = $_POST['user_id'];

                                   $code = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0,6);

                                   $buy_date = date('Y-m-d');

                                    $sqlCheck = "SELECT * FROM enroll_course, users, courses WHERE enroll_course.user_id = '$user_data[user_id]' AND enroll_course.course_id = '$course_id' ";
                                    $result = mysqli_query($connect, $sqlCheck);
                                    $count = mysqli_num_rows($result);

                                    if ($count > 0){
                                        $_SESSION['exist'] = 'You All ready Buy This Course ';
                                    }else{
                                        $buy = $connect->query("INSERT INTO enroll_course (course_id, user_id, payment, course_code, buy_date, status) VALUES ('$corse', '$user_id', '$price', '$code', '$buy_date', '1')");

                                        $id = mysqli_insert_id($connect);
                                        if ($buy)
                                        {
                                            $_SESSION['last_id'] = $id;
                                            $_SESSION['success'] = 'Course Buy Success';
                                            echo "<script>document.location.href='code.php?last_id=$id'</script>";
                                        }else{
                                            echo "Error: ".mysqli_error($connect);
                                        }
                                    }

                                }
                            ?>
                            <?php
                            if(isset($_SESSION['exist'])){
                                echo "
                                    <div class='alert alert-danger alert-dismissible' id='login_msg' style='background-color: red; color: white'>
                                          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                          <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['exist']."
                                    </div>
                                 ";
                                unset($_SESSION['exist']);
                            }
                            ?>
                            <form action="" method="post">
                                <div class="form-group col-md-6 float-left">
                                    <label>Name: </label>
                                    <input type="text" hidden name="user_id" value="<?php echo $user_data['user_id'];?>">
                                    <input type="text" hidden name="course_id" value="<?php echo $data['course_id'];?>">
                                    <input type="text" hidden name="payment" value="<?php echo $data['course_price'];?>">

                                    <input type="text" value="<?php echo $user_data['first_name'].' '.$user_data['last_name'];?>" disabled class="form-control text-capitalize">
                                </div>
                                <div class="form-group col-md-6 float-left">
                                    <label>Email: </label>
                                    <input type="text" value="<?php echo $user_data['email'];?>" disabled class="form-control">
                                </div>
                                <div class="form-group col-md-6 float-left">
                                    <label>Course Name: </label>
                                    <input type="text" value="<?php echo $data['course_name'];?>" disabled class="form-control text-capitalize">
                                </div>
                                <div class="form-group col-md-6 float-left">
                                    <label>Course Price: </label>
                                    <input type="text" value="<?php echo number_format($data['course_price'],2);?>" disabled class="form-control text-capitalize">
                                </div>
                                <div class="form-group col-md-6 float-left">
                                    <label></label>
                                    <input type="submit" name="btn" id="generate" class="glyphicon glyphicon-random btn btn-success btn-block" value="Buy Now">
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
<script type="text/javascript">
    $(document).ready(function(){
        $('#generate').on('click', function(){
            $.get("get_coupon.php", function(data){
                $('#coupon').val(data);
            });
        });
    });
</script>
</body>
</html>

