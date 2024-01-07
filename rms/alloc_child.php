<?php 
if(isset($_GET["logout"]))
{
  session_destroy();
  unset($_SESSION);
  echo '<script> window.location="../../";</script>';
}
include('../data/db.php');
include('../data/functions.php');

$semester = $_SESSION['rsemester'];
$session = $_SESSION['rsession'];  
$staff_name = encryptor('decrypt',$_GET['names']);
//$names = encryptor('decrypt',$_GET['department']);
$staff_id = encryptor('decrypt',$_GET['id']);

function get_all_programmes($pdo)
{
  $prgs = $pdo->query("SELECT * FROM `programmes` WHERE `dept_id` = '".$_SESSION['dept_id']."' GROUP BY programme");
  $prgss = [];
  while($rws = $prgs->fetch())
  {
    $prgss[] =  $rws['programme'];
  }
  return $prgss;
}
function fetchecourses($pdo, $programme){     
    $ccqry = $pdo->query("SELECT * FROM `course` WHERE `programme` LIKE '$programme' AND `semester` = '".$_SESSION['rsemester']."' ORDER BY `semester`, `level`"); 
    return $ccqry;  
}  
function fetch_alloc($pdo, $staff_id){     
    $allqry = $pdo->query("SELECT * FROM `staff_allocation` WHERE `staff_id` LIKE '$staff_id' AND `semester` = '".$_SESSION['rsemester']."' AND `session` = '".$_SESSION['rsession']."' ORDER BY `semester`"); 
    return $allqry;
} 

