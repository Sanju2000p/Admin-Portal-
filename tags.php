<?php
require_once "fs_world.php";
require_once ("header.php");
?>

<div class="main-content">
    <section class="section">
        <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
                <h4 class="page-title m-b-0">Dashboard</h4>
            </li>
            <li class="breadcrumb-item">
                <a href="tags.php">
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
                    <h3>Tags Form</h3>
                  </div>
                  <div class="card-body">
                    <form id="MyForm" method="POST">
                        <input type="hidden" class="form-control" id="tag_id" name="tag_id" >
                            <div class="row">
                                <div class="form-group">
                                    <label for="tags">Tag Name</label>                                   
                                     <div class="form-group">
                                        <input type="text" class="form-control" id="tag_name" name="tag_name">
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
                    <h3>Tags Table</h3>
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

        var tag_id = $('#tag_id').val();
        var tag_name = $('#tag_name').val(); // Update variable names to match input fields

        $.ajax({
            type: "POST",
            url: "../dashboard/AJAX/in_up_tags.php",
            data: {
                'tag_id': tag_id,
                'tag_name': tag_name,
                
            },
            success: function(response) {
                console.log(response);
                if (response ==1) {
                    Swal.fire({
                        title: "Insert",
                        text: "Record inserted successfully!",
                        icon: "success"
                    });
                    $('#tag_id, #tag_name').val('');
                    GetData();
                } else if (response ==2) {
                    Swal.fire({
                        title: "Update",
                        text: "Record updated successfully!",
                        icon: "success"
                    });
                    $('#tag_id, #tag_name').val('');
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
            type: "GET",
            url: "../dashboard/AJAX/fetch_tags.php",
            success: function(response) {
                $("#showData").html(response);
            },
        });
    }

    function UpdateData(tag_id, tag_name) {
        $('#tag_id').val(tag_id); 
        $('#tag_name').val(tag_name);
    }

    function clearFormFields() {
        $('#tag_name').val('');
        $('#tag_id').val('');
    }

    function DeleteData(tag_id) {
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
                    url: "../dashboard/AJAX/delete_tag.php",
                    data: { action: "delete", 'tag_id': tag_id },
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
