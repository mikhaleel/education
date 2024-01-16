<?php include("../data/db.php");
if(isset($_GET["matno"]))
{
    $matno = encryptor('decrypt',$_GET["matno"]);
    $semster =  encryptor('decrypt',$_GET["semster"]);
    $level =  encryptor('decrypt',$_GET["level"]);
    $session =  encryptor('decrypt',$_GET["session"]);
    $semster =  encryptor('decrypt',$_GET["semster"]);
    $programme =  encryptor('decrypt',$_GET["prog"]);
    $names =  encryptor('decrypt',$_GET["name"]);

    $fetchcourse = $pdo->prepare("SELECT * FROM `stu_course_reg` WHERE `matno`=? AND `level`=? AND `session`=? AND `semester`=?");
    $fetchcourse->execute([$matno,$level,$session,$semster]);

    $fetchcourseR = $pdo->prepare("SELECT * FROM `stu_course_reg` WHERE `matno`=? AND `level`=? AND `session`=? AND `semester`=?");
    $fetchcourseR->execute([$matno,$level,$session,$semster]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Course Form</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
   
    <link rel="stylesheet" href="assets/css/demo_1/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
          <div class="content-wrapper">
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
                    <div class="container-fluid">
                      <h3 class="text-right my-2">Course Form</h3>
                      <hr>
                    </div>
                    <div class="container-fluid d-flex justify-content-between">
                      <div class="col-lg-6 pl-0">
                        <p class="mt-2 mb-2"><b> Name: <?php echo $names;?>  </b></p>
                        <p>Matric No: <?php echo $matno;?>,<br> Level: <?php echo $level;?>,<br> Session: <?php echo $session;?>.</p>
                      </div>
                      <div class="col-lg-6 pr-0">
                        <p class="mt-2 mb-2 text-right"><b><?php echo $programme;?></b></p>
                        <!-- <p class="text-right">Gaala & Sons,<br> C-201, Beykoz-34800,<br> Canada, K1A 0G9.</p> -->
                      </div>
                    </div>
                    <div class="container-fluid mt-2 d-flex justify-content-center w-100">
                      <div class="table-responsive w-100">
                        <table class="table">
                          <thead>
                            <tr class="bg-dark text-white">
                              <th>#</th>
                              <th>Course Code</th>
                              <th class="text-right">Course Title</th>
                              <th class="text-right">Course Unit</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $nn=0; while($rowcr = $fetchcourse->fetch()){ $nn++;?>
                            <tr class="text-right">
                              <td class="text-left"><?php echo $nn;?></td>
                              <td class="text-left"><?php echo $rowcr["coursecode"];?></td>
                              <td><?php echo $rowcr["coursetitle"];?></td>
                              <td><?php echo $rowcr["courseunit"];?></td>
                            </tr>
                            <?php }?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="container-fluid mt-2 w-100">
                      <p class="text-right mb-2">&nbsp;</p>
                      <p class="text-right">&nbsp;</p>
                      <h4 class="text-right mb-5">Head of Department</h4>
                      <hr>
                    </div>
                    
                  </div>

                  <!-- Exam card start here  -->
                   <p style="page-break-after: always;">&nbsp;</p>
                    <div class="card-body">
                    <div class="text-right my-3" style="text-align:center">
                    <img src="../schoologo.png" style="width: 70px; height: 70px;">
                    <br>
                    <b><?php echo strtoupper($school_names);?></b>
                        <?php echo strtoupper($school_address);?>.
                    </div>
                    <div class="container-fluid">
                      <h3 class="text-right my-2">Exam Card</h3>
                      <hr>
                    </div>
                    <div class="container-fluid d-flex justify-content-between">
                      <div class="col-lg-6 pl-0">
                        <p class="mt-2 mb-2"><b> Name: <?php echo $names;?>  </b></p>
                        <p>Matric No: <?php echo $matno;?>,<br> </p>
                      </div>
                      <div class="col-lg-6 pr-0">
                        <p class="mt-2 mb-2 text-right"><b><?php echo $programme;?></b></p>
                        <p class="text-right">Level: <?php echo $level;?>,<br> Session: <?php echo $session;?>.</p>
                      </div>
                    </div>
                    <div class="alert alert-success" role="alert"><b>Regulation / Instruction</b>
                    <ul>
                      <li>You are expected to goto the exam hall with this slip, </li>
                      <li>Make sure you are in the exam hall atleast 10 mumits before the commencement of exam</li>
                      <li> Do not go into the exam hall with any foreing material.</li>
                    </ul> </div>
                    <div class="container-fluid mt-2 d-flex justify-content-center w-100">
                        <div class="table-responsive w-100">
                          <table class="table">
                            <thead>
                              <tr class="bg-dark text-white">
                                <th>#</th>
                                <th>Course Code</th>
                                <th class="text-right">Course Title</th>
                                <th class="text-right">Course Unit</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $nr=0; while($rowcrr = $fetchcourseR->fetch()){ $nr++;?>
                              <tr class="text-right">
                                <td style="font: size 7px;"><?php echo $nr;?></td>
                                <td style="font: size 7px;"><?php echo $rowcrr["coursecode"];?></td>
                                <td style="font: size 7px;"><?php echo $rowcrr["coursetitle"];?></td>
                                <td style="font: size 7px;"><?php echo $rowcrr["courseunit"];?></td>
                              </tr>
                              <?php }?>
                            </tbody>
                          </table>
                        </div>
                    </div>
                    <div class="container-fluid mt-2 w-100">
                      <p class="text-right mb-2">&nbsp;</p>
                      <p class="text-right">&nbsp;</p>
                      <h4 class="text-right mb-5">Head of Department</h4>
                      <hr>
                    </div>
                    
                  </div>

                </div>
              </div>
            </div>
          </div>
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
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
  </body>

<!-- Mirrored from demo.bootstrapdash.com/plus/jquery/template/demo_1/pages/samples/invoice.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 04 Nov 2023 12:18:25 GMT -->
</html>