if(isset($_GET['rd']))
{
    $rid = encryptor("decrypt", $_GET["rd"]);
    $qrys = $pdo->prepare("UPDATE staff_allocation SET staff_id=? WHERE id = ?");
    $qrys->execute(['', $rid]);
    echo '<script>alert("Course Removed!")</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Course Allocation</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="assets/vendors/jquery-bar-rating/css-stars.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/demo_3/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="logos.png" />
  </head>
  <body>
  <div class="dot-opacity-loader" id="spinner">
    <span></span>
    <span></span>
    <span></span>
  </div>
<div class="card">
    <div class="card-body">
        <h4>Course Allocation</h4>
        <div>
           <h4> Staff Name: <?php echo $staff_name;?></h4>
            <h4>Staff ID: <?php echo $staff_id;?></h4>
            
        </div>
        <div class="row">
            <div class="col-6">
                <?php 
                if(isset($_POST['allocateBtn']))
                {
                    if(!empty($_POST['sn']))
                    {
                        $sn = $_POST['sn'];
                        foreach($sn as $id)
                        {
                            $select_course = $pdo->prepare("SELECT * FROM course WHERE `sn` = ?");
                            $id = encryptor('decrypt',$id);
                            $select_course->execute([$id]);
                            $cols = $select_course->fetch();
                            $code = $cols['code'];
                            $title = $cols['title'];
                            $semester = $cols['semester'];
                            $session = $cols['sessions'];
                            $programme = $cols['programme'];
                            $level = $cols['level'];
                            
                            $chk = $pdo->query("SELECT id FROM `staff_allocation` WHERE `staff_id` = '".$_POST['staff_id']."' AND `coursecode` = '$code' AND  `programme` = '$programme' AND `session` = '".$_SESSION['rsession']."' AND `semester` = '$semester'");
                            
                            if( $chk->rowCount() == 0){
                            $salloc = $pdo->query("INSERT INTO `staff_allocation`(`staff_id`,`staffname`, `coursecode`,`coursetitle`, `programme`,`level`,`session`, `semester`) VALUES ('".$_POST['staff_id']."','".$_POST['staff_name']."','$code','$title','$programme','$level','".$_SESSION['rsession']."','". $_SESSION['rsemester']."')");
                            }
                            else
                            {
                                echo '<div class="alert alert-warning">Cant Allocate the course '.$code.' twice!</div>';
                            }
                        }
                        if($salloc)
                        {
                            echo '<div class="alert alert-info"> Allocation Successful!!</div>';
                           // echo '<script>window.location.href="?names='.encryptor("encrypt",$_GET['names']).'&id='.encryptor("encrypt",$_GET['id']).'";</script>';
                        }
                        
                    }
                }
                
                ?>
        <div class="table-responsive">
            <form id="alloc" method="post">
                <input name='staff_name' type='hidden' value='<?php echo $staff_name;?>'>
                <input name='staff_id' type='hidden' value='<?php echo $staff_id;?>'>
            <table id="order-listing" class="table">
                <thead>
                    <tr class="bg-success text-white">
                        <th>#</th>
                        <th>Course Code / Title</th>
                        <th>Unit</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $srn = 0;      
                    $r_row = get_all_programmes($pdo); foreach($r_row as $pr1=> $theprogramme){  
                    $ccqry = fetchecourses($pdo, $theprogramme);
                    while($coderow = $ccqry->fetch()){
                        $srn++;
                    $cod = encryptor('encrypt',$coderow['code']); 
                    //$prg = encryptor('encrypt',$coderow['programme']);
                    $sn=encryptor('encrypt',$coderow['sn']);
                    ?>
                    <tr>
                        <td><?php echo $srn;?></td>
                        <td><?php echo $coderow['code'];?> - <?php echo $coderow['title'];?></td>
                        <td><?php echo $coderow['unit'];?></td>
                        <td>
                            <input name="sn[]" type="checkbox" value='<?php echo $sn;?>'>
                        </td>
                    </tr>
                    <?php 
                   }
                    }?>
                </tbody>
            </table>
           <button name="allocateBtn" id="allocateBtn" type="Submit" class="btn btn-primary">Allocate Course</button>
            </form>
        </div>
     </div> 
     <div class="col-6">
         <h4>Allocated Courses</h4>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Title</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $arn=0;
                     $ccqry = fetch_alloc($pdo, $staff_id);
                    while($allocrow = $ccqry->fetch()){
                        $arn++;
                    ?>
                    <tr>
                    <td><?php echo $arn;?></td>
                    <td><?php echo $allocrow['coursecode'];?></td>
                    <td><?php echo $allocrow['coursetitle'];?></td>
                    <td><a href="?rd=<?php echo encryptor('encrypt',$allocrow['id']).'&names='.$_GET['names'].'&id='.$_GET['id'];?>">Remove</a></td>
                    </tr>
                    <?php 
                    }
                    ?>
                </tbody>
            </table>
        </div>
         
         
     </div>
    </div>
        
    </div>
</div>
<footer class="footer">
  <div class="container">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
      <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021 <a href="https://www.bootstrapdash.com/" target="_blank">Niger State Polytechnic, Zungeru</a>. All rights reserved.</span>
      <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Ultracode Global Ventures Ltd </span>
    </div>
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
<script src="assets/vendors/select2/select2.min.js"></script>
<script src="assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
<script src="assets/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="assets/vendors/jquery-bar-rating/jquery.barrating.min.js"></script>
<script src="assets/vendors/chart.js/Chart.min.js"></script>
<script src="assets/vendors/flot/jquery.flot.js"></script>
<script src="assets/vendors/flot/jquery.flot.resize.js"></script>
<script src="assets/vendors/flot/jquery.flot.categories.js"></script>
<script src="assets/vendors/flot/jquery.flot.fillbetween.js"></script>
<script src="assets/vendors/flot/jquery.flot.stack.js"></script>
<script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="assets/js/modal-demo.js"></script>
<script src="assets/js/off-canvas.js"></script>
<script src="assets/js/hoverable-collapse.js"></script>
<script src="assets/js/misc.js"></script>
<script src="assets/js/settings.js"></script>
<script src="assets/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="assets/js/dashboard.js"></script>
    <script src="assets/js/data-table.js"></script>
    <script src="assets/js/file-upload.js"></script>
    <script src="assets/js/typeahead.js"></script>
    <script src="assets/js/select2.js"></script>
    <script src="assets/js/jquery.min"></script>
<!-- End custom js for this page -->

<script>
    
    document.onreadystatechange = function() {
            if (document.readyState !== "complete") {
                document.querySelector(
                  "body").style.visibility = "hidden";
                document.querySelector(
                  "#spinner").style.visibility = "visible";
            } else {
                document.querySelector(
                  "#spinner").style.display = "none";
                document.querySelector(
                  "body").style.visibility = "visible";
            }
        };

</script>
</body>
<!-- Mirrored from bootstrapdash.com/demo/plus/jquery/template/demo_3/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 22 Aug 2022 23:32:31 GMT -->
</html>