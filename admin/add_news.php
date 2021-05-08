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
                <li class="breadcrumb-item active">Add News</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12  mx-auto mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h3>Add New News <a href="manage_news.php" class="btn btn-primary float-right"><i class="fa fa-edit"></i> Manage News</a></h3>
                        </div>
                        <div class="card-body">
                            <?php
                            //add new news
                                if (isset($_POST['btn'])){
                                    $title = $_POST['title'];
                                    $image = $_FILES['image']['name'];
                                    $desc  = $_POST['description'];

                                    if ($title == ''){
                                        $_SESSION['title'] = 'Please Enter Title';
                                    }elseif ($image == ''){
                                        $_SESSION['image'] = 'Please Select Image';
                                    }elseif ($desc == ''){
                                        $_SESSION['desc'] = 'Please Write Description';
                                    }else{
                                        $fileinfo1 = PATHINFO($_FILES['image']['name']);
                                        $newfilename1 = $fileinfo1['filename'] . "." . $fileinfo1['extension'];
                                        move_uploaded_file($_FILES['image']['tmp_name'], "../images/" . $newfilename1);
                                        $location2 = $newfilename1;

                                        $create = @date('Y-m-d');

                                        $add_news = $connect->query("INSERT INTO news (title, image, description, post_date) VALUES ('$title', '$image','$desc','$create')");

                                        if ($add_news){
                                            $_SESSION['success'] = 'New News Create Successful';
                                        }else{
                                            $_SESSION['error'] = 'New News Create Failed...!'.mysqli_error($connect);
                                        }

                                    }
                                }
                            ?>
                            <?php
                            // validation message
                            if(isset($_SESSION['title'])){
                                echo "
                                            <div class='alert alert-danger alert-dismissible' id='blog_title' style='background-color: red; color: white'>
                                              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                              <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['title']."
                                            </div>
                                        ";
                                unset($_SESSION['title']);
                            }
                            if(isset($_SESSION['desc'])){
                                echo "
                                            <div class='alert alert-danger alert-dismissible' id='blog_name_valid' style='background-color: red; color: white'>
                                              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                              <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['desc']."
                                            </div>
                                       ";
                                unset($_SESSION['desc']);
                            }
                            if(isset($_SESSION['image'])){
                                echo "
                                            <div class='alert alert-danger alert-dismissible' id='blog_name_valid' style='background-color: red; color: white'>
                                              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                              <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['image']."
                                            </div>
                                       ";
                                unset($_SESSION['image']);
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
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>News Title <sup class="text-danger font-weight-bold">*</sup></label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter Title">
                                </div>
                                <div class="form-group">
                                    <label>Image <sup class="text-danger font-weight-bold">*</sup></label>
                                    <input type="file" name="image" class="form-control" accept=".jpeg,.jpg,.png">
                                </div>
                                <div class="form-group">
                                    <label>Description <sup class="text-danger font-weight-bold">*</sup></label>
                                    <textarea class="form-control" name="description" id="application"></textarea>
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input type="submit" name="btn" class="btn btn-success col-5" value="Submit">
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

