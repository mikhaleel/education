<?php 
include('../data/db.php');
$time = date("h:i:sa");

	
if(isset($_REQUEST["csvss"]))
{
	$name = encryptor('decrypt',$_REQUEST["code"]).$time.".csv";
	header("Content-Type: application/vnd.msexcel");
	header("Expires: 0");
	header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
	header("Content-disposition: attachment; filename=$name");

    
	 $programme = encryptor('decrypt',$_REQUEST['programme']);
	$code =  encryptor('decrypt',$_REQUEST['code']);
	$level =  encryptor('decrypt',$_REQUEST["level"]);

	$coqr = $pdo->query("SELECT * FROM `stu_course_reg` WHERE `programme` = '".$programme."' &&  `semester` = '".$_SESSION['rsemester']."' && `session` = '".$_SESSION['rsession']."' && `coursecode` = '".$code."' AND `level` = '".$level."' GROUP BY `matno` ORDER BY `matno`");
	
	$found_course = $coqr->fetch();
	echo "MatricNo,Score,\n";
	$mn = 0; 
	while($stdrows = $coqr->fetch(PDO::FETCH_ASSOC))
	{
        $results = $pdo->query("SELECT * FROM `results` WHERE `code` = '".$code."' AND `matno` = '".$stdrows["matno"]."'");
        $scores = $results->fetch();
		if($results->rowcount() == 0)
		{
			echo  $stdrows["matno"].","."0".",\n";
		}
		else
		{
			echo  $stdrows["matno"].",".$scores['score'].",\n";
		}
		
	}
	
}
// elseif(isset($_REQUEST["cocsvss"]))
// {
// 	$name = encryptor('decrypt',$_REQUEST["ccode"])."_co.csv";
// 	header("Content-Type: application/vnd.msexcel");
// 	header("Expires: 0");
// 	header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
// 	header("Content-disposition: attachment; filename=$name");
	
	
// 	$ssn = encryptor('decrypt',$_REQUEST['session']);
// 	$session = explode("/", TRIM($ssn));
// 	$nsession = ($session[0] - 1)."/".$session[0]; 
	
// 	echo "MatricNo,Score,\n";
// 	$stdt_qry = $pdo->prepare("SELECT * FROM `stu_course_reg` WHERE `programme` = ? && `code` = ? && `session` = ? AND `semester` =? AND `level`=? ORDER BY `matno` ASC");
// 	$stdt_qry->execute([
// 	encryptor('decrypt',$_REQUEST["programme"]), 
// 	encryptor('decrypt',$_REQUEST["code"]),
// 	"F"]);
	
	
// 	while($stdrows = $stdt_qry->fetch(PDO::FETCH_ASSOC))
// 	{
// 		echo  $stdrows["matric_no"].",0,\n";
// 	}
// }
?>