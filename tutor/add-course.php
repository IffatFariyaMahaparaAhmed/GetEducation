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
                <li class="breadcrumb-item active">Create New Course</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-10 mx-auto mt-2 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h3>Create New Course <a class="btn btn-info float-right" href="manage-course.php"><i class="fa fa-edit"></i> Manage Course</a></h3>
                        </div>
                        <div class="card-body">
                            <?php
                                if (isset($_POST['btn']))
                                {
                                    $user_id       = $user_data['user_id'];
                                    $course_name   = $_POST['course_name'];
                                    $course_status = $_POST['course_status'];
                                    $course_image  = $_FILES['course_image']['name'];
                                    $description   = $_POST['course_description'];

                                    if ($course_name == ''){
                                        $_SESSION['erro_course_name'] = 'Enter Course Name';
                                    }elseif ($course_image == ''){
                                        $_SESSION['course_image'] = 'Please Select Image';
                                    }elseif ($description == ''){
                                        $_SESSION['description'] = 'Enter Course Description';
                                    }else{
                                        $fileinfo1 = PATHINFO($_FILES['course_image']['name']);
                                        $newfilename1 = $fileinfo1['filename'] . "." . $fileinfo1['extension'];
                                        move_uploaded_file($_FILES['course_image']['tmp_name'], "../images/" . $newfilename1);
                                        $location2 = $newfilename1;

                                        $course = $connect->query("INSERT INTO courses (user_id, course_name, course_status, course_description, course_image) VALUES ('$user_id', '$course_name', '$course_status', '$description', '$course_image')");

                                        if ($course){
                                            $_SESSION['success'] = 'New Course Create Successful';
                                            echo "<script>document.location.href='manage-course.php'</script>";
                                        }else{
                                            echo "error: ".mysqli_error($connect);
                                        }
                                    }
                                }
                            ?>
                            <div>
                                <?php
                                    if(isset($_SESSION['erro_course_name'])){
                                        echo "
                                        <div class='alert alert-danger alert-dismissible' id='error' style='background-color: red; color: white'>
                                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                            <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['erro_course_name']."
                                        </div>
                                        ";
                                        unset($_SESSION['erro_course_name']);
                                    }
                                if(isset($_SESSION['course_image'])){
                                    echo "
                                    <div class='alert alert-danger alert-dismissible' id='error' style='background-color: red; color: white'>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['course_image']."
                                    </div>
                                    ";
                                    unset($_SESSION['course_image']);
                                }
                                if(isset($_SESSION['description'])){
                                    echo "
                                    <div class='alert alert-danger alert-dismissible' id='error' style='background-color: red; color: white'>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['description']."
                                    </div>
                                    ";
                                    unset($_SESSION['description']);
                                }
                                ?>
                            </div>

                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Course Name <sup class="text-danger font-weight-bold">*</sup></label>
                                    <input type="text" name="course_name" placeholder="Enter Course Name" class="form-control" value="<?php if ($_POST){
                                        echo $_POST['course_name'];
                                    }?>">
                                </div>


                                <div class="form-group">
                                    <label>Course Status <sup class="text-danger font-weight-bold">*</sup></label>
                                    <select name="course_status" class="form-control">
                                        <option value="0">Free Course</option>
                                        <option value="1">Paid Course</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Course Image <sup class="text-danger font-weight-bold">*</sup></label>
                                    <input type="file" name="course_image" class="form-control" accept=".jpeg,.jpg,.png">
                                </div>

                                <div class="form-group">
                                    <label>Course Description <sup class="text-danger font-weight-bold">*</sup></label>
                                    <textarea name="course_description" id="application" class="form-control"></textarea>
                                </div>

                                <div class="form-group">
                                    <input type="submit" name="btn" value="Submit" class="btn btn-success col-4">
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

