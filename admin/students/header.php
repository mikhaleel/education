<?php
include("../../data/db.php");
if(isset($_GET["logout"]))
{
  echo '<script>location.replace("../") </script>';
}
$semester_arr = array(1=>"First Semester", 2=>"Second Semester", 3=>"Third Semester");
if (!isset($_SESSION)){ session_start(); }
//fetch students record
if(isset($_GET["matno"])){ $_SESSION["student_id"] = $_GET["matno"];}
$id = encryptor('decrypt',$_GET["matno"]) ?? encryptor('decrypt',$_SESSION["student_id"]);
$student_info = $pdo->prepare("SELECT * FROM students WHERE `id`=?");
$student_info->execute([$id]); $student_data=$student_info->fetch();
$student_id = $student_data["id"];
$student_name = $student_data["names"];
$student_utme = $student_data["utme"];
$student_matno = $student_data["matno"];
$student_level = $student_data["level"];
$student_password = $student_data["password"];
$student_sex = $student_data["sex"];
$student_dob = $student_data["dob"];
$student_tribe = $student_data["tribe"];
$student_religion = $student_data["religion"];
$student_country = $student_data["country"];
$student_state = $student_data["states"];
$student_lga = $student_data["lga"];
$student_address = $student_data["address"];
$student_email = $student_data["email"];
$student_contact = $student_data["contact"];
$student_programme = $student_data["programme"];
$student_department = $student_data["department"];
$student_year = $student_data["year"];
$student_entry_session = $student_data["entry_session"];
$student_session = $student_data["session"];
$student_stat = $student_data["stat"];
$student_Withdrwan = $student_data["Withdrwan"];
$student_college_id = $student_data["college_id"];
$student_school_id = $student_data["school_id"];
$student_semester = $student_data["semester"];
$colg = $pdo->prepare("SELECT * FROM `colleges` WHERE `id`=? ");
$colg->execute([$student_college_id]);
$stcolleges = $colg->fetch();
$student_college = $stcolleges["college"];


$schl = $pdo->prepare("SELECT * FROM `schools` WHERE `id`=? ");
$schl->execute([$student_school_id]);
$stschl = $schl->fetch();
$student_school = $stschl["school"];
//fetch  payments by session and semester
$stu_pay = $pdo->query("SELECT * FROM `stu_payloader` WHERE `matno`='$student_matno' AND `session` = '$school_activesession' AND `semester` = '$school_activesemester' AND `status` = 'paid'");
$stu_p = $pdo->query("SELECT * FROM `stu_payloader` WHERE `matno`='$student_matno' AND `session` = '$school_activesession' AND `semester` = '$school_activesemester' AND `status` = 'paid'");
$pay_row = $stu_pay->fetch();
//fatch  courses reg by session and semmester
$stu_course_reg = $pdo->query("SELECT * FROM `stu_course_reg` WHERE `matno`='$student_matno' AND `session` = '$school_activesession' AND `semester` = '$school_activesemester'");
$course_reg_row = $stu_course_reg->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Student Portal</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/jquery-bar-rating/css-stars.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/demo_1/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>
  <body>
  <?php include "sidebar.php"?>
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_settings-panel.html -->
        <div id="settings-trigger"><i class="mdi mdi-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close mdi mdi-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-default-theme">
            <div class="img-ss rounded-circle bg-light border me-3"></div>Default
          </div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme">
            <div class="img-ss rounded-circle bg-dark border me-3"></div>Dark
          </div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles default primary"></div>
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles light"></div>
          </div>
        </div>
        <!-- partial -->
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
          <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-chevron-double-left"></span>
            </button>
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
              <a class="navbar-brand brand-logo-mini" href="index-2.html"><img src="https://demo.bootstrapdash.com/plus/jquery/template/assets/images/logo-mini.svg" alt="logo" /></a>
            </div>
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="mdi mdi-email-outline"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-left navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                  <h6 class="p-3 mb-0 font-weight-semibold">Messages</h6>
                  <div class="dropdown-divider"></div>
                 
                  <h6 class="p-3 mb-0 text-center text-primary font-13">0 messages</h6>
                </div>
              </li>
              <li class="nav-item dropdown ms-3">
                <a class="nav-link" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                  <i class="mdi mdi-bell-outline"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-left navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                  <h6 class="px-3 py-3 font-weight-semibold mb-0">Notifications</h6>
                  <div class="dropdown-divider"></div>
                  
                  <h6 class="p-3 font-13 mb-0 text-primary text-center">View notifications</h6>
                </div>
              </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item nav-profile dropdown d-none d-md-block">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                  <div class="nav-profile-text">English </div>
                </a>
                <div class="dropdown-menu center navbar-dropdown" aria-labelledby="profileDropdown">
                  <a class="dropdown-item" href="#">
                    <i class="flag-icon flag-icon-bl me-3"></i> French </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">
                    <i class="flag-icon flag-icon-cn me-3"></i> Chinese </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">
                    <i class="flag-icon flag-icon-de me-3"></i> German </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">
                    <i class="flag-icon flag-icon-ru me-3"></i>Russian </a>
                </div>
              </li>
              <li class="nav-item nav-logout d-none d-lg-block">
                <a class="nav-link" href="../index.php">
                  <i class="mdi mdi-power"></i>Logout
                </a>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </nav>