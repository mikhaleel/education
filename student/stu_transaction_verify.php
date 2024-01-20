<?php session_start(); $title = "Institute - Applicant Transaction Status";
// if(!isset($_SESSION['userapps'])){
//   echo '<script type="text/javascript">
//   window.close();
// </script>';
// echo '<script>window.location.href="../index";</script>';
//}?>
<script src="../jquery.min.js"></script>
<title><?php echo $title;?></title>
<?php include('../data/db.php');?>
<?php
$msg="Oops! Payment failed...";
$good=0;

if(isset($_REQUEST['tx_ref']) || $_REQUEST['txid']){
	$ref=@$_REQUEST['tx_ref'] ?? $_REQUEST['transaction_id'];
	$txid=encryptor("decrypt",$_REQUEST['txid']);
	//$txid=@$_REQUEST['flw_ref'];
	$status=@$_REQUEST['status'];
	//$txid=@$_REQUEST['transaction_id'];
	$matno=encryptor("decrypt",@$_REQUEST['id']);
	$amount=@$_REQUEST['amount'];

	if($status=='successful' || $status=='completed')
	{
		$tran_query = $pdo->prepare("SELECT * FROM `stu_payment_epay` WHERE `matno`=? AND `transaction_id`=?");
		$tran_query->execute([$matno,$txid]);
		$tran_row = $tran_query->fetch();
		$total_tran_row = $tran_query->rowCount();
		$fees_id = $tran_row['matno'];
		$pay_id = @$tran_row['pay_id'];

		if ($total_tran_row > 0) 
		{
			$qry=$pdo->prepare("update `stu_payment_epay` set `gateway`='flutterwave',`notes`=?, `status`='successful' where `transaction_id`=?");
			$qry->execute([$ref,$txid]);
			if($qry)
			{
				$qry2=$pdo->prepare("update `stu_payloader` set `status`='paid', `refno`=?, `gateway`='flutterwave' where `matno`=? and `txid`=?");
				$qry2->execute([$ref,$fees_id,$txid]);

				$qryap=$pdo->prepare("update `applicant` set `$dbtbl_field`=? where `application_no`=?");
				$qryap->execute(['paid',$fees_id]);
			}		
			$studids = $pdo->query("SELECT `id` from `students` where `matno`='$matno");
			$strowid = $studids->fetch(); $students_ids = encryptor('encrypt',$strowid["id"]);
			//	$_SESSION['NHCAPPNO'] =encryptor("decrypt",$orderid);
					echo '<div class="alert alert-success">Loading student Dashboad.....</div><script>setTimeout(function(){location.href="dashboard?matno='.$students_ids.'&start'.'"},10)</script>';
				//}
		}// else if school fee is nto paid do something
	}else
	{
		echo'<script>window.close();</script>';
	}
}
?>