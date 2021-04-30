<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 4/9/2021
 * Time: 3:59 PM
 */

include "front/header.php"; ?>

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
                <li class="breadcrumb-item active">Manage Public Message's</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 col-sm-12 mt-2">
                    <div class="card">
                        <div class="card-header">
                            <h3>Manage Public Message</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    //get all Public message
                                    $sql_get_tutor = $connect->query("SELECT * FROM public_msg");

                                    $i = 1;

                                    while ($row = mysqli_fetch_assoc($sql_get_tutor)){?>
                                        <tr>
                                            <td><?php echo $i++;?></td>
                                            <td><?php echo $row['name']?></td>
                                            <td><?php echo $row['email'];?></td>
                                            <td><?php echo $row['phone'];?></td>
                                            <td style="width: 30%"><?php echo $row['message'];?></td>
                                            <td><?php echo $row['date'];?></td>
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
