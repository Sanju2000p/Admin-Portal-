<?php
require_once('header.php');
require_once('fs_world.php');
?>

<div class="main-content">
        <section class="section">
          <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
              <h4 class="page-title m-b-0">Courses</h4>
            </li>
            <li class="breadcrumb-item">
              <a href="courses.php">
                <i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">Add Courses</li>
          </ul>

          <div class="section-body">
            <!-- add content here -->   
           <div class="row">
           <div class="col-12 col-md-6 col-lg-12">
           <div class="card">
                  <div class="card-header">
                  <h3>Add Courses</h3>
                  </div>
          <div class="card-body">
            <form id="MyForm" method="POST" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-6">

                  <div class="form-group">
                    <label>Course Name </label>
                    <input type="hidden" name="id" id="id" class="form-control" />
                    <input type="text" name="cname" id="cname" class="form-control" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Course Duration </label>
                        <input type="text" name="duration" id="duration" class="form-control" />
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Instructor </label>
                        <select class="form-select form-control form-control-sm" name="instructor" id="instructor">
                          <option value="">Select Instructor</option>
                          <?php
                          $GetData = mysqli_query($connection, "SELECT * FROM instructors WHERE status='1'");
                          while ($resData = mysqli_fetch_assoc($GetData)) {
                          ?>
                            <option value="<?php echo $resData['instructor_id']; ?>">
                              <?php echo $resData['instructor_name']; ?>
                            </option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Projects </label>
                        <input type="text" name="projects" id="projects" class="form-control" />
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Course Feature Image </label>
                    <input type="file" name="cimage" id="cimage" accept="image/png, image/jpg, image/jpeg" class="form-control" />
                    <input type="hidden" name="old_cmage" id="old_cmage" class="form-control" />
                    <p id="selectedcimage"></p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Course Banner image </label>
                    <input type="file" name="bannerimage" id="bannerimage" accept="image/png, image/jpg, image/jpeg" class="form-control" />
                    <input type="hidden" name="old_bannerimage" id="old_bannerimage" class="form-control" />
                    <p id="selectedbannerimage"></p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Course Shared image </label>
                    <input type="file" name="sharedimage" id="sharedimage" accept="image/png, image/jpg, image/jpeg" class="form-control" />
                    <input type="hidden" name="old_shareimage" id="old_shareimage" class="form-control" />
                    <p id="selectedshareimage"></p>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Iframe URL</label>
                <input type="url" name="iframe_url" id="iframe_url" class="form-control" />
              </div>
              <div class="form-group">
                <label>Course Description</label>
                <textarea type="text" name="description" id="description" class="form-control"></textarea>
              </div>
              <div class="p-0">
                <button type="submit" id="save" name="save" class="btn btn-primary">Save Course</button>
              </div>
            </form>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h3>Courses List</h3>
          </div>
          <div class="card-body" id="showData">

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
require_once ("footer.php");
?>

<script>
  $(document).ready(function() {
    GetData();
  });
  $("#MyForm").submit(function(event) {
    event.preventDefault();
    var formData = new FormData(this);
    var instructor_profile_image = $('#instructor_profile_image')[0].files[0];
    var fileName = instructor_profile_image.name;
    var allowedExtensions = /(\.jpg|\.png|\.svg)$/i;
    if (!allowedExtensions.exec(fileName)) {
      alert('Please upload a file with .jpg, .png, or .svg extension.');
      return false;
    }

    $.ajax({
      type: "POST",
      url: "../dashboard/AJAX/in_up_courses.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function(response) {
        console.log(response);
        if (response == 1) {
          Swal.fire({
            title: "Insert",
            text: "You clicked the button!",
            icon: "success"
          });
          var id = $('#id').val('');
          var cname = $('#cname').val('');
          var duration = $('#duration').val('');
          var instructor = $('#instructor').val('');
          var projects = $('#projects').val('');
          var cimage = $('#cimage').val('');
          var bannerimage = $('#bannerimage').val('');
          var sharedimage = $('#sharedimage').val('');
          var description = $('#description').val('');
          var iframe_url = $('#iframe_url').val('')
          GetData();
        }
        if (response == 2) {
          Swal.fire({
            title: "Update",
            text: "You clicked the button!",
            icon: "success"
          });
          var id = $('#id').val('');
          var cname = $('#cname').val('');
          var duration = $('#duration').val('');
          var instructor = $('#instructor').val('');
          var projects = $('#projects').val('');
          var cimage = $('#cimage').val('');
          var bannerimage = $('#bannerimage').val('');
          var sharedimage = $('#sharedimage').val('');
          var description = $('#description').val('');
          var iframe_url = $('#iframe_url').val('')
          $('#selectedFileName').text('');

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
      url: "../dashboard/AJAX/fetch_courses.php",
      success: function(response) {
        $("#showData").html(response);

      }
    });
  }

  function UpdateData(a, b, c, d, e,f, g, h, i, j) {
    $('#id').val(a);
    $('#cname').val(b);
    $('#instructor').val(c);
    $('#duration').val(d);
    $('#projects').val(e);
    // $('#description').val(f);
    $('#old_cmage').val(g)
    $('#old_bannerimage').val(h)
    $('#old_shareimage').val(i)  
    $('#selectedcimage').text(g);  
    $('#selectedbannerimage').text(h);  
    $('#selectedshareimage').text(i);  
    $('#description').val(f);
    $('#iframe_url').val(j)

  }

  function DeleteData(course_id) {
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
          url: "../dashboard/AJAX/delete_courses.php",
          data: {
            action: "delete",
            'course_id': course_id
          },
          success: function(response) {
            console.log(response);
            Swal.fire(
              'Deleted!',
              'Your record has been deleted.',
              'success'
            );
            GetData();
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