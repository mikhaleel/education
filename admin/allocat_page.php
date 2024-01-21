<?php
if (!isset($_SESSION)){ session_start();}
if (!isset($_SESSION['pageaccess'])) {
header('Location: ../');
exit();
}
include("../data/db.php");
$staff_id = encryptor('decrypt',$_GET["stfid"]);
$fetch_staffs = $pdo->prepare("SELECT * FROM `staff` WHERE `id`=?");
$fetch_staffs->execute([$staff_id]);
$staffrows = $fetch_staffs->fetch();
extract($staffrows);
?>
<!DOCTYPE html>
<html lang="en">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Staff Allocation</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
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
    <link rel="shortcut icon" href="../schoologo.png" />
  </head>
  <body>
          <div class="content-wrapper">
              <span class="text-right my-3" style="text-align:center">
              <img src="../schoologo.png" style="width: 70px; height: 70px;">
              <br>
              <b><?php echo strtoupper($school_names);?></b>
                  <?php echo strtoupper($school_address);?>
              </span>
            <div class="row">
              <div class="col-lg-12">
                <div class="card px-2">
                  <div class="card-body">
                  <table class="table" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th >Staff Name:</th>
                        <th ><?php echo $names;?></th>
                        <th >Semester:</th>
                        <th ><?php echo $semester_arr[$school_activesemester];?> </th>
                    </tr>
                    <tr>
                        <th >Email:</th>
                        <th ><?php echo $email;?></th>
                        <th >Session:</th>
                        <th ><?php echo strtoupper($school_activesession);?> </th>
                    </tr>
                    <tr>
                        <th >Department:</th>
                        <th ><?php echo $department;?></th>
                        <th ><a href="?stfid=<?php echo $_GET["stfid"];?>" class="btn btn-secondary">View Less Courses</a></th>
                        <th ><a href="?othercourses=&stfid=<?php echo $_GET["stfid"];?>" class="btn btn-warning">View All Courses</a></th>
                    </tr>
                        </thead>
                    </table>
        </div>
        </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-6">
                <div class="card px-1">
                  <div class="card-body">
                    <?php 
                    if(isset($_GET["othercourses"]))
                    {
                        $fetch_courses = $pdo->prepare("SELECT * FROM `course`");
                        $fetch_courses->execute([]);
                    }
                    else
                    {
                        $fdepartment = "%".$department."%";
                        $fetch_courses = $pdo->prepare("SELECT * FROM `course` WHERE `programme` LIKE ?");
                        $fetch_courses->execute([$fdepartment]);
                    }
                    ?>
                    <div class="table-responsive">
                    <table id="order-listing" class="table" cellspacing="0" width="100%">
                        <thead>
                        <tr class="bg-primary text-white">
                            <th >Level/Prog</th>
                            <th >Code</th>
                            <th >Title/unit</th>
                            <th >Add</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $csn = 0;
                        while($cours = $fetch_courses->fetch()){ $csn++;
                        $prgs = $pdo->query("SELECT abv FROM programmes WHERE programme LIKE '".$cours["programme"]."'");
                        $pgr_abv = $prgs->fetch(); 
                            ?>
                        <tr >
                            <td style="font-size: 9pt;"><?php echo $cours["level"];?> - <?php echo $pgr_abv["abv"];?>
                            </td>
                            <td style="font-size: 9pt;"><a href="?crsall=&cid=<?php echo encryptor('encrypt',$cours["id"]);?>&stfid=<?php echo $_GET["stfid"];?>">[<?php echo $cours["code"];?>]</a> 
                            </td>
                            <td style="font-size: 9pt;">
                                <?php echo $cours["title"];?> (<?php echo $cours["unit"];?>)
                            </td>
                            <td style="font-size: 16pt;">
                                <a href="?crsall=&cid=<?php echo encryptor('encrypt',$cours["id"]);?>&stfid=<?php echo $_GET["stfid"];?>"> <i class=" mdi mdi-folder-plus text-primary"> </i> </a></td>
                        </tr><?php }?>
                        </tbody>
                    </table>
                    </div>
                    </div>
              </div>
            </div>
              <div class="col-lg-6">
                <div class="card px-2">
                  <div class="card-body">
                    <?php 
                    if(isset($_GET["delid"]))
                    {
                        $staff_ids = $_GET["stfid"];
                        $id = encryptor('decrypt',$_GET["delid"]);
                        $delstfcors = $pdo->prepare("DELETE FROM `staff_course` WHERE `id`=?");
                        $delstfcors->execute([$id]);
                        echo '<div class="alert alert-info"> has been deleted!</div><script>setTimeout(function(){location.href="?stfid='.$staff_ids.'"},100)</script>';
                    }
                    if(isset($_GET["crsall"]))
                    {
                        //insert into staff course table
                        $staff_id = encryptor('decrypt',$_GET["stfid"]);
                        $cid = encryptor('decrypt',$_GET["cid"]);

                        $course_det = $pdo->prepare("SELECT * FROM `course` WHERE `id`=?");
                        $course_det->execute([$cid]);
                        $ctbinst = $course_det->fetch();
                        $codes = $ctbinst["code"];
                        $level = $ctbinst["level"];
                        $programme = $ctbinst["programme"];
                        $title = $ctbinst["title"];
                        $unit = $ctbinst["unit"];
                        $chkrec = $pdo->query("SELECT id FROM `staff_course` WHERE `staff_id` ='$staff_id' AND `programme`='$programme' AND `level`='$level' AND `coursecode` ='$codes' AND `semester` = '$school_activesemester' AND  `session` ='$school_activesession'");
                        if($chkrec->rowCount()==0)
                        {
                            $inststaftbl = $pdo->prepare("INSERT INTO `staff_course`(`staff_id`, `course_id`, `coursetitle`, `programme`, `level`, `coursecode`, `unit`,`semester`, `session`) VALUES (?,?,?,?,?,?,?,?,?)");
                            $inststaftbl->execute([$staff_id,$cid,$title,$programme,$level,$codes,$unit,$school_activesemester,$school_activesession]);
                            echo '<div class="alert alert-info">'.$ctbinst["title"].'('.$ctbinst["code"].')Course allocated!!</div><script>setTimeout(function(){location.href="stfid=<?php echo $_GET["stfid"];?>"},100)</script>';
                        }
                    }
                    ?>
                    <h5>Allocated Courses</h5>  
                    <?php
                    $chkrec = $pdo->query("SELECT * FROM `staff_course` WHERE `staff_id` ='$staff_id' AND `semester` = '$school_activesemester' AND `session` ='$school_activesession'");
                   
                    ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Level</th>
                                <th>Code</th>
                                <th>Title</th>
                                <th>Unit</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $aln=0;
                            while($allcrs = $chkrec->fetch()){ $aln++; 
                            $pgr_abv = $pdo->query("SELECT abv FROM programmes WHERE programme LIKE '".$allcrs["programme"]."'")->fetch(); ?>
                            <tr>
                                <td style="font-size: 9pt;"><?php echo $aln;?></td>
                                <td style="font-size: 9pt;"><?php echo $allcrs["level"];?>-<?php echo $pgr_abv["abv"];?></td>
                                <td style="font-size: 9pt;"><?php echo $allcrs["coursecode"];?></td>
                                <td style="font-size: 9pt;"><?php echo $allcrs["coursetitle"];?></td>
                                <td style="font-size: 9pt;"><?php echo $allcrs["unit"];?></td>
                                <td style="font-size: 16pt;"><a href="?stfid=<?php echo $_GET["stfid"];?>&delid=<?php echo encryptor('encrypt',$allcrs["id"]);?>"" ><i class=" mdi mdi-delete-forever text-danger"> </i></a></td>
                            </tr>
                            <?php
                            }?>
                        </tbody>

                        </table>
                    </div>


                  </div>
                </div>
              </div>
        </div>
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