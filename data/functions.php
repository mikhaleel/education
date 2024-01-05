<?php 
//include 'config.php';
//require_once 'database.php';
require_once('uniques.php');

if(!isset($_SESSION)){  session_start(); }


function staffname($username,$pdo){
	$name='';
		$sql = "SELECT *
			FROM `staff` 
			WHERE `username` ='$username'";
	$result = $pdo->query($sql) ;
		$row =$result->fetch();
		$name = ucwords($row['names']);
		return $name;
}
function studentname($username,$pdo){
	$name='';
		$sql = "SELECT *
			FROM `students` 
			WHERE `matno` ='$username'";
	$result = $pdo->query($sql) ;
		$row =$result->fetch();
		$name = ucwords($row['names']);
		return $name;
}

function getcoursetitle($code,$pdo){
	$name='';
		$sql = "SELECT *
			FROM `course` 
			WHERE `code` ='$code'";
	$result = $pdo->query($sql) ;
		$row =$result->fetch();
		$name = ucwords($row['title']);
		return $name;
}


function passportstaff($username,$pdo){
	$path = "passports/";
	$pic='passports/user.png';	
	
		$sql = "SELECT *
			FROM `staff` 
		WHERE  `username` ='$username'";
	$result = $pdo->query($sql) ;
		$row =$result->fetch();
	
		if (file_exists($row['image'])) {
			$pic = $row['image'];
	}else{
		
		}
	$_SESSION['PASSPORT']=$pic;
	return $pic;

	
}
function staffdetail($username,$pdo){
	$students='';	
	$sql = "SELECT *
			FROM `teacher` 
			WHERE `username` = '$username' or loginid='$username'";
		$result = $pdo->query($sql);
		$row = $result->fetch();
		if (file_exists('../passports/'.$row['passport'])) {
			$pic = $row['passport'];
	}else{
			if($row['sex']=='Male'){
			$pic='../passports/user.png';
		}else{  $pic='../passports/staff_female.png';}
			
		}
		$students = $row['firstname'].' '.$row['lastname'].'-'.$row['username'].'-'.$pic.'-'.$row['position'];
	//}
	$_SESSION['PASSPORT']=$pic;
	return $students;
}
function staffsubject($subj,$user, $pdo){
	$names='';	
	$sql = "SELECT  `studentsubjects`.`class`, `studentsubjects`.`subject`, `teacher_subjects`.`staff`, `teacher`.`firstname`, `teacher`.`lastname`, `teacher`.`passport`, `teacher`.`username` FROM `studentsubjects` inner join `teacher_subjects` on `studentsubjects`.`class`=`teacher_subjects`.`class` and `studentsubjects`.`subject` =`teacher_subjects`.`subject` inner join `teacher` on `teacher_subjects`.`staff`=`teacher`.`username` WHERE `studentsubjects`.`std_id`='".$user."' and `studentsubjects`.`subject`='".$subj."'";
		$result = $pdo->query($sql);
		$row = $result->fetch();
		if (file_exists($row['passport'])) {
			$pic = $row['passport'];
	}else{
			$pic='passports/user.png';
			
		}
		$names = $row['firstname'].' '.$row['lastname'].'-'.$row['username'].'-'.$pic;
	//}
	return $names;
}

function staffchatcounter($username,$pdo){
	$name='';
		$sql = "SELECT *
			FROM `bae_chat` 
			 where `std_id`='".$_SESSION['BAE']."' and `staff`='".$username."' and `poster`='0' and `status`='unread'";
	$result = $pdo->query($sql) ;
		$row =$result->num_rows;
		//$name = ucwords($row['firstname']. ' ' .$row['lastname']);
		return $row;
}

function passportstudent($username,$pdo){
	$path = "passports/";
	$pic='student.png';	
	
		$sql = "SELECT *
			FROM `students` 
			WHERE `matno` = '$username'";
	$result = $pdo->query($sql) ;
		$row =$result->fetch();
	
		if (file_exists('../passports/'.$row['images'])) {
			$pic = $row['images'];
	}else{
			$pic='student.png';
			
		}
	
	return '../passports/'.$pic;

	
}
function getcollegename($id,$pdo){
	$name='';
		$sql = "SELECT *
			FROM `colleges` 
			WHERE `id` ='$id'";
	$result = $pdo->query($sql) ;
		$row =$result->fetch();
		$name = ucwords($row['college']);
		return $name;
}
function getcenter($id,$pdo){
	$name='';
		$sql = "SELECT *
			FROM `studycenters` 
			WHERE `id` ='$id'";
	$result = $pdo->query($sql) ;
		$row =$result->fetch();
		$name = ucwords($row['centers']);
		return $name;
}

