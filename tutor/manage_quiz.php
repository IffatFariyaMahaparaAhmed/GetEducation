
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
                <li class="breadcrumb-item active">Manage Quiz</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 col-sm-12 mt-2">
                    <div class="card">
                        <div class="card-header">
                            <h3>Manage All Quiz
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addnew"><i class="fa fa-plus"></i> Add New quiz</button>
                            </h3>

<!--                            --><?php
//                                if (isset($_POST['btn_input']))
//                                {
//                                    $input_filed = $_POST['input_filed'];
//
//                                    for($i=1;$i<$input_filed;$i++)
//                                    {
//                                        echo'<tr><td><b>Image '.$i.'</b><br/>
//
//                                        <input type=text name=file'.$i.' class=bginput><td><b>Image Title '.$i.'</b><br />
//                                        ';
//                                    }
//                                }
//                            ?>
                        </div>
                        <div class="card-body">
                            <div>
                                <?php
                                if(isset($_SESSION['success'])){
                                    echo "
                                    <div class='alert alert-success alert-dismissible'>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        <h6><i class='icon fa fa-check'></i> Success!</h6>".$_SESSION['success']."
                                    </div>
                                    ";
                                    unset($_SESSION['success']);
                                }
                                if(isset($_SESSION['error'])){
                                    echo "
                                                <div class='alert alert-danger alert-dismissible' id='error' style='background-color: red; color: white'>
                                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                    <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['error']."
                                                </div>
                                                ";
                                    unset($_SESSION['error']);
                                }
                                ?>
                            </div>
                            <div class="table-responsive">
                                <table id="bootstrap-data-table" class="text-center table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Course Name</th>
                                            <th>Title</th>
                                            <th>Add Question</th>
                                            <th>View Question</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        //get all quiz list

                                    $sql = $connect->query("SELECT * FROM users, courses, quiz_sub WHERE quiz_sub.course_id = courses.course_id AND quiz_sub.user_id = users.user_id AND quiz_sub.user_id = '$user_data[user_id]'");
                                    $i = 1;

                                    while ($row = mysqli_fetch_assoc($sql)){?>
                                        <tr>
                                            <td><?php echo $i++;?></td>
                                            <td><?php echo $row['course_name'];?></td>
                                            <td><?php echo $row['title'];?></td>
                                            <td>
                                                <a class="btn btn-info" href="add_qustion.php?course=<?php echo $row['course_id'];?>"> <i class="fa fa-plus"></i> Add Question</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-info" href="view_qsn.php?qsn=<?php echo $row['quiz_id'];?>"><i class="fa fa-eye"></i> View</a>
                                            </td>
                                            <td>
                                                <?php
                                                $status = $row['status'];
                                                // echo $status;

                                                if (($status) == '0'){?>
                                                    <a href="quiz_status.php?status=<?php echo $row['quiz_id'];?>" class="text-decoration-none btn btn-success" onclick="return confirm('Are You Sure To Un-Publish  <?php echo $row['blog_title'];?> Blog')" > Published </a>
                                                    <?php
                                                }
                                                if (($status) == '1'){?>
                                                    <a href="quiz_status.php?status=<?php echo $row['quiz_id'];?>" class="text-decoration-none text-white btn btn-danger" onclick="return confirm('Are You Sure To Publish <?php echo $row['blog_title'];?> Blog')" > Un-Published</a>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-danger" href="delete.php?quiz=<?php echo $row['quiz_id'];?>"> <i class="fa fa-trash"></i> Delete</a>
                                            </td>
                                        </tr>
                                    <?php }?>
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Add New Quiz</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="add_query.php" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-12">
                        <label class="font-weight-bold">Select Course</label>
                        <select class="form-control" name="course_id">
                            <option>----Select One----</option>
                            <?php
                            $get_course = $connect->query("SELECT * FROM courses WHERE user_id = '$user_data[user_id]'");

                            while ($course = mysqli_fetch_assoc($get_course)){?>
                                <option value="<?php echo $course['course_id'];?>"><?php echo $course['course_name'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="font-weight-bold">Quiz Title</label>
                        <input type="text" name="title" placeholder="Enter Title" class="form-control">
                    </div>
                    <div class="form-group col-md-5 float-left">
                        <label class="p-2"></label>
                        <div class="input-group">
                            <button type="submit" class="btn btn-primary btn-flat btn-block" name="add_quiz"><i class="fa fa-save"></i> Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
