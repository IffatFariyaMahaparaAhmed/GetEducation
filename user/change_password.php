<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 3/21/2021
 * Time: 2:49 PM
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
                <li class="breadcrumb-item active">Change Password</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-10 mx-auto mt-2">
                    <div class="card">
                        <div class="card-header">
                            <h3>Change Password</h3>
                        </div>
                        <div class="card-body">
                            <h3 class="p-2">
                                <?php
                                // change password
                                if (isset($_POST['change_pass'])){
                                    $old_pass = $_POST['old_pass'];
                                    $new_pass = $_POST['password'];

                                    $has_pass = hash('md5', $old_pass); // hash password
                                    $new_pass_hash = hash('md5', $new_pass); // passsword hash into sha256

                                    if ($old_pass == ''){
                                        $_SESSION['old_pass'] = 'Type Your Old Password';
                                    }elseif ($new_pass == ''){
                                       $_SESSION['new_pass'] = 'Type Your New Password';
                                    }elseif (preg_match('/\s/', $new_pass)) {
                                       $_SESSION['space'] = 'Password Must Have No Space';
                                    }else{
                                        if ($old_pass && $has_pass){
                                            $sql = "SELECT * FROM users WHERE user_id = '$user_data[user_id]' AND password = '$has_pass'"; // check password hash
                                            $result = mysqli_query($connect, $sql); // connect with query and database

                                            $up = mysqli_fetch_assoc($result);

                                            if ($up !=0){
                                                $change_pass = "UPDATE users SET password = '$new_pass_hash' WHERE user_id = '$user_data[user_id]'"; // update password
                                                $res_change  = mysqli_query($connect, $change_pass);// connect with query and database

                                              $_SESSION['success'] = 'Password Change Successful';
                                            }else{
                                                $_SESSION['error'] = 'Password Does Not Match With Current Password';
                                            }
                                        }
                                    }
                                }
                                ?>
                            </h3>
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
                                if(isset($_SESSION['old_pass'])){
                                    echo "
                                                <div class='alert alert-danger alert-dismissible' id='error' style='background-color: red; color: white'>
                                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                    <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['old_pass']."
                                                </div>
                                                ";
                                    unset($_SESSION['old_pass']);
                                }
                                if(isset($_SESSION['old_pass'])){
                                    echo "
                                                <div class='alert alert-danger alert-dismissible' id='error' style='background-color: red; color: white'>
                                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                    <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['old_pass']."
                                                </div>
                                                ";
                                    unset($_SESSION['old_pass']);
                                }

                                if(isset($_SESSION['new_pass'])){
                                    echo "
                                                <div class='alert alert-danger alert-dismissible' id='error' style='background-color: red; color: white'>
                                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                    <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['new_pass']."
                                                </div>
                                                ";
                                    unset($_SESSION['new_pass']);
                                }

                                if(isset($_SESSION['space'])){
                                    echo "
                                                <div class='alert alert-danger alert-dismissible' id='error' style='background-color: red; color: white'>
                                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                    <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['space']."
                                                </div>
                                                ";
                                    unset($_SESSION['space']);
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
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Type Your Old Password</label>
                                    <input type="password" placeholder="Enter Old Password" name="old_pass" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Type New Password</label>
                                    <input type="password" placeholder="Enter New Password" name="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="change_pass" class="btn btn-success" value="Change Password">
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

