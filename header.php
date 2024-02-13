


 <?php
require_once "fs_world.php";
session_start();
$mainID=$_SESSION["mainID"];
include_once "forbidaccess/forbiddenaccess.php";


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Gati - Admin Dashboard Template</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel='stylesheet' href='assets/bundles/fullcalendar/packages/core/main.min.css' />
  <link rel='stylesheet' href='assets/bundles/fullcalendar/packages/daygrid/main.min.css' />
  <link rel='stylesheet' href='assets/bundles/fullcalendar/packages/timegrid/main.min.css' />
  <link rel="stylesheet" href="assets/bundles/prism/prism.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <link rel="stylesheet" href="assets/bundles/jqvmap/dist/jqvmap.min.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />

  <link rel="stylesheet" href="assets/bundles/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="assets/bundles/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="assets/bundles/jquery-selectric/selectric.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
  <link rel="stylesheet" href="assets/bundles/pretty-checkbox/pretty-checkbox.min.css">
  <link rel="stylesheet" href="assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/bundles/izitoast/css/iziToast.min.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline me-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-bs-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="menu"></i></a></li>
            <li>
              <form class="form-inline me-auto">
                <div class="search-element d-flex">
                  <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </form>
            </li>
          </ul>
        </div>


        <?php 
    $qry=mysqli_query($connection,"SELECT * from admin_details where a_id ='$mainID' and status='1'") or die(mysqli_error($connection));
    while($res=mysqli_fetch_object($qry)){

      ?>

        <ul class="navbar-nav navbar-right">
          <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
              <i data-feather="maximize"></i>
            </a></li>
          <li class="dropdown"><a href="#" data-bs-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="assets/img/user.png"
                class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">Hello <?php echo $res ->admin_name;?>!</div>
              <a href="#" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Profile
              </a> <a href="#" class="dropdown-item has-icon"> <i class="fas fa-bolt"></i>
                Activities
              </a> <a href="" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                Settings
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item has-icon text-danger" class="logout" name="logout" id="sessionend"> <i class="fas fa-sign-out-alt"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="#"> <img alt="image" src="assets/img/logo.png" class="header-logo" /> <span
                class="logo-name">Gati</span>
            </a>
          </div>
          <div class="sidebar-user">
            <div class="sidebar-user-picture">
              <img alt="image" src="assets/img/user.png">
            </div>
            <div class="sidebar-user-details">
              <div class="user-name"><?php echo $res ->admin_name;?></div>
              <div class="user-role">Administrator</div>
              <div class="sidebar-userpic-btn">
                <a href="#" data-bs-toggle="tooltip" title="Profile">
                  <i data-feather="user"></i>
                </a>
                <a href="#" data-bs-toggle="tooltip" title="Mail">
                  <i data-feather="mail"></i>
                </a>
                <a href="#" data-bs-toggle="tooltip" title="Chat">
                  <i data-feather="message-square"></i>
                </a>
                <a data-bs-toggle="tooltip" title="Log Out">
                  <i data-feather="log-out" class="logout" name="logout" id="sessionend" ></i>
                </a>
              </div>
            </div>
          </div>
       <ul class="sidebar-menu">
    <li class="menu-header">Main</li>
    <li class="dropdown">
        <a href="dashboard.html" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
        <?php
      
        $Get_menus = mysqli_query($connection, "SELECT menu_name, menu_url, menu_id FROM menus WHERE status='1' AND type='P'") or die(mysqli_error($connection));
        while ($row = mysqli_fetch_object($Get_menus)) {
            $menu = $row->menu_name;
            $menu_id = $row->menu_id;
            $menu_url = $row->menu_url;

            // Check for submenus
            $hasSubmenus = mysqli_query($connection, "SELECT COUNT(*) AS total FROM menus WHERE status='1' AND parent_id='$menu_id' AND type='c'");
            $subMenuCount = mysqli_fetch_assoc($hasSubmenus)['total'];

            if ($subMenuCount > 0) {
        ?>
                <li class="dropdown">
                    <a href="<?= $menu_url ?>" class="menu-toggle nav-link has-dropdown"><i data-feather="arrow-right"></i><span><?= $menu ?></span></a>
                    <ul class="dropdown-menu">
                        <?php
                        $sub_menus = mysqli_query($connection, "SELECT menu_name, menu_url, menu_id FROM menus WHERE status='1' AND parent_id='$menu_id' AND type='c'") or die(mysqli_error($connection));
                        while ($sub_row = mysqli_fetch_object($sub_menus)) {
                            $sub_menu = $sub_row->menu_name;
                            $sub_menu_url = $sub_row->menu_url;
                        ?>
                            <li><a class="nav-link" href="<?= $sub_menu_url ?>"><?= $sub_menu ?></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>
            <?php
            } else {
            ?>
                <li>
                    <a href="<?= $menu_url ?>" class="nav-link"><i data-feather="layout"></i><span><?= $menu ?></span></a>
                </li>
        <?php
            }
        }
       
        ?>
    </li>
</ul>
</aside>
</div>


      <?php
    }
    ?>
    <script>
$(document).ready(function() {
    $('#sessionend').click(function() {
        $.ajax({
            type: 'POST',
            url: 'forbidaccess/destroy_session.php', // Replace with your PHP script file
            data: { logout: 2 }, // Data to send to PHP script
            success: function(response) {
                console.log('Data sent successfully');
                // Do something with the response if needed
            },
            error: function() {
                console.error('Error sending data');
            }
        });
    });
});
</script>


   
    </body>
</html>