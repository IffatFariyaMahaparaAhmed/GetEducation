<?php

session_start();
include_once 'php/db_connect.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <title>GetEducation</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>

<!--nav bar-->
<section class="menu_bar">
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark m-0 p-0" >
        <?php include "nav.php";?>
    </nav>
</section>
<section class="contact_us_page">
    <div class="contact_section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h1 class="text-center text-capitalize" style="font-size: 48px; font-weight: 600; margin-top: 150px; color: white">Contact With Us</h1>
                    <p class="text-center" style="font-size: 20px; color: white">Home <i class="fa fa-arrow-right"></i> Contact Us</p>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="contact-page">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <h2 class="text-center text-white font-weight-bold font-italic mt-5 p-5 text-uppercase contact-title">send  message!!</h2>

                <p class="text-center">
                    <?php
                    if (isset($_POST['btn']))
                    {
                        $name    = $_POST['name'];
                        $phone   = $_POST['phone'];
                        $email   = $_POST['email'];
                        $message = $_POST['message'];


                        if ($name && $phone && $email && $message)
                        {
                            $date = date('Y-m-d');
                            $sql_msg = "INSERT INTO public_msg (name, phone, email, message, date) VALUES ('$name', '$phone', '$email', '$message', '$date')";
                            $res_msg = mysqli_query($connect, $sql_msg);

                            echo "<span class='text-success'>Message Sent Successful</span>";
                        }
                    }
                    ?>
                </p>
            </div>
            <div class="col-md-5 col-sm-12">
                <h2 class="ml-5 text-white mt-5 font-weight-bold">Getting in touch is easy!</h2>
                <p class="text-white ml-5 mt-3 font-weight-light">Address:  Dhaka, Bangladesh.</p>
                <p class="text-white ml-5 mt-3 font-weight-light">Phone:  +8801620007693 </p>
                <p class="text-white ml-5 mt-3 font-weight-light">Email:  geteducation@edu.bd</p>

                <li class="nav-link float-left ml-4 mt-5"><a href="" class="nav-item"><i class="fab fa-facebook fa-2x social-symbol2"></i></a></li>
                <li class="nav-link float-left mt-5"><a href="" class="nav-item"><i class="fab fa-twitter fa-2x social-symbol2"></i></a></li>
                <li class="nav-link float-left mt-5"><a href="" class="nav-item"><i class="fab fa-linkedin fa-2x social-symbol2"></i></a></li>
                <li class="nav-link float-left mt-5"> <a href="" class="nav-item"><i class="fab fa-google-plus fa-2x social-symbol2"></i></a></li>
            </div>

            <div class="col-sm-12 col-md-7 mt-5">
                <form action="" method="post">
                    <div class="input-group input-group-lg">
                            <span class="input-group-addon" id="sizing-addon1">
                                <i class="fas fa-user fa-2x p-4 social-symbol3"></i>
                            </span>
                        <input type="text" class="form-control mt-3" name="name" placeholder="Enter Your Name" required>
                    </div>
                    <div class="input-group input-group-lg">
                            <span class="input-group-addon" id="sizing-addon2">
                                <i class="fas fa-envelope fa-2x p-4 social-symbol3"></i>
                            </span>
                        <input type="email" class="form-control mt-3" name="email" placeholder="Enter Your Email" required>
                    </div>
                    <div class="input-group input-group-lg">
                            <span class="input-group-addon" id="sizing-addon3">
                                <i class="far fa-address-book fa-2x p-4 social-symbol3"></i>
                            </span>
                        <input type="text" class="form-control mt-3" name="phone" placeholder="Enter Your Phone Number" required>
                    </div>
                    <div class="input-group">
                        <textarea cols="40" rows="6" class="form-control mt-4" name="message" placeholder="Type your Message"></textarea>
                    </div>
                    <button type="submit" name="btn" class="btn btn-success btn-lg mt-3 mb-5 contact-btn">Send Your Message</button>
                </form>
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



