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
                <li class="breadcrumb-item active">My Enrolled Courses</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 col-sm-12 mt-2">
                    <div class="card">
                        <div class="card-header">
                            <h3>My Enrolled Courses</h3>
                        </div>
                        <div class="card-body">
                            <?php
                            if(isset($_SESSION['error'])){
                                echo "
                                    <div class='alert alert-danger alert-dismissible' id='error' style='background-color: red; color: white'>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['error']."
                                    </div>
                                    ";
                                unset($_SESSION['error']);
                            }
                            if(isset($_SESSION['success'])){
                                echo "
                                    <div class='alert alert-success alert-dismissible'>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        <h6><i class='icon fa fa-check'></i> Success!</h6>".$_SESSION['success']."
                                    </div>
                                    ";
                                unset($_SESSION['success']);
                            }
                            ?>
                            <div class="table-responsive">
                                <table id="bootstrap-data-table" class="text-center table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Course Name</th>
                                            <th>Enter Course</th>
                                            <th>Status</th>
                                            <th>Invoice</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $get_course = $connect->query("SELECT * FROM enroll_course, courses WHERE enroll_course.course_id = courses.course_id AND enroll_course.user_id = '$user_data[user_id]'");
                                        $i =1;
                                        while ($row = mysqli_fetch_assoc($get_course)){?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $row['course_name']?></td>
                                                <td>
                                                    <?php
                                                    if ($row['status'] == '1') {

                                                        echo '<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#addnew">Please Active Course <i class="fa fa-arrow-right"></i></button>';
                                                    }else{
                                                        echo "<a href='my_enroll_course.php?course=$row[course_id]' class='btn btn-success'> View Course File <i class='fa fa-arrow-right'></i></a>";
                                                    }

                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        if ($row['status'] == '1')
                                                        {
                                                            echo "<span class='btn btn-danger'>Deactive</span>";
                                                        }else{
                                                            echo "<span class='btn btn-success'>Active</span>";
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <a class="text-decoration-none" href="invoice.php?invoice=<?php echo $row['enroll_id'];?>"><i class="fa fa-file"></i> Invoice</a>
                                                </td>
                                            </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
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
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="formModal"
     aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Upload File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="update_query.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="font-weight-bold">Enter Course Code</label>
                        <input type="text" name="course_code" placeholder="Enter Course Code" class="form-control">
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <button type="submit" class="btn btn-primary btn-flat btn-block" name="active_course"><i class="fa fa-save"></i> Submit Code</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

