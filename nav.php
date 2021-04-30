<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 4/6/2021
 * Time: 10:57 PM
 */
?>
<div class="container">
    <a class="navbar-brand font-weight-bold" href="#" style="font-size: 30px"><span style="color: white">Get</span><span style="color: red">Education</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="main_nav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="course.php">Courses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="forum.php">Forum</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="successful.php">Success Story</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="news.php">News</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="trainer.php">Trainer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact_us.php">Contact Us</a>
            </li>
            <li class="nav-item dropdown bg-dark">
                <?php
                //check user login or not

                if (!isset($_SESSION['user']))
                {
                    echo "<a href='login.php' class='nav-link'>Login</a>";
                }else{
                    $sql = "SELECT * FROM users WHERE email = '$_SESSION[user]'";
                    $res = mysqli_query($connect, $sql);

                    $userdata = mysqli_fetch_assoc($res);
                    echo "
                        <li class='nav-item dropdown'>
                        <a class='nav-link  dropdown-toggle' data-toggle='dropdown' href='#'> $userdata[first_name] $userdata[last_name]  <img src='images/$userdata[image]' style='height: 30px; width: 30px; border-radius: 50%'></a>
                            <div class='dropdown-menu bg-dark' id='drop' aria-labelledby='navbarDropdown'>
                                <a href='user/index.php' class='dropdown-item text-capitalize'>Profile</a>
                                <a href='user/logout.php' class='dropdown-item text-capitalize'>Logout</a>
                            </div>
                        </li>
                   ";
                }

                ?>
            </li>
        </ul>
    </div>
</div>
