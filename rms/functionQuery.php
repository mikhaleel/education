<?php 
function applicatInsertQuery($pdo, $names, $contact, $email, $password, $programme)
{
	$pqry = $pdo->prepare("INSERT INTO `application` (`names`, `email`, `contact`, `password`, `programme`, `status`, `paystatus`, `year`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
	$pqry->execute([$names, $contact, $email, $password, $programme, "pending", "unpaid", date("Y")]);
	$user_id = $pdo->lastInsertId();
		
		$sqry = $pdo->prepare("SELECT * FROM `session`");
		$sqry->execute();
		$srows = $sqry->fetch(PDO::FETCH_ASSOC);

		$appno = "FLAILAS".$srows["session"].$user_id;

	if($pqry)
	{
		$qry = $pdo->prepare("SELECT * FROM `programmes`, `departments` WHERE `programme` = ? && `programmes`.`dept_id` =`departments`. `dept_id`");
		$qry->execute([$programme]);
		$rows = $qry->fetch(PDO::FETCH_ASSOC);
		//if($qry->rowCount() > 0)
		//{
			//echo $uaqry = '<script>alert('.$appno.')</script>';
			$uaqry = $pdo->prepare("UPDATE `application` SET `applicationno` = ? ,`department` = ? WHERE `email` = ?");
			$uaqry->execute([$appno, $rows['name'], $_SESSION["email"]]);
		//}	
	}

	return  $uaqry;
}

function updatePayment($pdo, $appno, $ref)
{
	$uaqry = $pdo->prepare("UPDATE `application` SET `paystatus` = ?, `refference` = ? WHERE `applicationno` = ?");
	$uaqry->execute(["paid",$ref , $appno]);
}

function selectToInvoice($pdo, $email)
{
	$qry = $pdo->prepare("SELECT * FROM `application`  WHERE `email` = ?");
	$qry->execute([$email]);
	//$rows = $qry->fetch(PDO::FETCH_ASSOC);
	return $qry;
}




function lecturerInsertQuery($pdo, $names, $snumber, $dept_id, $user_type, $username, $password, $images)
{
	$pqry = $pdo->prepare("INSERT INTO `lecturernm` (`names`, `snumber`, `dept_id`) VALUES (?, ?, ?)");
	$pqry->execute([$names, $snumber, $dept_id]);
	$user_id = $pdo->lastInsertId();
	
	$logqry = $pdo->prepare("INSERT INTO `login` (`names`, `username`, `password`, `user_id`, `dept_id`, `user_type`, `image`) VALUES (?, ?, ?, ?, ?, ?, ?)");
	$logqry->execute([$names, $username, $password, $user_id, $dept_id, $user_type,  $images]);
	//return $qry;
}



function accessInsertQuery($pdo, $names, $username, $user_id, $dept_id, $user_type, $password, $images)
{
	$logqry = $pdo->prepare("INSERT INTO `login` (`names`, `username`, `password`, `user_id`, `dept_id`, `user_type`, `image`) VALUES (?, ?, ?, ?, ?, ?, ?)");
	$logqry->execute([$names, $username, $password, $user_id, $dept_id, $user_type,  $images]);
	//return $qry;
}

function ProInsertQuery($pdo, $programme, $procode, $department)
{
	$logqry = $pdo->prepare("INSERT INTO `programmes` (`programme`, `pro_code`, `dept_id`) VALUES (?, ?, ?)");
	$logqry->execute([$programme, $procode, $department]);
	//return $qry;

}

function deptInsertQuery($pdo, $programme, $procode, $department)
{
	$logqry = $pdo->prepare("INSERT INTO `departments` (`name`, `code`, `schl_id`) VALUES (?, ?, ?)");
	$logqry->execute([$programme, $procode, $department]);
	//return $qry;

}

function colInsertQuery($pdo, $programme, $procode, $department)
{
	$logqry = $pdo->prepare("INSERT INTO `colleges` (`college`, `collegecode`, `campus`) VALUES (?, ?, ?)");
	$logqry->execute([$programme, $procode, $department]);
	//return $qry;

}

// use this query to sellect all records from all tablebles 
function selectAllQuery($pdo, $tableName)
{
	$qry = $pdo->prepare("SELECT * FROM `$tableName`");
	$qry->execute();
	//$rows = $qry->fetch(PDO::FETCH_ASSOC);
	return $qry;
	//return $qry;
}
// count all student,  lectueres, programmes, departments, schools

function countRecords($pdo)
{
		$allStds = $pdo->prepare("SELECT * FROM studentsnm");
		$allStds ->execute();
		$allStds ->fetch(PDO::FETCH_ASSOC);
		$allStdss = $allStds ->rowCount();

		$allLect =  $pdo->prepare("SELECT * FROM lecturernm");
		$allLect ->execute();
		$allLect ->fetch(PDO::FETCH_ASSOC);
		$allLects = $allLect ->rowCount();


		$allProg = $pdo->prepare("SELECT * FROM programmes");
		$allProg ->execute();
		$allProg ->fetch(PDO::FETCH_ASSOC);
		$allProgs = $allProg ->rowCount();


		$allDept = $pdo->prepare("SELECT * FROM departments");
		$allDept ->execute();
		$allDept ->fetch(PDO::FETCH_ASSOC);
		$allDepts = $allDept ->rowCount();

		$allSchl = $pdo->prepare("SELECT * FROM schools");
		$allSchl ->execute();
		$allSchl ->fetch(PDO::FETCH_ASSOC);
		$allSchls = $allSchl ->rowCount();
		
		$theCout_array = array("stds"=>$allStdss,"lect"=>$allLects,"prog"=>$allProgs,"dept"=>$allDepts,"schl"=>$allSchls);
		return $theCout_array;

}
 
						 
function insertAssignment($pdo, $tableName, $prgid, $coursid, $lectid, $title, $assign, $session, $sem)
{
$qry = $pdo->prepare("INSERT INTO `$tableName` (`prog_id`, `course_id`, `lect_id`, `title`, `assign`, `session`, `semester`)VALUES(?, ?, ?, ?, ?, ?, ?)");
$qry->execute([$prgid, $coursid, $lectid, $title, $assign, $session, $sem]);
return $qry;
}

function insertAssignSubmit($pdo, $tableName, $assign_id, $prgid, $coursid, $std_id, $assign, $session)
{
$qry = $pdo->prepare("INSERT INTO `$tableName` (`assign_id`, `prog_id`, `course_id`, `std_id`, `assign`, `session`)VALUES(?, ?, ?, ?, ?, ?)");
$qry->execute([$assign_id, $prgid, $coursid, $std_id, $assign, $session]);
return $qry;
}
 
 
// use this function to sellect records with one field like id or so..
function selectQueryById($pdo, $tableName, $fieldName, $field)
{
	$qry = $pdo->prepare("SELECT * FROM `$tableName` WHERE `$fieldName` = ?");
	$qry->execute([$field]);
	//$rows = $qry->fetch(PDO::FETCH_ASSOC);
	
	return $qry;
}

function selectDistintQuery($pdo, $tableName, $distField, $fieldName, $field)
{
	$qry = $pdo->prepare("SELECT DISTINCT $distField FROM `$tableName` WHERE `$fieldName` = ?");
	$qry->execute([$field]);
	//$rows = $qry->fetch(PDO::FETCH_ASSOC);
	return $qry;
	//return $qry;
}


function selectDistintQueryBy3Fields($pdo, $tableName, $distField, $fieldName1, $field1, $fieldName2, $field2, $fieldName3, $field3)
{
	$qry = $pdo->prepare("SELECT DISTINCT $distField FROM `$tableName` WHERE `$fieldName1` = ? && `$fieldName2` = ? && `$fieldName3` = ?");
	$qry->execute([$field1, $field2, $field3]);
	//$rows = $qry->fetch(PDO::FETCH_ASSOC);
	return $qry;
	//return $qry;
}

function selectDistintQueryBy2Fields($pdo, $tableName, $distField, $fieldName1, $field1, $fieldName2, $field2)
{
	$qry = $pdo->prepare("SELECT DISTINCT $distField FROM `$tableName` WHERE `$fieldName1` = ? && `$fieldName2` = ?");
	$qry->execute([$field1, $field2]);
	//$rows = $qry->fetch(PDO::FETCH_ASSOC);
	return $qry;
	//return $qry;
}


// use this function to sellect records with two field like id or so..
function selectQueryBy2Fields($pdo, $tableName, $fieldName1, $field1, $fieldName2, $field2)
{
	$qry = $pdo->prepare("SELECT * FROM `$tableName` WHERE `$fieldName1` = ? && `$fieldName2` = ?");
	$qry->execute([$field1, $field2]);
	//$rows = $qry->fetch(PDO::FETCH_ASSOC);
	
	return $qry;
}

function whereInslectStudent($pdo, $dep_id)
{
	$qry = $pdo->prepare("
							SELECT * FROM `studentsnm` 
							WHERE `prog_id` 
							IN 
							(
								SELECT `prog_id` FROM `programmes` 
								WHERE dept_id =?
							)
						");
	$qry->execute([$dep_id]);
	//$rows = $qry->fetch(PDO::FETCH_ASSOC);
	
	return $qry;

}

function whereInslectCourse($pdo, $dep_id)
{
	$qry = $pdo->prepare("
							SELECT * FROM `course` 
							WHERE `prog_id` 
							IN 
							(
								SELECT `prog_id` FROM `programmes` 
								WHERE dept_id =?
							)
						");
	$qry->execute([$dep_id]);
	//$rows = $qry->fetch(PDO::FETCH_ASSOC);
	
	return $qry;

}
function whereInslectLecturer($pdo, $dep_id)
{
	$qry = $pdo->prepare("
							SELECT * FROM `lecturernm` 
							WHERE 
							 dept_id =?
						");
	$qry->execute([$dep_id]);
	//$rows = $qry->fetch(PDO::FETCH_ASSOC);
	
	return $qry;

}


function updatePersonnelQueryById($pdo, $p_id, $pa_id, $arms_id)
{
	//$qry = $pdo->prepare("UPDATE `personnelxt` SET `returnDate` = now() WHERE `personnelxt`.`id` = ? && `arms_id` = ? && returnDate=NULL");
	$qry = $pdo->prepare("UPDATE `personnelxt` SET `returnDate` = CURRENT_TIMESTAMP WHERE `personnelxt`.`id` = ?");
	//$qry->execute([date("Y-m-d h:m:s"), $pa_id, $arms_id]);	
	$qry->execute([$pa_id]);	
	
	if($qry->rowCount()!=0)
	{
	//update
		$stmt = $pdo->prepare("SELECT * FROM `personnelxt` WHERE pid = ? && returnDate is NULL"); 
		$stmt->execute([$p_id]); 
		$stmt->fetch(PDO::FETCH_ASSOC);
		if($stmt->rowCount() == 0)
		{
		$uqry = $pdo->prepare("UPDATE `personnel` SET `has_rifle` = '0' WHERE `personnel`.`id` = ?");
		$uqry->execute([$p_id]);
		}
		$uaqry = $pdo->prepare("UPDATE `arms` SET `available` = '1' WHERE `arms`.`id` = ?");
		$uaqry->execute([$arms_id]);
	}
}

function logaccessComein($pdo, $username)
{
		
	$stmt = $pdo->prepare("SELECT * FROM `login` WHERE username = ?"); 
	$stmt->execute([$username]); 
	return $stmt;
}


function dashboardRecord($pdo)
{
	//All Arms
	$qry = $pdo->prepare("SELECT * FROM `arms`");
	$qry->execute();
	$qry->fetch(PDO::FETCH_ASSOC);
	$armsCount = $qry->rowCount();
	//All personnel
	$pqry = $pdo->prepare("SELECT * FROM `personnel`");
	$pqry->execute();
	$pqry->fetch(PDO::FETCH_ASSOC);
	$personnelCount = $pqry->rowCount();
	//arms maintenance Record
	$nmqry = $pdo->prepare("SELECT * FROM `arms` WHERE nmDate LIKE ?");
	$nmqry->execute([date("Y-m-d")]);
	$nmqry->fetch(PDO::FETCH_ASSOC);
	$arms_maint=$nmqry->rowCount();
	//arms expirery record
	$expdate = date('Y-m-d');
	$expqry = $pdo->prepare("SELECT * FROM `arms` WHERE expiryDate LIKE '%$expdate%'");
	$expqry->execute();
	$expqry->fetch(PDO::FETCH_ASSOC);
	$exparms=$expqry->rowCount();
	//arms out of Store
	$osqry = $pdo->prepare("SELECT * FROM `arms` WHERE available = ?");
	$osqry->execute([0]);
	$osqry->fetch(PDO::FETCH_ASSOC);
	$arms_outofstore=$osqry->rowCount();
	
	$theArray = array("tarms"=>$armsCount, "tperssonel"=>$personnelCount, 
						"tmaintain"=>$arms_maint, "texparms"=>$exparms, "tarmsos"=>$arms_outofstore);
	return $theArray;
	
}



function getCollegeSchoolProgrammeByDeptId($pdo, $dept_id)
{
$dptqry = $pdo->prepare("SELECT * FROM `departments` WHERE dept_id=?");// get school_id
$dptqry ->execute([$dept_id]);
$drows = $dptqry ->fetch(PDO::FETCH_ASSOC);
$dptrows =$dptqry ->rowCount();

$pgqry = $pdo->prepare("SELECT * FROM `programmes` WHERE dept_id=?"); // fetch programme details
$pgqry ->execute([$dept_id]);
$pgqry ->fetch(PDO::FETCH_ASSOC);
$pgrows =$pgqry ->rowCount();

$schqry = $pdo->prepare("SELECT * FROM `schools` WHERE schl_id=?"); // get college using the schl_id fetched from dept
$schqry ->execute([$drows["schl_id"]]);
$srows = $schqry ->fetch(PDO::FETCH_ASSOC);
$schrows=$schqry ->rowCount();

$colqry = $pdo->prepare("SELECT * FROM `colleges` WHERE college_id =?"); //get college details using the college id fetched from school 
$colqry ->execute([$srows["college_id"]]);
$colqry ->fetch(PDO::FETCH_ASSOC);
$colrows=$colqry ->rowCount();

$theArray = array("tdept"=>$dptqry, "tprog"=>$pgqry,"tschl"=>$schqry,"tcol"=>$colqry,
				  "ndept"=>$dptrows, "nprog"=>$pgrows,"nschl"=>$schrows,"ncol"=>$colrows);
return $theArray;

//inclde student ghere 
}


function updateQuery($pdo, $tableName, $fieldToUpdate, $clauseField, $updateValue, $clauseValue)
{
	$uaqry = $pdo->prepare("UPDATE `$tableName` SET `$fieldToUpdate` = ? WHERE `$clauseField` = ?");
	$uaqry->execute([$updateValue, $clauseValue]);
	return  $uaqry;
}
function encryptor($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    //pls set your unique hashing key
    $secret_key = 'muni';
    $secret_iv = 'muni123';

    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    //do the encyption given text/string/number
    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
    	//decrypt the given text/string/number
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}


?>