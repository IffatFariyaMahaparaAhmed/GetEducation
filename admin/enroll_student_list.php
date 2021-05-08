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
                <li class="breadcrumb-item active">Enrolled Student's List</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 col-sm-12 mt-2 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <?php
                            //get course name
                             if (isset($_GET['course_id'])){
                                 $course_id = $_GET['course_id'];

                                 $course_name = $connect->query("SELECT * FROM courses WHERE course_id = '$course_id'");

                                 $data = mysqli_fetch_assoc($course_name);
                             }
                            ?>
                            <h3><span class="text-info"><?php echo $data['course_name'];?> </span> Enrolled Student's List</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="bootstrap-data-table" class="text-center table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Student ID</th>
                                            <th>Student Name</th>
                                            <th>Enroll Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        //get enrooled student data
                                        $get_student_list = $connect->query("SELECT * FROM enroll_course, users WHERE enroll_course.user_id = users.user_id AND enroll_course.course_id = '$course_id'");

                                        $i = 1;

                                        while ($row = mysqli_fetch_assoc($get_student_list)){?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $row['user_id']?></td>
                                                <td class="text-capitalize">
                                                    <a class="text-decoration-none" href="student_profile.php?student=<?php echo $row['user_id']?>"> <?php echo $row['first_name'].' '.$row['last_name'];?></a>
                                                </td>
                                                <td><?php echo $row['buy_date']?></td>
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

</body>
</html>

