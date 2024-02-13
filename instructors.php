<?php
require_once("header.php");
?>
<link rel="stylesheet" href="student.css">
<div class="main-content">
    <section class="section">
        <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
                <h4 class="page-title m-b-0">Instructors</h4>
            </li>
            <li class="breadcrumb-item">
                <a href="dashboard.html">
                <i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">Add Instructor</li>
        </ul>
        <div class="section-body">
            <!-- add content here -->

            <div class="row">
              <div class="col-12 col-md-6 col-lg-12">
              <div class="card">
    <div class="card-header">
        <h3>Instructor Details</h3>
    </div>
    <div class="card-body">
        <form id="MyForm" method="POST">
            <div class="row">
            <input type="hidden" class="form-control" id="instructor_id" name="instructor_id" value=""> 
            <div class=" col mb-3">
                <label for="instructor_name" class="form-label required">Instructor Name</label>
                <input type="text" class="form-control" id="instructor_name" name="instructor_name" value="" required>
            </div>
            <div class="col mb-3">
                <label for="instructor_profile_image" class="form-label required">Instructor Profile Image</label>
                <input type="file" class="form-control" id="instructor_profile_image" name="instructor_profile_image" accept="image/*" required>
            </div>
            </div>
            
            <div class="row">
            <div class=" col mb-3">
                <label for="instructor_designation" class="form-label required">Instructor Designation</label>
                <input type="text" class="form-control" id="instructor_designation" name="instructor_designation" value="" required>
            </div>
            
            <div class=" col mb-3">
                <label for="about_instructor" class="form-label required">About Instructor</label>
                <textarea class="form-control" id="about_instructor" name="about_instructor" required></textarea>
            </div></div>
            <button type="submit" class="btn btn-primary" id="saveInstructor" name="saveInstructor" style="float:right;">Submit</button>
        </form>
    </div>
</div>


            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h3>Instructors list</h3>
                  </div>
                  <div class="card-body" id="showData">
                  </div>
              </div>
            </div>

          </div>            
    </section>
</div>





<?php
require_once ("footer.php");
?>





<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>



$(document).ready(function () {
    GetData();
});

function refreshData() {
    GetData();
}

function showSuccessAlert(message) {
    Swal.fire({
        position: "center",
        icon: "success",
        title: "Successful",
        showConfirmButton: false,
        text: message,
        timer: 1500
    });
}

$("#MyForm").submit(function (event) {
    event.preventDefault();
    var formData = new FormData(this);
    var instructor_profile_image = $('#instructor_profile_image')[0].files[0];
    var fileName = instructor_profile_image.name;
    var allowedExtensions = /(\.jpg|\.png|\.svg)$/i;
    if (!allowedExtensions.exec(fileName)) {
      alert('Please upload a file with .jpg, .png, or .svg extension.');
      return false;
    }

    var instructor_id = $('#instructor_id').val();
    var instructor_name = $('#instructor_name').val();
    var about_instructor = $('#about_instructor').val();
    var instructor_designation = $('#instructor_designation').val();
    var instructor_profile_image = $('#instructor_profile_image')[0].files[0];

  
    $.ajax({
        type: "POST",
        url: "../dashboard/AJAX/in_up_instructors1.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            console.log(response);
            refreshData() 
            $("#MyForm")[0].reset();
            if (response.trim() === '1') {
                showSuccessAlert('Data inserted successfully!');
                var lastInsertedID = response.lastInsertedID;
                uploadProfileImage(lastInsertedID);
            } else if (response.trim() === '2') {
                showSuccessAlert('Data updated successfully!');
            }
           
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});


function GetData() {
    $.ajax({
        type: "GET",
        url: "../dashboard/AJAX/fetch_instructors.php",
        success: function(response) {
            $("#showData").html(response);
        }
    });
}

function updateData(instructor_id, instructor_name, about_instructor, instructor_designation,instructor_profile_image) {
    $('#instructor_id').val(instructor_id);
    $('#instructor_name').val(instructor_name);
    $('#about_instructor').val(about_instructor);
    $('#instructor_designation').val(instructor_designation);
    $('#instructor_profile_image').val(instructor_profile_image);
     
}

function DeleteData(instructor_id) {
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
                    url: "../dashboard/AJAX/delete_instructor.php",
                    data: { action: "delete", 'instructor_id': instructor_id },
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