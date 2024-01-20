<?php 
include("../data/db.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Applicant</title>
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
    <link rel="shortcut icon" href="../schoologo.png" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper auth p-0 theme-two">
          <div class="row d-flex align-items-stretch">
            <div class="col-md-4 banner-section d-none d-md-flex align-items-stretch justify-content-center">
              <div class="slide-content bg-2"> </div>
            </div>
            <div class="col-12 col-md-8 h-100 bg-white">
              <div class="auto-form-wrapper d-flex align-items-center justify-content-center flex-column">
                <div class="nav-get-started">
                  <p>Already have an account?</p>
                  <a class="btn get-started-btn" href="login.php">Continue Application</a>
                </div>
                <form action="" method="post" name="newappform"> 
                  <h3 class="mr-auto">Start New Application</h3>
                  <p class="mb-5 mr-auto">Enter your details below.</p>
                  
                  <?php 
                  if(isset($_POST["btn"]))
                  {
                    $fullname = $_POST["fullname"];
                    $email = $_POST["email"];
                    $programme = $_POST["programme"];
                    $contact = $_POST["contact"];
                    $password = $_POST["password"];
                    $checkexist = $pdo->prepare("SELECT * FROM `applicant` WHERE `gsm` = ? OR `email` = ?");
                    $checkexist->execute([$contact, $email]);
                    if($checkexist->rowCount() > 0)
                    {
                      echo '<div class="alert alert-danger">Sorry email or phone number already exist.</div>';
                    }else
                    {
                      if($fullname =="" || $programme =="" || $contact ==""|| $password =="" || $email==""){
                        if($_POST["fullname"] == "")
                        {
                          echo "Please enter your fullname<br>";
                        }
                        if($_POST["email"]=="")
                        {
                          echo "Please enter your email<br>";
                        }
                        if($_POST["programme"]=="")
                        {
                          echo "Please select programme<br>";
                        }
                        if($_POST["contact"]=="")
                        {
                          echo "Please enter your contact<br>";
                        }
                        if($_POST["password"]=="")
                        {
                          echo "Please enter your Password<br>";
                        }
                      }
                      else
                      {
                        $programme = strtoupper($_POST["programme"]);
                        $programme_type = strtok($programme, ' ');
                        echo $programme_type; // Test

                     //   list($programme_type) = explode(' IN', $programme);
                        if (strtolower($programme_type) == "national"){
                          $level = "ND1";
                        }else
                        if (strtolower($programme_type) == "higher"){
                          $level = "HND1";
                        }else
                        if (strtolower($programme_type) == "prehnd"){
                          $level = "PREHND";
                        }else
                        if (strtolower($programme_type) == "prend"){
                          $level = "PREND";
                        }else
                        if (strtolower($programme_type) == "diploma"){
                          $level = "DIP1";
                        }else
                        if (strtolower($programme_type) == "certificate"){
                          $level = "CERT";
                        }else
                        {
                          $level = "LEVEL1";
                        }
                        $schn = $school_abb;
                        $selectappno = $pdo->query("SELECT `applno` FROM `appno`");
                        $fndapno = $selectappno->fetch();
                        $newapno = ($fndapno["applno"] + 1);
                      if(strlen($newapno) >= 4){
                          $serial_no = $newapno;
                      }else
                      {
                          $serial_no = str_pad($newapno, 4,'0', STR_PAD_LEFT);
                      }
                        $year= $school_app_year;
                        $application_no= $schn.$year."-APP-".$serial_no; 
                        
                        $insertrec = $pdo->prepare("INSERT INTO `applicant`(`names`, `application_no`, `programme`, `password`, `gsm`, `email`, `level`, `year`)VALUES(?,?,?,?,?,?,?,?)");
                        $insertrec->execute([$fullname, $application_no, $programme, $password, $contact, $email, $level, $year]);
                        //$appid = $pdo->lastInsertId();
                        if($insertrec){
                         // $_SESSION['userapps']=="app";
                          $invoicetype = encryptor("encrypt","Application fee");
                          $updt = $pdo->query("UPDATE `appno` SET applno = '".$newapno."'");
                          echo "<script>alert('Please copy down this Application number"." ". $application_no."')</script>";
                          echo '<div class="alert alert-success">Loading payment Invoice.....</div><script>setTimeout(function(){location.href="app_invoice?appno='.encryptor("encrypt",$application_no).'&invtyp='.$invoicetype.'"},100)</script>';
                        }
                      }  
                    }
                  }
                  ?>
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="mdi mdi-account-outline"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control" placeholder="Full name" name="fullname" Required>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="mdi mdi-contact-mail "></i>
                        </span>
                      </div>
                      <input type="email" class="form-control" placeholder="Email" name="email" Required>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="mdi mdi-book-multiple"></i>
                        </span>
                      </div>
                      <select type="text" class="form-control" placeholder="Programmes" name="programme" Required>
                        
                      <option value="" selected>Programmes</option>
                        <?php 
                        $theprg = $pdo->query("SELECT `programme` FROM `programmes`");
                        while($prow = $theprg->fetch()){
                        ?>
                        <option><?php echo $prow["programme"];?></option>
                        <?php 
                        }?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class=" mdi mdi-cellphone-android "></i>
                        </span>
                      </div>
                      <input type="text" class="form-control" placeholder="Phone" name="contact" Required>
                    </div>
                  </div>
                  <div class="form-group">
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
                    <button class="btn btn-primary submit-btn" type="Submit" name="btn">Create Account</button>
                  </div>
                  <div class="wrapper mt-5 text-gray">
                  <p class="footer-text">Copyright <?php echo date('Y');?> © GIGBDI LTD -  All rights reserved.</p>
                    <ul class="auth-footer text-gray">
                    <li>
                        <a href="#"><b>Having Issues?</b></a>
                      </li>
                      <li>
                        <a href="#">Contact ICT </a>
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