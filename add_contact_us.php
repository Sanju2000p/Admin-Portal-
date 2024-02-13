<?php
require_once "fs_world.php";
require_once "header.php";
?>


  <div class="main-content">
    <section class="section">
      <ul class="breadcrumb breadcrumb-style ">
        <li class="breadcrumb-item">
          <h4 class="page-title m-b-0">Dashboard</h4>
        </li>
        <li class="breadcrumb-item">
          <a href="reach_us.php">
           <i data-feather="home"></i></a>
        </li>
        <li class="breadcrumb-item">Reach Us</li>
      </ul>
      <div class="section-body">
        <div class="row">
          <div class="col-12 col-md-6 col-lg-12">
            <div class="card">
              <div class="card-header">
                <h5>Contact Us</h5>
              </div>
              <div class="card-body">
              <form id="reachus" method="POST">
              <input type="hidden" class="form-control" id="contact_id" name="contact_id" value="">
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label for="contact_name">Contact Name</label>
                      <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Enter Contact Name" required>
                  </div> </div>
                  <div class="col">
                    <div class="form-group">
                      <label for="contact_email">Contact Email</label>
                      <input type="email" class="form-control" id="contact_email" name="contact_email" placeholder="Enter Contact Email" required>
                </div> </div> </div>
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label for="contact_subject">Contact Subject</label>
                      <textarea type="text" class="form-control" id="contact_subject" name="contact_subject" rows="2" placeholder="Enter Contact Subject" required></textarea> 
                  </div> </div>
                  <div class="col">
                    <div class="form-group">  
                      <label for="contact_message">Contact Message</label>
                      <textarea type="text" class="form-control" name="contact_message" id="contact_message" rows="4" placeholder="Enter Contact Message" required></textarea> 
                  </div> </div> 
                  <div class="col">
                    <div class="form-group">
                      <label for="email_headers">Email Headers</label>
                      <textarea type="text" class="form-control" id="email_headers" name="email_headers" rows="2" placeholder="Enter Email Headers" required></textarea>
                </div> </div> </div>
                <div class="row">
                <div class="col">
                  <div class="form-group">
                    <button type="submit" name="submit" id="submit" class="btn btn-primary btn-md" style="float: right">Submit</button>
                </div> </div> </div>
                </form>
              </div>
      </div> 
</div>
    </section>

<div id="showData"></div>
</div>
    <?php
require_once "footer.php";
?> 



<script>
  $(document).ready(function() {
    GetData();
  }); 

  $("#reachus").submit(function(event){
    event.preventDefault();
    var contact_id = $('#contact_id').val();
    var contact_name = $('#contact_name').val();
    var contact_email = $('#contact_email').val();
    var contact_subject = $('#contact_subject').val();
    var contact_message = $('#contact_message').val();
    var email_headers = $('#email_headers').val();
    $.ajax({
      type: "POST",
      url: "../dashboard/AJAX/in_up_contact_us.php",
      data: {
        'contact_id': contact_id, 
        'contact_name': contact_name, 
        'contact_email': contact_email, 
        'contact_subject': contact_subject,
        'contact_message': contact_message,
        'email_headers': email_headers
      },
      success: function(response) {
          console.log(response);
          if(response==1){
          Swal.fire({
              title: "Insert",
              text: "You clicked the button!",
              icon: "success"
            });
            $('#contact_name').val('');
            $('#contact_email').val('');
            $('#contact_subject').val('');
            $('#contact_message').val('');
            $('#email_headers').val('');
            GetData();
          }
          if(response==2){
            Swal.fire({
                title: "Update",
                text: "You clicked the button!",
                icon: "success"
              });
              $('#contact_name').val('');
              $('#contact_email').val('');
              $('#contact_subject').val('');
              $('#contact_message').val('');
              $('#email_headers').val('');
              GetData();
            }
            if(response==0){
              Swal.fire({
                  icon: "error",
                  title: "Oops...",
                  text: "Something went wrong!"
                });
            }
        }
    });
});

function GetData(){
    $.ajax({
        type: "GET",
        url: "../dashboard/AJAX/fetch_contact_us.php",
        success: function(response) {
            $("#showData").html(response);
        }
    });
}

function UpdateData(a,b,c,d,e,f){
    $('#contact_id').val(a);
    $('#contact_name').val(b); 
    $('#contact_email').val(c);
    $('#contact_subject').val(d);
    $('#contact_message').val(e);
    $('#email_headers').val(f);
}

