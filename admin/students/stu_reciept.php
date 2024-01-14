<?php //stpid
 include("../../data/db.php");
     $stpid = encryptor('decrypt',$_GET["stpid"]);
     $fetchpay = $pdo->prepare("SELECT * FROM `stu_payloader` WHERE `id`=?");
     $fetchpay->execute([$stpid]);
     $payrow = $fetchpay->fetch();
     $seme_ar=array(1=>"First Semester",2=>"Second Semester",3=>"Third Semester")
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Payment reciept</title>
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
            <div class="page-header">
              <h5 class="page-title"> Invoice </h5>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="card px-2">
                  <div class="card-body">
                    <div class="container-fluid">
                      <h4 class="text-right my-5">Invoice&nbsp;&nbsp;#SCHF-<?php echo number_format($payrow["id"],3);?> </h4>
                      <hr>
                    </div>
                    <div class="container-fluid d-flex justify-content-between">
                      <div class="col-lg-6 pl-0">
                        <p class="mt-2 mb-2"><?php echo $payrow["pay_type"];?><b> [<?php echo $payrow["matno"];?>]</b>
                        <br><?php echo $payrow["level"];?>  - <?php echo $payrow["programme"];?> 
                        <br><?php echo $seme_ar[$payrow["semester"]];?> - <?php echo $payrow["session"];?>
                      </p>
                      </div>
                      <div class="col-lg-2 pl-0">
                        <p class="mt-2 mb-2">Status: <b class="badge badge-outline-primary "> &nbsp;Paid &nbsp;</b>
                      </p>
                      </div>
                    </div>
                    
                    <div class="container-fluid mt-2 d-flex justify-content-center w-100">
                      <div class="table-responsive w-100">
                        <table class="table">
                          <thead>
                            <tr class="bg-dark text-white">
                              <th>#</th>
                              <th>Description</th>
                              <th class="text-right">Amount</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="text-right">
                              <td class="text-left">1</td>
                              <td class="text-left"><?php echo $payrow["level"];?> - <?php echo $seme_ar[$payrow["semester"]];?> <?php echo $payrow["session"];?> <?php echo $payrow["type"];?></td>
                              <td><?php echo $payrow["amount"];?></td>
                            </tr>
                            <tr class="text-right">
                              <td class="text-left">2</td>
                              <td class="text-left">Late Charges </td>
                              <td><?php echo $payrow["lates"];?></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="container-fluid mt-2 w-100">
                      <p class="text-right mb-2">Total amount: N <?php echo ($payrow["amount"] + $payrow["lates"]);?></p>
                      <p class="text-right">
                        
                      </p>
                      <h4 class="text-right mb-5 mt-5 w-100">Bursar</h4>
                      <hr>
                    </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
       
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