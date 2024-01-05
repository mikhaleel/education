<?php
require_once("db.php");
if (!isset($_SESSION))
{
  session_start();
}
if(
	$_POST["username"]==""||
	$_POST["password"]==""
  )
  {
	  echo '<div class="alert alert-danger">Empty fields cannot be submitted</div>';
  }
  else
  {
	//staff table
	 $checkq = $pdo->prepare("SELECT * FROM `staff` WHERE `username` = ? && `password` = ? and `status`=?");
	 $checkq->execute([$_POST["username"], $_POST["password"], '1']);
	 $trows = $checkq->fetch(PDO::FETCH_ASSOC);
	 
	 $depts = @$trows["department"];
	 
	 $deptids = $pdo->prepare("SELECT dept_id FROM `departments` WHERE `names` = ?");
	 $deptids->execute([$depts]);
	 $dpt_ids = $deptids->fetch();


		
		if($checkq->rowCount() != 0)
		{
			if($trows["usertype"] <= 0)
			{
				echo '<div class="alert alert-danger">Access, Denied</div><script>setTimeout(function(){location.href="../logout.php"},10)</script>';
			}
			else
			{
			    if($trows["designation"] == 'EO' OR $trows["designation"] == 'EXAMINATION OFFICER' OR $trows["designation"] == 'APO'){
					$_SESSION['eo'] = $trows["designation"];
					
				//	$dtum = array("DEPT_ID"=>$dpt_ids["dept_id"],"DEPARTMENT"=>$trows["department"],""=>,""=>,""=>,""=>,""=>,""=>);
				}
				
				
			 //   echo '<script>alert("'.$trows["department"].'")</script>';
				$_SESSION["username"] = $trows["username"];
				$_SESSION["names"] = $trows["names"];
				$_SESSION["designation"] = $trows["designation"];
				$_SESSION["school"] = $trows["school"];
				$_SESSION["dept_id"] = $dpt_ids["dept_id"];//$trows["department"];
				$_SESSION["department"] =$trows["department"];
				$_SESSION["usertype"] = $trows["usertype"];
				$_SESSION["accesslevel"] = $trows["accesslevel"];
				$_SESSION["image"] = $trows["image"];
				$_SESSION["status"] = $trows["status"];
				$_SESSION["usermenu"] = $trows["usertype"];
			//	$_SESSION["usertype"] = $trows["usertype"];

				$_SESSION["usreid"] = encryptor("encrypt",$trows["id"]);
				$_SESSION["level"] = 'staff';
				$_SESSION["pageaccess"] = "pageaccess";
				$_SESSION["studeymode"] = encryptor("encrypt","Full Time");

                if($trows["designation"] == 'APO'){
                	$_SESSION['dap'] = $trows["designation"];
                	echo '<div class="alert alert-success outline alert-dismissible fade show" role="alert"><i data-feather="thumbs-up"></i><b>Wait,</b> loading dashboard....</div><script>setTimeout(function(){location.href="rms_dap"},50)</script>';
				}else{
				    echo '<div class="alert alert-success outline alert-dismissible fade show" role="alert"><i data-feather="thumbs-up"></i><b>Wait,</b> loading dashboard....</div><script>setTimeout(function(){location.href="index"},50)</script>';
				}
			}
// 		}else
// 		{			echo '<div class="alert alert-danger">'.$_POST["username"].'Login details incorrect</div>';
	}
	 elseif($checkq->rowCount() == 0)
	 {
		 // stduent table
		$scheckq = $pdo->prepare("SELECT * FROM `students` WHERE `matno` = ? &&  (`password` = ? OR `password`=?) ");
		$scheckq->execute([$_POST["username"], $_POST["password"], 'Easy123']);
		$strows = $scheckq->fetch(PDO::FETCH_ASSOC);

		if($scheckq->rowCount() != 0 && $strows['stat']=='1')//student count
		{
		  $_SESSION["username"] = $strows["matno"];
		  $_SESSION["names"] = $strows["names"];
		  $_SESSION["designation"] = "Students";
		  $_SESSION["department"] = $strows["department"];
		  $_SESSION["programme"] = $strows["programme"];
		  //$_SESSION["accesslevel"] = $trows["accesslevel"];
		  $_SESSION["image"] = $strows["images"];
		  $_SESSION["status"] = $strows["stat"];
		  //$_SESSION["usermenu"] = $trows["usertype"];
		  $_SESSION["usreid"] = encryptor("encrypt",$strows["id"]);
		  $_SESSION["matno"] = encryptor("encrypt",$strows["matno"]);
		  //$_SESSION["matno"] = $strows["matno"];
          $_SESSION["level"] = 'student';
		  $_SESSION["usertype"] = 0;

		  $_SESSION["email"] = $strows["email"];
		  $_SESSION["spageaccess"] = "spageaccess";
		  $_SESSION["studeymode"] = encryptor("encrypt","Full Time");			
          echo '<div class="alert alert-success outline alert-dismissible fade show" role="alert"><i data-feather="thumbs-up"></i><b>Wait,</b> loading dashboard....</div><script>setTimeout(function(){location.href="index"},20)</script>';
        }
    	elseif($scheckq->rowCount() != 0 && $strows['stat']=='2')//student count
            {
    		   echo '<div class="alert alert-danger">'.$_POST["username"].' You have been  RUSTICATED</div>';

    }else
	   {
		   echo '<div class="alert alert-danger">'.$_POST["username"].' Login details incorrect</div>';
	   }
	 }
  }
?>
