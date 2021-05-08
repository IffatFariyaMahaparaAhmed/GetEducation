<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 3/22/2021
 * Time: 10:20 AM
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
                <li class="breadcrumb-item active">Upload Course File & Video Tutorial</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 col-sm-12 mt-2 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h3>Upload Course File</h3>
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
                                if(isset($_SESSION['size'])){
                                    echo "
                                            <div class='alert alert-success alert-dismissible'>
                                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                <h6><i class='icon fa fa-check'></i> Success!</h6>".$_SESSION['size']."
                                            </div>
                                        ";
                                    unset($_SESSION['size']);
                                }
                                ?>
                            </div>

                            <nav>
                                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true" style="background-color: honeydew"><span class="ml-3 text-dark font-weight-bold">Upload Course File </span> </a>
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false" style="background-color: floralwhite"> <span class="ml-3 text-dark font-weight-bold">  Upload Course Video</span></a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent" style="box-shadow:  0px 0px 14px #888888;">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="card-body" style="background-color: honeydew">
                                        <div class="pb-4">
                                            <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#addnew"><i class="fa fa-upload"></i> Upload File</button>
                                        </div>
                                        <br/>
                                        <div class="table-responsive">
                                            <table class="text-center table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Course Name</th>
                                                        <th>All File's</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    $get_course = $connect->query("SELECT * FROM courses WHERE user_id = '$user_data[user_id]'");

                                                    $i = 1;

                                                    while ($row = mysqli_fetch_assoc($get_course)){?>
                                                    <tr>
                                                        <td><?php echo $i++;?></td>
                                                        <td><?php echo $row['course_name']?></td>
                                                        <td>
                                                            <a href="manage-course-file.php?file=<?php echo $row['course_id']?>" class="btn btn-success"><i class="fa fa-eye"></i> View File's</a>
                                                        </td>
                                                    </tr>
                                                <?php }?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <div class="card-body" style="background-color: floralwhite;">

                                        <div class="card-body" style="background-color: floralwhite">
                                            <div class="pb-4">
                                                <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#video"><i class="fa fa-upload"></i> Upload Video</button>
                                            </div>
                                            <br/>
                                            <div class="table-responsive">
                                                <table class="text-center table table-striped table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Course Name</th>
                                                        <th>All File's</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $get_course = $connect->query("SELECT * FROM courses WHERE user_id = '$user_data[user_id]'");

                                                    $i = 1;

                                                    while ($row = mysqli_fetch_assoc($get_course)){?>
                                                        <tr>
                                                            <td><?php echo $i++;?></td>
                                                            <td><?php echo $row['course_name']?></td>
                                                            <td>
                                                                <a href="manage-video.php?video=<?php echo $row['course_id']?>" class="btn btn-success"><i class="fa fa-eye"></i> View File's</a>
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
<!-- Description -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="formModal"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Upload File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="add_query.php" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-11">
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
                    <div class="form-group col-md-11">
                        <label class="font-weight-bold">File Title</label>
                        <input type="text" name="title" placeholder="Enter File Title" class="form-control">
                    </div>
                    <div class="form-group col-md-11">
                        <label class="font-weight-bold">Select File</label>
                        <div class="input-group">
                            <input type="file" class="form-control"  name="file1" required>
                        </div>
                    </div>
                    <div class="form-group col-md-5 float-left">
                        <label class="p-2"></label>
                        <div class="input-group">
                            <button type="submit" class="btn btn-primary btn-flat btn-block" name="add_file"><i class="fa fa-upload"></i> Upload FIle</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="video" tabindex="-1" role="dialog" aria-labelledby="formModal"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Upload Video</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="add_query.php" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-11">
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

                    <div class="form-group col-md-11">
                        <label class="font-weight-bold">Title</label>
                        <input name="title" type="text" placeholder="Enter Title" class="form-control" required>
                    </div>
                    <div class="form-group col-md-11">
                        <label class="font-weight-bold">Select File</label>
                        <div class="input-group">
                            <input type="file" class="form-control"  name="file">
                        </div>
                    </div>
                    <div class="form-group col-md-5 float-left">
                        <label class="p-2"></label>
                        <div class="input-group">
                            <input type="submit" name="btn" class="btn btn-success btn-block" value="Upload">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>