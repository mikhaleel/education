<?php
include("data/db.php");
if (!isset($_SESSION))
{
  session_start();
}
if(isset($_POST["logbtn"])){
if(
	$_POST["username"]==""||
	$_POST["password"]==""
  )
  {
	  echo '<div class="alert alert-danger">Empty fields cannot be submitted</div>';
  }
  else
  {
	//staff table
	 $checkq = $pdo->prepare("SELECT * FROM `staff` WHERE `username` = ? && `password` = ? and `status`=?");
	 $checkq->execute([$_POST["username"], $_POST["password"], '1']);
	 $trows = $checkq->fetch(PDO::FETCH_ASSOC);
	 
	 $depts = @$trows["department"];
	 
	 $deptids = $pdo->prepare("SELECT dept_id FROM `departments` WHERE `names` = ?");
	 $deptids->execute([$depts]);
	 $dpt_ids = $deptids->fetch();
		
		if($checkq->rowCount() != 0)
		{
			if($trows["usertype"] <= 0)
			{                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
				echo '<div class="alert alert-danger">Access, Denied</div><script>setTimeout(function(){location.href="../logout.php"},10)</script>';
			}
			else
			{
			  if($trows["designation"] == 'EO' OR $trows["designation"] == 'EXAMINATION OFFICER' OR $trows["designation"] == 'APO'){
				$_SESSION['eo'] = $trows["designation"];
				}
 //   echo '<script>alert("'.$trows["department"].'")</script>';
				$_SESSION["username"] = $trows["username"];
				$_SESSION["names"] = $trows["names"];
				$_SESSION["designation"] = $trows["designation"];
				$_SESSION["school"] = $trows["school"];
				$_SESSION["dept_id"] = $dpt_ids["dept_id"];//$trows["department"];
				$_SESSION["department"] =$trows["department"];
				$_SESSION["usertype"] = $trows["usertype"];
				$_SESSION["accesslevel"] = $trows["accesslevel"];
				$_SESSION["image"] = $trows["image"];
				$_SESSION["status"] = $trows["status"];
				$_SESSION["usermenu"] = $trows["usertype"];
			  $_SESSION["usreid"] = encryptor("encrypt",$trows["id"]);
				$_SESSION["level"] = 'staff';
				$_SESSION["pageaccess"] = "pageaccess";
				$_SESSION["studeymode"] = encryptor("encrypt","Full Time");

        // if($trows["designation"] == 'APO'){
        //   $_SESSION['dap'] = $trows["designation"];
        //   echo '<div class="alert alert-success outline alert-dismissible fade show" role="alert"><i data-feather="thumbs-up"></i><b>Wait,</b> loading dashboard....</div><script>setTimeout(function(){location.href="rms_dap"},50)</script>';
				// }else{
				    echo '<div class="alert alert-success outline alert-dismissible fade show" role="alert"><i data-feather="thumbs-up"></i><b>Wait,</b> loading dashboard....</div><script>setTimeout(function(){location.href="admin/"},50)</script>';
				//}
			}
// 		}else
// 		{			echo '<div class="alert alert-danger">'.$_POST["username"].'Login details incorrect</div>';
	}
	 elseif($checkq->rowCount() == 0)
	 {
		 // stduent table
		$scheckq = $pdo->prepare("SELECT * FROM `students` WHERE `matno` = ? &&  (`password` = ? OR `password`=?) ");
		$scheckq->execute([$_POST["username"], $_POST["password"], 'Easy123']);
		$strows = $scheckq->fetch(PDO::FETCH_ASSOC);

		if($scheckq->rowCount() != 0 && $strows['stat']=='1')//student count
		{
		  $_SESSION["username"] = $strows["matno"];
		  $_SESSION["names"] = $strows["names"];
		  $_SESSION["designation"] = "Students";
		  $_SESSION["department"] = $strows["department"];
		  $_SESSION["programme"] = $strows["programme"];
		  //$_SESSION["accesslevel"] = $trows["accesslevel"];
		  $_SESSION["image"] = $strows["images"];
		  $_SESSION["status"] = $strows["stat"];
		  //$_SESSION["usermenu"] = $trows["usertype"];
		  $_SESSION["usreid"] = encryptor("encrypt",$strows["id"]);
		  $_SESSION["matno"] = encryptor("encrypt",$strows["matno"]);
		  //$_SESSION["matno"] = $strows["matno"];
          $_SESSION["level"] = 'student';
		  $_SESSION["usertype"] = 0;

		  $_SESSION["email"] = $strows["email"];
		  $_SESSION["spageaccess"] = "spageaccess";
		  $_SESSION["studeymode"] = encryptor("encrypt","Full Time");			
          echo '<div class="alert alert-success outline alert-dismissible fade show" role="alert"><i data-feather="thumbs-up"></i><b>Wait,</b> loading dashboard....</div><script>setTimeout(function(){location.href="index"},20)</script>';
        }
    	elseif($scheckq->rowCount() != 0 && $strows['stat']=='2')//student count
            {
    		   echo '<div class="alert alert-danger">'.$_POST["username"].' You have been  RUSTICATED</div>';

    }else
	   {
		   echo '<div class="alert alert-danger">'.$_POST["username"].' Login details incorrect</div>';
	   }
	 }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>School Login</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="admin/assets/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="admin/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="admin/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="admin/assets/css/demo_1/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="admin/assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
          <div class="row flex-grow">
            <div class="col-lg-6 d-flex align-items-center justify-content-center">
              <div class="auth-form-transparent text-left p-3">
                <div class="brand-logo">
                  <img src="https://demo.bootstrapdash.com/plus/jquery/template/assets/images/logo.svg" alt="logo">
                </div>
                <h4>Welcome back!</h4>
                <h6 class="font-weight-light"> Log in to your dashboard.</h6>
                <form class="pt-3" method="post">
                  <div class="form-group">
                    <label for="exampleInputEmail"><b>Email / Matric No</b></label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-account-outline text-primary"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control form-control-lg border-left-0" id="" placeholder="Email / Matric No" name="username">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword"><b>Password</b></label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-lock-outline text-primary"></i>
                        </span>
                      </div>
                      <input type="password" class="form-control form-control-lg border-left-0" id="exampleInputPassword" placeholder="Password" name="password" >
                    </div>
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input"> Keep me signed in </label>
                    </div>
                    <p><b>Having Issues? <a href="#" class="auth-link text-success">Contact MIS</a></b></p>
                  </div>
                  <div class="my-3">
                    <button name="logbtn" class="btn btn-block btn-primary btn-lg font-weight-semibold auth-form-btn">LOGIN</button>
                  </div>
                 
                </form>
              </div>
            </div>
            <div class="col-lg-6 login-half-bg d-flex flex-row">
              <p class="text-white font-weight-semibold text-center flex-grow align-self-end">Copyright <?php echo date('Y');?> © Renew Portal -  All rights reserved.</p>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="admin/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="admin/assets/js/off-canvas.js"></script>
    <script src="admin/assets/js/hoverable-collapse.js"></script>
    <script src="admin/assets/js/misc.js"></script>
    <script src="admin/assets/js/settings.js"></script>
    <script src="admin/assets/js/todolist.js"></script>
    <!-- endinject -->
  </body>

</html>