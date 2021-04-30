<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 3/21/2021
 * Time: 12:34 PM
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
                <li class="breadcrumb-item active">Student Profile</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 mx-auto mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-uppercase text-info"><?php echo $user_data['first_name'];?> <?php echo $user_data['last_name'];?> <span class="text-dark text-capitalize"> Details</span>  <a class="btn btn-info float-right text-capitalize" href="update_profile.php"><i class="fa fa-edit"></i> Update Profile</a></h4>
                        </div>
                        <div class="card-body">
                            <div class="col-md-4 col-sm-12 float-left">
                                <img src="../images/<?php echo $user_data['image'];?>" style="height: 344px; width: 100%">
                            </div>
                            <div class="col-md-8 col-sm-12 float-left">
                                <div class="table-responsive">
                                    <table class="table table-bordered" style="background-color: blue; color: white">
                                        <tr>
                                            <td class="text-center"> Name</td>
                                            <td class="text-center text-capitalize" style="background-color: white; color: black; border: 1px solid black; border-left: none"><?php echo $user_data['first_name']?> <?php echo $user_data['last_name']?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"> Email</td>
                                            <td class="text-center" style="background-color: white; color: black; border: 1px solid black; border-left: none"><?php echo $user_data['email']?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"> Phone</td>
                                            <td class="text-center" style="background-color: white; color: black; border: 1px solid black; border-left: none"><?php echo $user_data['phone']?></td>

                                        </tr>
                                        <tr>
                                            <td class="text-center"> Address</td>
                                            <td class="text-center" style="background-color: white; color: black; border: 1px solid black; border-left: none"><?php echo $user_data['address']?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">Gender </td>
                                            <td class="text-center" style="background-color: white; color: black; border: 1px solid black; border-left: none"><?php echo $user_data['gender']?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">Date Of Birth </td>
                                            <td class="text-center" style="background-color: white; color: black; border: 1px solid black; border-left: none"><?php echo date('d-M-Y', strtotime($user_data['date_of_birth']))?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">Join Date </td>
                                            <td class="text-center" style="background-color: white; color: black; border: 1px solid black; border-left: none"><?php echo date('d-M-Y', strtotime($user_data['join_date']))?></td>
                                        </tr>

                                    </table>
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

</body>
</html>












