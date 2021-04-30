
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
                <li class="breadcrumb-item active">Manage Tutor's</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 col-sm-12 mt-2">
                    <div class="card">
                        <div class="card-header">
                            <h3>Manage Tutor's <span class="float-right"><a href="new_tutor.php" class="text-decoration-none">New Register Tutor <sup class="text-danger font-weight-bold">
                                          <?php
                                          //get number of new register tutor

                                          $count = 0;
                                          $sql2 = "SELECT * FROM users WHERE status = 1 AND role = 'tutor'";
                                          $result = mysqli_query($connect, $sql2);
                                          $count = mysqli_num_rows($result);
                                          ?>
                                          <?php if($count>0) { echo $count; } ?>
                                      </sup></a>
                              </span></h3>
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
                                        <th>CV</th>
                                        <th>Approve</th>
                                        <th>More</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    //get all active tutors
                                    $sql_get_tutor = $connect->query("SELECT * FROM users WHERE role = 'tutor' AND approve = '1'");

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
                                                <a target="_blank" href="../upload_file/<?php echo $row['education_certificate'];?>"> <i class="fa fa-download"></i> <?php echo $row['education_certificate'];?> </a>
                                            </td>
                                            <td>
                                                <?php
                                                $status = $row['approve'];
                                                // echo $status;

                                                if (($status) == '0'){?>
                                                    <a href="approve.php?status=<?php echo $row['user_id'];?>" class="text-decoration-none text-white btn btn-success" onclick="return confirm('Are You Sure To Not Approve  <?php echo $row['first_name'];?>')" >Approve </a>
                                                    <?php
                                                }
                                                if (($status) == '1'){?>
                                                    <a href="approve.php?status=<?php echo $row['user_id'];?>" class="text-decoration-none text-white btn btn-danger" onclick="return confirm('Are You Sure To Approve <?php echo $row['first_name'];?>')" > Not Approve</a>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-info" href="tutor_profile.php?tutor=<?php echo $row['user_id']?>"><i class="fa fa-eye"></i> More</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a class="float-right btn btn-info" href="manage-tutor.php">Manage Tutor's</a>
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
