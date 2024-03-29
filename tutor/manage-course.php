<?php

?>

<?php include "front/header.php"; ?>

<body id="page-top">

<?php include "front/nav.php"; ?>


<div id="wrapper">
    <?php include "front/sidebar.php"; ?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Manage Courses</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 col-sm-12 mt-2 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h3>Manage Courses <a class="btn btn-info float-right" href="add-course.php"><i
                                            class="fa fa-plus"></i> Add New Course</a></h3>
                        </div>
                        <div class="card-body">
                            <div class="p-2">
                                <?php
                                if (isset($_SESSION['error'])) {
                                    echo "
                                    <div class='alert alert-danger alert-dismissible' id='error' style='background-color: red; color: white'>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        <span><i class='fas fa-exclamation-triangle'></i></span> " . $_SESSION['error'] . "
                                    </div>
                                    ";
                                    unset($_SESSION['error']);
                                }
                                if (isset($_SESSION['success'])) {
                                    echo "
                                    <div class='alert alert-success alert-dismissible'>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        <h6><i class='icon fa fa-check'></i> Success!</h6>" . $_SESSION['success'] . "
                                    </div>
                                    ";
                                    unset($_SESSION['success']);
                                }
                                ?>
                            </div>

                            <div class="table-responsive">
                                <table id="bootstrap-data-table" class="text-center table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Course Name</th>
                                        <th>Course Status</th>
                                        <th>Course Price</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    //get all courses
                                    $sql_get_course = $connect->query("SELECT * FROM courses WHERE user_id = '$user_data[user_id]'");

                                    $i = 1;

                                    while ($row = mysqli_fetch_assoc($sql_get_course)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $row['course_name'] ?></td>
                                            <td>
                                                <?php
                                                $status = $row['course_status'];
                                                // echo $status;

                                                if (($status) == '0') {
                                                    ?>
                                                    <button class="btn btn-primary">Free</button>
                                                    <?php
                                                }
                                                if (($status) == '1') {
                                                    ?>
                                                    <button class="btn btn-info">Paid</button>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($row['course_status'] == '1') {

                                                    if ($row['course_price'] == true) {
                                                        echo number_format($row['course_price'], 2);

                                                    } else {
                                                        ?>
                                                        <a href='#description' data-toggle='modal'
                                                           class='btn btn-success btn-flat desc'
                                                           data-id='<?php echo $row['course_id']; ?>'><i
                                                                    class='fa fa-plus'></i> Add Course Fee</a>
                                                    <?php }

                                                } else {
                                                    echo "<span class='text-success'>Free Course</span>";
                                                }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <a href='#edit' data-toggle='modal' class='btn btn-info btn-flat edit'
                                                   data-id='<?php echo $row['course_id']; ?>'><i class='fa fa-edit'></i>
                                                    Edit</a> |
                                                <a class="btn btn-danger"
                                                   href="delete.php?course=<?php echo $row['course_id']; ?>"
                                                   onclick="return confirm('Are You Sure To Delete..!')"><i
                                                            class="fa fa-trash"></i> Delete</a>
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
        <?php include "front/sub_footer.php"; ?>
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->


<?php include "front/footer.php"; ?>
<!--edit-->


</body>
</html>
<!-- Description -->

<div class="modal fade" id="description" tabindex="-1" role="dialog" aria-labelledby="formModal"
     aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal"> Add Course Price</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="update_query.php" method="post">
                    <div class="form-group">
                        <input type="hidden" class="course_id" name="course_id">
                        <label class="font-weight-bold">Course Fee</label>
                        <input type="text" class="form-control" placeholder="Enter Course Fee" name="course_price"
                               id="course_price">
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <label class="p-2"></label>
                            <button type="submit" class="btn btn-primary btn-flat btn-block" name="add_price"><i
                                        class="fa fa-save"></i> Add Course Fee
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-flat pull-left" data-dismiss="modal"><i
                            class="fa fa-close"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>


<!--update -->
<div class="modal fade  bd-example-modal-lg" id="edit" tabindex="-1" role="dialog" aria-labelledby="formModal"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Update Course Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="update_query.php" method="post">
                    <div class="form-group">
                        <input type="hidden" class="course_id" name="course_id">
                        <label class="font-weight-bold">Course Name</label>
                        <input type="text" class="form-control" placeholder="Enter Course Name" name="course_name"
                               id="course_name">
                    </div>
                    <div class="form-group">
                        <label>Course Status <sup class="text-danger font-weight-bold">*</sup></label>
                        <select name="course_status" class="form-control" id="course_status"
                                onchange="checkSelectedIndex(this)">
                            <option value="0">Free Course</option>
                            <option value="1">Paid Course</option>
                        </select>
                    </div>
                    <div class="form-group" style="display: none;" id="course_price_input">
                        <input type="hidden" class="course_id" name="course_id">
                        <label class="font-weight-bold">Course Fee</label>
                        <input type="text" class="form-control" placeholder="Enter Course Fee" name="course_price"
                               id="course_price_update">
                    </div>
                    <div class="form-group">
                        <label>Course Image <sup class="text-danger font-weight-bold">*</sup></label>
                        <input type="file" name="course_image" class="form-control" accept=".jpeg,.jpg,.png"
                               onchange="previewFile(this);">
                        <img src="" class="mt-2" id="course_image_display" height="100px" width="100px">
                    </div>

                    <div class="form-group">
                        <label>Course Description <sup class="text-danger font-weight-bold">*</sup></label>
                        <textarea name="course_description" id="application" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <button type="submit" class="btn btn-primary col-6" name="update_course"><i
                                        class="fa fa-save"></i> Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-flat pull-left" data-dismiss="modal"><i
                            class="fa fa-close"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>
<script src="js/checkeditor.js"></script>
<!-- Demo scripts for this page-->
<script>
    CKEDITOR.replace('application',
        {
            height: 300,
            resize_enabled: true,
            wordcount: {
                showParagraphs: false,
                showWordCount: true,
                showCharCount: true,
                countSpacesAsChars: true,
                countHTML: false,

                maxCharCount: 20
            }
        });
</script>
<script>
    $(document).on('click', '.desc', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        getRow(id);
    });

    $(document).on('click', '.edit', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        getRow(id);
    });

    function getRow(id) {
        $.ajax({
            type: 'POST',
            url: 'update_query.php',
            data: {course_id: id},
            dataType: 'json',
            success: function (response) {
                $('.course_id').val(response.course_id);
                $('#course_name').val(response.course_name);
                $('#course_price_update').html(response.course_price);
                // $('#application').val(response.course_description);
                $("#course_image_display").attr("src", 'http://localhost/GetEducation/images/' + response.course_image);
                CKEDITOR.instances["application"].setData(response.course_description)
                $('#course_status').prop('selectedIndex', response.course_status);
                checkSelectedIndex();
            }
        });
    }

    function previewFile(input) {
        var file = $("input[type=file]").get(0).files[0];

        if (file) {
            var reader = new FileReader();

            reader.onload = function () {
                $("#course_image_display").attr("src", reader.result);
            }

            reader.readAsDataURL(file);
        }
    }

    function checkSelectedIndex() {
        if ($("#course_status option:selected").index() == 1) {
            document.getElementById("course_price_input").style.display = 'block';

        } else {
            document.getElementById("course_price_input").style.display = 'none';
            $('#course_price_update').html('');

        }
    }
</script>
