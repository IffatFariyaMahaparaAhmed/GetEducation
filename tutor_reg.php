<?php

    require_once 'php/db_connect.php';

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    
    <title>GetEducation</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body style="background-color: #96a2b4">
<section class="menu_bar">
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark m-0 p-0" >
        <?php include "nav.php";?>
    </nav>
</section>
<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto mt-5 mb-5">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="text-center text-white">Tutor Registration</h3>
                </div>
                <div class="card-body">
                    <h4 class="ml-2">
                        <?php
                        //new tutor registration
                            if (isset($_POST['btn']))
                            {
                                $first_name   = $_POST['first_name'];
                                $last_name    = $_POST['last_name'];
                                $email        = $_POST['email'];
                                $phone        = $_POST['phone'];
                                $birth        = $_POST['date_of_birth'];
                                $gender       = $_POST['gender'];
                                $address      = $_POST['address'];
                                $nid          = $_POST['nid'];
                                $certificate  = $_FILES['education_certificate']['name'];
                                $institute    = $_POST['institute'];
                                $image        = $_FILES['image']['name'];
                                $password     = $_POST['password'];

                                $has = hash('md5', $password); //hash password

                                //check validation
                                if ($first_name == ''){
                                    echo "<span class='text-danger'>Enter First Name</span>";
                                }elseif (!preg_match('/^[a-zA-Z ]*$/', $first_name)){
                                    echo "<span class='text-danger'> First Name Must In Character Value</span>";
                                }elseif ($last_name == ''){
                                    echo "<span class='text-danger'>Enter Last Name</span>";
                                }elseif (!preg_match('/^[a-zA-Z ]*$/', $last_name)){
                                    echo "<span class='text-danger'> Last Name Must In Character Value</span>";
                                }elseif ($email == ''){
                                    echo "<span class='text-danger'> Enter Email Address</span>";
                                }elseif ($phone == ''){
                                    echo "<span class='text-danger'> Enter Phone Number</span>";
                                }elseif (!preg_match('/^[0-9]*$/',$phone)){
                                    echo "<span class='text-danger'> Phone Number Must be Numeric Value</span>";
                                }elseif (strlen($phone)<11){
                                    echo "<span class='text-danger'> Phone Number Must be 11 Digit</span>";
                                }elseif (strlen($phone)>11){
                                    echo "<span class='text-danger'> Phone Number Must be 11 Digit</span>";
                                }elseif ($birth == ''){
                                    echo "<span class='text-danger'> Enter Birth Date</span>";
                                }elseif ($nid == ''){
                                    echo "<span class='text-danger'> Enter NID Number</span>";
                                }elseif (!preg_match('/^[0-9]*$/', $nid)){
                                    echo "<span class='text-danger'> NID Number Must Be Numeric Value</span>";
                                }elseif (strlen($nid)<16){
                                    echo "<span class='text-danger'> NID Number Must be 16 Digit</span>";
                                }elseif (strlen($nid)>16){
                                    echo "<span class='text-danger'> NID Number Must be 16 Digit</span>";
                                }elseif ($certificate == ''){
                                    echo "<span class='text-danger'> Select Your Certificate </span>";
                                }elseif ($institute == ''){
                                    echo "<span class='text-danger'> Enter Your Current Institute Name</span>";
                                }elseif ($image == ''){
                                    echo "<span class='text-danger'> Select Image</span>";
                                }elseif ($password == ''){
                                    echo "<span class='text-danger'> Enter Password</span>";
                                }elseif (preg_match('/\s/', $password)){
                                    echo "<span class='text-danger'> Must Be Password Has No Space</span>";
                                }else{
                                    //check user registerd or not
                                    $sqlCheck = "SELECT * FROM users WHERE email = '$email'";
                                    $result = mysqli_query($connect, $sqlCheck);
                                    $count = mysqli_num_rows($result);
                                    if ($count > 0) {
                                        echo "<span class='text-danger'>Email All ready Registered.... Please Try Agin With New Email!</span><br/>";
                                    }else{
                                        $fileinfo = PATHINFO($_FILES['education_certificate']['name']);
                                        $newfilename = $fileinfo['filename'] . "." . $fileinfo['extension'];
                                        move_uploaded_file($_FILES['education_certificate']['tmp_name'], "upload_file/" . $newfilename);
                                        $location = $newfilename;

                                        $fileinfo1 = PATHINFO($_FILES['image']['name']);
                                        $newfilename1 = $fileinfo1['filename'] . "." . $fileinfo1['extension'];
                                        move_uploaded_file($_FILES['image']['tmp_name'], "images/" . $newfilename1);
                                        $location2 = $newfilename1;

                                        $join_date = date('Y-m-d');

                                        //insert query for registration new tutor

                                        $sql = $connect->query("INSERT INTO users (first_name, last_name, email, phone, date_of_birth, gender, address, nid, education_certificate, institute, join_date, status, role, image, password, approve) VALUES ('$first_name', '$last_name', '$email', '$phone', '$birth', '$gender', '$address', '$nid', '$certificate', '$institute', '$join_date', '0', 'tutor', '$image', '$has', '1')");

                                        if ($sql){
                                            echo "<span class='text-success'>Registration Successful.....<a href='login.php' class='text-info'>Login Now</a></span>";
                                        }else{
                                            echo "Error: ".mysqli_error($connect);
                                        }
                                    }
                                }

                            }
                        ?>
                    </h4>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group col-md-6 float-left">
                            <label>First Name<sup class="text-danger font-weight-bold">*</sup></label>
                            <input type="text" name="first_name" placeholder="Enter First Name" class="form-control" value="<?php if ($_POST) {
                                echo $_POST['first_name'];
                            }?>">
                        </div>
                        <div class="form-group col-md-6 float-left">
                            <label>Last Name<sup class="text-danger font-weight-bold">*</sup></label>
                            <input type="text" name="last_name" placeholder="Enter Last Name" class="form-control" value="<?php if ($_POST) {
                                echo $_POST['last_name'];
                            }?>">
                        </div>
                        <div class="form-group col-md-6 float-left">
                            <label>Email<sup class="text-danger font-weight-bold">*</sup></label>
                            <input type="email" name="email" placeholder="Enter Email" class="form-control" value="<?php if ($_POST) {
                                echo $_POST['email'];
                            }?>">
                        </div>
                        <div class="form-group col-md-6 float-left">
                            <label>Phone<sup class="text-danger font-weight-bold">*</sup></label>
                            <input type="text" name="phone" placeholder="Enter Phone Number" class="form-control" value="<?php if ($_POST) {
                                echo $_POST['phone'];
                            }?>">
                        </div>
                        <div class="form-group col-md-6 float-left">
                            <label>Date Of Birth<sup class="text-danger font-weight-bold">*</sup></label>
                            <input type="date" name="date_of_birth" class="form-control" value="<?php if ($_POST) {
                                echo $_POST['date_of_birth'];
                            }?>">
                        </div>

                        <div class="form-group col-md-6 float-left">
                            <label>NID Number<sup class="text-danger font-weight-bold">*</sup></label>
                            <input type="text" name="nid" placeholder="Enter Your NID Number" class="form-control" value="<?php if ($_POST) {
                                echo $_POST['nid'];
                            }?>">
                        </div>
                        <div class="form-group col-md-6 float-left">
                            <label>Upload CV<sup class="text-danger font-weight-bold">*</sup></label>
                            <input type="file" name="education_certificate" class="form-control" accept=".pdf,.docx">
                        </div>
                        <div class="form-group col-md-6 float-left">
                            <label>Current Institute <sup class="text-danger font-weight-bold">*</sup></label>
                            <input type="text" name="institute" placeholder="Current Job Institute Name" class="form-control" value="<?php if ($_POST){
                                echo $_POST['institute'];
                            }
                            ?>">
                        </div>

                        <div class="form-group col-md-6 float-left">
                            <label>Gender<sup class="text-danger font-weight-bold">*</sup></label><br/>
                            <input type="radio" checked value="Male" name="gender"> Male
                            <input type="radio"  value="Female" name="gender"> Fe-Male
                        </div>
                        <div class="form-group col-md-6 float-left">
                            <label>Address<sup class="text-danger font-weight-bold">*</sup></label>
                            <textarea name="address" placeholder="Enter Address" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-6 float-left">
                            <label>Password<sup class="text-danger font-weight-bold">*</sup></label>
                            <input type="password" name="password" placeholder="Enter Password" class="form-control">
                        </div>
                        <div class="form-group col-md-6 float-left">
                            <label>Image<sup class="text-danger font-weight-bold">*</sup></label>
                            <input type="file" name="image" class="form-control" accept=".jepg,.jpg,.png">
                        </div>
                        <div class="form-group col-md-6 float-left">
                            <label></label>
                            <input type="submit" name="btn" class="btn btn-success btn-block" value="Submit">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <span>All Ready Registered? <a href="login.php">Login Now</a> <a href="registration.php" class="float-right">Student Registration</a></span>
                </div>
            </div>

        </div>
    </div>
</div>



<section class="fotter bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <p class="text-center text-white pt-1" style="font-size: 14px">This site is Copyright By &copy;<b> <i> GetEducation</i></b></p>
            </div>
        </div>
    </div>
</section>

<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

</body>
</html>
