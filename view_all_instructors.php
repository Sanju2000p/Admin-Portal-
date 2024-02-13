<?php
require_once "fs_world.php";
include_once "header.php";
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<div class="main-content">
    <section class="section">
        <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
                <h4 class="page-title m-b-0">Dashboard</h4>
            </li>
            <li class="breadcrumb-item">
                <a href="view_all_instructors.php">
                    <i data-feather="home"></i>
                </a>
            </li>
            <li class="breadcrumb-item">View_All_Instructors</li>
        </ul>
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h2>Instructors List</h2>
                        </div>
                        <div class="card-body">
                            <table id="instructorsTable" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Instructor ID</th>
                                        <th>Instructor Name</th>
                                        <th>About Instructor</th>
                                        <th>Instructor Designation</th>
                                        <th>Instructor Profile Image</th>
                                        <th>Created By</th>
                                        <th>Modified By</th>
                                        <th>Created Date Time</th>
                                        <th>Modify Date Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $GetData = mysqli_query($connection, "SELECT * FROM instructors WHERE status='1'") or die(mysqli_error($connection));
                                    $count = 1;
                                    while ($res = mysqli_fetch_object($GetData)) {
                                        ?>
                                        <tr>
                                            <td><?= $res->instructor_id ?></td>
                                            <td><?= $res->instructor_name ?></td>
                                            <td><?= $res->about_instructor ?></td>
                                            <td><?= $res->instructor_designation ?></td>
                                            <td><img src="<?= $res->instructor_profile_image ?>" alt="Profile Image" style="width: 100px; height: auto;"></td>
                                            <td><?= $res->created_by ?></td>
                                            <td><?= $res->modified_by ?></td>
                                            <td><?= $res->created_date_time ?></td>
                                            <td><?= $res->modify_date_time ?></td>
                                            <td>
                                                <a href='javascript:void(0);'onclick='getInstructorData(<?= $res->instructor_id ?>' class='btn-view'><i class='far fa-edit m-r-10'></i></a>
                                                <a href='javascript:void(0);' onclick='deleteInstructor(<?= $res->instructor_id ?>)' style='color:red' class='btn-delete'><i class='far fa-trash-alt'></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    mysqli_close($connection);
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<script>
    function deleteInstructor(instructorId) {
    if (confirm("Are you sure you want to delete this instructor?")) {
        $.ajax({
            url: '../dashboard/AJAX/delete_instructor.php',
            method: 'POST',
            data: { id: instructorId },
            success: function(response) {
                // Check if deletion was successful based on the response from the server
                if (response === 'success') {
                    alert('Instructor deleted successfully');
                    $(row).closest('tr').remove(); // Display a success message
                    // You can also perform additional actions like hiding the row from the table
                } else {
                    alert('Instructor deleted successfully'); // Display a failure message
                }
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(error);
            }
        });
    }
}


function getInstructorData(instructorId) {
    $.ajax({
        url: 'update_instructors.php', // Update with your endpoint to fetch instructor data
        method: 'POST',
        data: { id: instructorId },
        success: function(response) {
            var data = JSON.parse(response);
            document.getElementById('instructor_name').value = data.instructor_name;
            document.getElementById('instructor_designation').value = data.instructor_designation;
            document.getElementById('about_instructor').value = data.about_instructor;
            document.getElementById('profile_image').src = data.instructor_profile_image;
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}


    $(document).ready(function() {
        $('#instructorsTable').DataTable();
    });

    // Example to redirect to the edit page
    $('.btn-view').click(function(e) {
        e.preventDefault(); // Prevent default link behavior
        var instructorId = $(this).attr('data-id');
        window.location.href = 'instructors.php?id=' + instructorId;
    });
</script>
<?php
require_once "footer.php";
?>