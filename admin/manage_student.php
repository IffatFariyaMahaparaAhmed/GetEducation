<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 3/30/2021
 * Time: 4:21 PM
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
                <li class="breadcrumb-item active">Manage Student's</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 col-sm-12 mt-2">
                    <div class="card">
                        <div class="card-header">
                            <h3>Manage Student's </h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> Name</th>
                                        <th>Email</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>More</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    //get all active tutors
                                    $sql_get_tutor = $connect->query("SELECT * FROM users WHERE role = 'user'");

                                    $i = 1;

                                    while ($row = mysqli_fetch_assoc($sql_get_tutor)){?>
                                        <tr>
                                            <td><?php echo $i++;?></td>
                                            <td><?php echo $row['first_name'].' '.$row['last_name']?></td>
                                            <td><?php echo $row['email'];?></td>
                                            <td>
                                                <img src="../images/<?php echo $row['image'];?>" class="img-thumbnail" style="height: 70px; width: 100px">
                                            </td>
                                            <td>
                                                <?php
                                                $status = $row['status'];
                                                // echo $status;

                                                if (($status) == '0'){?>
                                                    <a href="student_status.php?status=<?php echo $row['user_id'];?>" class="text-decoration-none text-white btn btn-success" onclick="return confirm('Are You Sure To Block  <?php echo $row['first_name'];?>')" >Un-Block </a>
                                                    <?php
                                                }
                                                if (($status) == '1'){?>
                                                    <a href="student_status.php?status=<?php echo $row['user_id'];?>" class="text-decoration-none text-white btn btn-danger" onclick="return confirm('Are You Sure To Un-Block <?php echo $row['first_name'];?>')" > Block</a>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-info" href="student_profile.php?student=<?php echo $row['user_id']?>"><i class="fa fa-eye"></i> More</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
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
