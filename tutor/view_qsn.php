<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 3/24/2021
 * Time: 10:53 PM
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
                <li class="breadcrumb-item active">View Quiz Question</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-10 mx-auto mt-2 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h3>View Quiz Question</h3>
                            <?php
                            $i = 1;
                            if (isset($_GET['qsn'])){
                                $id  = $_GET['qsn'];

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
                                        A. <input type="radio" name="option" value="<?php echo $data['option_one']?>"> <?php echo $data['option_one']?> <br/>
                                        B. <input type="radio" name="option" value="<?php echo $data['option_tow']?>"> <?php echo $data['option_tow']?> <br/>
                                        C. <input type="radio" name="option" value="<?php echo $data['option_tow']?>"> <?php echo $data['option_three']?> <br/>
                                        D. <input type="radio" name="option" value="<?php echo $data['option_tow']?>"> <?php echo $data['option_four']?>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-success">Correct Answer:   <?php echo $data['ans']?></label>
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

