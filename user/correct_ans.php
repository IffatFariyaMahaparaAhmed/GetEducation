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
                <li class="breadcrumb-item active">View Quiz Question Answer's</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 mx-auto mt-2 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h3>View Quiz Question Answer's</h3>
                            <?php
                            $i = 1;
                            if (isset($_GET['correct_ans'])){
                                $id  = $_GET['correct_ans'];

                                $sql = "SELECT * FROM quiz_qsn WHERE qsn_id = '$id' ";
                                $result = mysqli_query($connect, $sql);

                            }
                            ?>
                        </div>
                        <div class="card-body">

                            <div class="ml-4">
                                <?php while ($data = mysqli_fetch_assoc($result)){?>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Question <?php echo $i++;?>: <?php echo $data['qsn'];?> </label>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                            if ($data['option_one'] == $data['ans']){
                                                echo " A. <label class='text-success'> $data[option_one]</label> <br/>";
                                            }else{
                                                echo " A. <label> $data[option_one]</label> <br/>";
                                            }

                                            if ($data['option_tow'] == $data['ans']){
                                                echo " B. <label class='text-success'> $data[option_tow]</label> <br/>";
                                            }else{
                                                echo " B. <label> $data[option_tow]</label> <br/>";
                                            }


                                            if ($data['option_three'] == $data['ans']){
                                                echo " C. <label class='text-success'> $data[option_three]</label> <br/>";
                                            }else{
                                                echo " C. <label> $data[option_three]</label> <br/>";
                                            }

                                            if ($data['option_four'] == $data['ans']){
                                                echo " D. <label class='text-success'> $data[option_four]</label> <br/>";
                                            }else{
                                                echo " D. <label> $data[option_four]</label> <br/>";
                                            }
                                        ?>
                                    </div>
                                <?php }?>
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

