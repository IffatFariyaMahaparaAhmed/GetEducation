
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
                <li class="breadcrumb-item active">Manage Course File's</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 col-sm-12 mt-2">
                    <div class="card">
                        <div class="card-header">
                            <?php
                            //get course related file
                                if (isset($_GET['file']))
                                {
                                    $id = $_GET['file'];
                                    $_SESSION['page_id'] = $id;

                                    $get_course_name = $connect->query("SELECT * FROM courses WHERE course_id = '$id'");
                                    $data = mysqli_fetch_assoc($get_course_name);
                                }
                            ?>
                            <h3><span class="text-info"><?php echo $data['course_name'];?> </span> Files</h3>
                        </div>
                        <div class="card-body">
                            <div class="p-2">
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
                            </div>
                            <div class="table-responsive">
                                <table id="bootstrap-data-table" class="text-center table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>File</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sql_get_file = $connect->query("SELECT * FROM courses, course_files WHERE course_files.course_id = courses.course_id AND course_files.course_id = '$id'");

                                        $i = 1;
                                            while ($row = mysqli_fetch_assoc($sql_get_file)){?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $row['title'];?></td>
                                                <td>
                                                    <a class="text-decoration-none" href="../upload_file/<?php echo $row['filename'];?>" target="_blank"> <i class="fa fa-download"></i> <?php echo $row['filename'];?></a>
                                                </td>
                                                <td>
                                                    <a class="btn btn-danger" href="delete.php?course_file=<?php echo $row['course_file_id'];?>" onclick="return confirm('Are you Sure To Delete')"><i class="fa fa-trash"></i> Delete</a>
                                                </td>
                                            </tr>
                                        <?php }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="upload-course-file.php" class="btn btn-info float-right"><i class="fa fa-arrow-circle-left"></i> Back</a>
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
