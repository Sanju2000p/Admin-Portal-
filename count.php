<?php
require_once ("header.php");
?>
<?php
require_once "fs_world.php";
?>

<?php

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
                    <h3>Counts Form</h3>
                  </div>
                  <div class="card-body">
                    <form id="MyForm" method="POST">
                        <!-- <input type="hidden" class="form-control" id="bc_id" name="bc_id" value=""> -->
                            <div class="row">
                                <div class="mb-3 col-6">
                                  <label for="finishedSessions" class="form-label">Finished Sessions:</label>
                                  <input type="text" id="finishedSessions" class="form-control" name="finishedSessions" value="" disabled>
                                </div>
                                <div class="mb-3 col-6">
                                  <label for="onlineEnrollment" class="form-label">Online Enrollment:</label>
                                  <input type="text" id="onlineEnrollment" class="form-control" name="onlineEnrollment" value="" disabled>
                                </div>
                                <div class="mb-3 col-6">
                                  <label for="subjectsTaught" class="form-label">Subjects Taught:</label>
                                  <input type="text" id="subjectsTaught" class="form-control" name="subjectsTaught" value="" disabled>
                                </div>
                                <div class="mb-3 col-6">
                                  <label for="satisfactionRate" class="form-label">Satisfaction Rate:</label>
                                  <input type="text" id="satisfactionRate" class="form-control" name="satisfactionRate" value="" disabled>
                                </div>
                            </div>
                            <!-- <button type="submit" class="btn btn-primary" id="save" name="save">Submit</button>  -->
                    </form>
                  </div>
              </div>
            </div>
          </div>            
    </section>

<?php
require_once ("footer.php");
?>


<!-- Include jQuery (if not already included) -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Include SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
$(document).ready(function() {
    // Function to fetch and update data
    function fetchDataAndUpdateFields() {
        $.ajax({
            type: 'GET',
            url: '../dashboard/AJAX/fetch_count.php', // Replace with the correct path to your PHP file
            dataType: 'json', // Expect JSON data from the server
            success: function(response) {
                // Update input fields with fetched data
                $('#finishedSessions').val(response.finishedSessions);
                $('#onlineEnrollment').val(response.onlineEnrollment);
                $('#subjectsTaught').val(response.subjectsTaught);
                $('#satisfactionRate').val(response.satisfactionRate);
            },
            error: function() {
                // Handle errors here
            }
        });
    }

    fetchDataAndUpdateFields(); // Initial call to fetch data
});
</script>
