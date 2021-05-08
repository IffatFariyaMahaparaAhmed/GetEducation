<?php

?>
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
                <li class="breadcrumb-item active">Post On Success Story</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-10 mx-auto mt-2 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h3>Add New Post On Success Story</h3>
                        </div>
                        <div class="card-body">
                            <?php
                            //ADD NEW POST ON DISCUSSION FOURM
                            if (isset($_POST['btn'])) {
                                $title = $_POST['title'];
                                $desc  = $_POST['description'];
                                $image = $_FILES['success_image']['name'];

                                if ($title == ''){
                                    $_SESSION['title_error'] = 'Please Enter Title';
                                }elseif ($desc == ''){
                                    $_SESSION['description'] = 'Please Enter Description';
                                }elseif ($image == ''){
                                    $_SESSION['image_succes'] = 'Please Select an Image';
                                }else{

                                    $fileinfo1 = PATHINFO($_FILES['success_image']['name']);
                                    $newfilename1 = $fileinfo1['filename'] . "." . $fileinfo1['extension'];
                                    move_uploaded_file($_FILES['success_image']['tmp_name'], "../images/" . $newfilename1);
                                    $location2 = $newfilename1;

                                    $create = date('Y-m-d');

                                    $post = $connect->query("INSERT INTO success_story (user_id, title, description, success_image, post_date, post_status) VALUES ('$user_data[user_id]','$title', '$desc', '$image', '$create', '1')");

                                    if ($post){
                                        $_SESSION['success'] = 'Post Create Successful...!';
                                    }else{
                                        $_SESSION['error'] = 'Post Create Failed..!';
                                    }
                                }
                            }
                            ?>
                            <?php
                            // validation message
                            if(isset($_SESSION['title_error'])){
                                echo "
                                            <div class='alert alert-danger alert-dismissible' id='blog_title' style='background-color: red; color: white'>
                                              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                              <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['title_error']."
                                            </div>
                                        ";
                                unset($_SESSION['title_error']);
                            }
                            if(isset($_SESSION['description'])){
                                echo "
                                            <div class='alert alert-danger alert-dismissible' id='blog_name_valid' style='background-color: red; color: white'>
                                              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                              <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['description']."
                                            </div>
                                       ";
                                unset($_SESSION['description']);
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
                            if(isset($_SESSION['image_succes'])){
                                echo "
                                            <div class='alert alert-danger alert-dismissible' id='error' style='background-color: red; color: white'>
                                                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                  <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['image_succes']."
                                            </div>
                                        ";
                                unset($_SESSION['image_succes']);
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
                                    <label class="font-weight-bold">Enter Title <sup class="text-danger">*</sup></label>
                                    <input type="text" name="title" placeholder="Enter Title" class="form-control" value="<?php if ($_POST){
                                        echo $_POST['title'];
                                    }?>">
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Select Image <sup class="text-danger">*</sup></label>
                                    <input type="file" name="success_image" class="form-control" accept=".jpeg,.png,.jpg">
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Enter Description <sup class="text-danger">*</sup></label>
                                    <textarea  name="description" id="application" placeholder="Enter Description" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input type="submit" name="btn" class="btn btn-success col-6" value="Post Now">
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


