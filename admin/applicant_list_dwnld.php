<?php 
include('../data/db.php');
$time = date("h:i:sa");
if(isset($_REQUEST["csvss"]))
{
	$name = "Applicat Lis as @".$time.".csv";
	header("Content-Type: application/vnd.msexcel");
	header("Expires: 0");
	header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
	header("Content-disposition: attachment; filename=$name");

  $app = $pdo->prepare("SELECT * FROM `applicant` WHERE `year` = ? AND `adm_status` = ? AND `application_fee`= ?");
  $app->execute([$school_app_year, 'No','paid']);
	$found_data = $app->fetch();
	echo "Applicationno,Name,\n";
	$mn = 0; 
	while($stdrows = $app->fetch(PDO::FETCH_ASSOC))
	{
			echo  $stdrows["application_no"].",".$stdrows["names"].",\n";
	
	}	
}
?>