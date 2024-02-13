<?php 
include_once "header.php";
require_once "fs_world.php";
?>

 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
              <h4 class="page-title m-b-0">Dashboard</h4>
            </li>
            <li class="breadcrumb-item">
              <a href="meta_tags.php">
                <i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">Meta Tags</li>
          </ul>
          <div class="section-body">
            <!-- add content here -->   
           <div class="row">
           <div class="col-12 col-md-6 col-lg-12">
           <div class="card">
                  <div class="card-header">
                  <h3>Meta Tags</h3>
                  </div>
                  <div class="card-body">
                  <form  id="metaform"  method="POST">
                  <input type="hidden" class="form-control" id="meta_id" name="meta_id" >
                  <div class="row">
                  <div class="col">

                      <div class="form-group">
                        <label for="meta_name">Meta Name:</label>
                        <input type="text" class="form-control" id="meta_name" name="meta_name" value="" >
                    </div> </div>
                    <div class="col">
                    <div class="form-group">
                        <label for="meta_property">Meta Property:</label>
                        <input type="text"class="form-control"  id="meta_property" name="meta_property" value="">
                    </div></div></div>
                    
                    <div class="row">
                    <div class="col"> 
                    <div class="form-group">
                    <label for="Menu">Menu:</label>

                        <select class="form-select form-control" id="menu_id" name="menu_id"  required>  
                          <option value="">Select Menu</option>
                          <?php
                          $GetData = mysqli_query($connection,"SELECT * FROM menus WHERE status='1'");
                          while($resData =mysqli_fetch_array($GetData)){
                            ?>
                          <option value="<?php echo $resData['menu_id'];?>">
                          <?php echo $resData['menu_name'];?>
                          </option>
                          <?php
                          }
                          ?>
                          </select>

                    </div></div>
                    <div class="col"> 
                    <div class="form-group">
                    <label for="Tag">Tag:</label>

                    <select class="form-select form-control" id="tag_id" name="tag_id"  required> 
                         
                          <option value="">Select Tag</option>
                        <?php
                            $GetData = mysqli_query($connection,"SELECT * FROM tags WHERE status='1'");
                            while($resData = mysqli_fetch_assoc($GetData)){
                        ?>
                            <option value="<?php echo $resData['tag_id']; ?>">
                            <?php echo $resData['tag_name']; ?>
                            </option>
                            <?php
                        }
                        ?>
                        </select>
                    </div></div>
                    <div class="col"> 
                    <div class="form-group">
                    <label for="courses">Course:</label>

                    <select class="form-select form-control " name="course_id" id="course_id" required>
                            <option value="">Select Course</option> 
                        <?php
                            $GetData = mysqli_query($connection, "SELECT * FROM courses WHERE status='1'");
                            while ($resData = mysqli_fetch_assoc($GetData)) {
                              ?>
                              <option value="<?php echo $resData['course_id']; ?>">
                                <?php echo $resData['course_name']; ?>
                              </option>
                              <?php
                            }
                            ?>
                          </select>
                    </div></div></div>
                    
                        <div class="col">
                    <div class="form-group">   
                    <label for="content">Content:</label>
                    <textarea type="text" class="form-control" id="content" name="content"  ></textarea>
                    </div>
                        <button type="submit" name="submit" id="submit" style="float:right" class="btn btn-primary btn-md">Add Instructor</button>
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
            <div class="col-2">
                  <div class="form-group"> 
                  <button type="button" style="float:left" onclick="printTable()" class="btn btn-primary btn-md">Print Table</button>
                        </div>
                        </div>
          </div>            
    </section>

   </div>

<script>
 $(document).ready(function() {
        GetData();
    });
$(document).ready(function() {
    $('#metaform').submit(function(event) {
        event.preventDefault(); // Prevent default form submission behavior

        var meta_id = $('#meta_id').val();
        var meta_name = $('#meta_name').val();
        var meta_property = $('#meta_property').val();
        var content = $('#content').val();
        var menu_id = $('#menu_id').val();
        var tag_id = $('#tag_id').val();
        var course_id = $('#course_id').val();

        $.ajax({
            type: 'POST',
            url: '../dashboard/AJAX/in_up_meta_tags.php', // Update with the correct PHP file handling meta tags
            data: {
                'meta_id': meta_id,
                'meta_name': meta_name,
                'meta_property': meta_property,
                'content': content,
                'menu_id': menu_id,
                'tag_id': tag_id,
                'course_id': course_id
            },
            success: function(response) {
                console.log(response);
                if (response == 1) {
                    Swal.fire({
                        title: 'Insert',
                        text: 'Record inserted successfully!',
                        icon: 'success'
                    });
                    clearFormFields();
                    GetData(); // Refresh data after successful insertion
                } else if (response == 2) {
                    Swal.fire({
                        title: 'Update',
                        text: 'Record updated successfully!',
                        icon: 'success'
                    });
                    clearFormFields();
                    GetData(); // Refresh data after successful update
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!'
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!'
                });
            }
        });
    });
});


    function GetData() {
        $.ajax({
            type: "GET",
            url: "../dashboard/AJAX/fetch_meta_tags.php",
            success: function(response) {
                $("#showData").html(response);
            },
        });
    }
    function UpdateData(meta_id, meta_name, meta_property, content, menu_id, tag_id, course_id) {
    $('#meta_id').val(meta_id); 
    $('#meta_name').val(meta_name);
    $('#meta_property').val(meta_property);
    $('#content').val(content);
    $('#menu_id').val(menu_id);
    $('#tag_id').val(tag_id);
    $('#course_id').val(course_id);
}


function clearFormFields() {
    $('#meta_name').val('');
    $('#meta_property').val('');
    $('#content').val('');
    $('#menu_id').val('');
    $('#tag_id').val('');
    $('#course_id').val('');
    $('#meta_id').val('');
}


    function DeleteData(meta_id) {
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
                    url: "../dashboard/AJAX/delete_meta_tags.php",
                    data: { action: "delete", 'meta_id': meta_id },
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

     function printTable() {
        var printContents = document.getElementById("showData").innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>

<?php
include_once "footer.php";
?>