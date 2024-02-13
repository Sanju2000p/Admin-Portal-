<?php
include_once "header.php";
include_once "forbidaccess/forbiddenaccess.php";

?>



            <div class="main-content">
        <section class="section">
          <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
              <h4 class="page-title m-b-0">Dashboard</h4>
            </li>
            <li class="breadcrumb-item">
              <a href="registeration_form.php">
                <i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">student Registration Form</li>
          </ul>
          <div class="section-body">
            <!-- add content here -->   
           <div class="row">
           <div class="col-12 col-md-6 col-lg-12">
           <div class="card">
                  <div class="card-header">
                  <h3>Student Registration Form</h3>
                  </div>
                  <div class="card-body">
                  <div class="row">
            <div class="col">
            <form id="registrationForm" method="post">
            <input type="hidden" class="form-control" id="student_id" name="student_id" >
        <div class="form-group">
          <label for="fname">First Name*</label>
          <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter First Name" required>
        </div></div>
        <div class="col">
        <div class="form-group">
          <label for="lname">Last Name*</label>
          <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Last Name" required>
        </div></div></div>
        <div class="row">
            <div class="col">
        <div class="form-group">
          <label for="lname">Email Address*</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
        </div></div>
        <div class="col">
        <div class="form-group">
          <label for="phonenum">Contact Number*</label>
          <input type="tel" class="form-control" id="number" name="number" placeholder="Contact Number" pattern="[0-9]{10}"required>
        </div></div></div> 
        <div class="row">
            <div class="col">
        <div class="form-group">
          <label for="lname">Alternate Number</label>
          <input type="tel" class="form-control" id="altnumber" name="altnumber" placeholder="Alternate Number" pattern="[0-9]{10}">
        </div></div>
            <div class="col">
        <div class="form-group">
          <label for="gender">Gender*</label><br>
          <div class="pretty p-default p-round" required>
          <input type="radio" name="gender" value="Male">
                      <div class="state">
                        <label>Male</label>
                      </div>
                    </div>
                    <div class="pretty p-default p-round">
                    <input type="radio" name="gender" value="Female">
                      <div class="state">
                        <label>Female</label>
                      </div>
                    </div>
                    <div class="pretty p-default p-round">
                    <input type="radio" name="gender" value="Other">
                      <div class="state">
                        <label>Other</label>
                      </div>
                    </div>
          </select>
        </div></div></div>
        <div class="row">
        <div class="col">
        <div class="form-group">
          <label for="address">Address*</label>
          <textarea type="text" class="form-control" id="address" rows="3" name="address" placeholder="Enter Address" required></textarea>
        </div></div>
        <div class="col">
        <div class="form-group">
          <label for="course">Select Course*</label>
          <select class="form-control" id="course" name="course" required>
            <option value="">Select Course</option>
            <option value="Course 1">Course 1</option>
            <option value="Course 2">Course 2</option>
            <option value="Course 3">Course 3</option>
            <!-- Add more course options as needed -->
          </select>
        </div></div></div>
        
        <div class="row">
            <div class="col">
        <div class="form-group">
          <label for="ref1">Reference 1 Name</label>
          <input type="text" class="form-control" id="ref1" name="ref1" placeholder="Enter Reference 1 Name" required>
        </div></div>
        <div class="col">
        <div class="form-group">
          <label for="ref1Number">Reference 1 Number</label>
          <input type="tel" class="form-control" id="ref1Number" name="ref1Number" placeholder="Enter Reference 1 Number" required>
        </div></div></div>
        <div class="row">
            <div class="col">
        <div class="form-group">
          <label for="ref2">Reference 2 Name</label>
          <input type="text" class="form-control" id="ref2" name="ref2" placeholder="Enter Reference 2 Name">
        </div></div>
        <div class="col">
        <div class="form-group">
          <label for="ref2Number">Reference 2 Number</label>
          <input type="tel" class="form-control" id="ref2Number" name="ref2Number" placeholder="Enter Reference 2 Number">
        </div></div></div>
        <!-- Add other form fields based on the table structure -->
        <div class="row">
            <div class="col">
        <div class="form-group">
          <label for="ref2">Student Program1</label>
          <input type="text" class="form-control" id="studentprogram1" name="studentprogram1" placeholder="Enter Student Program 1">
        </div></div>
        <div class="col">
        <div class="form-group">
          <label for="ref2Number">Student Program2</label>
          <input type="text" class="form-control" id="studentprogram2" name="studentprogram2" placeholder="Enter Student Program 2">
        </div></div>
        <div class="col">
        <div class="form-group">
          <label for="ref2Number">Student Program3</label>
          <input type="text" class="form-control" id="studentprogram3" name="studentprogram3" placeholder="Enter Student Program 3">
        </div></div></div>


        <div class="row">
        <div class="col">
        <div class="form-group">
          <label for="about">Student Hear Aboutus</label>
          <textarea type="text" class="form-control" id="about" rows="5" placeholder="Student Hear Aboutus" name="about" style="width: 567px;" ></textarea>
        </div>
        </div></div>
        <input type="submit" id="insert" name="insert" class="btn btn-primary" style="float: right;" value="Submit">
    </div>
    </div>
        </section>
</form>


<div id="alert"></div>
<div id="message"></div>
<div id="StudentForm"></div>
</div>






