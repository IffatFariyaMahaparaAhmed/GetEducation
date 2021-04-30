<!-- Sidebar -->
<ul class="sidebar navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" target="_blank" href="../index.php">
            <i class="fa fa-home"></i>
            <span>Home</span>
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user" style="color: #005cbf;"></i>
            <span>Manage Profile</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="update_profile.php"><i class="fa fa-edit text-danger"></i> Update Profile</a>
            <a class="dropdown-item" href="change_password.php"><i class="fa fa-edit text-danger"></i>  Change Password</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-file" style="color: #BE4BDB;"></i>
            <span> Manage New Course</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="add-course.php"><i class="fas fa-plus" style="color: #007bff"></i> Create New Course</a>
            <a class="dropdown-item" href="manage-course.php"><i class="fa fa-edit text-danger"></i>  Manage Course</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-file-pdf" style="color: #1BBD36;"></i>
            <span> Manage Course File</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="upload-course-file.php"><i class="fas fa-upload" style="color: #007bff"></i> Upload File</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-book-open" style="color: #1BBD36;"></i>
            <span> Manage Quiz</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="manage_quiz.php"><i class="fas fa-edit" style="color: #007bff"></i> Manage Quiz</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-blog" style="color: red;"></i>
            <span>Discussion Forum</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="fourm_page.php"><i class="fa fa-newspaper text-info"></i> Discussion Forum</a>
            <a class="dropdown-item" href="fourm.php"><i class="fa fa-plus text-primary"></i> Post On Forum</a>
            <a class="dropdown-item" href="my_post.php"><i class="fa fa-edit text-danger"></i> My Post</a>

        </div>
    </li>
</ul>