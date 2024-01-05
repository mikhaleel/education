<?php session_start();$title = "Etsu Yahaya Institute - Applicant Transaction Status";
if(!isset($_SESSION['userapps'])){
  echo '<script type="text/javascript">
  window.close();
</script>';
echo '<script>window.location.href="../index";</script>';
}?>
<script src="../assets/js/jquery-3.5.1.min.js"></script>
<title><?php echo $title;?></title>
<?php include('data/db.php');?>
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

if($status=='successful' || $status=='completed'){

	$tran_query = $pdo->prepare("SELECT * FROM `stu_payment_epay` WHERE `matno`=?");
	$tran_query->execute([$matno]);
	$tran_row = $tran_query->fetch();
	$total_tran_row = $tran_query->rowCount();
	$fees_id = $tran_row['matno'];
	$pay_id = @$tran_row['pay_id'];

	if ($total_tran_row > 0) {
	if($_SESSION["dbtbl_field"]!='')
	{
    	$dbtbl_field = strtolower($_SESSION["dbtbl_field"]);
	}
	else
	{
	    $dbtbl_field = strtolower(encryptor('decrypt',$_GET["t_f"]));
	}

$qry=$pdo->prepare("update `stu_payment_epay` set `gateway`='flutterwave',`notes`=?, `status`='successful' where `transaction_id`=?");
	$qry->execute([$ref,$txid]);
if($qry)
{
	$qry2=$pdo->prepare("update `stu_payloader` set `status`='paid', `refno`=?, `gateway`='flutterwave' where `matno`=? and `txid`=?");
	$qry2->execute([$ref,$fees_id,$txid]);

	$qryap=$pdo->prepare("update `applicant` set `$dbtbl_field`=? where `application_no`=?");
	$qryap->execute(['paid',$fees_id]);
}

$checkq = $pdo->prepare("SELECT * FROM `applicant` WHERE `application_no` = ?");
$checkq->execute([$fees_id]);
$checked = $checkq->fetch();
$serial_no = date("Ydmis");
if($dbtbl_field == "school_fee")
{
	if($checked["school_fee"] == "paid")
	{
		$gpr = $pdo->prepare("SELECT * FROM `programmes` WHERE `programme`=?");
		$gpr->execute([$checked['programme']]);
		$gprg = $gpr->fetch();

		$year = $checked["year"];
		$pgr_abv = $gprg["abv"];
		$deyear = $company_application_year;
		$yr = substr($deyear, -3);
		
		$foundcenter = $checked['study_center'];
		$theCentre = strtolower($foundcenter);
		
        if( ($theCentre == 'bida'))
        {
            $study_center = $theCentre;
			$college_id = 2;
        }
        elseif(($theCentre == 'minna'))
        {
            $study_center = 'minna';
		   // $mds = '';
			$college_id = 3;
        }
		
		if($checked["level"] == 'REMEDIAL')
        {
		  //  $count = $pdo->query("SELECT * FROM `matno_counter` WHERE `class` = ? AND `session` = ? AND `center`= '$study_center'");
		   $count = $pdo->query("SELECT * FROM `matno_counter` WHERE `class` = ?");
		
		    $count->execute(['PND']);
    	}
    	else
    	{
		    $count = $pdo->prepare("SELECT * FROM `matno_counter` WHERE `class` = ?");
		    $count->execute([$pgr_abv]);
    	}
    	
		$thecount = $count->fetch();
		if($count->rowCount() == 0)
		{
			//$no = 0;
		}else
		{
			$no = $thecount["count"];
			$newno = $thecount["count"] + 1;
		}
		
// 		if($study_center == 'minna')
// 		{
// 		$nos= substr(str_repeat(0, 3).$no, - 3);
// 		$matno = $pgr_abv.$mds."/0".$yr."/".$nos;
// 		}
// 		elseif($study_center == 'bida'){
		$nos= substr(str_repeat(0, 4).$no, - 4);
		$matno = $pgr_abv."/".$yr."/".$nos;
        //}
        
		$sessions = $deyear."/".($deyear+1);
		$theprogs = strtolower($checked['programme']); 
		list($theprog) = explode(' in', $theprogs);
		if($theprog == "higher national diploma")
		{
			$level = "HND1";
		}
		else
		if($theprog == "national diploma")
		{
			$level = "ND1";
		}
		else
		if($theprog == "diploma")
		{
			$level = "DIP1";
		}
		else
		if($theprogs == 'ijmb')
		{
			$level = "IJMB";
		}
		else
		if($theprog == 'pre-nd')
		{
			$level = "REMEDIAL";
		}
		else
		if($theprog == 'pre-hnd')
		{
			$level = "PREHND";
		}
		else
		if(strpos($theprogs,'certificate') == TRUE)
		{
			$level = "CERT";
		}
//'".$checked['religion']."',
//$checked['matno']
    if($checked['matno'] == "" OR $checked['matno'] == NULL)
    {
		$uqryapp=$pdo->prepare("update `applicant` set `matno`=? where `application_no`=?");
		$uqryapp->execute([$matno,$fees_id]);
		
		$qryst = $pdo->prepare("INSERT INTO `students`(`applicationno`, `utme`,`matno`, `password`, `names`, `sex`, `dob`, `tribe`, `country`, `states`, `lga`, `address`, `email`, `contact`, `programme`, `department`, `year`, `entry_session`, `session`, `stat`, `college_id`, `school_id`, studycenter_id, `level`, `semester`, `images`) VALUES
		(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
		 ");
		 
		$qryst->execute([$checked["application_no"],$checked["utme"],$matno,'Easy123',$checked["names"],$checked['gender'],$checked['dob'],$checked['tribe'],$checked['country'],$checked['state'],$checked['lga'],$checked['pgaddress'],$checked['email'],$checked['gsm'],$checked['programme'],$gprg['dept_id'],$checked['year'],$sessions,$sessions,1,$college_id,$gprg['school_id'],$gprg['study_center'],$level, 1,$checked['passport']]);
        if($checked["level"] == 'REMEDIAL')
        {
    	    $qrymtc = $pdo->prepare("UPDATE `matno_counter` SET `count` = ? WHERE `class`=?");
    		$qrymtc->execute([$newno,'PND']);
        }
        else
        {	
    		$qrymtc = $pdo->prepare("UPDATE `matno_counter` SET `count` = ? WHERE `class`=?");
    		$qrymtc->execute([$newno,$pgr_abv]);
        }
		if($qrymtc)
		{
		    $nqry=$pdo->prepare("update `stu_payment_epay` set `matno`=? where `matno`='$fees_id' AND `transaction_id`=? AND `type` = 'School Fees'");
        	$nqry->execute([$matno,$txid]);
        	$nqry2=$pdo->prepare("update `stu_payloader` set `matno`='$matno' where `matno`=? and `txid`=? AND `type` = 'School Fees'");
        	$nqry2->execute([$fees_id,$txid]);
		    $apnoo = $checked["application_no"];
			$app_detail = array("PROGRAMME" => $checked["programme"], "FULLNAME" =>$checked["names"], "CONTACT" =>$checked["gsm"], "EMAIL" =>$checked["email"], "MATNO" =>$matno, "APPLICATIONNO"=>$checked["application_no"], "SERIALNO" => $serial_no);
			$app_details = encryptor("encrypt",serialize($app_detail));
			//	$_SESSION['NHCAPPNO'] =encryptor("decrypt",$orderid);
					echo '<div class="alert alert-success">Loading Applicant Account.....</div><script>setTimeout(function(){location.href="dashboard?appno='.$apnoo.'&start'.'"},1)</script>';
		}
	}// else if matno does not exist  do something
	else
	{
		$app_detail = array("PROGRAMME" => $checked["programme"], "FULLNAME" =>$checked["names"], "CONTACT" =>$checked["gsm"], "EMAIL" =>$checked["email"], "MATNO" =>$checked['matno'], "APPLICATIONNO"=>$checked["application_no"], "SERIALNO" => $serial_no);
		$app_details = encryptor("encrypt",serialize($app_detail));
		//	$_SESSION['NHCAPPNO'] =encryptor("decrypt",$orderid);
				echo '<div class="alert alert-success">Loading Applicant Account.....</div><script>setTimeout(function(){location.href="dashboard?appno='.$apnoo.'&start'.'"},10)</script>';
	}
}// else if school fee is nto paid do something
}
	if($qryap){
		$app_detail = array("PROGRAMME" => $checked["programme"], "FULLNAME" =>$checked["names"], "CONTACT" =>$checked["gsm"], "EMAIL" =>$checked["email"], "ITEM" =>"APPLICATION FORM", "APPLICATIONNO"=>$checked["application_no"], "SERIALNO" => $serial_no);
			$app_details = encryptor("encrypt",serialize($app_detail));
//	$_SESSION['NHCAPPNO'] =encryptor("decrypt",$orderid);
		echo '<div class="alert alert-success">Loading Application Form.....</div><script>setTimeout(function(){location.href="index?appno='.$apnoo.'&start'.'"},10)</script>';
	}
else
		{
			echo'<script>window.close();</script>';
		}
	} 
}
}
?>