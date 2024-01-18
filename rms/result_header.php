<?php 
if(session_id() == ''){
  //session has not started
  session_start();
}
if (!isset($_SESSION['eo'])) {

  echo '<script> 
  alert("you are timed out.., cannot be here");
  window.location="../";</script>';
  exit;
}
if(isset($_GET["logout"]))
{
  session_destroy();
  unset($_SESSION);
  echo '<script> window.location="../";</script>';
}
include('../data/db.php');
include('../data/functions.php');
$semester_conv = array(1=>"First Semester", 2=>"Second Semester");
$department = $_SESSION['department'];

// $res_config = $pdo->query("SELECT * FROM `config_res`");
// $res_conf = $res_config->fetch();

// $conf_semester = $res_conf['semester'];
// $conf_session = $res_conf['sessions'];

$_SESSION['rsemester'] = $res_conf['semester'];
$_SESSION['rsession'] = $res_conf['sessions'];
function get_colschdept($pdo, $id)
{
    $csd = $pdo->query("SELECT * FROM `programmes` WHERE `dept_id` = '".$id."'");
    $schlr = $csd->fetch();
    
     $ccsd = $pdo->query("SELECT * FROM `colleges` WHERE `id` = '".$schlr["college_id"]."'");
    $cschlr = $ccsd->fetch();
    
     $scsd = $pdo->query("SELECT * FROM `schools` WHERE `id` = '".$schlr["school_id"]."'");
    $sschlr = $scsd->fetch();
    
     $dcsd = $pdo->query("SELECT * FROM `departments` WHERE `dept_id` = '".$schlr["dept_id"]."'");
    $dschlr = $dcsd->fetch();
    
    $csdrec = array("college"=>$cschlr["college"],"school"=>$sschlr["school"],"dept"=>$dschlr["names"]);		
    return $csdrec;
}
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
function yearsem($pdo, $level, $semester, $matno)
{
    $cgpa_qr1 = $pdo->query("SELECT sum(`unit`) as sunit, sum(`cunit`) as tunit, sum(`gp`) as gps, sum(gp)/sum(cunit) as gpa  FROM `results` WHERE `matno` = '".$matno."' and `level` like '".$level."' and `semester` = '".$semester."'"); // YEAR2
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

$config = $pdo->query("SELECT * FROM `config`");
$config_row = $config->fetch();

$dept_d = $pdo->query("SELECT * FROM `departments` WHERE `names` = '$department'");
$dept_row = $dept_d->fetch();
$_SESSION['dept_id'] = @$dept_row['dept_id'];

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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Result Portal</title>
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
    <link rel="shortcut icon" href="../schoologo.png" />
    
   
 <script type="text/javascript">
  function PrintDiv(divContents) {
          var divContents = document.getElementById("printdivcontent").innerHTML;
    var mywindow= window.open('print.php','Print','height=600,width=800');
    mywindow.document.write('<html><head><title>NigerPoly broadsheet result</title><style>@printerpage { size 8.5in 11in; margin: 2cm }div.printerpage { page-break-after: always }</style>');
    mywindow.document.write('</head><body onload="window.print();">');
      //mywindow.document.write("<link rel=\"stylesheet\" type=\"text/css\" href=\"css/bootstrap.css\"/>");
      
      mywindow.document.write('<link rel=\"stylesheet\" href=\"assets/vendors/mdi/css/materialdesignicons.min.css\">');
     mywindow.document.write('<link rel=\"stylesheet\" href=\"assets/vendors/flag-icon-css/css/flag-icon.min.css\">');
     mywindow.document.write('<link rel=\"stylesheet\" href=\"assets/vendors/css/vendor.bundle.base.css\">');
     mywindow.document.write('<style>');
     mywindow.document.write('.alignleft{text-align:left;}');
     mywindow.document.write('.aligncenter{text-align:center;}');
     mywindow.document.write('.alignright{text-align:right;}');
     mywindow.document.write('#textbox{display:flex;flex-flow:row wrap;width:100%;}');
     mywindow.document.write('table,th,td{border:1px solid black;border-collapse:collapse;padding:10px;letter-spacing:1px;}</style>');
     mywindow.document.write('<style>#ttbl{border-collapse: collapse; border: none;}</style>');

    mywindow.document.write(divContents);
    mywindow.document.write('</body></html>');
    // mywindow.document.close();
    mywindow.focus();
    setTimeout(function(){mywindow.print();mywindow.close();},500)
    
  return true;
  }
	</script>
  </head>
  <body>
  <div class="dot-opacity-loader" id="spinner">
    <span></span>
    <span></span>
    <span></span>
  </div>

    <div class="container-scroller">
      <div class="row p-0 m-0 proBanner" id="proBanner"> 
        <div class="col-md-12 p-0 m-0">
          <div class="card-body card-body-padding px-3 d-flex align-items-center justify-content-between">
            <div class="ps-lg-3">
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <a href="index"><i class="mdi mdi-home me-3 text-white"></i></a>
              <button id="bannerClose" class="btn border-0 p-0">
                <i class="mdi mdi-close text-white"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- partial:partials/_horizontal-navbar.html -->
      <div class="horizontal-menu">
        <nav class="navbar top-navbar col-lg-12 col-12 p-0">
          <div class="container">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
              <a class="navbar-brand brand-logo" href="index">
                <img src="../schoologo.png" alt="logo" />
                <span class="font-12 d-block font-weight-light"><?php echo $config_row["school"];?> </span>
              </a>
              <a class="navbar-brand brand-logo-mini" href="index"><img src="logos.png" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            
              <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                  <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="nav-profile-img">
                     
                      <img src="<?php echo passportstaff($_SESSION["username"],$pdo);?>" alt="image">
                    </div>
                    <div class="nav-profile-text">
                      <p class="text-black font-weight-semibold m-0"> <?php echo $_SESSION["names"];?></p>
                      <!-- <span class="font-13 online-color">online <i class="mdi mdi-chevron-down"></i></span> -->
                    </div>
                  </a>
                  <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="#">
                      <i class="mdi mdi-cached me-2 text-success"></i> Activity Log </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="?logout">
                      <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
                  </div>
                </li>
              </ul>
              <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
                <span class="mdi mdi-menu"></span>
              </button>
            </div>
          </div>
        </nav>
        
        <nav class="bottom-navbar">
          <div class="container">
            <ul class="nav page-navigation">
               <?php 
               if($_SESSION["usertype"] == '99'){?>
              <li class="nav-item">
                <a class="nav-link" href="mark_attendance_gns">
                  <i class="mdi mdi-compass-outline menu-icon"></i>
                  <span class="menu-title">Mark & Attendance Sheet</span>
                </a>
              </li>
               
              <?php 
              }else{
                  ?>
              <li class="nav-item">
                <a class="nav-link" href="index">
                  <i class="mdi mdi-compass-outline menu-icon"></i>
                  <span class="menu-title">Dashboard</span>
                </a>
              </li>
              <?php 
              if($_SESSION["usertype"] == 10){
              if($res_conf['add_menu'] == 1){?>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="mdi mdi-clipboard-text menu-icon"></i>
                  <span class="menu-title">ADD RECORDS</span>
                  <i class="menu-arrow"></i></a>
                <div class="submenu">
                  <ul class="submenu-item">
                    <!--<li class="nav-item"><a class="nav-link" href="add_score_students">Input Scores By Student</a></li>-->
                    <li class="nav-item"><a class="nav-link" href="add_scores">Input Scores By Course</a></li>
                    <li class="nav-item"><a class="nav-link" href="add_scores_upload">Upload Scores By Course</a></li>
                      <!--<li class="nav-item"><a class="nav-link" href="#course_allocation">Course Allocation</a></li> -->
                  </ul>
                </div>
              </li>
              <?php }
              if($res_conf['edit_menu'] == 1){
              ?>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="mdi mdi-clipboard-text menu-icon"></i>
                  <span class="menu-title">EDIT RECORDS</span>
                  <i class="menu-arrow"></i></a>
                <div class="submenu">
                  <ul class="submenu-item">
                    <li class="nav-item"><a class="nav-link" href="edit_scores">Scores from broadsheet</a></li>
                    <li class="nav-item"><a class="nav-link" href="edit_scores_list">Scores from list</a></li>
                    <li class="nav-item"><a class="nav-link" href="edit_scores_course ">Scores by Course</a></li>
                  </ul>
                </div>
              </li>
              <?php }
              }
              if($_SESSION["usertype"] == 10 OR $_SESSION["usertype"] == 11)
              {
              if($res_conf['view_menu'] == 1){
              ?>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="mdi mdi-clipboard-text menu-icon"></i>
                  <span class="menu-title">VIEW RECORDS</span>
                  <i class="menu-arrow"></i></a>
                <div class="submenu">
                  <ul class="submenu-item">
                    <li class="nav-item"><a class="nav-link" href="broadsheet">Result Broadsheet</a></li>
                    <li class="nav-item"><a class="nav-link" href="summary_start">Result Summary</a></li>
                    <li class="nav-item"><a class="nav-link" href="full_summary_result">Full Result Summary</a></li>
                    <li class="nav-item"><a class="nav-link" href="view_courses">Courses</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="view_scores">Scores</a></li>
                    <li class="nav-item"><a class="nav-link" href="score_template_download">Score Template</a></li>
                    <li class="nav-item"><a class="nav-link" href="view_students">Students</a></li>
                    <li class="nav-item"><a class="nav-link" href="mark_attendance">Attendance</a></li>
                  </ul>
                </div>
              </li>
              <?php }
              }
              ?>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="mdi mdi-account menu-icon"></i>
                  <span class="menu-title">USER</span>
                  <i class="menu-arrow"></i></a>
                <div class="submenu">
                  <ul class="submenu-item">
                    <li class="nav-item"><a class="nav-link" href="?logout">SignOut</a></li>
                    <li class="nav-item"><a class="nav-link" href="pages/forms/advanced_elements.html">Change Password</a></li>
                  </ul>
                </div>
              </li>
              <?php 
              
              }?>
            </ul>
          </div>
        </nav>
        
      </div>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
          <div class="content-wrapper pb-0">
            <div class="page-header flex-wrap">
              <div class="header-left">
                <button class="btn btn-warning mb-2 mb-md-0 me-2">
                    <?php if($_SESSION['department'] == 'DIRECTORATE OF ACADEMIC PLANNING'){ echo $_SESSION['department'];}
                    else{ echo 'DEPARTMENT OF '.$_SESSION['department']; }?></button>
              </div>
              <div class="header-right d-flex flex-wrap  mt-md-2 mt-lg-0">
                <div class="d-flex align-items-center">
                  <a href="index">
                    <p class="m-0 pe-3">Dashboard</p>
                  </a>
                  <a class="ps-3 me-4" href="#">
                    <p class="m-0"><?php echo $pagename;?></p>
                  </a>
                </div>
              </div>
            </div>