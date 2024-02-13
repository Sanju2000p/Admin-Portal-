<?php
include_once "header.php";
require_once "fs_world.php";
$instructorQuery = "SELECT instructor_id, instructor_name FROM instructors";
$instructorResult = mysqli_query($connection, $instructorQuery);
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JavaScript -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Instructor</title>
    
</head>
<body>
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
              <h4 class="page-title m-b-0">Dashboard</h4>
            </li>
            <li class="breadcrumb-item">
              <a href="instructor_social_tags.php">
                <i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">Add Instructors Social Tags</li>
          </ul>
          <div class="section-body">
            <!-- add content here -->   
           <div class="row">
           <div class="col-12 col-md-6 col-lg-12">
           <div class="card">
                  <div class="card-header">
                  <h3>Add Instructors Social Tags</h3>
                  </div>
                  <div class="card-body">
            <form  id="MyForm"  method="POST" >
            <input type="hidden" class="form-control" id="instructor_social_tag_id" name="instructor_social_tag_id" value="">
            <div class="row">
            <div class="col">
            <div class="form-group">
    <label for="instructor_name">Instructor Name:</label>
    <select class="form-select form-control" name="instructor_name" id="instructor_name" required>
        <option value="">Select Instructor</option>
        <?php
        while ($row = mysqli_fetch_assoc($instructorResult)) {
            echo "<option value='{$row['instructor_name']}'>{$row['instructor_name']}</option>";
        }
        ?>
    </select>
</div></div>
                    <div class="col">
                    <div class="form-group">
                        <label for="instructor_social_tag_name">Instructor Social Tag Type:</label>
                        <input type="text"class="form-control"  id="instructor_social_tag_type" name="instructor_social_tag_type" >
                    </div></div></div>
                    <div class="row">
                        <div class="col-6">
                    <div class="form-group">   
                    <label for="instructor_social_tag_URL">Instructor Social Tag URL:</label>
                    <input type="text" class="form-control" id="instructor_social_tag_URL" name="instructor_social_tag_URL">
                    </div></div>
                    </div>
                        <button type="submit" name="submit" id="submit" style="float:right" class="btn btn-primary btn-md">Add Instructor Social Tag </button>
                  </div>           
                </div> 
    </div> 
            </div> 
          </div>
        </section>
        </form>
     
<div id="message"></div>

</div>




<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Include SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
   $(document).ready(function() {
        GetData(); 
    });


    $("#MyForm").submit(function(event){
        event.preventDefault();
        var instructor_social_tag_id = $('#instructor_social_tag_id').val();
        var instructor_name = $('#instructor_name').val();
        var instructor_social_tag_type = $('#instructor_social_tag_type').val();
        var instructor_social_tag_URL =$('#instructor_social_tag_URL').val();

        $.ajax({
            type: "POST",
            url: "../dashboard/AJAX/in_up_instructor_social_tags.php",
            data: {
                'instructor_social_tag_id': instructor_social_tag_id,
                'instructor_name': instructor_name,
                'instructor_social_tag_type': instructor_social_tag_type,
                'instructor_social_tag_URL': instructor_social_tag_URL
            },
            success: function(response) {
                console.log(response);
                if (response ==1) {
                    Swal.fire({
                        title: "Insert",
                        text: "Record inserted successfully!",
                        icon: "success"
                    });
                    $('#instructor_social_tag_id, #instructor_name, #instructor_social_tag_type, #instructor_social_tag_URL').val('');
                    GetData();
                } else if (response ==2) {
                    Swal.fire({
                        title: "Update",
                        text: "Record updated successfully!",
                        icon: "success"
                    });
                    $('#instructor_social_tag_id, #instructor_name, #instructor_social_tag_type, #instructor_social_tag_URL').val('');
                    GetData();
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!"
                    });
                }
            }
        });
    });

    function GetData() {
        $.ajax({
            type: 'GET',
            url: '../dashboard/AJAX/fetch_instructor_tags.php', 
            success: function(response) {
                $("#message").html(response); // Update the table content
            },
        });
    }

    function UpdateData(a, b, c, d) {
        $('#instructor_social_tag_id').val(a); 
        $('#instructor_name').val(b);
        $('#instructor_social_tag_type').val(c);
        $('#instructor_social_tag_URL').val(d);
    }

    function DeleteData(instructor_social_tags_id) {
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
                    url: "../dashboard/AJAX/delete_instructor_tag.php",
                    data: { action: "delete", 'instructor_social_tags_id': instructor_social_tags_id },
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
include_once "footer.php";
?>