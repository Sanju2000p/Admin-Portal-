<?php
require_once "fs_world.php";
?>
<?php
require_once ("header.php");
?>

<div class="main-content">
    <section class="section">
        <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
                <h4 class="page-title m-b-0">Dashboard</h4>
            </li>
            <li class="breadcrumb-item">
                <a href="dashboard.html">
                <i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">Dashboard</li>
        </ul>
        <div class="section-body">
            <!-- add content here -->

            <div class="row">
              <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h3>Technologies Form</h3>
                  </div>
                  <div class="card-body">
                    <form id="MyForm" method="POST">
                        <input type="hidden" class="form-control" id="technology_id" name="technology_id" value="">
                            <div class="row">
                                <div class="form-group">
                                    <label for="technology">Technology Name</label>                                   
                                     <div class="form-group">
                                        <input type="text" class="form-control" id="technology_name" name="technology_name">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" id="submit" name="submit">Submit</button> 
                    </form>
                  </div>
              </div>
            </div>

            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h3>Technolgies Table</h3>
                  </div>
                  <div class="card-body" id="showData">
                  </div>
              </div>
            </div>

          </div>            
    </section>



    

<script>
    $(document).ready(function() {
    GetData();
    });


    $("#MyForm").submit(function(event) {
    event.preventDefault(); // Prevent default form submission behavior

    var technology_name = $('#technology_name').val(); // Update the ID to match the input field
    var technology_id = $('#technology_id').val();

    $.ajax({
        type: "POST",
        url: "../dashboard/AJAX/in_up_technologies.php",
        data: {
            'technology_name': technology_name,
            'technology_id': technology_id,
        },
        success: function(response) {
            if (response == 1 || response == 2) {
                var successMessage = (response == 1) ? "Record inserted successfully!" : "Record updated successfully!";
                Swal.fire({
                    title: 'Success!',
                    text: successMessage,
                    icon: 'success'
                });
                clearFormFields();
                GetData(); // Refresh data after successful submission
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!"
                });
            }
        },
        error: function() {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!"
            });
        }
    });
});



// Get data function
function GetData() {
    $.ajax({
        type: "GET",
        url: "../dashboard/AJAX/fetch_technologies.php",
        success: function(response) {
            $("#showData").html(response);
        },
    });
}
function UpdateData(technology_id, technology_name) {
        $('#technology_id').val(technology_id); 
        $('#technology_name').val(technology_name);
    }
// Clear form fields
function clearFormFields() {
    $('#technology_name').val('');
    $('#technology_id').val('');
}

// Function to delete data
function DeleteData(technology_id) {
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
                url: "../dashboard/AJAX/delete_technology.php",
                data: { action: "delete", 'technology_id': technology_id },
                success: function(response) {
                    console.log(response);
                    Swal.fire(
                        'Deleted!',
                        'Your record has been deleted.',
                        'success'
                    )
                        GetData(); // Refresh data after successful deletion
                    
                },
                error: function() {
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
include_once('footer.php');
?>