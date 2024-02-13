<?php
require_once "fs_world.php";
?>
<?php
require_once ("header.php");
?>
<!-- Include SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JavaScript -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
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
            <li class="breadcrumb-item">Bootcamp</li>
        </ul>
        <div class="section-body">
            <!-- add content here -->

            <div class="row">
              <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h3>BootCamp Form</h3>
                  </div>
                  <div class="card-body">
                    <form id="MyForm" method="POST">
                        <input type="hidden" class="form-control" id="bc_id" name="bc_id" value="">
                            <div class="row">
                                <div class="col">
                                <div class="form-group">
                                    <label for="your_email">Your Email:</label>
                                    <input type="email" class="form-control" id="bc_email" name="bc_email">
                                </div></div>
                                
                                    <div class="col">
                                    <div class="form-group">
                                    <label for="contact_number">Contact Number:</label>
                                    <input type="tel"class="form-control"  id="bc_contactNo" name="bc_contactNo" pattern="[0-9]{10}">
                                </div></div>
                            </div>
                            <button type="submit" class="btn btn-primary" id="save" name="save">Submit</button> 
                    </form>
                  </div>
              </div>
            </div>

            </div>
<div id="message"></div>
          </div>            
    </section>

    <!-- <form id="MyFormDelete" method="POST">
        <input type="hidden" class="form-control" id="InsSlTagsDelete" name="InsSlTagsDelete" value="">
    </form> -->



</div>

<?php
require_once ("footer.php");
?>



<!-- Include jQuery (if not already included) -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Include SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function() {
        GetData();
    });

    $("#MyForm").submit(function(event){
    event.preventDefault();
    var bc_email = $('#bc_email').val();
    var bc_contactNo = $('#bc_contactNo').val();
    var bc_id = $('#bc_id').val(); // Retrieve bc_id value
    if (bc_contactNo.length !== 10 || isNaN(bc_contactNo)) {
        Swal.fire({
            title: 'Error!',
            text: 'Please enter a valid 10-digit contact number.',
            icon: 'error'
        });
        return; // Prevent further execution if validation fails
    }


    // AJAX call to send bc_id, bc_email, and bc_contact to bootcampmodify.php
    $.ajax({
        type: "POST",
        url: "../dashboard/AJAX/in_up_bootcamp.php",
        data: {
            'bc_email': bc_email, 
            'bc_contactNo': bc_contactNo,
            'bc_id': bc_id // Send bc_id along with other data
        },
        success: function(response) {
            console.log(response);
            if(response == 1) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Record inserted successfully!',
                    icon: 'success'
                });
                // Clear form fields
                $('#bc_email').val('');
                $('#bc_contactNo').val('');
                GetData(); // Refresh data after successful insertion
            } else if (response == 2) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Record updated successfully!',
                    icon: 'success'
                });
                // Clear form fields
                $('#bc_email').val('');
                $('#bc_contactNo').val('');
                $('#bc_id').val(''); // Reset bc_id field after successful update
                GetData(); // Refresh data after successful update
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to save record.',
                    icon: 'error'
                });
            }
        },
        error: function() {
            Swal.fire({
                title: 'Error!',
                text: 'Failed to save record.',
                icon: 'error'
            });
        }
    });
});


    function GetData(){
        $.ajax({
            type: "GET",
            url: "../dashboard/AJAX/fetch_bootcamp.php",
            success: function(response) {
                $("#message").html(response);
            }
        });
    }

    function UpdateData(a, b, c) {
        $('#bc_email').val(a);
        $('#bc_contactNo').val(b);
        $('#bc_id').val(c); // Add this line to set the bc_id value in a hidden field
    }

    function DeleteData(bc_id) {
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
                    url: "../dashboard/AJAX/delete_bootcamp.php",
                    data: { action: "delete", 'bc_id': bc_id },
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
    $('#bc_contactNo').on('input', function() {
    var sanitized = $(this).val().replace(/[^0-9]/g, ''); // Remove non-numeric characters
    if (sanitized.length > 10) {
        sanitized = sanitized.substr(0, 10); // Trim the input to 10 characters
    }
    $(this).val(sanitized); // Update the input value
});

</script>