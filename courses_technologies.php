<?php
require_once('header.php');
require_once('fs_world.php');
?>

<body>

      <div class="main-content">
        <section class="section">
        <ul class="breadcrumb breadcrumb-style">
            <li class="breadcrumb-item">
              <h4 class="page-title m-b-0">Course Technologies</h4>
            </li>
            <li class="breadcrumb-item">
              <a href="../dashboard/dashboard.php"> <i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">All Course Technologies</li>
          </ul>
          <div class="row">
            <div class="col-md-12">
              <!-- Add Course -->
              <div class="card" id="addcourse">
                <div class="card-header">
                  <h3>Course Technology</h3>
                </div>
                <div class="card-body">
                  <form id="MyForm" method="POST" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Course Name </label>
                          <select class="form-select form-control form-control-sm" name="courses" id="courses"
                            required>
                            <option value="">Select Course</option>
                            <?php
                            $GetData1 = mysqli_query($connection, "SELECT * FROM courses WHERE status='1'");
                            while ($resData = mysqli_fetch_assoc($GetData1)) {
                              ?>
                              <option value="<?php echo $resData['course_id']; ?>">
                                <?php echo $resData['course_name']; ?>
                              </option>
                              <?php
                            }
                            ?>
                          </select>
                          <input type="hidden" name="id" id="id" required class="form-control" />

                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Technology </label>
                          <select class="form-select form-control form-control-sm" name="technology" id="technology"
                            required>
                            <option value="">Select Technology</option>
                            <?php
                            $GetData = mysqli_query($connection, "SELECT * FROM technologies WHERE status='1'");
                            while ($resData = mysqli_fetch_assoc($GetData)) {
                              ?>
                              <option value="<?php echo $resData['technology_id']; ?>">
                                <?php echo $resData['technology_name']; ?>
                              </option>
                              <?php
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                      <div class="form-group">
                      <label>Technology Topics</label>
                      <textarea  name="technology_topics" id="technology_topics" required class="form-control"></textarea>
                    </div>
                    </div>
                    </div>
                    <div class="p-0">
                      <button type="submit" id="save" name="save" class="btn btn-primary" style="float:right">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
              <div class="card">
                <div class="card-header">
                  <h3>Course Technologies List</h3>
                </div>
                <div class="card-body" id="showData">
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
      <?php include('footer.php'); ?>
    </div>
  </div>

  <script>
    $(document).ready(function () {
      GetData();
    });
    $("#MyForm").submit(function (event) {
      event.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        type: "POST",
        url: "../dashboard/AJAX/in_up_courses_tech.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          console.log(response);
          if (response == 1) {
            Swal.fire({
              title: "Insert",
              text: "You clicked the button!",
              icon: "success"
            });
            var courses = $('#courses').val('');
            var technology = $('#technology').val(''); 
            var technology_topics = $('#technology_topics').val('');           
            GetData();
          }
          if (response == 2) {
            Swal.fire({
              title: "Update",
              text: "You clicked the button!",
              icon: "success"
            });
            var courses = $('#courses').val('');
            var technology = $('#technology').val('');
            var technology_topics = $('#technology_topics').val('');           

            GetData();
          }
          if (response == 0) {
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
        url: "../dashboard/AJAX/fetch_courses_tech.php",
        success: function (response) {
          $("#showData").html(response);

        }
      });
    }
    function UpdateData(a, b, c, d) {
           
      $('#id').val(a);
      $('#courses').val(b);
      $('#technology').val(c);
      $('#technology_topics').val(d)
      // alert(a+b+c+d);
    }

    function DeleteData(courses_technologies_id) {
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
            url: "../dashboard/AJAX/delete_courses_tech.php",
            data: { action: "delete", 'courses_technologies_id': courses_technologies_id },
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
</body>

</html>