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
                <h4 class="page-title m-b-0">Number Verify Access Key</h4>
            </li>
            <li class="breadcrumb-item">
                <a href="dashboard.html">
                <i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">Number Verify Access Key</li>
        </ul>
        <div class="section-body">
            <!-- add content here -->

            <div class="row">
              <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h3>Number Verify Access Key Form</h3>
                  </div>
                  <div class="card-body">
                    <form id="MyForm" method="POST">
                        <input type="hidden" class="form-control" id="ak_id" name="ak_id" value="">
                            <div class="row">
                                <div class="form-group">
                                    <label for="ak">Access key Name</label>                                   
                                     <div class="form-group">
                                        <input type="text" class="form-control" id="ak_name" name="ak_name">
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
                    <h3>Number Verify Access Key Table</h3>
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

    var ak_name = $('#ak_name').val(); // Update the ID to match the input field
    var ak_id = $('#ak_id').val();

    $.ajax({
        type: "POST",
        url: "../dashboard/AJAX/in_up_technologies.php",
        data: {
            'ak_name': ak_name,
            'ak_id': ak_id,
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
        url: "sd",
        success: function(response) {
            $("#showData").html(response);
        },
    });
}
function UpdateData(technology_id, technology_name) {
        $('#ak_id').val(ak_id); 
        $('#ak_name').val(ak_name);
    }
// Clear form fields
function clearFormFields() {
    $('#ak_name').val('');
    $('#ak_id').val('');
}

// Function to delete data
function DeleteData(ak_id) {
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
                data: { action: "delete", 'ak_id': ak_id },
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