<script>
    $(document).ready(function() {
      GetData();
    });
 
    $("#registrationForm").submit(function(event) {
    event.preventDefault();
    var student_id = $('#student_id').val(); // Assuming this field exists
    var fname = $('#fname').val();
    var lname = $('#lname').val();
    var email = $('#email').val();
    var number = $('#number').val();
    var altnumber = $('#altnumber').val();
    var gender = $("input[name='gender']:checked").val(); // Assuming radio buttons for gender
    var address = $('#address').val();
    var course = $('#course').val();
    var ref1 = $('#ref1').val();
    var ref1Number = $('#ref1Number').val();
    var ref2 = $('#ref2').val();
    var ref2Number = $('#ref2Number').val();
    var studentprogram1 = $('#studentprogram1').val();
    var studentprogram2 = $('#studentprogram2').val();
    var studentprogram3 = $('#studentprogram3').val();
    var about = $('#about').val();



    console.log({

        'student_id': student_id,
        'fname': fname,
        'lname': lname,
        'email': email,
        'number': number,
        'altnumber': altnumber,
        'gender': gender,
        'address': address,
        'course': course,
        'ref1': ref1,
        'ref1Number': ref1Number,
        'ref2': ref2,
        'ref2Number': ref2Number,
        'studentprogram1' : studentprogram1,
        'studentprogram2' : studentprogram2,
        'studentprogram3' : studentprogram3,
        'about': about,
    });

    $.ajax({
        type: "POST",
        url: "../dashboard/AJAX/in_up_students.php",
        data: {

            'student_id': student_id,
            'fname': fname,
            'lname': lname,
            'email': email,
            'number': number,
            'altnumber': altnumber,
            'gender': gender,
            'address': address,
            'course': course,
            'ref1': ref1,
            'ref1Number': ref1Number,
            'ref2': ref2,
            'ref2Number': ref2Number,
            'studentprogram1': studentprogram1,
            'studentprogram2': studentprogram2,
            'studentprogram3': studentprogram3,
            'about': about,
        },
        success: function(response) {
            console.log(response);
            if (response == 1) {
                Swal.fire({
                    title: "Insert",
                    text: "Data Inserted Sucessfully!",
                    icon: "success"
                });

                $('#student_id').val('');
                $('#fname').val('');
                $('#lname').val('');
                $('#email').val('');
                $('#number').val('');
                $('#altnumber').val('');
                $("input[name='gender']").prop('checked', false); // Clear radio buttons
                $('#address').val('');
                $('#course').val('');
                $('#ref1').val('');
                $('#ref1Number').val('');
                $('#ref2').val('');
                $('#ref2Number').val('');
                $('#studentprogram1').val('');
                $('#studentprogram2').val('');
                $('#studentprogram3').val('');
                $('#about').val('');

                GetData();
            } else if (response == 2) {
                Swal.fire({
                    title: "Update",
                    text: "Data Updated Sucessfully!",
                    icon: "success"
                });

                $('#student_id').val('');
                $('#fname').val('');
                $('#lname').val('');
                $('#email').val('');
                $('#number').val('');
                $('#altnumber').val('');
                $("input[name='gender']").prop('checked', false); // Clear radio buttons
                $('#address').val('');
                $('#course').val('');
                $('#ref1').val('');
                $('#ref1Number').val('');
                $('#ref2').val('');
                $('#ref2Number').val('');
                $('#studentprogram1').val('');
                $('#studentprogram2').val('');
                $('#studentprogram3').val('');
                $('#about').val('');

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



function GetData(){
    $.ajax({
        type: "GET",
        url: "../dashboard/AJAX/fectch_students.php",
        success: function(response) {
            $("#message").html(response);
        }
    });
}



function UpdateData(student_id, fname, lname, email, number, altnumber, gender, address, courses, ref1, ref1Number, ref2, ref2Number, studentprogram1, studentprogram2, studentprogram3, about) {
    $('#student_id').val(student_id);
    $('#fname').val(fname);
    $('#lname').val(lname);
    $('#email').val(email);
    $('#number').val(number);
    $('#altnumber').val(altnumber);
    $("input[name='gender'][value='" + gender + "']").prop('checked', true);
    $('#address').val(address);
    $('#course').val(courses); 
    $('#ref1').val(ref1);
    $('#ref1Number').val(ref1Number);
    $('#ref2').val(ref2);
    $('#ref2Number').val(ref2Number);
    $('#studentprogram1').val(studentprogram1); 
    $('#studentprogram2').val(studentprogram2); 
    $('#studentprogram3').val(studentprogram3); 
    $('#about').val(about);
}

   
function DeleteData(student_id) {
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
              url: "../dashboard/AJAX/delete_student.php",
              data: { action: "delete", 'student_id': student_id },
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

<script>
  $(document).ready(function() {
    // GetData();

    $('#number, #altnumber, #ref1Number, #ref2Number').on('input', function() {
      var sanitized = $(this).val().replace(/[^0-9]/g, ''); // Remove non-numeric characters
      if (sanitized.length > 10) {
        sanitized = sanitized.substr(0, 10); 
      }
      $(this).val(sanitized); // Update the input value
    });

    $("#registrationForm").submit(function(event) {
      event.preventDefault();


      var number = $('#number').val();
      var altnumber = $('#altnumber').val();
      var ref1Number = $('#ref1Number').val();
      var ref2Number = $('#ref2Number').val();

      if (!isValidPhoneNumber(number)) {
        showError('Invalid contact number.');
        return;
      }

    });
  });

  function isValidPhoneNumber(phoneNumber) {
    return phoneNumber.length === 10 && !isNaN(phoneNumber);
  }

  function showError(alert) {
    Swal.fire({
      title: 'Error!',
      text: alert,
      icon: 'error'
    });
  }

  function printTable() {
        var printContents = document.getElementById("message").innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>




<?php
include_once "footer.php";
 ?>