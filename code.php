<?php
require 'fs_world.php';
if (isset($_POST['save_course'])) {
    $target_dir = "uploads/";
    //Validation for Course Image file.
    $course_file = basename($_FILES["cimage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($course_file, PATHINFO_EXTENSION));

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $reason = "only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["cimage"]["size"] > 2000000) {
        $reason = "your file is larger than 2 MB.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        $error1 = "Sorry, your course image was not uploaded because " . $reason;
        // if everything is ok, try to upload file
    } else {
        $courseimg = 'courseimg_' . strtotime(date('d-m-y H:i:s')) . "." . $imageFileType;
        $newpath = $target_dir . $courseimg;
        if (move_uploaded_file($_FILES["cimage"]["tmp_name"], $newpath)) {
            $error1 = '';
        } else {
            $error1 = "Sorry, there was an error uploading your course image file uploading.";
        }
    }

    //Validation for the banner image
    $banner_file = basename($_FILES["bannerimage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($banner_file, PATHINFO_EXTENSION));

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $reason = "only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["bannerimage"]["size"] > 2000000) {
        $reason = "your file is larger than 2 MB.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $error2 = "Sorry, your banner image was not uploaded because " . $reason;
        // if everything is ok, try to upload file
    } else {
        $banimage = 'bannerimg_' . strtotime(date('d-m-y H:i:s')) . "." . $imageFileType;
        $newpath2 = $target_dir . $banimage;
        if (move_uploaded_file($_FILES["bannerimage"]["tmp_name"], $newpath2)) {
            $error2 = '';
        } else {
            $error2 = "Sorry, there was an error uploading your banner image file uploading.";
        }

    }
    $cname = mysqli_real_escape_string($con, $_POST['cname']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $lessons = mysqli_real_escape_string($con, $_POST['lessons']);
    $students = mysqli_real_escape_string($con, $_POST['students']);
    $duration = mysqli_real_escape_string($con, $_POST['duration']);
    $instructor = mysqli_real_escape_string($con, $_POST['instructor']);
    ob_clean();
    if ($cname == NULL || $description == NULL || $lessons == NULL || $students == NULL || $duration == NULL || $instructor == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO courses (course_name,
    course_description,lessons,students, duration, instructor_id, course_image, course_banner_image) VALUES ('$cname','$description','$lessons','$students', '$duration', '$instructor', '$courseimg', '$banimage')";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Course Created Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Course Not Created'
        ];
        echo json_encode($res);
        return;
    }
}


if (isset($_POST['update_course'])) {

    $target_dir = "uploads/";
    //Validation for Course Image file.
    $course_file = basename($_FILES["cimage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($course_file, PATHINFO_EXTENSION));

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $reason = "only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["cimage"]["size"] > 2000000) {
        $reason = "your file is larger than 2 MB.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        $error1 = "Sorry, your course image was not uploaded because " . $reason;
        // if everything is ok, try to upload file
    } else {
        $courseimg = 'courseimg_' . strtotime(date('d-m-y H:i:s')) . "." . $imageFileType;
        $newpath = $target_dir . $courseimg;
        if (move_uploaded_file($_FILES["cimage"]["tmp_name"], $newpath)) {
            $error1 = '';
        } else {
            $error1 = "Sorry, there was an error uploading your course image file uploading.";
        }
    }

    //Validation for the banner image
    $banner_file = basename($_FILES["bannerimage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($banner_file, PATHINFO_EXTENSION));

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $reason = "only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["bannerimage"]["size"] > 2000000) {
        $reason = "your file is larger than 2 MB.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $error2 = "Sorry, your banner image was not uploaded because " . $reason;
        // if everything is ok, try to upload file
    } else {
        $banimage = 'bannerimg_' . strtotime(date('d-m-y H:i:s')) . "." . $imageFileType;
        $newpath2 = $target_dir . $banimage;
        if (move_uploaded_file($_FILES["bannerimage"]["tmp_name"], $newpath2)) {
            $error2 = '';
        } else {
            $error2 = "Sorry, there was an error uploading your banner image file uploading.";
        }

    }
    $course_id = mysqli_real_escape_string($con, $_POST['cid']);
    $cname = mysqli_real_escape_string($con, $_POST['cname']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $lessons = mysqli_real_escape_string($con, $_POST['lessons']);
    $students = mysqli_real_escape_string($con, $_POST['students']);
    $duration = mysqli_real_escape_string($con, $_POST['duration']);
    $instructor = mysqli_real_escape_string($con, $_POST['instructor']);

    if ($banimage == '') 
    $banimage = $_POST['old_bannerimage'];
    if ($courseimg == '')
        $courseimg = $_POST['c_oldimage'];

    ob_clean();
    if ($cname == NULL || $description == NULL || $lessons == NULL || $students == NULL || $duration == NULL || $instructor == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }



    $query = "UPDATE courses SET course_name='$cname', course_description='$description', lessons='$lessons', students='$students', duration='$duration', instructor_id='$instructor', course_image='$courseimg', course_banner_image='$banimage' 
                WHERE course_id='$course_id'";
    $query_run = mysqli_query($con, $query);
    ob_clean();
    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Course Updated Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Course Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


if (isset($_GET['course_id'])) {
    $course_id = mysqli_real_escape_string($con, $_GET['course_id']);

    $query = "SELECT * FROM courses WHERE course_id='$course_id'";
    $query_run = mysqli_query($con, $query);
    ob_clean();
    if (mysqli_num_rows($query_run) == 1) {
        $student = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Course Fetch Successfully by id',
            'data' => $student
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'Course Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['delete_student'])) {
    $course_id = mysqli_real_escape_string($con, $_POST['course_id']);

    $query = "DELETE FROM courses WHERE course_id='$course_id'";
    $query_run = mysqli_query($con, $query);
    ob_clean();
    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Course Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Course Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}


?>