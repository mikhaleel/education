<?php include("../../data/db.php");
$id = encryptor('decrypt',$_GET["tid"]) ?? encryptor('decrypt',$_SESSION["student_id"]);
$student_info = $pdo->prepare("SELECT * FROM students WHERE `id`=?");
$student_info->execute([$id]); $student_data=$student_info->fetch();
//fetch course from the active semester
$act_course = $pdo->prepare("SELECT * FROM `course` WHERE `programme` =? AND `semester` = ? AND `level` = ?");
$act_course->execute([$student_data["programme"],$school_activesemester, $student_data["level"]]);
//fetch courses registered from the active semester
$act_courseR = $pdo->prepare("SELECT * FROM `stu_course_reg` WHERE `matno`=? AND `programme` =? AND `semester` = ? AND `level` = ? AND `session`=?");
$act_courseR->execute([$student_data["matno"],$student_data["programme"],$school_activesemester, $student_data["level"],$school_activesession]);

//fetch caryy over courses of the ctive semester

$school_activesession;
$school_activesemester;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Student Course Registration</title>
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
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header flex-wrap">              
        <div class="header-left">              
            <h4 class="page-title"> <?php echo $student_data["names"];?> (<?php echo $student_data["matno"];?>) </h4>
        </div>
        <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
            <div class="d-flex align-items-center">
                <a href="#">
                    <p class="m-0 pe-3"> <i class="mdi mdi-account-multiple menu-icon"></i> Course Registration</p>
                </a>
                <a class="ps-3 me-4" href="#">
                    <p class="m-0">Page</p>
                </a>
            </div>
       </div>
      </div>
        <div class="row">
<?php
if(isset($_GET["remcrs"]))
{
    $cid = encryptor('decrypt',$_GET["remcrs"]);
    $dcrs = $pdo->prepare("DELETE FROM `stu_course_reg` WHERE `id`=?");
    $dcrs->execute([$cid]);
    $tid = $_GET["tid"];
    if($dcrs)
    {
        echo '<script>alert("Deleted!")</script>';
        echo '<div class="alert alert-info"><b>Please wait</b> Updating records....</div><script>setTimeout(function(){location.href="?tid='.$tid.'"},10)</script>';
    }
}
if(isset($_GET["adcrs"]))
{
   $mtano =  $_GET["num"];
    $code = $_GET["code"];
    $title = $_GET["title"];
    $unit = $_GET["unit"];
    $coures_level = $_GET["level"];
    $semester = $_GET["semester"]; 
    $session = $_GET["session"];
    $programme = $_GET["prog"];
    $student_levels = $_GET["slevel"];
    $tid = $_GET["tid"];
    
    //check if course exist
    $chk = $pdo->query("SELECT id FROM `stu_course_reg` WHERE `matno`='$mtano' AND `coursecode` = '$code' AND `level` = '$student_levels' AND `session`='$session' AND `semester`='$semester'");

if($chk->rowCount()==0){
    $reg_course = $pdo->prepare("INSERT INTO `stu_course_reg`(`matno`, `level`, `session`, `semester`, `coursecode`, `coursetitle`, `courseunit`, `courselevel`, `coursesemester`, `programme`, `college_id`)VALUES (?,?,?,?,?,?,?,?,?,?,?)");
    $reg_course->execute([$mtano,$student_levels,$session,$semester,$code,$title,$unit,$coures_level,$semester,$programme,$student_college_id]);
    if($reg_course)
    {
        echo '<script>alert("'.$code.' Added!!")</script>';
        echo '<div class="alert alert-info"><b>Please wait</b> Updating records....</div><script>setTimeout(function(){location.href="?tid='.$tid.'"},10)</script>';
    }
}
else{}
}?>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Code</th>
                                        <th>Title</th>
                                        <th>Unit</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $sn = 0; while($fethcours = $act_course->fetch()){ $sn++;?>
                                    <tr>
                                        <td><?php echo $sn;?></td>
                                        <td><?php echo $fethcours["code"];?></td>
                                        <td><?php echo $fethcours["title"];?></td>
                                        <td><?php echo $fethcours["unit"];?></td>
                                        <td><a href="?num=<?php echo $student_data["matno"];?>&code=<?php echo $fethcours["code"];?>&title=<?php echo $fethcours["title"];?>&unit=<?php echo $fethcours["unit"];?>&level=<?php echo $fethcours["level"];?>&semester=<?php echo $fethcours["semester"];?>&session=<?php echo $school_activesession;?>&slevel=<?php echo $student_data["level"];?>&prog=<?php echo $student_data["programme"];?>&tid=<?php echo $_GET["tid"];?>&adcrs=" class="btn btn-success">Add</a></td>
                                    </tr><?php
                                    }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Code</th>
                                        <th>Title</th>
                                        <th>Unit</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $sn = 0; while($fethcoursR = $act_courseR->fetch()){ $sn++;?>
                                    <tr>
                                        <td><?php echo $sn;?></td>
                                        <td><?php echo $fethcoursR["coursecode"];?></td>
                                        <td><?php echo $fethcoursR["coursetitle"];?></td>
                                        <td><?php echo $fethcoursR["courseunit"];?></td>
                                        <td><a href="?tid=<?php echo $_GET["tid"];?>&remcrs=<?php echo encryptor('encrypt',$fethcoursR["id"]);?>" class="btn btn-danger">Remove</a></td>
                                    </tr><?php
                                    }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <a href="stu_course_form?matno=<?php echo encryptor('encrypt',$student_data["matno"]);?>&semster=<?php echo encryptor('encrypt',$school_activesemester);?>&level=<?php echo encryptor('encrypt',$student_data["level"]);?>&session=<?php echo encryptor('encrypt',$school_activesession);?>&name=<?php echo encryptor('encrypt',$student_data["names"]);?>&prog=<?php echo encryptor('encrypt',$student_data["programme"]);?>" class="btn btn-primary" >Submit & Print</a>
        </div>
     </div>            
    </div>
   <!-- partial:partials/_footer.html -->
 <footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">&copy; <script>document.write(new Date().getFullYear())</script> All rights reserved.</span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"><i class="mdi mdi-heart text-danger"></i> Designed By ULTRACODE LTD.</span>
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
    <script src="assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="assets/vendors/jquery-bar-rating/jquery.barrating.min.js"></script>
    <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/flot/jquery.flot.js"></script>
    <script src="assets/vendors/flot/jquery.flot.resize.js"></script>
    <script src="assets/vendors/flot/jquery.flot.categories.js"></script>
    <script src="assets/vendors/flot/jquery.flot.fillbetween.js"></script>
    <script src="assets/vendors/flot/jquery.flot.stack.js"></script>
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/data-table.js"></script>
     <!-- Custom js for this page -->
     <script src="assets/js/formpickers.js"></script>
    <script src="assets/js/form-addons.js"></script>
    <script src="assets/js/x-editable.js"></script>
    <script src="assets/js/dropify.js"></script>
    <script src="assets/js/dropzone.js"></script>
    <script src="assets/js/jquery-file-upload.js"></script>
    <script src="assets/js/formpickers.js"></script>
    <script src="assets/js/form-repeater.js"></script>
    <script src="assets/js/inputmask.js"></script>
    <!-- End custom js for this page -->
    <!-- End custom js for this page -->
  </body>
</html>