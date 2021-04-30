<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 3/24/2021
 * Time: 3:24 PM
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
                <li class="breadcrumb-item active">Add Post On Discussion Forum</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-10 mx-auto mt-2 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h3>Add Post On Discussion Forum</h3>
                        </div>
                        <div class="card-body">
                            <?php
                            //ADD NEW POST ON DISCUSSION FOURM
                                if (isset($_POST['btn'])) {
                                    $title = $_POST['title'];
                                    $desc  = $_POST['description'];

                                    if ($title == ''){
                                        $_SESSION['title_error'] = 'Please Enter Title';
                                    }elseif ($desc == ''){
                                        $_SESSION['description'] = 'Please Enter Description';
                                    }else{
                                        $create = date('Y-m-d');

                                        $post = $connect->query("INSERT INTO discussion_forum (title, description, post_by, post_date, status) VALUES ('$title', '$desc', '$user_data[user_id]', '$create', '1')");

                                        if ($post){
                                            $_SESSION['success'] = 'Post Successful...!';
                                        }else{
                                            $_SESSION['error'] = 'Post Failed..!';
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
                            <form action="" method="post">
                                <div class="form-group">
                                    <label class="font-weight-bold">Enter Title <sup class="text-danger">*</sup></label>
                                    <input type="text" name="title" placeholder="Enter Title" class="form-control" value="<?php if ($_POST){
                                        echo $_POST['title'];
                                    }?>">
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