function DeleteData(contact_id) {
  Swal.fire({
      title: 'Are you sure?',
      text: 'You won\'t be able to revert this!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
      if (result.isConfirmed) {
          $.ajax({
              type: "POST",
              url: "../dashboard/AJAX/delete_contact_us.php",
              data: { action: "delete", 'contact_id': contact_id },
              success: function (response) {
                  console.log(response);
                  Swal.fire(
                      'Deleted!',
                      'Your record has been deleted.',
                      'success'
                  );
                  GetData();
              },
              error: function () {
                  Swal.fire(
                      'Error!',
                      'There was an error deleting the record.',
                      'error'
                  );
              }
          });
      }
  });
}
</script>

 


<?php
require_once("fs_world.php");

$instructorQuery = "SELECT course_id FROM courses";
$instructorResult = mysqli_query($connection, $instructorQuery);

$target_coursedir = "C:/xampp/htdocs/FS_WORLD_ADMIN/dashboard/AJAX/course_images/";
$target_bannerdir = "C:/xampp/htdocs/FS_WORLD_ADMIN/dashboard/AJAX/banner_images/";
$target_sharedir = "C:/xampp/htdocs/FS_WORLD_ADMIN/dashboard/AJAX/shared_images/";

function generateFileName($course_id, $file_extension) {
    return $course_id . "." . $file_extension;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Solg = 0;
    $id = $_POST["id"];
    $cname = $_POST["cname"];
    $description = $_POST["description"];
    $duration = $_POST["duration"];
    $projects = $_POST["projects"];
    $instructor = $_POST["instructor"];
    $courseID = $id;


    // Retrieve the course_id from courses table
    $courseIDQuery = "SELECT MAX(course_id) AS max_id FROM courses";
    $courseIDResult = mysqli_query($connection, $courseIDQuery);
    $row = mysqli_fetch_assoc($courseIDResult);
    $courseID = $row['max_id'] + 1;

    // Process Course Image
    $course_file = $_FILES["cimage"]["name"];
    $course_extension = pathinfo($course_file, PATHINFO_EXTENSION);
    $courseimg = generateFileName($courseID, $course_extension);
    $newpath_course = $target_coursedir . $courseimg;

    if (move_uploaded_file($_FILES["cimage"]["tmp_name"], $newpath_course)) {
        // Image uploaded successfully
        $error1 = '';
    } else {
        // Error in uploading image
        $error1 = "Sorry, there was an error uploading your course image file.";
    }

    // Process Banner Image
    $banner_file = $_FILES["bannerimage"]["name"];
    $banner_extension = pathinfo($banner_file, PATHINFO_EXTENSION);
    $banimage = generateFileName($courseID, $banner_extension);
    $newpath_banner = $target_bannerdir . $banimage;

    if (move_uploaded_file($_FILES["bannerimage"]["tmp_name"], $newpath_banner)) {
        // Image uploaded successfully
        $error2 = '';
    } else {
        // Error in uploading image
        $error2 = "Sorry, there was an error uploading your banner image file.";
    }

    // Process Shared Image
    $shared_file = $_FILES["sharedimage"]["name"];
    $shared_extension = pathinfo($shared_file, PATHINFO_EXTENSION);
    $sharedimage = generateFileName($courseID, $shared_extension);
    $newpath_shared = $target_sharedir . $sharedimage;

    if (move_uploaded_file($_FILES["sharedimage"]["tmp_name"], $newpath_shared)) {
        // Image uploaded successfully
        $error3 = '';
    } else {
        // Error in uploading image
        $error3 = "Sorry, there was an error uploading your shared image file.";
    }

    // Assign old image paths if the uploaded image paths are empty
    if ($courseimg == '') {
        $courseimg = $_POST['old_cmage'];
    }
    if ($banimage == '') {
        $banimage = $_POST['old_bannerimage'];
    }
    if ($sharedimage == '') {
        $sharedimage = $_POST['old_shareimage'];
    }
             
    if ($cname != '') {
        if ($id != '') {
            $UpdateData = mysqli_query($connection, "UPDATE courses SET course_name='$cname', course_description='$description', projects='$projects', duration='$duration', instructor_id='$instructor', course_image='$courseimg', course_banner_image='$banimage', course_share_image='$sharedimage' WHERE status='1' AND course_id='$id'") or die(mysqli_error($connection));
            ob_clean();
            if ($UpdateData) {
                $Solg = 2;
            }
        } else {
            $InsertData = mysqli_query($connection, "INSERT INTO courses (course_name, course_description, projects, duration, instructor_id, course_image, course_banner_image, course_share_image) VALUES ('$cname', '$description', '$projects', '$duration', '$instructor', '$courseimg', '$banimage', '$sharedimage')") or die(mysqli_error($connection));
            ob_clean();
            if ($InsertData) {
                $Solg = 1;
            }
        }
    } else {
        $Solg = 0;
    }
    echo $Solg;
}
?>
