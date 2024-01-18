<?php include("../data/db.php");
$matno = encryptor("decrypt",$_GET["matno"]);
$invtype = encryptor("decrypt",$_GET["invtyp"]);
$checkexist = $pdo->prepare("SELECT * FROM `students` WHERE  `matno` = ?");
$checkexist->execute([$matno]);
$stu_infor = $checkexist->fetch();
$level = $stu_infor["level"];

$payment_type = $pdo->prepare("SELECT * FROM `payment_schedule` WHERE `category` like ? AND `level` = ? AND `session`=? AND `semester`=?");
$payment_type->execute([$invtype,$level, $school_activesession, $school_activesemester]);
$payment_schedule= $payment_type->fetch();

$duedate = $payment_schedule["created_at"];
$amount = $payment_schedule['amount_indigene'];
$pay_status = "unpaid";
$payment_status = $pdo->prepare("SELECT * FROM `stu_payloader` WHERE `matno` = ? AND `type` = ?");
$payment_status->execute([@$matno, $invtype]);
$fetchpay = $payment_status->fetch();
$id = @$fetchpay['id'];
if($payment_status->rowCount() == 0)
{
  try {
    // if($cn_qryp  == 0){
    $insert_status = $pdo->prepare("INSERT INTO `stu_payloader`(`matno`, `programme`,`type`, `session`, `semester`, `level`, `pay_type`, `amount`, `status`,`fees_id`, `category`, `refno`, `txid`, `college_id`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $insert_status->execute([$matno,@$stu_infor["programme"],$invtype,$school_activesession,$school_activesemester,$stu_infor["level"],strtoupper(@$stu_infor["names"]),$amount,"unpaid",'','','','','']);
    $id = $pdo->lastInsertId();
    if($insert_status){}
  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}
else
{
  if($fetchpay['status']=='paid'){ $pay_status = "paid";}else{ $pay_status = "unpaid";}
} 
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
    <link rel="shortcut icon" href="../schoologo.png" />
  </head>
  <body>
      <div class="container-fluid page-body-wrapper">
        <div class="main-panel container">
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
                      <h5 class="text-right my-3">Invoice&nbsp;&nbsp;#INV-<?php echo date("mdy");?></h5>
                      <hr>
                    </div>
                    <div class="container-fluid d-flex justify-content-between">
                      <div class="col-lg-3 pl-0">
                        <p class="mt-3 mb-2">
                          <b><?php echo $school_names;?></b>
                        </p>
                        <p><?php echo $school_address;?>.<br> Invoice Date : <?php $date = date("Y-m-d"); echo date('jS M Y', strtotime($date));?><br>Due Date : <?php $ddate = $duedate; echo date('jS M Y', strtotime($ddate));?></p>
                      </div>
                      <div class="col-lg-3 pr-0">
                        <p class="mt-3 mb-2 text-right">
                          <b>Invoice to</b>
                        </p>
                        <p class="text-right"><?php echo $stu_infor["names"];?>, <br> <?php echo $stu_infor["matno"];?>, <br> <?php echo $stu_infor["email"];?>.</p>
                      </div>
                    </div>
                    <div class="container-fluid mt-3 d-flex justify-content-center w-100">
                      <div class="table-responsive w-100">
                        <table class="table">
                          <thead>
                            <tr class="bg-light">
                              <th>#</th>
                              <th colspan="3">Description</th>
                              <th class="text-right">Amount</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="text-right">
                              <td class="text-left">1</td>
                              <td colspan="3" class="text-left"><?php echo @strtoupper($invtype).' FOR '.$level.' - '.$stu_infor["programme"]. ' ('.$school_activesession.')';?></td>
                              <td>N<?php echo $amount = $payment_schedule['amount_indigene'];?></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="container-fluid mt-3 w-100">
                      <p class="text-right mb-2">Sub - Total amount: N<?php echo $amount;?></p>
                      <!-- <p class="text-right">charges : N<?php //echo $charges = ((1.5/100)*$amount);?></p> -->
                      <h4 class="text-right mb-5">Total : N<?php echo $total = $amount;?></h4>
                      <hr>
                    </div>
                    <div class="container-fluid w-100">
                    <?php 
                    if(isset($_GET['payinv']))
                    {
                    $matno =@encryptor("decrypt",$_GET['students']);
                    $id= @encryptor("decrypt",$_GET['id']);
                    $req = $pdo->prepare("SELECT * FROM `students` where `matno`='".$matno."'");
                    $req->execute();
                    $row= $req->fetch();
                    $totalRows_cou = $req->rowCount();
                    if($totalRows_cou ==0){
                      echo '<script>window.close();</script>';
                    }
                    try {
                    $payment_status = $pdo->query("SELECT * FROM `stu_payloader` WHERE `id`='$id' AND `matno` = '$matno'");
                    $row_pay=$payment_status->fetch();
                    $amount= floatval($row_pay['amount']);
                    if($row_pay['type']=='School Fees'){
                      $charges = (0.019 * (@$amount));
                    }else{
                      $charges = ((@$amount) * 0.038);
                    }
                    //$charges = (0.038 * @$amount) ;
                    $to = number_format(($amount + $charges));
                    $total = str_replace(",","",$to);

                    if($payment_status->rowCount()==0){
                        echo '<script>alert("Payment Link was not found! Please Contact Administrator");</script>';
                        echo'<script>window.close();</script>';
                    }else{
                    $tran_query = $pdo->query("SELECT * FROM `stu_payment_epay` WHERE `matno`='".$row_pay['matno']."' AND `type`='".$row_pay['type']."' AND `session`='".$row_pay['session']."' AND `semester`='".$row_pay['semester']."' AND `level`='".$row_pay['level']."'") ;
                    $tran_row = $tran_query->fetch();
                    $total_tran_row = $tran_query->rowCount();
                    if($total_tran_row == 0){
                      $transid = $random = substr(number_format(time() * rand(),0,'',''),0,16);
                      $pdo->query("INSERT INTO `stu_payment_epay`(`transaction_id`, `matno`, `names`, `session`, `semester`, `level`, `amount`, `type`, `gateway`, `rcode`, `notes`, `pay_id`, `status`) VALUES (
                          '".$transid."',
                          '".$row['matno']."',
                          '".$row['names']."',
                          '".$row_pay['session']."',
                          '".$row_pay['semester']."',
                          '".$row_pay['level']."',
                          '".$row_pay['amount']."',
                          '".$row_pay['type']."',
                          'nil',
                          'nil',
                          'nil',
                          '".$row_pay['id']."',
                          'Pending')");
                        $rpid = $row_pay['id'];
                          $rpmatno = $row_pay['matno'];
                        $qry=$pdo->prepare("update `stu_payloader` set  `txid`=? where `id`=? and `matno`=?");
                        $qry->execute([$transid, $rpid, $rpmatno]);

                        }else{
                        $transid = $tran_row['transaction_id'];
                        }
                      }
                    } catch(PDOException $e) {
                      echo "Error: " . $e->getMessage();
                    }
                    ?>
 
                      <form  id="paymentForm">
                          <input type="hidden" name="txid" id="txid" value="<?php echo encryptor("encrypt",$transid); ?>">
                          <input type="hidden" id="desc" name="desc" value="<?php echo $row_pay['type'];?>">
                          <input type="hidden" id="memo" name="memo" value="<?php echo @$row_pay['programme'];?>-<?php echo @$row_pay['session'];?>-<?php echo @$row_pay['semester'];?>-<?php echo @$row_pay['level'];?>">
                          
                          <input type="hidden" id="extra" name="extra" value="<?php echo @$row_pay['category'];?>-<?php echo @$row_pay['session'];?>-<?php echo @$row_pay['semester'];?>-<?php echo @$row_pay['level'];?>-college<?php echo @$row_pay['college_id'];?>-<?php echo @$row_pay['type'];?>-<?php echo @$row_pay['amount'];?>">

                          <input name="email" type="hidden" required="required" id="email" value="<?php echo $row['email'];?>">
                          <input name="phone" type="hidden" required="required" id="phone" value="<?php echo @$row['contact'];?>">
                          <input name="names" type="hidden" required="required" id="names" value="<?php echo $row['names'];?>">
                          <input name="dated" type="hidden" required="required" id="dated" value="<?php echo date('dd MM yyyy');?>">

                          <input name="category" type="hidden" required="required" id="category" value="<?php echo @$row_pay['category'];?>">
                          <input name="student_id" type="hidden" required="required" id="student_id" value="<?php echo encryptor("encrypt",$matno);?>">
                          <input name="matno" type="hidden" required="required" id="matno" value="<?php echo $matno;?>">		 

                          <input name="amount" type="hidden" required="required" id="amount" value="<?php echo $total;?>">
                          <br><br>
                          <?php //$pow=0; if($pow=='1'){
                          if($row_pay['type'] !='School Fees'){?>
                          <!--<button type="button" class="btn btn-primary" onclick="SquadPay()"> Pay Now (Debit card only)</button> &nbsp;&nbsp;-->
                          <?php }?>
                          <?php //$pow=0; if($pow=='1'){?>
                          <button type="button" class="btn btn-warning float-end mt-4" onclick="makePayment()"> Pay Now (Cards, USSD & Transfer)</button><?php //}?>
                          
                      </form>
                      <?php 
                    }else
                    { // get the table field name -- 
                      //School Fees //Acceptance fee //Late Registration//Putme fee //Screening fee //Application fee
                      if($invtype=="School Fees"){
                       $_SESSION['dbtbl_field'] = $tfn = 'school_fee';
                      }if($invtype=="Acceptance fee"){
                        $_SESSION['dbtbl_field'] = $tfn = 'acceptance_fee';
                      }if($invtype=="Late Registration"){
                      }if($invtype=="Putme fee"){
                        $_SESSION['dbtbl_field'] = $tfn = 'putme_fee';
                      }if($invtype=="Screening fee"){
                        $_SESSION['dbtbl_field'] = $tfn = 'screening_fee';
                      }if($invtype=="Application fee"){
                        $_SESSION['dbtbl_field'] = $tfn = 'application_fee';
                      }

                      ?>
                      <a href="?payinv=1&<?php echo encryptor("encrypt", $matno).'&invtyp='.encryptor("encrypt",$invtype).'&matno='.encryptor("encrypt", $matno).'&students='.encryptor("encrypt", $matno).'&id='.encryptor("encrypt",$id).'&t_f='.encryptor("encrypt",$invtype);?>" class="btn btn-primary float-end mt-4 ms-2">
                        <i class="mdi mdi-printer me-4"></i>Continue</a>
                      <?php 
                    }
                    ?>
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
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2023<a href="#" target="_blank">ULTRACODE LTD</a>. All rights reserved.</span>
              <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i>
              </span>
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