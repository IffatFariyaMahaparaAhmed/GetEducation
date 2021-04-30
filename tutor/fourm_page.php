
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
                <li class="breadcrumb-item active">Discussion Forum</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div>

                    <?php
                    $limit = 8;
                    if (isset($_GET["page"])) {
                        $page  = $_GET["page"];
                    }
                    else{
                        $page=1;
                    };
                    $start_from = ($page-1) * $limit;

                    $sql = $connect->query("SELECT * FROM users, discussion_forum WHERE discussion_forum.post_by = users.user_id ORDER BY forum_id ASC LIMIT $start_from, $limit");

                    while ($row = mysqli_fetch_assoc($sql)){?>
                        <div class="col-md-6 col-sm-12 mt-5 float-left">
                            <div class="card" style="height: 400px;">
                                <div class="card-body">
                                    <h4 class="font-weight-bold"><a href="full_fourm.php?forum=<?php echo $row['forum_id'];?>" class="text-decoration-none"><?php echo $row['title']?></a></h4>
                                    <div class="font-italic p-2">
                                        <p class="text-capitalize"><i class="fa fa-user" style="color: blue;"> Post By : </i> <?php echo $row['first_name'].' '.$row['last_name'];?> <span class="float-right" style="color: blue;"><i class="fa fa-calendar"></i> Post Date: <span class="text-dark"><?php echo @date('d-M-Y', strtotime($row['post_date']))?></span></span></p>
                                    </div>

                                    <div class="p-2">
                                        <p class="text-justify">
                                            <?php
                                                $forum_id = $row['forum_id'];
                                                $desc = $row['description'];
                                                $strcut = substr($desc,0,400);
                                                $desc = substr($strcut, 0, strrpos($strcut, ' ')).'....'.'<a href="full_fourm.php?forum='.$forum_id.'" class="text-decoration-none">Read More</a>';
                                                echo $desc;
                                            ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <?php
                                    //check user login or not and get total like
                                    if (!isset($_SESSION['tutor'])){
                                        echo "<a href='like_unlike.php?like=$row[forum_id]'><button type='button'  name='like' class='btn btn-success btn-sm'><i class='fas fa-thumbs-up'></i></button></a>";
                                        $sql_like_1 = "SELECT like_unlike, SUM(like_unlike) as TotaLike_1 FROM fourm_like_unlike WHERE fourm_like_unlike.fourm_id = $row[forum_id]";
                                        $res_like_1 = mysqli_query($connect, $sql_like_1);

                                        $totla_like_1 = mysqli_fetch_assoc($res_like_1);

                                        if ($totla_like_1['TotaLike_1'] == 0) {
                                            echo "<span> 0 Like</span>";
                                        } else {
                                            echo "<span> $totla_like_1[TotaLike_1] Like</span>";
                                        }

                                    }else {
                                        //get total like
                                        $like_unlike = "SELECT * FROM fourm_like_unlike, users, discussion_forum WHERE 
                                                                fourm_like_unlike.fourm_id = '$row[forum_id]' AND 
                                                                fourm_like_unlike.user_id = $user_data[user_id]";

                                        $res_like_unlike = mysqli_query($connect, $like_unlike);

                                        $count = mysqli_fetch_assoc($res_like_unlike);

                                        if ($count == true) {
                                            if ($count['like_unlike'] == '0') {
                                                echo "<a href='like_unlike.php?unlike_up=$row[forum_id]'><button type='button'  name='like' class='btn btn-success btn-sm'><i class='fas fa-thumbs-up'></i></button></a>";
                                            } else {
                                                echo "<a href='like_unlike.php?unlike=$row[forum_id]'><button type='button'  name='like' class='btn btn-success btn-sm'><i class='fas fa-thumbs-down'></i></button></a>";
                                            }
                                        } elseif ($count !== true) {
                                            echo "<a href='like_unlike.php?like=$row[forum_id]'><button type='button'  name='like' class='btn btn-success btn-sm'><i class='fas fa-thumbs-up'></i></button></a>";
                                        }


                                        $sql_like = "SELECT like_unlike, SUM(like_unlike) as TotaLike FROM fourm_like_unlike WHERE fourm_like_unlike.fourm_id = $row[forum_id]";
                                        $res_like = mysqli_query($connect, $sql_like);

                                        $totla_like = mysqli_fetch_assoc($res_like);

                                        if ($totla_like['TotaLike'] == 0) {
                                            echo "<span> 0 Like</span>";
                                        } else {
                                            echo "<span> $totla_like[TotaLike] Like</span>";
                                        }

                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php }?>



                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 mt-5 mx-auto">
                            <?php
                                $result_db = mysqli_query($connect,"SELECT COUNT(forum_id) FROM discussion_forum");
                                $row_db = mysqli_fetch_row($result_db);
                                $total_records = $row_db[0];
                                $total_pages = ceil($total_records / $limit);
                                /* echo  $total_pages; */
                                $pagLink = "<ul class='pagination'>";
                                for ($i=1; $i<=$total_pages; $i++) {
                                    $pagLink .= "<li class='page-item'><a class='page-link' href='fourm_page.php?page=".$i."'>".$i."</a></li>";
                                }
                                echo $pagLink . "</ul>";
                            ?>
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
