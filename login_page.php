<?php
include_once "fs_world.php";

if(isset($_POST['submit'])){
  $email = $_POST['email'];
  $password = $_POST['password'];

  $qry = mysqli_query($connection,"SELECT a_id from admin_details WHERE email_id ='$email' AND password='$password'") or die(mysqli_error($connection));
  $row = mysqli_fetch_object($qry);
  if ($row !== null) {
    $mainID = $row->a_id;
} else {
    $mainID = 0;
}
  // echo "$mainID";
 session_start();
  $_SESSION["mainID"] = $mainID;
  $count = mysqli_num_rows($qry);

  if($count > 0){
    header("location:../dashboard/registeration_form.php");
    exit();
    // echo"success";
  } else{
    echo"Login failed. Email or password is incorrect!";
  }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
.screen {
    width: 100vw; /* 100% viewport width */
            height: 100vh; /* 100% viewport height */
            overflow: hidden; /* Hide any overflow */
            position: relative;
        }

        .login {
            width: 50%;
            height: 50%;
        }

        .card-on-image {
            /* display: flex; */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80%;
            height: 80%;
            max-width: 1000px;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            box-shadow: 8px 8px 6px 0px rgba(2, 2, 2, 2);
        }

        .card-image {
            /* Adjust width to occupy 100% of its container */
            width: 100%;
            height: 100%;
            text-align: right;
        }

        .img-fluid {
            height: 100%;
            width: 100%;
        }

        .login {
            width: 100%;
            height: auto;
        }
        .forgot-password a {
            text-align: right;
            text-decoration: none;
            font-weight: bold;
        }

        .google-sign-in {
            text-align: center;
            margin-top: 20px;
            
        }

        /* Styles for the eye icon */
        .eye-icon {
            position: absolute;
            right: 10px;
            top: calc(50% - 10px);
            cursor: pointer;
        }
        .google-icon {
            vertical-align: middle;
            margin-right: 8px;
            width: 35px;
            border-radius: 50px;
            float: left;
            
        }
        .google-round-btn {
            border-radius: 30px; /* Use a large value to create a round shape */
           
        }
        .plant {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%; /* Adjust the width as needed */
             z-index: -1; /*Places the image behind other content */
            opacity: 0.3 /* Places the image behind other content */
        }
        .card-on-image {
            animation: fadeIn 1s ease-in-out forwards;
        }

        .google-round-btn {
            transition: transform 0.3s ease-in-out;
            font-weight: bold;
        }

        @keyframes pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1);
    }
    100% {
        transform: scale(1);
    }
}

.google-round-btn:hover {
    animation: pulse 1s ;
}


@import url('https://fonts.googleapis.com/css?family=Exo:400,700');

*{
    margin: 0px;
    padding: 0px;
}

body{
    font-family: 'Exo', sans-serif;
}


.context {
    width: 100%;
    position: absolute;
    top:50vh;
    
}

.context h1{
    text-align: center;
    color: #fff;
    font-size: 50px;
}

