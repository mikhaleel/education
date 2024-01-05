<?php
include("../data/db.php");
$appno = encryptor("decrypt",$_GET["appno"]);
$checkexist = $pdo->prepare("SELECT * FROM `applicant` WHERE  `application_no` = ?");
$checkexist->execute([$appno]);
$app_infor = $checkexist->fetch();

$screeningfee = "paid"; $screninglink = '<a href="#" class="btn btn-success">Paid</a>';
$schoolfee = 'paid'; $schoolfeelink = '<a href="#" class="btn btn-success">Paid</a>';
$acceptancefee = 'paid'; $acceptancelink = '<a href="#" class="btn btn-success">Paid</a>';
$admstatus = 'Congratulations!! you got an offer';

if($app_infor['acceptance_fee'] !== "paid")
{
  $acceptancefee = "unpaid"; $acceptancelink = '<a href="app_invoice?appno='.$_GET["appno"].'&invtyp='.encryptor("encrypt","Acceptance fee").'">Pay Now</a>';
}
if($app_infor['screening_fee'] !== "paid")
{
  $screeningfee = "unpaid"; $screninglink = '<a href="app_invoice?appno='.$_GET["appno"].'&invtyp='.encryptor("encrypt","Screening fee").'">Pay Now</a>';
}
if($app_infor['school_fee'] !== "paid")
{
  $schoolfee = "unpaid"; $schoolfeelink = '<a href="app_invoice?appno='.$_GET["appno"].'&invtyp='.encryptor("encrypt","School Fees").'">Pay Now</a>';
}
if($app_infor['adm_status'] == "No")
{
  $admstatus = "Applictaion under review";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Applicant-<?php echo $appno;?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/jquery-bar-rating/css-stars.css">
    <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <!-- End Plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/shared/style.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/demo_11/style.css">
    <!-- End Layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_horizontal-navbar.html -->
      <nav class="navbar horizontal-layout col-lg-12 col-12 p-0">
        <div class="container d-flex flex-row nav-top">
          <div class="text-center navbar-brand-wrapper d-flex align-items-top">
            <a class="navbar-brand brand-logo" href="index-2.html">
              <img src="https://demo.bootstrapdash.com/star-admin-pro/src/assets/images/logo_2.svg" alt="logo" /> </a>
            <a class="navbar-brand brand-logo-mini" href="index-2.html">
              <img src="https://demo.bootstrapdash.com/star-admin-pro/src/assets/images/logo-mini.svg" alt="logo" /> </a>
          </div>
          <div class="navbar-menu-wrapper d-flex align-items-center">
            <form action="#" class="d-none d-sm-block">
              <div class="input-group search-box">
                <div class="input-group-prepend">
                  <!-- <span class="input-group-text">
                    <i class="mdi mdi mdi-magnify"></i>
                  </span> -->
                </div>
                <!-- <input type="text" class="form-control" placeholder="Type to search…"> -->
                <!-- <i class="mdi mdi mdi-close search-close"></i> -->
              </div>
            </form>
            <ul class="navbar-nav ms-auto">
              <li class="nav-item dropdown">
               
              </li> 
              <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
                <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                  <div class="wrapper d-flex flex-column">
                    <span class="profile-text"><?php echo $app_infor["names"];?></span>
                    <span class="user-designation"><?php echo $app_infor["email"];?></span>
                  </div>
                  <!-- <div class="display-avatar bg-inverse-primary text-primary">AS</div> -->
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                  <div class="dropdown-header text-center">
                    <!-- <img class="img-md rounded-circle" src="assets/images/faces/face1.jpg" alt="Profile image">
                    <p class="mb-1 mt-3 font-weight-semibold"><?php echo $app_infor["names"];?></p>
                    <p class="font-weight-light text-muted mb-0"></p> -->
                  </div>
                  <!-- <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary"></i> My Profile </a>
                  <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-help-circle-outline text-primary"></i> FAQ</a> -->
                  <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-power text-primary"></i>Sign Out</a>
                </div>
              </li>
            </ul>
            <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </div>
  <?php include "sidebar.php"?>
      </nav>
      <!-- partial -->