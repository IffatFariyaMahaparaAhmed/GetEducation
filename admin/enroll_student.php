<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 3/30/2021
 * Time: 4:31 PM
 */
?>
<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 3/21/2021
 * Time: 7:27 PM
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
                <li class="breadcrumb-item active">Manage Course's</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 col-sm-12 mt-2 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h3>Manage Course's</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="bootstrap-data-table" class="text-center table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Course Name</th>
                                        <th>Number Of Student</th>
                                        <th>View All Student's</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    //get all courses
                                    $sql_get_course = $connect->query("SELECT * FROM users, courses WHERE courses.user_id = users.user_id");

                                    $i = 1;

                                    while ($row = mysqli_fetch_assoc($sql_get_course)){?>
                                        <tr>
                                            <td><?php echo $i++;?></td>
                                            <td><?php echo $row['course_name']?></td>
                                            <td>
                                                <?php
                                                    //count how many students are enrolled in this course

                                                    $sql = $connect->query("SELECT user_id, course_id, COUNT(user_id) AS Total_Student FROM enroll_course WHERE enroll_course.course_id = '$row[course_id]'");

                                                    $total_student = mysqli_fetch_assoc($sql);

                                                    echo $total_student['Total_Student'];
                                                ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-info" href="enroll_student_list.php?course_id=<?php echo $row['course_id'];?>"><i class="fa fa-eye"></i> View</a>
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
<!--edit-->


</body>
</html>



