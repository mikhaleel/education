<?php

function yearsem($pdo, $level, $semester, $matno)
{
    $cgpa_qr1 = $pdo->query("SELECT sum(`unit`) as tunit, sum(`gp`) as gps, sum(gp)/sum(unit) as gpa  FROM `results` WHERE `matno` = '".$matno."' and `level` like '".$level."' and `semester` = '".$semester."'"); // YEAR2
    return $cgpa_qr1->fetch();
}

function titlqr($pdo, $programme, $level, $semester, $session)
{
	$ressql= $pdo->query("SELECT * FROM `results` WHERE `programme` = '".$programme."'  && `level`= '$level' && `semester` = '".$semester."'  && `session` = '".$session."'");
	return $ressql->fetch();
}
function get_school($pdo, $id)
{
    $schl = $pdo->query("SELECT * FROM `schools` WHERE `id` = '$id'");
    $schlr = $schl->fetch();
    $schlr["school"];		
    return $schlr["school"];
}
function get_department($pdo, $id)
{
    $dept = $pdo->query("SELECT * FROM `departments` WHERE `dept_id` = '$id'");
    $depts = $dept->fetch();
    return $depts["names"];
}
include('../data/db.php');
include('../data/functions.php');
$time = date("h:i:sa");
$name = $_SESSION['ex_level'].'_'.$_SESSION['ex_session'].'_'.$_SESSION['ex_semester'].'_'."Broadsheet Result".$time.".doc";

//$name = "Academic Result".$time.".xls";
//header("Content-Type: application/vnd.msexcel");

header("Content-Type: application/vnd.msword");
header("Expires: 0");
header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
header("Content-disposition: attachment; filename=$name");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Nigerpoly Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../land/img/flailas-logo.png" />
</head>
<body>
<?php 
$acad = $_REQUEST["acad"];
include("broadsheet_contents.php");?>
 
  <!-- plugins:js -->
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <script src="js/data-table.js"></script>
  <script src="js/jquery.dataTables.js"></script>
  <script src="js/dataTables.bootstrap4.js"></script>
  <!-- End custom js for this page-->
  
<script>
 
    $('#recent-purchases-listing').DataTable({
      "aLengthMenu": [
        [5, 10, 15, -1],
        [5, 10, 15, "All"]
      ],
      "iDisplayLength": 10,
      "language": {
        search: ""
      },
      searching: true, paging: true, info: false
    });

</script>
<script>
//function myfunction(){
  //var myWindow = window.open("","Applicant Result","width=200,height=100");
 // myWindow.document.write("<h3>Result Page</h3>").
//}
</script>
</body>

</html>