.circles{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.circles li{
    position: absolute;
    display: block;
    list-style: none;
    width: 20px;
    height: 20px;
    background:#A0E7F7;
    animation: animate 20s linear infinite;
    bottom: -150px;
    
}

.circles li:nth-child(1){
    left: 25%;
    width: 80px;
    height: 80px;
    animation-delay: 0s;
}


.circles li:nth-child(2){
    left: 10%;
    width: 20px;
    height: 20px;
    animation-delay: 2s;
    animation-duration: 12s;
}

.circles li:nth-child(3){
    left: 70%;
    width: 20px;
    height: 20px;
    animation-delay: 4s;
}

.circles li:nth-child(4){
    left: 40%;
    width: 60px;
    height: 60px;
    animation-delay: 0s;
    animation-duration: 18s;
}

.circles li:nth-child(5){
    left: 65%;
    width: 20px;
    height: 20px;
    animation-delay: 0s;
}

.circles li:nth-child(6){
    left: 75%;
    width: 110px;
    height: 110px;
    animation-delay: 3s;
}

.circles li:nth-child(7){
    left: 35%;
    width: 150px;
    height: 150px;
    animation-delay: 7s;
}

.circles li:nth-child(8){
    left: 50%;
    width: 25px;
    height: 25px;
    animation-delay: 15s;
    animation-duration: 45s;
}

.circles li:nth-child(9){
    left: 20%;
    width: 15px;
    height: 15px;
    animation-delay: 2s;
    animation-duration: 35s;
}

.circles li:nth-child(10){
    left: 85%;
    width: 150px;
    height: 150px;
    animation-delay: 0s;
    animation-duration: 11s;
}



@keyframes animate {

    0%{
        transform: translateY(0) rotate(0deg);
        opacity: 1;
        border-radius: 0;
    }

    100%{
        transform: translateY(-1000px) rotate(720deg);
        opacity: 0;
        border-radius: 50%;
    }

}


  .checkbox-wrapper-46 input[type="checkbox"] {
    display: none;/
    visibility: hidden;
  }

  .checkbox-wrapper-46 .cbx {
    margin: auto;
    -webkit-user-select: none;
    user-select: none;
    cursor: pointer;
  }
  .checkbox-wrapper-46 .cbx span {
    display: inline-block;
    vertical-align: middle;
    transform: translate3d(0, 0, 0);
  }
  .checkbox-wrapper-46 .cbx span:first-child {
    position: relative;
    
    width: 18px;
    height: 18px;
    border-radius: 3px;
    transform: scale(1);
    vertical-align: middle;
    border: 1px solid #9098A9;
    transition: all 0.2s ease;
  }
  .checkbox-wrapper-46 .cbx span:first-child svg {
    position: absolute;
    top: 3px;
    left: 2px;
    fill: none;
    stroke: #FFFFFF;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
    stroke-dasharray: 16px;
    stroke-dashoffset: 16px;
    transition: all 0.3s ease;
    transition-delay: 0.1s;
    transform: translate3d(0, 0, 0);
  }
  .checkbox-wrapper-46 .cbx span:first-child:before {
    content: "";
    width: 100%;
    height: 100%;
    background: #506EEC;
    display: block;
    transform: scale(0);
    opacity: 1;
    border-radius: 50%;
  }
  .checkbox-wrapper-46 .cbx span:last-child {
    padding-left: 8px;
  }
  .checkbox-wrapper-46 .cbx:hover span:first-child {
    border-color: #506EEC;
  }

  .checkbox-wrapper-46 .inp-cbx:checked + .cbx span:first-child {
    background: #506EEC;
    border-color: #506EEC;
    animation: wave-46 0.4s ease;
  }
  .checkbox-wrapper-46 .inp-cbx:checked + .cbx span:first-child svg {
    stroke-dashoffset: 0;
  }
  .checkbox-wrapper-46 .inp-cbx:checked + .cbx span:first-child:before {
    transform: scale(3.5);
    opacity: 0;
    transition: all 0.6s ease;
  }

  @keyframes wave-46 {
    50% {
      transform: scale(0.9);
    }
  }
</style>


</head>
<body>


    <!-- <div class="container"> -->
        <div class="container-fluid screen">
            <img class="login" src="../dashboard/images/bg.avif" alt="Background Image"></div>
            <div class="card card-on-image" >
                <div class="row ">
                    <div class="col">
                        <div class="card-body">
                            <h5 class="card-title" style="font-weight: bold; font-size: 40px; font-family: Georgia;">LOGIN</h5>
                            <form method="POST">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" style="font-weight: bold; font-family: Georgia;" class="form-label">Email address</label>
                                    <input type="email" name="email" class="form-control" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" style="font-weight: bold; font-family: Georgia;" class="form-label">Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control">
                                        <span class="eye-icon" onclick="togglePassword()">&#128065;</span>
                                    </div>
                                </div>
                                <div style="float:right"class="checkbox-wrapper-46">
                                    <input class="inp-cbx" id="cbx-46" type="checkbox" />
                                    <label class="cbx" for="cbx-46"><span>
                                      <svg width="12px" height="10px" viewbox="0 0 12 10">
                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                      </svg></span><span>Remember Me</span>
                                    </label>
                                  </div>
                                <div class="forgot-password">
                                    <a href="#">Forgot Password?</a>
                                </div>
                                
                                <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary google-round-btn" style=" margin-top:40px;width: 300px; height: 45px; margin-left: auto; margin-right: auto;" name="submit" id="submit">Submit</button></div>
                                </form>
                            
                            <!-- <div class="google-sign-in">
                                <button  style="background-color: white; color:black ; width: 300px;" type="button" class="btn btn-primary google-round-btn">
                                    <img src="https://cdn-icons-png.flaticon.com/128/300/300221.png" alt="Google icon" class="google-icon">
                                    <p style="font-family: Georgia; margin-bottom: 5px;">Sign in with Google</p>
                                </button>
                            </div> -->
                        </div>
                    </div>
                    
                    <div class="col card-image">
                        <img src="../dashboard/images/Code review-amico.png" class="img-fluid" alt="...">
            </div>
            <img class="plant" src="../dashboard/images/plants123.png" alt="Plant Image">
            </div>
        
</div>
</div>
<div class="context">

       
    <div class="area" >
                <ul class="circles">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                </ul>
        </div >
    </div>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("exampleInputPassword1");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>
</body>
</html>