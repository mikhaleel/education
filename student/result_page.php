<?php if (!isset($_SESSION)){ session_start();}
if (!isset($_SESSION['pageaccess'])) {
    header('Location: ../');
    exit();
}include("../data/db.php");
$matno = encryptor("decrypt",$_GET["matno"]);
$level =  encryptor("decrypt",$_GET["level"]);
$semester = encryptor("decrypt",$_GET["semester"]);
//$session = encryptor("decrypt",$_GET["matno"]);

$results_s = $pdo->prepare("SELECT * FROM `results` WHERE `matno`=? AND `level` = ? AND `semester`=?");
$results_s->execute([$matno, $level, $semester]);

$sturec = $pdo->query("SELECT * FROM `students` WHERE `matno`='$matno'");
$stur = $sturec->fetch();
?>
<!DOCTYPE html>
<html lang="en">
  
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $matno. " - ".$level." ".$semester_arr[$semester];?> - Result</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../applicant/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../applicant/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../../applicant/assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../applicant/assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="../../applicant/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End Plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../../applicant/assets/css/shared/style.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../../applicant/assets/css/demo_11/style.css">
    <!-- End Layout styles -->
    <link rel="shortcut icon" href="../../applicant/assets/images/favicon.png" />
  </head>
  <body class="invoice-page">
    <div class="container-scroller">
     
      <!-- partial -->
      <!-- partial:../../partials/_settings-panel.html -->

      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <div class="main-panel container">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-lg-12">
                <div class="card px-2">
                  <div class="card-body">
                    <div class="container-fluid">
                      <span class="text-right my-3" style="text-align:center"><img src="../schoologo.png"></span>
                    </div>
                    <div class="container-fluid d-flex justify-content-between">
                      <div class="col-lg-3 pl-0">
                        <p class="mt-1 mb-2" style="text-align:center">
                          <b><?php echo strtoupper($school_names);?></b>
                          <?php echo strtoupper($school_address);?>.
                        </p>
                      <hr>
                      </div>
                      <div class="col-lg-3 pr-0">
                        <p class="mt-3 mb-2 text-right">
                        </p>
                      <p class="text-right">
                        Name: <?php echo $stur["names"];?>
                        <br> Matric No: <?php echo $stur["matno"];?>
                        <br> Level: <?php echo $level;?> 
                        <br> Semester: <?php echo $semester_arr[$semester];?>
                      </p>
                      </div>
                    </div>
                    
                    <div class="container-fluid w-100">
                    <div class="table-responsive">
                    <table border="1" id="order-listing" class="table" cellspacing="0" width="100%">
                    <tr class="bg-primary text-white">
                    <th>#</th>
                    <th>Code</th>
                    <th>Title</th>
                    <th>Unit</th>
                    <th>Mark</th>
                    <th>Grade</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php $unit = 0; $gp = 0;
                      $idn = 1; while($resRow =$results_s->fetch()){ 
                        $unit = ($unit + $resRow["unit"]);
                        $gp = ($gp + $resRow["gp"]);
                        ?>
                    <tr>
                    <td><?php echo $idn;?></td>
                    <td><?php echo $resRow["code"];?></td>
                    <td><?php echo $resRow["title"];?></td>
                    <td><?php echo $resRow["unit"];?></td>
                    <td><?php echo $resRow["score"];?></td>
                    <td><?php echo $resRow["grade"];?></td>
                    </tr>
                    <?php $idn++; }?>
                    </tbody>
                    </table>
                  </div>
                    </div>
                  <div class="table-responsive">
                  <table border="1" id="order-listing" class="table" cellspacing="0" width="100%">
                  
                  <tbody>
                  <td>Total Unit: <?php echo @$unit;?></td>
                  <td>GP: <?php echo number_format(@$gp,2);?></td>
                  <td>GPA: <?php if($unit ==0){echo "0.00";} else{ echo number_format((@$gp/@$unit), 2);}?></td>
                  </tbody>
                  </table>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->

          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../applicant/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js-->
    <script src="../../applicant/assets/js/shared/off-canvas.js"></script>
    <script src="../../applicant/assets/js/shared/hoverable-collapse.js"></script>
    <script src="../../applicant/assets/js/shared/misc.js"></script>
    <script src="../../applicant/assets/js/shared/settings.js"></script>
    <script src="../../applicant/assets/js/shared/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="../../applicant/assets/js/demo_11/script.js"></script>
    <!-- End custom js for this page -->
  </body>

</html>

<script src="../jquery.min.js"></script>
<script src="htmlcanva.js"></script>
<script src="https://checkout.squadco.com/widget/squad.min.js"></script> 
<script src="https://checkout.flutterwave.com/v3.js"></script>
<script src="https://js.paystack.co/v1/inline.js"></script>