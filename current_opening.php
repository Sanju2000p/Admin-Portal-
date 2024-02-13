<?php
require_once "fs_world.php";
require_once "header.php";
?>
<!-- Include SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Current Opening</title>  
</head>
<body>
  <!-- Main Content -->
  <div class="main-content">
    <section class="section">
      <ul class="breadcrumb breadcrumb-style ">
        <li class="breadcrumb-item">
          <h4 class="page-title m-b-0">Dashboard</h4>
        </li>
        <li class="breadcrumb-item">
          <a href="current_opening.php">
           <i data-feather="home"></i></a>
        </li>
        <li class="breadcrumb-item">Current Opening</li>
      </ul>
      <div class="section-body">
        <div class="row">
          <div class="col-12 col-md-6 col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3>Current Opening</h3>
              </div>
              <div class="card-body">
              <form id="currentopening" method="POST">
              <input type="hidden" class="form-control" id="co_id" name="co_id" value="">
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label for="coursename">Course Name</label>
                      <select type="text" class="form-control" id="coursename" name="coursename" placeholder="Enter Course Name" required>
  <option value="">Select Course</option>
  <?php
  $GetData= mysqli_query($connection ,"SELECT * FROM courses WHERE status='1'");
  while ($row = mysqli_fetch_assoc($GetData)) {
    echo '<option value="' . $row['course_name'] . '">' . $row['course_name'] . '</option>';
  }
  ?>
</select>
                  </div> </div>
                  <div class="col">
                    <div class="form-group">
                      <label for="noofopean">Number of Openings</label>
                      <input type="number" class="form-control" id="noofopean" name="noofopean" placeholder="Enter No of Openings" required>
                  </div> </div> 
                  <div class="col">
                    <div class="form-group">
                      <label for="hiring">Hiring</label>
                      <input type="number" class="form-control" id="hiring" name="hiring" placeholder="Enter No of Hirings" required>
                  </div> </div> </div>
                  <!-- <div class="col">
                    <div class="form-group">  
                      <label for="hiddenfieldname">Hidden Field</label>
                      <input type="hidden" name="hiddenFieldName" value="hiddenFieldValue">
                </div> </div> </div>   -->
                <div class="col">
                  <div class="form-group">
                    <button type="submit" name="submit" id="submit" class="btn btn-primary btn-md" style="float: right">Submit</button>
                </div> </div>
              </form>
              </div>
            </div>           
          </div> 
        </div>
        <div class="col-12 col-md-6 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h3>Current Opening Table</h3>
            </div>
            <div class="card-body" id="showData">
            </div>
          </div>
        </div>
      </div> 
    </section>
  </div> 
  <form id="currentopeningDelete" method="POST">
    <input type="hidden" class="form-control" id="currentopeningDelete" name="currentopeningDelete" value="">
  </form>  
<!-- Include jQuery (if not already included) -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- Include SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
  $(document).ready(function() {
    GetData();
  }); 
  $("#currentopening").submit(function(event){
    event.preventDefault();
    var co_id = $('#co_id').val();
    var coursename = $('#coursename').val(); // This line was missing, make sure to define coursename
    var noofopean = $('#noofopean').val();
    var hiring = $('#hiring').val();
    $.ajax({
      type: "POST",
      url: "../dashboard/AJAX/in_up_current_opening.php",
      data: {
        'co_id': co_id,
        'coursename': coursename, 
        'noofopean': noofopean, 
        'hiring': hiring
      },
      success: function(response) {
          console.log(response);
          if(response==1){
          Swal.fire({
              title: "Insert",
              text: "You clicked the button!",
              icon: "success"
            });
            $('#coursename').val('');
            $('#noofopean').val('');
            $('#hiring').val('');
            GetData();
          }
          if(response==2){
            Swal.fire({
                title: "Update",
                text: "You clicked the button!",
                icon: "success"
              });
              $('#coursename').val('');
              $('#noofopean').val('');
              $('#hiring').val('');
              GetData();
            }
            if(response==0){
              Swal.fire({
                  icon: "error",
                  title: "Oops...",
                  text: "Something went wrong!"
                });
            }
        }
    });
});

function GetData(){
    $.ajax({
        type: "GET",
        url: "../dashboard/AJAX/fetch_current_opening.php",
        success: function(response) {
            $("#showData").html(response);
        }
    });
}

function UpdateData(a,b,c,d){
    $('#co_id').val(a);
    $('#coursename').val(b); 
    $('#noofopean').val(c);
    $('#hiring').val(d);
}

// function validateForm() {
//   var coursename = $('#coursename').val();
//   var noofopean = $('#noofopean').val();
//   var hiring = $('#hiring').val();

//   // Basic validation: Check if fields are empty
//   if (coursename === '' || noofopean === '' || hiring === '') {
//     Swal.fire({
//       icon: 'error',
//       title: 'Validation Error',
//       text: 'Please fill in all required fields!',
//     });
//     return false;
//   }
//   return true;
// }


function DeleteData(co_id) {
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
              url: "../dashboard/AJAX/delete_current_opening.php",
              data: { action: "delete", 'co_id': co_id },
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
<?php
require_once "footer.php";
?> 
</body>
</html>