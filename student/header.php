<?php 
if (!isset($_SESSION)){ session_start();}
if (!isset($_SESSION['pageaccess'])) {
    header('Location: ../');
    exit();
}
include("../data/db.php");
if(isset($_GET["logout"]))
{
  session_destroy();
  echo '<script>location.replace("../") </script>';
}
// if (!isset($_SESSION)){ session_start(); }
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
$gender = $student_sex; 
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
$student_college = @$stcolleges["college"];

$schl = $pdo->prepare("SELECT * FROM `schools` WHERE `id`=? ");
$schl->execute([$student_school_id]);
$stschl = $schl->fetch();
$student_school = $stschl["school"];
//fetch  payments by session and semester
$stu_pay = $pdo->query("SELECT * FROM `stu_payloader` WHERE `matno`='$student_matno' AND `session` = '$school_activesession' AND `semester` = '$school_activesemester' AND `status` = 'paid'");
$pay_rw = $stu_pay->fetch();

$stu_p = $pdo->query("SELECT * FROM `stu_payloader` WHERE `matno`='$student_matno' AND `session` = '$school_activesession' AND `semester` = '$school_activesemester'");
//fatch  courses reg by session and semmester
$stu_course_reg = $pdo->query("SELECT * FROM `stu_course_reg` WHERE `matno`='$student_matno' AND `session` = '$school_activesession' AND `semester` = '$school_activesemester'");
$course_reg_row = $stu_course_reg->fetch();

$stu_passpt = $pdo->query("SELECT `file` FROM `stu_files` WHERE `matno`='$student_matno' AND `certificate` = 'Passport'");
$file_ppt = $stu_passpt->fetch();
$stu_passport = @$file_ppt["file"];
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
        <!-- partial -->
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
          <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-chevron-double-left"></span>
            </button>
            <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item nav-logout d-none d-lg-block">
                <a class="nav-link" href="?logout">
                  <i class="mdi mdi-power"></i>Logout
                </a>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </nav>