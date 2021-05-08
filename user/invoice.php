<?php

?>
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
                <li class="breadcrumb-item active">Your Invoice</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 mx-auto float-left mt-4 mb-5">
                    <div class="card" style="border-top: 3px solid greenyellow">
                        <div class="card-header">
                            <?php
                            if (isset($_GET['invoice'])){
                                $invoice = $_GET['invoice'];

                                $i = 1;
                                $sql1 = "SELECT * FROM users, enroll_course,courses WHERE enroll_course.user_id = users.user_id AND enroll_course.course_id = courses.course_id AND enroll_course.enroll_id = '$invoice'";
                                $res1 = mysqli_query($connect, $sql1);
                                $data1 = mysqli_fetch_assoc($res1);
                            }
                            ?>
                            <h3 class="text-capitalize text-dark"> Invoice Number : #GetEdu_<?php echo $data1['enroll_id'];?></h3>
                        </div>
                        <div class="card-body" id="mainFrame">
                            <div class="col-md-12">
                                <div class="order_history mt-3 mb-5">
                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <address>
                                            <strong>Billed To:</strong><br>
                                            <span class="text-capitalize"><?php echo $user_data['first_name']. ' '.$user_data['last_name'];?></span><br>
                                            <?php echo $user_data['phone'];?><br>
                                        </address>
                                    </div>
                                    <div class="col-md-6 text-md-right">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <address>
                                            <strong>Payment Method: </strong><br>
                                            Payment By: <span class="font-weight-bold"><?php echo $data1['payment_by'];?></span><br/>
                                            Account Number: <span class="font-weight-bold"> <?php echo $data1['bkas_number'];?></span>
                                            <br>
                                            <?php echo $user_data['email'];?><br>
                                        </address>
                                    </div>
                                    <div class="col-md-6 text-md-right">
                                        <address>
                                            <strong>Payment Date:</strong><br>
                                            <?php echo $data1['buy_date'];?><br><br><br>
                                        </address>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="section-title">Order Summary</div>
                                        <p class="section-lead">All items here cannot be deleted.</p>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover table-md">
                                                <tr>
                                                    <th data-width="40">#</th>
                                                    <th class="text-center">Course Name</th>
                                                    <th class="text-center">Course Code</th>
                                                    <th class="text-center">Price</th>
                                                </tr>
                                                    <tr>
                                                        <td class="text-center"><?php echo $i++;?></td>
                                                        <td class="text-center"><?php echo $data1['course_name'];?></td>
                                                        <td class="text-center"><?php echo $data1['course_code'];?></td>
                                                        <td class="text-center"><?php echo number_format($data1['course_price'], '2');?> T.K</td>
                                                    </tr>
                                            </table>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-lg-8">
                                            </div>
                                            <div class="col-lg-4 ">
                                                <hr class="mt-2 mb-2">
                                                <div class="invoice-detail-item">
                                                    <div class="invoice-detail-value invoice-detail-value-lg">Total : <span class="ml-5"><span class="ml-5">
                                                              <?php echo number_format($data1['course_price'], '2');?> T.K </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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


