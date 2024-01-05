<?php
include("../data/db.php");
$appno = encryptor("decrypt",$_GET["appno"]);
$checkexist = $pdo->prepare("SELECT * FROM `applicant` WHERE  `application_no` = ?");
$checkexist->execute([$appno]);
$app_infor = $checkexist->fetch();
$dlevels = $app_infor['level'];
if(isset($_GET['final']))
{
  $updateap = $pdo->prepare("UPDATE `applicant` SET `app_status` = ? WHERE  `application_no` = ?");
  $updateap->execute(['completed',$appno]);
  
  if ($updateap)
  {
    echo '<div class="alert alert-success">Loading Applicant Account.....</div><script>setTimeout(function(){location.href="dashboard?appno='.encryptor("encrypt",$appno).'&start'.'"},1000)</script>';
  }
}

?>
<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from demo.bootstrapdash.com/star-admin-pro/src/demo_11/pages/forms/validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 04 Nov 2023 12:10:53 GMT -->
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $appno;?> - Applicant Form</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
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
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/demo_11/style.css">
    <!-- End Layout styles -->
    <link rel="shortcut icon" href="images/favicon.html" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:../../partials/_horizontal-navbar.html -->
      <nav class="navbar horizontal-layout col-lg-12 col-12 p-0">
        <div class="container d-flex flex-row nav-top">
          <div class="text-center navbar-brand-wrapper d-flex align-items-top">
            <a class="navbar-brand brand-logo" href="../../index-2.html">
              <img src="https://demo.bootstrapdash.com/star-admin-pro/src/assets/images/logo_2.svg" alt="logo" /> </a>
            <a class="navbar-brand brand-logo-mini" href="../../index-2.html">
              <img src="https://demo.bootstrapdash.com/star-admin-pro/src/assets/images/logo-mini.svg" alt="logo" /> </a>
          </div>
          <div class="navbar-menu-wrapper d-flex align-items-center">
            <form action="https://demo.bootstrapdash.com/star-admin-pro/src/demo_11/pages/forms/form-action" class="d-none d-sm-block">
              <div class="input-group search-box">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="mdi mdi mdi-magnify"></i>
                  </span>
                </div>
                <input type="text" class="form-control" placeholder="Type to search…">
                <i class="mdi mdi mdi-close search-close"></i>
              </div>
            </form>
            <ul class="navbar-nav ms-auto">
              <li class="nav-item dropdown">
              </li>
              <li class="nav-item dropdown ms-4">
              </li>
              <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
                <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                  <div class="wrapper d-flex flex-column">
                    <span class="profile-text"><?php echo $app_infor["names"];?></span>
                    <span class="user-designation">Applicant</span>
                  </div>
                  <div class="display-avatar bg-inverse-primary text-primary">AS</div>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                  <div class="dropdown-header text-center">
                    <img class="img-md rounded-circle" src="assets/images/faces/face1.jpg" alt="Profile image">
                    <p class="mb-1 mt-3 font-weight-semibold"><?php echo $app_infor["names"];?></p>
                    <p class="font-weight-light text-muted mb-0"><?php echo $app_infor["email"];?></p>
                  </div>
                </div>
              </li>
            </ul>
            <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </div>
    
        
      </nav>
      <!-- partial -->
      <!-- partial:../../partials/_settings-panel.html -->
  
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <div class="main-panel container">
          <div class="content-wrapper">
            <div class="row grid-margin">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Personal Information</h4>
                    <?php 
                    if(isset($_POST["pinfo"]))
                    {
                      $appno = $_POST["appno"];
                      $gender = $_POST["gender"];
                      $dob = $_POST["dob"];
                    $mstatus = $_POST["mstatus"];
                    $country =  $_POST["country"];
                    $state =  $_POST["state"];
                    $lga =  $_POST["lga"];
                    $tribe =  $_POST["tribe"];

                    $updtapp = $pdo->prepare("UPDATE `applicant` SET `gender`=?, `dob`=?, `marital`=?,`country`=?, `state`=?,`lga`=?, `tribe`=? WHERE `application_no` =?");
                    $updtapp->execute([$gender,$dob,$mstatus,$country,$state,$lga,$tribe,$appno]);

                      if($updtapp)
                      {
                        echo '<div class="alert alert-success">Personal Information submitted..</div>';
                      }
                    }?>
                <form method="post" name="pi">
                  <div class="row"> 
                  <div class="col-md-6">
                    <div class="form-group row">
                      <div class="col-lg-3">
                        <label class="col-form-label">Full name: </label>
                      </div>
                      <div class="col-lg-8">
                        <input class="form-control" name="fullname" id="defaultconfig" type="text" value="<?php echo @$app_infor["names"];?>" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-lg-3">
                        <label class="col-form-label">application No.:</label>
                      </div>
                      <div class="col-lg-8">
                        <input class="form-control" id="defaultconfig-2" type="text" value="<?php echo @$app_infor["application_no"];?>" readonly>
                        <input class="form-control" name="appno" id="defaultconfig-2" type="hidden" value="<?php echo @$app_infor["application_no"];?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-lg-3">
                        <label class="col-form-label">Programme:</label>
                      </div>
                      <div class="col-lg-8">
                        <input class="form-control" maxlength="10" name="programme" id="defaultconfig-3" type="text" value="<?php echo @$app_infor["programme"];?>" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-lg-3">
                        <label class="col-form-label">Email:</label>
                      </div>
                      <div class="col-lg-8"> 
                        <input class="form-control" maxlength="10" name="email" id="defaultconfig-3" type="text" value="<?php echo @$app_infor["email"];?>" readonly> 
                      </div>
                    </div>
                    </div>
                   <div class="col-md-3">
                        <div class="form-group">
                          <label for="cname">Gender</label>
                          <select name="gender" class="form-control">
                            <option value="" selected><?php echo @$app_infor["gender"];?></option>
                            <option>Male</option>
                            <option>Female</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="cemail">Date of birth</label>
                          <input id="cemail" class="form-control" type="date" name="dob" value="<?php echo @$app_infor["dob"];?>" required>
                        </div>
                        <div class="form-group">
                          <label for="curl">Marital status</label>
                          <select name="mstatus" class="form-control">
                            <option selected><?php echo @$app_infor["marital"];?></option>
                            <option>Single</option>
                            <option>Married</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="ccomment">Country</label> 
                          <input id="cemail" class="form-control" type="text" name="country" value="<?php echo @$app_infor["country"];?>" required>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="cname">State</label>
                          <select name="state" class="form-control">
                            <option selected><?php echo @$app_infor["state"];?></option>
                            <?php $getstate=$pdo->query("SELECT `title` FROM `state`"); while($state=$getstate->fetch()){?>
                            <option><?php echo @$state["title"];?></option><?php }?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="cemail">LGA</label>
                          <select name="lga" class="form-control">
                            <option selected><?php echo @$app_infor["lga"];?></option>
                            <?php $getstate=$pdo->query("SELECT `title` FROM `lga`"); while($state=$getstate->fetch()){?>
                            <option><?php echo @$state["title"];?></option><?php }?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="curl">Phone Number</label>
                          <input id="curl" class="form-control" type="text" name="gsm" value="<?php echo @$app_infor["gsm"];?>" readonly>
                        </div>
                        <div class="form-group">
                          <label for="ccomment">Tribe</label> 
                          <input id="curl" class="form-control" type="text" name="tribe" value="<?php echo @$app_infor["tribe"];?>">
                        </div>
                      </div>
                                        
                        </div>
                      
                        <input class="btn btn-primary" type="submit" value="Submit" name="pinfo">
                </form>
                  </div>

                </div>
              </div>
            </div>
                <div class="row grid-margin">
                  <div class="col-lg-12">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Educational Information</h4>
                        <?php 
                        if(isset($_POST["edinfo"]))
                        {
                          $appno = $_POST["appno"];
                          $subject = $_POST["subject"];
                          $grade = $_POST["grade"];
                          $exbody = $_POST["exbody"];
                          $exdate =  $_POST["exdate"];

                          $addolevel = $pdo->prepare("INSERT INTO `app_olevel`(`appno`, `subject`, `grade`, `exambody`, `examdate`) VALUES (?,?,?,?,?)");
                          $addolevel->execute([$appno,$subject,$grade,$exbody,$exdate]);

                          if($addolevel)
                          {
                            echo '<div class="alert alert-success">'.$subject.' submitted..</div>';
                          }
                        }?>
                        <hr>
                        <h5>O/A Level</h5>
                        <form method="post" name="edi">
                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                          <input name="appno" value="<?php echo $appno;?>" type="hidden">
                          <label for="cname">Subject</label>
                          <select class="form-control" name="subject" required>
                            <option value="" selected>Select Subject</option>
                            <?php 
                            $getsubj = $pdo->query("SELECT * FROM `app_subjects`");
                            while($subject=$getsubj->fetch())
                            {
                              $subj = $subject["subject"];
                              $remv = $pdo->query("SELECT * FROM `app_olevel` WHERE `appno` = '$appno' AND `subject`='$subj'");
                              $findsbj = $remv->fetch();
                              if($remv->rowCount() == 0)
                              {
                              ?>
                               <option><?php echo $subj;?></option>
                               <?php 
                              }
                            }?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="cemail">Grade</label>
                          <input id="grade" class="form-control" type="text" name="grade" maxlength="2" required>
                        </div>
                        <div class="form-group">
                          <label for="cemail">Exam body</label>
                          <input id="exbody" class="form-control" type="text" name="exbody" required>
                        </div>
                        <div class="form-group">
                          <label for="cemail">Exam date</label>
                          <input id="exdate" class="form-control" type="date" name="exdate" required>
                        </div>
                      </div>    

                      <div class="col-md-6">
                        <?php
                        if(isset($_GET['sdels'])){
                          $sid = $_GET['subid'];
                          $delsub = $pdo->prepare("DELETE FROM `app_olevel` WHERE id = ?");
                          $delsub->execute([$sid]);
                          if($delsub)
                          {
                            echo '<div class="alert alert-info">Subject removed..</div>';
                          }
                        }?>
                        <div class="table-responsive">
                          <table class="table"> 
                            <thead>
                              <tr style="color:#FFFFFF" class="bg-secondary text-danger" >
                              <th>#</th>
                              <th>Subject</th>
                              <th>Grade</th>
                              <th>Body</th>
                              <th>Date</th>
                              <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $srn = 0;
                              $regolevel = $pdo->query("SELECT * FROM `app_olevel` WHERE `appno` = '$appno'");
                              while($olrow = $regolevel->fetch())
                              { $srn++;?>
                              <tr>
                              <td><?php echo $srn;?></td>
                              <td><?php echo $olrow["subject"];?></td>
                              <td><?php echo $olrow["grade"];?></td>
                              <td><?php echo $olrow["exambody"];?></td>
                              <td><?php echo $olrow["examdate"];?></td>
                              <td><a href="?sdels=&subid=<?php echo $olrow["id"];?>&appno='<?php echo $_GET['appno'];?>'" class="btn btn-danger">Remove</a></td>
                              </tr>
                              <?php 
                              }?>
                            </tbody>    
                          </table>
                        </div>
                      </div>
                      </div>
                        <input class="btn btn-primary" type="submit" value="Submit" name="edinfo">
                      </form>

                      <?php 
                      if($dlevels == "HND1" OR $dlevels == "PREHND")
                      {
                      ?>
                    <hr>
                    <h5>National Diploma / Diploma Details </h5>
                        <?php 
                        if(isset($_POST["dipinf"]))
                        {
                          $appno = $_POST["appno"];
                          $subject = $_POST["institution"];
                          $grade = $_POST["course"];
                          $exbody = $_POST["class"];
                          $exdate =  $_POST["gdate"];

                          $addolevel = $pdo->prepare("INSERT INTO `app_institute`(`appno`, `institution`, `course`, `class`, `date`) VALUES (?,?,?,?,?)");
                          $addolevel->execute([$appno,$subject,$grade,$exbody,$exdate]);

                          if($addolevel)
                          {
                            echo '<div class="alert alert-success">'.$subject.' submitted..</div>';
                          }
                        }?>
                    <form class="" id="" method="post" action="#">
                        <div class="row">
                          <div class="col-md-12">

                          <div class="table-responsive">
                            <table class="table"> 
                              <thead>
                                <tr style="color:#FFFFFF" class="bg-secondary text-danger" >
                                <th>#</th>
                                <th>Institution</th>
                                <th>Course</th>
                                <th>Class</th>
                                <th>Date</th>
                                <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $sr = 0;
                                $reginst = $pdo->query("SELECT * FROM `app_institute` WHERE `appno` = '$appno'");
                                while($inrow = $reginst->fetch())
                                { $srn++;?>
                                <tr>
                                <td><?php echo $sr;?></td>
                                <td><?php echo $inrow["institution"];?></td>
                                <td><?php echo $inrow["course"];?></td>
                                <td><?php echo $inrow["class"];?></td>
                                <td><?php echo $inrow["date"];?></td>
                                <td><a href="?indels=&instid=<?php echo $inrow["id"];?>&appno='<?php echo $_GET['appno'];?>'" class="btn btn-danger">Remove</a></td>
                                </tr>
                                <?php 
                                }?>
                              </tbody>    
                            </table>
                            </div>
                            </div>
                            </div>
                            <hr>
                        <div class="row">

                        <?php
                        if(isset($_GET['indels'])){
                          $sid = $_GET['instid'];
                          $delsub = $pdo->prepare("DELETE FROM `app_institute` WHERE id = ?");
                          $delsub->execute([$sid]);
                          if($delsub)
                          {
                            echo '<div class="alert alert-info">Subject removed..</div>';
                          }
                        }?>
                          <div class="col-md-6">
                            <label for="cname">Instituion (institution you attended)</label>
                            <input id="cname" class="form-control" name="institution" type="text" required>
                            <input id="cname" class="form-control" name="appno" value="<?php echo $appno;?>" type="hidden">
                          </div>
                          <div class="col-md-6">
                            <label for="cemail">Course (eg. National diploma in Computer Science)</label>
                            <input id="cemail" class="form-control" type="text" name="course" required>
                          </div>
                          <div class="col-6">
                            <label for="curl">Class (e.g Upper Credit)</label>
                            <input id="curl" class="form-control" type="text" name="class">
                          </div>
                          <div class="col-6">
                            <label for="ccomment">Date (Date on your Certificate/Result)</label>                            
                            <input class="form-control" type="date" name="gdate">
                          </div>
                      </div><br>
                          <input class="btn btn-primary" type="submit" value="Submit" name="dipinf">
                    </form>
                    <?php }?>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Guardian / Parent Information</h4>
                        <?php 
                        if(isset($_POST["pgnk"]))
                        {
                          $pgname = $_POST["pgname"];
                          $pgaddress = $_POST["pgaddress"];
                          $pggsm = $_POST["pggsm"];
                          $reltn= $_POST["relationship"];
                          
                          $updateapp = $pdo->prepare("UPDATE `applicant` SET `pgname`=?, `pggsm`=?,`pgaddress`=?, `relationship`=? WHERE  `application_no` = ?");
                          $updateapp->execute([$pgname, $pgaddress,$pggsm,$reltn,$appno]);
                          if($updateapp)
                          {
                            echo '<div class="alert alert-success">'.$subject.' submitted..</div>';
                          }
                        }?>
                    <form class="" id="" method="post">
                      <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <label for="firstname">Parent/Gaurdian Name</label>
                          <input id="firstname" class="form-control" name="pgname" type="text" value="<?php echo $app_infor["pgname"];?> ">
                        </div>
                        <div class="form-group">
                          <label for="lastname">Parent/Gaurdian  Address</label>
                          <input id="lastname" class="form-control" name="pgaddress" type="text" value="<?php echo $app_infor["pgaddress"];?>">
                        </div>
                      </div>

                      <div class="col-6">
                        <div class="form-group">
                          <label for="username">Parent/Gaurdian  Phone number</label>
                          <input id="username" class="form-control" name="pggsm" type="text" value="<?php echo $app_infor["pggsm"];?>" >
                        </div>
                        <div class="form-group">
                          <label for="lastname">Relationship</label>
                          <input id="lastname" class="form-control" name="relationship" type="text" value="<?php echo $app_infor["relationship"];?>">
                        </div>
                      </div>
                      </div>

                      <input class="btn btn-primary" type="submit" value="Submit" name="pgnk">
                    </form>
                  </div>
                </div>
              </div>
            </div>

            </div>

            <div class="row">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-body">

                  <div class="alert alert-info" role="alert"><span class="text-warning">Please, note that: there will be no forum to make any chenge after clicking on the continue button.</span><br> <span class="text-danger">Make you cross check all the the Information you have submitted.</span> </div>
                  <center>
                <a class="btn btn-success" href="?final=&appno=<?php echo $_GET['appno'];?>">Continue and Print</a>
                </center>
                  </div>
                </div>
              </div>
            </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <footer class="footer">
            <div class="container clearfix">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2021<a href="http://www.bootstrapdash.com/" target="_blank">Bootstrapdash</a>. All rights reserved.</span>
              <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i>
              </span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/jquery-validation/jquery.validate.min.js"></script>
    <script src="assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/shared/off-canvas.js"></script>
    <script src="assets/js/shared/hoverable-collapse.js"></script>
    <script src="assets/js/shared/misc.js"></script>
    <script src="assets/js/shared/settings.js"></script>
    <script src="assets/js/shared/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/shared/form-validation.js"></script>
    <script src="assets/js/shared/bt-maxLength.js"></script>
    <script src="assets/js/demo_11/script.js"></script>
    <!-- End custom js for this page -->
  </body>

<!-- Mirrored from demo.bootstrapdash.com/star-admin-pro/src/demo_11/pages/forms/validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 04 Nov 2023 12:10:54 GMT -->
</html>