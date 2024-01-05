<?php
include("../data/db.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Renew Applicant</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End Plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/shared/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper auth p-0 theme-two">
          <div class="row d-flex align-items-stretch">
            <div class="col-md-4 banner-section d-none d-md-flex align-items-stretch justify-content-center">
              <div class="slide-content bg-1"> </div>
            </div>
            <div class="col-12 col-md-8 h-100 bg-white">
              <div class="auto-form-wrapper d-flex align-items-center justify-content-center flex-column">
                <div class="nav-get-started">
                  <p>Don't have an account?</p>
                  <a class="btn get-started-btn" href="register.php">GET STARTED</a>
                </div>
                <form action="" name="cappForm" method="post">
                  <h3 class="mr-auto">Welcome back!</h3>
                  <p class="mb-5 mr-auto">Enter your details below.</p>
                  <?php 
                  if(isset($_POST["btn"]))
                  {
                    $gsmoremailorappno = $_POST["username"];
                    $password = $_POST["password"];
                    $checkexist = $pdo->prepare("SELECT * FROM `applicant` WHERE `password` = ? AND (`gsm` = ? OR `email` = ? OR `application_no` = ?)");
                    $checkexist->execute([$password, $gsmoremailorappno, $gsmoremailorappno, $gsmoremailorappno]);
                    if($checkexist->rowCount() > 0)
                    {
                      $_SESSION['userapps']=="app";
                      $checked = $checkexist->fetch();
                      //$last_string = serialize($checked["application_no"]);
                      $_SESSION['username'] = $checked["email"];
                      $serial_no = date("Ymdis");
                      $_SESSION['userapps'] = $checked["email"];
                      // pass all data into an array                    
                      //`application_fee` = 'paid'
                      $appno = $checked["application_no"];
                      if($checked["application_fee"] == "paid")
                      {
                          if($checked["app_status"] == "completed")
                          {                
                              echo '<div class="alert alert-success">Loading Applicant Account.....</div><script>setTimeout(function(){location.href="dashboard?appno='.encryptor("encrypt",$appno).'&start'.'"},1000)</script>';
                          }
                          else
                          {
                              //show application form
                              echo '<div class="alert alert-success">Loading Application Form.....</div><script>setTimeout(function(){location.href="appform?appno='.encryptor("encrypt",$appno).'&start'.'"},1000)</script>';
                          }
                      }
                      else
                      {
                          $invoicetype = encryptor("encrypt","Application fee");
                          //$_SESSION['userapps'] = $invoicetype;
                          //show invoice to pay app fee
                          echo '<div class="alert alert-success">Loading payment page.....</div><script>setTimeout(function(){location.href="app_invoice?appno='.encryptor("encrypt",$appno).'&invtyp='.$invoicetype.'"},100000)</script>';
                      }
                      
                    }else
                    {
                      echo '<div class="alert alert-danger">Login details incorrect.....</div>';

                    }
                  }
                  ?>
                  <div class="form-group">
                      <label><b>Application No.</b></label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="mdi mdi-account-outline"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control" placeholder="Application No. / Phone Number/ Email" name="username" Required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label><b>Password</b></label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="mdi mdi-lock-outline"></i>
                        </span>
                      </div>
                      <input type="password" class="form-control" placeholder="Password" name="password" Required>
                    </div>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-primary submit-btn" type="Submit" name="btn">SIGN IN</button>
                  </div>
                  <div class="wrapper mt-5 text-gray">
                    <p class="footer-text">Copyright <?php echo date('Y');?> © Renew Portal -  All rights reserved.</p>
                    <ul class="auth-footer text-gray">
                      <li>
                        <a href="#"><b>Having Issues?</b></a>
                      </li>
                      <li>
                        <a href="#">Contact MIS </a>
                      </li>
                    </ul>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/shared/off-canvas.js"></script>
    <script src="assets/js/shared/hoverable-collapse.js"></script>
    <script src="assets/js/shared/misc.js"></script>
    <script src="assets/js/shared/settings.js"></script>
    <script src="assets/js/shared/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
  </body>
</html>