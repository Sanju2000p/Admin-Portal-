<?php
require_once "fs_world.php";
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
  
    echo "SELECT a_id from myguests WHERE email ='$email' AND password='$password'";
    $qry = mysqli_query($conn,"SELECT a_id FROM admin_details WHERE email_id ='$email' AND password ='$password'") or die(mysqli_error($conn));
    while($row = mysqli_fetch_object($qry)){
      $mainID = $row->a_id;
      session_start();
      $_SESSION["mainID"] = $mainID;
    }
  
     //echo "$mainID";
  
    $count = mysqli_num_rows($qry);

  if($count > 0){
    header("Location: successful_login.php"); // Redirect to a success page
    exit();
} else {
    header("Location: failed_login.php"); // Redirect to a failure page
    exit();
}
}
  
?>
<?php if(isset($loginError)) { ?>
<div><?php echo $loginError; ?></div>
<?php } ?>