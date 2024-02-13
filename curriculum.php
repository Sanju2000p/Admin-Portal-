<?php
require_once "fs_world.php";
require_once "header.php";
?>

<div class="main-content">
    <section class="section">
        <ul class="breadcrumb breadcrumb-style">
            <li class="breadcrumb-item">
                <h4 class="page-title m-b-0">Curriculum</h4>
            </li>
            <li class="breadcrumb-item">
                <a href="dashboard.html">
                    <i data-feather="home"></i>
                </a>
            </li>
            <li class="breadcrumb-item">Curriculum</li>
        </ul>
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Curriculum Form</h3>
                        </div>
                        <div class="card-body">
                            <form id="MyForm" method="POST">
                                <input type="hidden" id="curriculum_id" name="curriculum_id" class="form-control" value="">

                                <div class="row">
                                    <div class="col">
                                    <div class="form-group">
                                        <label for="day_no" >Day no.:</label>
                                        <input type="text" class="form-control" id="day_no" name="day_no" required>
                                    </div></div>
                                    <div class="col">
                                    <div class="form-group">
                                        <label for="technology_details">Technology Details:</label>
                                        <input type="text" class="form-control" id="technology_details" name="technology_details" required>
                                    </div></div></div>

                                    <div class="row">
                                    <div class="col">
                                    <div class="form-group">
                                    <label for="technology_id">Select Technology:</label>
                                    <select class="form-control" id="technology_id" name="technology_id">
                <option value="">Select a technology</option>
                <?php
                $technologies = mysqli_query($connection, "SELECT technology_id, technology_name FROM technologies WHERE status='1'") or die(mysqli_error($connection));
                while ($row = mysqli_fetch_assoc($technologies)) {
                    echo '<option value="' . $row['technology_id'] . '">' . $row['technology_name'] . '</option>';
                }
                ?>
            </select>
                                </div></div>
                                

                                    <div class="col">
                                    <div class="form-group">
                                        <label for="training_time">Training duration in hours:</label>
                                        <input class="form-control" id="training_time" name="training_time" rows="4" required>
                                    </div></div></div>

                                    <div class="row">
                                    <div class="col-6">
                                    <div class="form-group">
                                        <label for="practice_time">Practice duration in hours:</label>
                                        <input class="form-control" id="practice_time" name="practice_time" rows="4" required>
                                    </div></div></div>
          
          
                                <button type="submit" class="btn btn-primary" id="save" name="save" style="float:right">Submit</button>
            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Curriculam Table</h3>
                    </div>
                    <div class="card-body" id="showData">
                        <!-- This section will display data after form submission -->
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>

<?php
require_once "footer.php";
?>

<!-- Include jQuery (if not already included) -->
<!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->

<!-- Include SweetAlert2 JS -->
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->

<script>
    GetData();
    $(document).ready(function() {
        // Event listener for the dropdown change
        $('#technologySelect').change(function() {
            var selectedTechnologyId = $(this).val(); // Get the selected technology_id
            $('#technology_id').val(selectedTechnologyId); // Set the selected technology_id in the hidden input field
        });

        
    });

    $("#MyForm").submit(function(event){
    event.preventDefault();
    var day_no = $('#day_no').val();
    var technology_details = $('#technology_details').val();
    var technology_id = $('#technology_id').val();
    var training_time = $('#training_time').val();
    var practice_time = $('#practice_time').val();
    var curriculum_id = $('#curriculum_id').val(); // Retrieve curriculum_id value

    $.ajax({
        type: "POST",
        url: "../dashboard/AJAX/in_up_curriculum.php",
        data: {
            'day_no': day_no,
            'technology_details': technology_details,
            'technology_id': technology_id,
            'training_time': training_time,
            'practice_time': practice_time,
            'curriculum_id': curriculum_id // Send curriculum_id along with other data
        },
        success: function(response) {
            // console.log(response);
            if(response == 1 || response == 2) {
                var successMessage = (response == 1) ? "Record inserted successfully!" : "Record updated successfully!";
                Swal.fire({
                    title: 'Success!',
                    text: successMessage,
                    icon: 'success'
                });
                // Reset form fields
                $('#day_no').val('');
                $('#technology_details').val('');
                $('#technology_id').val('');
                $('#training_time').val('');
                $('#practice_time').val('');
                $('#curriculum_id').val('');
                GetData();
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


function GetData() {
    $.ajax({
        type: "GET",
        url: "../dashboard/AJAX/fetch_curriculum.php",
        success: function(response) {
            $("#showData").html(response);
        }
    });
}

function UpdateData(a, b, c, d, e, f) {
    $('#day_no').val(a);
    $('#technology_details').val(b);
    $('#technology_id').val(c);
    $('#training_time').val(d);
    $('#practice_time').val(e);
    $('#curriculum_id').val(f);
};

function DeleteData(f) {
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
                url: "../dashboard/AJAX/delete_curriculum.php",
                data: { action: "delete", 'curriculum_id': f },
                success: function (response) {
                    console.log(response);
                    Swal.fire(
                        'Deleted!',
                        'Your record has been deleted.',
                        'success'
                    ).then(() => {
                        GetData();
                    });
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


