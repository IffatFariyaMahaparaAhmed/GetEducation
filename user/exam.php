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
                <li class="breadcrumb-item active">Attend Quiz</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 col-sm-12 mt-2">
                    <div class="card">
                        <div class="card-header">
                            <h3>Attend Quiz</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="bootstrap-data-table" class="text-center table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Course Name</th>
                                            <th>Title</th>
                                            <th>Starts Quiz</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $get_course = $connect->query("SELECT * FROM quiz_sub, courses, enroll_course WHERE quiz_sub.course_id = enroll_course.course_id AND enroll_course.course_id = courses.course_id AND enroll_course.user_id = '$user_data[user_id]' AND quiz_sub.status = '0'");
                                    $i =1;
                                    while ($row = mysqli_fetch_assoc($get_course)){?>
                                        <tr>
                                            <td><?php echo $i++;?></td>
                                            <td><?php echo $row['course_name']?></td>
                                            <td><?php echo $row['title']?></td>
                                            <td>
                                                <a class="btn btn-info" href="start_exam.php?qsn_id=<?php echo $row['quiz_id'];?>"> Start Now <i class="fa fa-arrow-right"></i></a>
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

</body>
</html>

