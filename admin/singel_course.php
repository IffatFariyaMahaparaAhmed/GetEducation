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

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 col-sm-12 mt-2">
                    <div class="card">
                        <div class="card-header">
                            <?php
                            //get course data
                                if (isset($_GET['course']))
                                {
                                    $course_id = $_GET['course'];
                                    $course = $connect->query("SELECT * FROM courses WHERE course_id = '$course_id'");
                                    $course_name = mysqli_fetch_assoc($course);
                                }
                            ?>
                            <h3><span class="text-info"><?php echo $course_name['course_name'];?></span> Details
                                <span class="float-right">
                                    <?php
                                    if ($course_name['course_status'] == '1')
                                    {
                                        echo "<span class='text-danger'>Paid Course</span>";
                                    }else{
                                        echo "<span class='text-success'>Free Course</span>";
                                    }
                                    ?>
                                </span>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="col-md-6 col-sm-12 float-left border-right">
                                <h3 class="text-center">Course File's</h3>
                                <br/>
                                <div id="accordion">
                                    <?php
                                    $get_file = $connect->query("SELECT * FROM course_files WHERE course_id = '$course_id'");

                                    $i = 1;
                                    while ($files = mysqli_fetch_assoc($get_file)){?>
                                        <div class="card">
                                            <div class="card-header" id="heading<?php echo $files['course_file_id']?>">
                                                <h5 class="mb-0 ">
                                                    <button class="btn btn-link text-decoration-none" data-toggle="collapse" data-target="#collapse<?php echo $files['course_file_id']?>" aria-expanded="true" aria-controls="collapseOne">
                                                        <span class="float-left"><?php echo $i++;?>. <?php echo $files['title']?></span>
                                                    </button>
                                                    <button class="btn btn-link text-decoration-none float-right" data-toggle="collapse" data-target="#collapse<?php echo $files['course_file_id']?>" aria-expanded="true" aria-controls="collapseOne">
                                                        <i class="fa fa-arrow-circle-down float-right"></i>
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="collapse<?php echo $files['course_file_id']?>" class="collapse" aria-labelledby="heading<?php echo $files['course_file_id']?>" data-parent="#accordion">
                                                <div class="card-body text-center">
                                                    <i class="fa fa-download text-info"></i> <a class="text-decoration-none" target="_blank" href="../upload_file/<?php echo $files['filename']?>"><?php echo $files['filename']?> </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }?>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 float-left">
                                <h3 class="text-center">Course Video's</h3>
                                <br/>
                                <div id="accordion_2">
                                    <?php
                                    $get_video = $connect->query("SELECT * FROM course_video WHERE course_id = '$course_id'");

                                    $i = 1;
                                    while ($videos = mysqli_fetch_assoc($get_video)){?>
                                        <div class="card">
                                            <div class="card-header" id="heading_vid<?php echo $videos['course_video_id']?>">
                                                <h5 class="mb-0 ">
                                                    <button class="btn btn-link text-decoration-none" data-toggle="collapse" data-target="#collapse_vid<?php echo $videos['course_video_id']?>" aria-expanded="true" aria-controls="collapseTow">
                                                        <span class="float-left"><?php echo $i++;?>. <?php echo $videos['title']?></span>
                                                    </button>
                                                    <button class="btn btn-link text-decoration-none float-right" data-toggle="collapse" data-target="#collapse_vid<?php echo $videos['course_video_id']?>" aria-expanded="true" aria-controls="collapseTow">
                                                        <i class="fa fa-arrow-circle-down float-right"></i>
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="collapse_vid<?php echo $videos['course_video_id']?>" class="collapse" aria-labelledby="heading_vid<?php echo $videos['course_video_id']?>" data-parent="#accordion_2">
                                                <div class="card-body text-center">
                                                    <i class="fa fa-play-circle text-info"></i> <a class="text-decoration-none" target="_blank" href="<?php echo $videos['location']?>"><?php echo $videos['name']?> </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="manage-course.php" class="btn btn-info float-right"><i class="fa fa-backward"></i> Back</a>
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
