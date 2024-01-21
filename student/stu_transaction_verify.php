<?php $title = "Student Transaction Status";?>
<title><?php echo $title;?></title>
<?php include('../data/db.php');?>
<?php 
if(!isset($_SESSION['username'])){
//echo '<script>window.location.replace("../../index");</script>';
}
$msg="Oops! Payment failed...";
$good=0;
	if(isset($_REQUEST['tx_ref']) || $_REQUEST['txid']){
	$ref=cleanstring(@$_REQUEST['tx_ref']) ?? cleanstring($_REQUEST['transaction_id']);
	//	$txid=@$_REQUEST['flw_ref'];
		$status=cleanstring(@$_REQUEST['status']);
		$txid=cleanstring(encryptor("decrypt",@$_REQUEST['txid']));
		$matno=cleanstring(encryptor("decrypt",@$_REQUEST['id']));
    	$matno1=cleanstring($_REQUEST['id']);
		$amount=cleanstring(@$_REQUEST['amount']);
	///	$status=encryptor("decrypt",@$_REQUEST['amount']);
if($status=='successful' || $status=='completed'){
		//$tx_ref=encryptor("decrypt",@$_REQUEST['tx_ref']);
    
    $tran_query = $pdo->prepare("SELECT * FROM `stu_payment_epay` WHERE `transaction_id`=? and (`matno`=? OR `matno`=?)") ;
    $tran_query->execute([$txid,$matno,$matno1]);
    $tran_row = $tran_query->fetch();
    $total_tran_row = $tran_query->rowCount();
    $pay_id = $tran_row['pay_id'];
   // $pay_id = $tran_row['pay_id'];

     if ($total_tran_row > 0) {
         
      $pay_query = $pdo->prepare("SELECT * FROM `stu_payloader` WHERE `txid`=?"); $pay_query->execute([$txid]);
      $pay_row = $pay_query->fetch();
      $fees_id=$pay_row['fees_id'];

    $qry=$pdo->prepare("update `stu_payment_epay` set  `gateway`=?,`notes`=?, `status`=? where `transaction_id`=? and (`matno`=? OR `matno`=?)");
    $qry->execute(['flutterwave',$ref,'successful',$txid,$matno,$matno1]);
    
    $qry1=$pdo->prepare("update `stu_payloader` set `status`=?, `refno`=?,`gateway`=?, fees_id= ? where `txid`=? and (`matno`=? OR `matno`=?)");
    $qry1->execute(['paid',$ref,'flutterwave',$fees_id,$txid,$matno,$matno1]);

if($tran_row['type']=='Accommodation'){
    $hostel = $fees_id;
    //get  hostel records 
    $query_hostels =$pdo->prepare("SELECT * FROM hostels WHERE `id` = ?");
	$query_hostels->execute([$hostel]);
	$row_hostels = $query_hostels->fetch(); 
    
    // $i=$row_hostels['bedspaces'] - $row_hostels['occupied'];
        
      
        // $qry2=$pdo->prepare("update `stu_accomodation` set  `status`=? where `id`=? and (`matno`=? OR `matno`=?)");
        // $qry2->execute(['paid',$fees_id,$matno,$matno1]);
        
        $acc_query = $pdo->query("SELECT * FROM `stu_accomodation` WHERE `reserved_id`='$fees_id' AND session = '".$pay_row['session']."' AND semester = '".$pay_row['semester']."' GROUP BY matno") ;
                $acc_row = $acc_query->fetch();
                $no_ocup= $acc_query->rowcount();
                
        $hostel_id=$fees_id;
        $occu_query = $pdo->query("SELECT * FROM `hostels` WHERE `id`='$hostel_id'") ;
                $occu_row = $occu_query->fetch();
         $bedspace=$occu_row['bedspaces'];
         $occupy =  ($no_ocup + 1);
         
          $i=  ($no_ocup + 1);
           
        //insert into stu_accomm
        $qry_instert=$pdo->prepare("INSERT INTO `stu_accomodation`(`matno`, `hostel`, `block`, `room`, `bedspace`, `session`,`level`,  `semester`,`reserved_id`,`amount`,`status`) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        $student_decrypt = $pay_row['matno'];
        $qry_instert->execute([$student_decrypt,$row_hostels['hostel'],$row_hostels['block'],$row_hostels['room'],$i,$pay_row['session'],$pay_row['level'],$pay_row['semester'],$hostel,$row_hostels['amount'],'paid']);

         
         
        //$occupy = number_format($occu_row['occupied']) + 1;
        $romstatus = $occu_row['status'];
        
        if($occupy >= $bedspace)
        {
            $status_room = 'occupied';
        }else
        {
            $status_room = 'vacant';
        }
        
        if ($romstatus == 'reserve')
        { 
            $status_room = $romstatus; 
        }
        $rmidd = ($occu_row['id']);
        $qry_exec=$pdo->query("update `hostels` set `occupied`='$occupy',`status`='$status_room' where `id`= $rmidd");

    }
	if($qry){
	//$_SESSION['NHCAPPNO'] =encryptor("decrypt",$orderid);
		//echo'<script>window.close()";</script>';
    $msg="Payment was successful..";
    $good =1;
	}
	else
	{
		//echo'<script>window.close();</script>';
		$msg="Oops! Payment failed...";
        $good =0;
	}
	}else{
    $msg="Oops! Payment failed...";
      $good =0;
  }
}
}else{
    //echo '<script>window.location.href="../../../index";</script>';
}
?>	
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="author" content="ultracode ltd">
    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <title><?php echo $title;?></title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="../assets/css/fontawesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="../assets/css/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/feather-icon.css">
    <!-- Plugins css start-->
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link id="color" rel="stylesheet" href="../assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">
  </head>
  <body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="theme-loader">    
        <div class="loader-p"></div>
      </div>
    </div>
    <!-- Loader ends-->
    <!-- Maintenance start-->
    <section class="maintenance-sec">
      <div class="page-wrapper">
        <div class="error-wrapper maintenance-bgm">
          <div class="container">
            <ul class="maintenance-icons">
              <?php if ($good==1){?>
              <li><i class="fa fa-check"></i></li>
              <li><i class="fa fa-check"></i></li>
              <li><i class="fa fa-check"></i></li>
              <?php }else{?>
                <li><i class="fa fa-close" style="color:red"></i></li>
              <li><i class="fa fa-close" style="color:red"></i></li>
              <li><i class="fa fa-close" style="color:red"></i></li>

                <?php }?>
            </ul>
            <div class="maintenance-heading">
              <h2 class="headline"><?php echo strtoupper( $msg);?></h2>
              <p>Refresh your Dashboard</p>
            </div>
            <h4 class="sub-content"></h4>
            <div><a class="btn btn-primary btn-lg text-light" onclick="return closeWindow();">CLOSE PAGE</a></div>
          </div>
        </div>
      </div>
    </section>
    <!-- Maintenance end-->
    <!-- latest jquery-->
    <script src="../assets/js/jquery-3.5.1.min.js"></script>
    <!-- feather icon js-->
    <script src="../assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="../assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- Sidebar jquery-->
    <script src="../assets/js/sidebar-menu.js"></script>
    <script src="../assets/js/config.js"></script>
    <!-- Bootstrap js-->
    <script src="../assets/js/bootstrap/popper.min.js"></script>
    <script src="../assets/js/bootstrap/bootstrap.min.js"></script>
    <!-- Plugins JS start-->
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="../assets/js/script.js"></script>
    <!-- login js-->
    <!-- Plugin used-->
  </body>
</html>
<script type="text/javascript">
        function closeWindow() {
  
            
            let new_window =
                open(location, '_self');
              //  document.opener.document.location.href = document.opener.document.location.href

            // Close this window
            new_window.close();
  
            return false;
        }
    </script>
    <form id="form1" runat="server">
    <script type="text/javascript">
        function RefreshParent() {
            if (window.opener != null && !window.opener.closed) {
                window.opener.location.reload();
            }
        }
        window.onbeforeunload = RefreshParent;
    </script>
</form>