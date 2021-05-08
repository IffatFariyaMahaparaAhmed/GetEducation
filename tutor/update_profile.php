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
                <li class="breadcrumb-item active">Update Profile</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 col-sm-12 mt-2">
                    <div class="card">
                        <div class="card-header">
                            <h3>Update Profile</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-md-8 col-sm-12 float-left">

                                <h3 class="ml-3 p-2">
                                    <?php
                                    if(isset($_SESSION['success'])){
                                        echo "
                                        <span class='text-success'>".$_SESSION['success']."</span>
                                     ";
                                        unset($_SESSION['success']);
                                    }
                                    ?>
                                    <?php
                                    if (isset($_POST['btn']))
                                    {
                                        $id   = $_POST['user_id'];
                                        $first_name   = $_POST['first_name'];
                                        $last_name    = $_POST['last_name'];
                                        $phone        = $_POST['phone'];
                                        $birth        = $_POST['date_of_birth'];
                                        $gender       = $_POST['gender'];
                                        $address      = $_POST['address'];

                                        if ($first_name == ''){
                                            echo "<span class='text-danger'>Enter First Name</span>";
                                        }elseif (!preg_match('/^[a-zA-Z ]*$/', $first_name)){
                                            echo "<span class='text-danger'> First Name Must In Character Value</span>";
                                        }elseif ($last_name == ''){
                                            echo "<span class='text-danger'>Enter Last Name</span>";
                                        }elseif (!preg_match('/^[a-zA-Z ]*$/', $last_name)){
                                            echo "<span class='text-danger'> Last Name Must In Character Value</span>";
                                        }elseif ($phone == ''){
                                            echo "<span class='text-danger'> Enter Phone Number</span>";
                                        }elseif (!preg_match('/^[0-9]*$/',$phone)){
                                            echo "<span class='text-danger'> Phone Number Must be Numeric Value</span>";
                                        }elseif (strlen($phone)<11){
                                            echo "<span class='text-danger'> Phone Number Must be 11 Digit</span>";
                                        }elseif (strlen($phone)>11){
                                            echo "<span class='text-danger'> Phone Number Must be 11 Digit</span>";
                                        }else{
                                            $update = "UPDATE users SET
                                              first_name = '$first_name',
                                              last_name  = '$last_name',
                                              phone      = '$phone',
                                           date_of_birth = '$birth',
                                              gender     = '$gender',
                                              address    = '$address'
                                              
                                              WHERE user_id = '$id'
                                        ";

                                            $res = mysqli_query($connect, $update);

                                            if ($res){
                                                $_SESSION['success'] = 'Profile Update Successful';
                                                echo "<script>document.location.href='update_profile.php'</script>";
//                                                echo "<span class='text-success'></span>";

                                            }else{
                                                echo "Error: ".mysqli_error($connect);
                                            }
                                        }

                                    }
                                    ?>


                                </h3>
                                <form action="" method="post">
                                    <div class="form-group col-md-6 float-left">
                                        <label>First Name<sup class="text-danger font-weight-bold">*</sup></label>
                                        <input type="text" name="user_id" hidden placeholder="Enter First Name" class="form-control" value="<?php echo $user_data['user_id'];?>">
                                        <input type="text" name="first_name" placeholder="Enter First Name" class="form-control" value="<?php echo $user_data['first_name']?>">
                                    </div>
                                    <div class="form-group col-md-6 float-left">
                                        <label>Last Name<sup class="text-danger font-weight-bold">*</sup></label>
                                        <input type="text" name="last_name" placeholder="Enter Last Name" class="form-control" value="<?php echo $user_data['last_name']?>">
                                    </div>
                                    <div class="form-group col-md-6 float-left">
                                        <label>Email<sup class="text-danger font-weight-bold">*</sup></label>
                                        <input type="email" disabled placeholder="Enter Email" class="form-control" value="<?php echo $user_data['email']?>">
                                    </div>
                                    <div class="form-group col-md-6 float-left">
                                        <label>Phone<sup class="text-danger font-weight-bold">*</sup></label>
                                        <input type="text" name="phone" placeholder="Enter Phone Number" class="form-control" value="<?php echo $user_data['phone'];?>">
                                    </div>
                                    <div class="form-group col-md-6 float-left">
                                        <label>Date Of Birth<sup class="text-danger font-weight-bold">*</sup></label>
                                        <input type="date" name="date_of_birth" class="form-control" value="<?php echo $user_data['date_of_birth'];?>">
                                    </div>

                                    <div class="form-group col-md-6 float-left">
                                        <label>NID Number<sup class="text-danger font-weight-bold">*</sup></label>
                                        <input type="text" disabled placeholder="Enter Your NID Number" class="form-control" value="<?php echo $user_data['nid'];?>">
                                    </div>
                                    <div class="form-group col-md-6 float-left">
                                        <label>Gender<sup class="text-danger font-weight-bold">*</sup></label><br/>
                                        <?php
                                        if ($user_data['gender'] == 'Male'){
                                            echo '<input type="radio" checked value="Male" name="gender"> Male'.' ';
                                        }else{
                                            echo '<input type="radio"  value="Male" name="gender"> Male'.' ';
                                        }

                                        if ($user_data['gender'] == 'Female'){
                                            echo '<input type="radio" checked value="Female" name="gender"> Fe-Male';
                                        }else{
                                            echo '<input type="radio"  value="Female" name="gender"> Fe-Male';
                                        }
                                        ?>
                                    </div>
                                    <div class="form-group col-md-6 float-left">
                                        <label>Address<sup class="text-danger font-weight-bold">*</sup></label>
                                        <textarea name="address" placeholder="Enter Address" class="form-control"><?php echo $user_data['address'];?></textarea>
                                    </div>
                                    <div class="form-group col-md-6 float-left">
                                        <label></label>
                                        <input type="submit" name="btn" class="btn btn-success btn-block" value="Submit">
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4 col-sm-12 float-left">
                                <h3>
                                    <?php
                                    if (isset($_POST['pic'])){
                                        $fileinfo = PATHINFO($_FILES['image']['name']);
                                        $newfilename  = $fileinfo['filename']. "." .$fileinfo['extension'];
                                        move_uploaded_file($_FILES['image']['tmp_name'],"../images/" .$newfilename);
                                        $location = $newfilename;

                                        $update_pic = $connect->query("UPDATE users SET image = '$location' WHERE user_id = '$user_data[user_id]'");

                                        if ($update_pic) {
                                            echo "<script>document.location.href='update_profile.php</script>";
                                        }else{
                                            echo "Error: ".mysqli_error($connect);
                                        }

                                    }
                                    ?>
                                </h3>
                                <div class="text-center">
                                    <img src="../images/<?php echo $user_data['image'];?>" class="img-fluid" style="height: 200px; width: 200px; border-radius: 50%">
                                </div>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Chose Photo</label>
                                        <input type="file" name="image" class="form-control" accept=".jpeg,.png,.jpg">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="pic" class="btn btn-primary" value="Update Profile Picture">
                                    </div>

                                </form>
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

