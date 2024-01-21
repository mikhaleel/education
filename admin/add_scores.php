<?php 
if (!isset($_SESSION)){ session_start();}
if (!isset($_SESSION['pageaccess'])) {
header('Location: ../');
exit();
}
include("../data/db.php");?>
<?php 
 $staff_id = encryptor('decrypt',$_GET["stfid"]);
 $course_id = encryptor("decrypt",$_GET["cid"]);

//fetch staff details
$fetch_staffs = $pdo->prepare("SELECT * FROM `staff` WHERE `id`=?");
$fetch_staffs->execute([$staff_id]);
$staffrows = $fetch_staffs->fetch();
//extract($staffrows);
//fetch course details
// $fetch_course = $pdo->prepare("SELECT * FROM `course` WHERE `id`=?");
// $fetch_course->execute([$course_id]);
// $courserows = $fetch_course->fetch();
//extract($courserows);
// fetch staff course 
$fetch_staff_course = $pdo->prepare("SELECT * FROM `staff_course` WHERE `staff_id`=? AND `course_id`=?");
$fetch_staff_course->execute([$staff_id,$course_id]);
$staff_courserows = $fetch_staff_course->fetch();

$fetch_course_reg = $pdo->prepare("SELECT * FROM `stu_course_reg` WHERE `coursecode`=? AND `session`=? AND `semester`=? AND `programme`=? AND `level`=?");
$fetch_course_reg->execute([$staff_courserows["coursecode"],$staff_courserows["session"],$staff_courserows["semester"],$staff_courserows["programme"],$staff_courserows["level"]]);

//extract($staff_courserows);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>registered Student</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/demo_1/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../schoologo.png" />
  </head>
  <body>
            <div class="row">
              <div class="col-lg-12">
                <div class="card px-2">
                  <div class="card-body">
                    <div class="text-right my-3" style="text-align:center">
                    <img src="../schoologo.png" style="width: 70px; height: 70px;">
                    <br>
                    <b><?php echo strtoupper($school_names);?></b>
                        <?php echo strtoupper($school_address);?>.
                    </div>
                    <div class="container-fluid mt-3 d-flex justify-content-center w-100">
                        
                      <div class="table-responsive w-100">
                    <table class="table">
                        <tr> <td>Programme: </td><td><?php echo $staff_courserows["programme"];?></td></tr>
                        <tr><td>Course:</td><td>[<?php echo $staff_courserows["coursecode"];?>] <?php echo $staff_courserows["coursetitle"];?></td></tr>
                        <tr> <td>Course Lecturer:</td><td><?php echo $staffrows["names"];?></td></tr>
                        <tr> <td>Session: </td><td><?php echo $staff_courserows["session"];;?></td></tr>
                        <tr> <td>Semester: </td><td><?php echo $semester_arr[$staff_courserows["semester"]];?></td></tr>
                    </table>
                    <br>
                    

                    <div class="table-responsive">
                    <form name="formscore" id="scoreform" onsubmit="return false">
                        <table id="order-listing." class="table" width="80" align="center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Matric Number</th>
                                <th>Name</th>
                                <th>SCORE</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $n=0;
                        while($row = $fetch_course_reg->fetch(PDO::FETCH_ASSOC))
                        { $mtno = $row['matno'];
                            $coursecode = $row['coursecode'];
                            $resqry = $pdo->query("SELECT * FROM `results` WHERE `code` = '$coursecode' AND `matno` = '$mtno' ");
                            $rows = $resqry->fetch();
                            $stn = $pdo->query("SELECT `names` FROM `students` WHERE `matno` LIKE '$mtno'")->fetch();   
                            $n++;?>
                            <tr>
                                <td><?php echo $n;?></td>
                                <td><?php echo $stn["names"];?></td>
                                <td>
                                    <input name="matno[]" value="<?php echo $row["matno"];?>" type="hidden">                    
                                    <input name="code" value="<?php echo $coursecode;?>" type="hidden">
                                    <input name="programme" value="<?php echo $programme;?>" type="hidden">
                                    <input name="level" value="<?php echo $level;?>" type="hidden">
                                    <input name="unit" value="<?php echo $row["courseunit"];?>" type="hidden">
                                    <input name="title" value="<?php echo $row["coursetitle"];?>" type="hidden"> 
                                <?php echo $row["matno"];?></td>
                                <?php if($resqry->rowCount() > 0) 
                                {?>                    
                                    <td>
                                        <div class="col-3"><?php echo $rows["score"];?></div>
                                    </td>                          
                                <?php 
                                }else
                                {?>
                                <td><div class="col-3"><input name="scores[]" value="0" class="form-control"></div></td>    
                                <?php 
                                }?>              
                            </tr>
                            <?php }?>
                            <tr>
                                <td colspan="2">
                                    <div class="pull-right">
                                        <button type="submit" id="scorebtn" class="btn btn-primary" name="scorebtn" value="sid">Submit Scores</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        </table>
                        </form>
                    </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <footer class="footer">
            <div class="container clearfix">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © <?php echo date("Y");?><a href="#" target="_blank">ULTRACODE LTD</a>. All rights reserved.</span>
              <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i>
              </span>
            </div>
          </footer>
          <!-- partial -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
  </body>

</html>

<script src="../jquery.min.js"></script>
<script src="htmlcanva.js"></script>
<script src="https://checkout.squadco.com/widget/squad.min.js"></script> 
<script src="https://checkout.flutterwave.com/v3.js"></script>
<script src="https://js.paystack.co/v1/inline.js"></script>