<?php



    session_start();
    if (!isset($_SESSION['tutor'])){
        header('Location: ../index.php');
    }

    require_once '../php/db_connect.php';
    $sql = $connect->query("SELECT * FROM users WHERE email = '$_SESSION[tutor]'");

    $user_data = mysqli_fetch_assoc($sql);

    //file upload
    if (isset($_POST['add_file'])) //button name
    {
        $course_id = $_POST['course_id'];
        $title     = $_POST['title'];

        $filename = $_FILES['file1']['name']; //declare name

        //upload file
        if($filename != '')
        {
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $allowed = ['pdf', 'txt', 'doc', 'docx', 'pptx'];

            //check if file type is valid
            if (in_array($ext, $allowed))
            {
                // get last record id
                $sql = 'select max(course_file_id) as id from course_files';
                $result = mysqli_query($connect, $sql);
                if (count($result) > 0)
                {
                    $row = mysqli_fetch_array($result);
                    $filename = ($row['id']+1) . '-' . $filename;
                }
                else
                    $filename = '1' . '-' . $filename;

                //set target directory
                $path = '../upload_file/';

                $created = @date('Y-m-d H:i:s');
                move_uploaded_file($_FILES['file1']['tmp_name'],($path . $filename));

                // insert file details into database
                $sql = "INSERT INTO course_files(filename, created, user_id, course_id, title) VALUES ('$filename', '$created', '$user_data[user_id]', '$course_id', '$title')";
                mysqli_query($connect, $sql);

                $_SESSION['success'] = 'File Upload Successful';
                header("Location: upload-course-file.php");
            }
            else {
                $_SESSION['error'] = 'Invalid File Extension..! Select Only pdf, docx, doc, txt,pptx file';
                header("Location: upload-course-file.php");
            }
        }else{
            header("Location: upload-course-file.php");
        }
    }


    //upload viedo course

    if (isset($_POST['btn']))
    {
        $course = $_POST['course_id'];
        $title2 = $_POST['title'];
        $max_size = 57580122; //10 mb

        $name         = $_FILES['file'] ['name'];
        $target_dir   = "../upload_file/";
        $target_file  = $target_dir . $_FILES['file'] ['name'];


        $videoFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $extention_arr = array("mp4","avi","3gp","mov","mkv","mpeg");

        //check condition
        if (in_array($videoFileType, $extention_arr)){

            //checl file size
            if (($_FILES['file']['size'] >= $max_size) || ($_FILES['file'] ['size'] == 0)){
                $_SESSION['size'] = 'File too large. File must be less than 10MB';
                header("Location: upload-course-file.php");
            }else{
                if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)){
                    $query = "INSERT INTO course_video (course_id, name, location, tutor_id, title) VALUES ('$course','$name', '$target_file', '$user_data[user_id]', '$title2')";
                    mysqli_query($connect, $query);

                    $_SESSION['success'] = 'Upload Successful';
                    header("Location: upload-course-file.php");
                }
            }
        }else{
            $_SESSION['error'] = 'Invalid File Extension..! Select Only mp4,avi,3gp,mov,mkv,mpeg';
            header("Location: upload-course-file.php");;
        }

    }


    //add quiz

    if (isset($_POST['add_quiz']))
    {
        $quiz_course_id = $_POST['course_id'];
        $quiz_title     = $_POST['title'];
        $create         = date('Y-m-d');

        $create_course = $connect->query("INSERT INTO quiz_sub (course_id, user_id, title, status, create_time) VALUES ('$quiz_course_id', '$user_data[user_id]', '$quiz_title', '0', '$create')");

        if ($create_course){
            $_SESSION['success'] = 'New Quiz Create Success Full';
            header("Location: manage_quiz.php");
        }else{
            $_SESSION['error'] = 'New Quiz Create Failed...!';
            header("Location: manage_quiz.php");
        }
    }

    //add quiz qsn
    if (isset($_POST['qz'])){

        foreach ($_POST['qsn'] as $q_id => $qsn_status){
            $qsn_id       = $_POST['qsn_id'] [$q_id];
            $qsn          = $_POST['qsn'] [$q_id];
            $option_one   = $_POST['option_one'] [$q_id];
            $option_tow   = $_POST['option_tow'] [$q_id];
            $option_three = $_POST['option_three'] [$q_id];
            $option_four  = $_POST['option_four'] [$q_id];
            $ans          = $_POST['ans'] [$q_id];

            $add_qz_qsn = "INSERT INTO quiz_qsn (qsn_id, qsn, option_one, option_tow, option_three, option_four, ans) VALUES ('$qsn_id', '$qsn', '$option_one', '$option_tow', '$option_three', '$option_four', '$ans')";
            $result_qsn = mysqli_query($connect, $add_qz_qsn);

            if ($result_qsn) {
                $_SESSION['success'] = 'QuiZ Question Added Successful';

                echo "<script>document.location.href='add_qustion.php'</script>";
            } else {
                $_SESSION['error'] = 'QuiZ Question Added Failed';

                echo "<script>document.location.href='add_qustion.php'</script>";
            }
        }
    }