function getschoolname($id,$pdo){
	$name='';
		$sql = "SELECT *
			FROM `schools` 
			WHERE `id` ='$id'";
	$result = $pdo->query($sql) ;
		$row =$result->fetch();
		$name = ucwords(@$row['school']);
		return $name;
}

function getdeptname($id,$pdo){
	$name='';
		$sql = "SELECT *
			FROM `departments` 
			WHERE `dept_id` ='$id'";
	$result = $pdo->query($sql) ;
		$row =$result->fetch();
		$name = ucwords(@$row['names']);
		return $name;
}
function getfeesstatus($id,$level, $semester, $pdo){
	$name='';
		$sql = "SELECT `id`, `matno`, `type`, `session`, `semester`, `level`, `pay_type`, `amount`, `status` FROM `payment_status` WHERE matno = '".$id."' and `type`='School Fees' and `semester`='".$semester."' and `level`='".$level."' and `status`='unpaid' GROUP BY `matno`, `type`, `session`, `semester`, `level`, `pay_type`, `amount`, `status` order by created_at desc";
	$result = $pdo->query($sql);
	$tot = $result->rowCount();
		return $tot;
}

function getstatus($id){
	
	if($id==0){
		$status='Inactive';
	}
	
	if($id==1){
		$status='Active';
	}
	return $status;
}
function getsemester($id){
	
	if($id==1){
		$sem='First';
	}
	
	elseif($id==2){
		$sem='Second';
	}
	else{
		$sem=$id;
	}
	return $sem;
}
?>

<?php

function numberTowords($num)
{ 
$ones = array( 
1 => "one", 
2 => "two", 
3 => "three", 
4 => "four", 
5 => "five", 
6 => "six", 
7 => "seven", 
8 => "eight", 
9 => "nine", 
10 => "ten", 
11 => "eleven", 
12 => "twelve", 
13 => "thirteen", 
14 => "fourteen", 
15 => "fifteen", 
16 => "sixteen", 
17 => "seventeen", 
18 => "eighteen", 
19 => "nineteen" 
); 
$tens = array( 
1 => "ten",
2 => "twenty", 
3 => "thirty", 
4 => "forty", 
5 => "fifty", 
6 => "sixty", 
7 => "seventy", 
8 => "eighty", 
9 => "ninety" 
); 
$hundreds = array( 
"hundred", 
"thousand", 
"million", 
"billion", 
"trillion", 
"quadrillion" 
); //limit t quadrillion 
$num = number_format($num,2,".",","); 
$num_arr = explode(".",$num); 
$wholenum = $num_arr[0]; 
$decnum = $num_arr[1]; 
$whole_arr = array_reverse(explode(",",$wholenum)); 
krsort($whole_arr); 
$rettxt = ""; 
foreach($whole_arr as $key => $i){ 
if($i < 20){ 
$rettxt .= $ones[$i]; 
}elseif($i < 100){ 
$rettxt .= $tens[substr($i,0,1)]; 
$rettxt .= " ".$ones[substr($i,1,1)]; 
}else{ 
$rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
$rettxt .= " ".$tens[substr($i,1,1)]; 
$rettxt .= " ".$ones[substr($i,2,1)]; 
} 
if($key > 0){ 
$rettxt .= " ".$hundreds[$key]." "; 
} 
} 
if($decnum > 0){ 
$rettxt .= " and "; 
if($decnum < 20){ 
$rettxt .= $ones[$decnum]; 
}elseif($decnum < 100){ 
$rettxt .= $tens[substr($decnum,0,1)]; 
$rettxt .= " ".$ones[substr($decnum,1,1)]; 
} 
} 
return $rettxt; 
} 
function refno($session,$semester,$level,$types,$college)
{
	$pre='NSPZFT';
	$type='';
	$sess=explode("/",$session);
	$lvl=str_replace(" ","",$level);
	if($types=='Application'){
       $type='APP';
	}elseif($types=='Screening'){
		$type='SCR';
	}elseif($types=='Accommodation'){
		$type='ACC';
	}elseif($types=='Acceptance'){
		$type='APT';
	}elseif($types=='School Fees'){
		$type='SCH';
	}elseif($types=='Putme'){
		$type='PUT';
	}elseif($types=='Certificate'){
		$type='CER';
	}elseif($types=='Statement'){
		$type='STA';
	}elseif($types=='Transcript'){
		$type='TRA';
	}
	return $pre.$type.$lvl.$sess[1].$semester.$college.get_rand_numbers(10);
}
?>