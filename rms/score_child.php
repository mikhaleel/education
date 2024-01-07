<?php 
if(isset($_GET["logout"]))
{
  session_destroy();
  unset($_SESSION);
  echo '<script> window.location="../../";</script>';
}
include('../data/db.php'); include('../data/functions.php');
$lev_arr = array();
$ses_arr = array();
$level_data = $pdo->query("SELECT * FROM `level`");
$session_data = $pdo->query("SELECT * FROM `session`");
while($level_details = $level_data->fetch())
{
  $lev_arr[] = $level_details['level'];
}
while($session_details = $session_data->fetch())
{
  $ses_arr[] = $session_details['session'];
}
$level =  encryptor('decrypt', $_GET['level']);
$programme =  encryptor('decrypt', $_GET['programme']);
$coursecode = encryptor('decrypt',$_GET['code']);
//$courseunit = encryptor('decrypt',$_GET['unit']);
$semester = $conf_semester;
$session = $conf_session;          

//  $c_reg = $pdo->query("SELECT * FROM `stu_course_reg` WHERE coursecode='$coursecode' AND `semester` = '$semester' AND `programme` = '$programme' AND `level` = '$level' AND `session` = '$session'");
$c_reg = $pdo->query("SELECT * FROM `stu_course_reg` WHERE coursecode='$coursecode' AND `semester` = '$semester' AND `programme` = '$programme' AND `courselevel` = '$level' AND `session` = '$session'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $coursecode;?> | Scores</title>
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
        <!-- <h4 class="card-title">Data table<?php //echo $dpt;?></h4> -->
            <div class="row"> <!--beginig of first row-->
      
  <div class="col-12">
  <div class="row bg-primary text-white">
                <div class="col-9">
                    <div>PROGRAMME: <?php echo $programme;?></div>	
                    <div>LEVEL: <?php echo $level;?></div>
                </div>
                <div class="col-3">
                    <div>SEMESTER: <?php echo $conf_semester;?></div>	
                    <div>CODE: <?php echo $coursecode;?></div>
                </div>
            </div>	
<div class="table-responsive">
<form name="formscore" id="scoreform" onsubmit="return false">
    <table id="order-listing" class="table">
    <thead>
        <tr class="bg-dark text-white">
            <th>#</th>
            <th>Matric Number</th>
            <th>SCORE</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $n=0;
    while($row = $c_reg->fetch(PDO::FETCH_ASSOC))
    {
        $mtrno = $row["matno"];
        $resqry = $pdo->query("SELECT * FROM `results` WHERE `code` = '$coursecode' AND `matno` = '$mtrno'");
        $rows = $resqry->fetch();
    $n++;?>
        <tr>
            <td><?php echo $n;?></td>
            <td>
            <?php echo $mtrno;?></td>
                <td>
                    <div class="col-3">
                        <?php echo $rows["score"];?>                    
                    </div>
                </td>   
        </tr>
        <?php }?>
    </tbody>
    </table>
    </form>
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