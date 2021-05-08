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
                <li class="breadcrumb-item active">Manage Forum Post</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 col-sm-12 mt-2 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h3>Manage Forum Post</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="bootstrap-data-table" class="text-center table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> Post By </th>
                                        <th> Title</th>
                                        <th> Description </th>
                                        <th> Post Date </th>
                                        <th> Status </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    //get all active tutors
                                    $sql_get_tutor = $connect->query("SELECT * FROM users, discussion_forum WHERE discussion_forum.post_by = users.user_id");

                                    $i = 1;

                                    while ($row = mysqli_fetch_assoc($sql_get_tutor)){?>
                                        <tr>
                                            <td><?php echo $i++;?></td>
                                            <td class="text-capitalize"><?php echo $row['first_name'].' '.$row['last_name']?></td>
                                            <td><?php echo $row['title'];?></td>
                                            <td>
                                                <a href='#description' data-toggle='modal' class='btn btn-primary btn-sm btn-flat desc' data-id='<?php echo $row['forum_id'];?>'><i class='fa fa-eye'></i> View</a>
                                            </td>
                                            <td>
                                                <?php echo $row['post_date'];?>
                                            </td>
                                            <td>
                                                <?php
                                                $status = $row['status'];
                                                // echo $status;

                                                if (($status) == '0'){?>
                                                    <a href="forum_status.php?status=<?php echo $row['forum_id'];?>" class="text-decoration-none text-white btn btn-success" onclick="return confirm('Are You Sure To Un-Post')" >Post </a>
                                                    <?php
                                                }
                                                if (($status) == '1'){?>
                                                    <a href="forum_status.php?status=<?php echo $row['forum_id'];?>" class="text-decoration-none text-white btn btn-danger" onclick="return confirm('Are You Sure To Post Now')" > Pending</a>
                                                    <?php
                                                }
                                                ?>
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
<!-- Description -->

<div class="modal fade" id="description" tabindex="-1" role="dialog" aria-labelledby="formModal"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">  Description</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="desc" class="text-justify"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).on('click', '.desc', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        getRow(id);
    });


    function getRow(id){
        $.ajax({
            type: 'POST',
            url: 'view_description.php',
            data: {forum_id:id},
            dataType: 'json',
            success: function(response){
                $('.forum_id').val(response.forum_id);
                $('#desc').html(response.description);

            }
        });
    }
</script>
</body>
</html>
