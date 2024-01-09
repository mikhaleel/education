<?php
include("../data/db.php");
if (!isset($_SESSION))
{
  session_start();
}?>
<?php 
$admstatus = $_GET["admstatus"];
$level = $_GET["level"];
$session = $_GET["session"];
if($admstatus == 'No' AND $level =='all' AND $session == 'all'){
    $cours = $pdo->prepare("SELECT * FROM `applicant`");
    $cours->execute([]);
    $title = "Report of all Courses";
}else
if($admstatus == 'No' AND $level =='all' AND $session != 'all'){
    $cours = $pdo->prepare("SELECT * FROM `applicant` WHERE `year`=?");
    $cours->execute([$session]);
    $title = "Report for all Courses in Semester: ".$session;
}
else
if($admstatus == 'No' AND $level !='all' AND $session == 'all'){
    $cours = $pdo->prepare("SELECT * FROM `applicant` WHERE `level`=?");
    $cours->execute([$level]);
    $title = "Report for all Semester of ".$admstatus. "for ". $level;
}else
if($admstatus != 'No' AND $level =='all' AND $session == 'all'){
    $cours = $pdo->prepare("SELECT * FROM `applicant` WHERE `adm_status`=?");
    $cours->execute([$admstatus]);
    $title = "Report for all Semester of ".$admstatus. "for ". $level;
}
else
if($admstatus == 'No' AND $level !='all' AND $session != 'all'){
    $cours = $pdo->prepare("SELECT * FROM `applicant` WHERE `level`=?  AND  `year`=?");
    $cours->execute([$level,$session]);
    $title = "Report for all Level of ".$admstatus. "for Semester". $session;
}
if($admstatus != 'No' AND $level !='all' AND $session == 'all'){
    $cours = $pdo->prepare("SELECT * FROM `applicant` WHERE `adm_status`=? AND `level`=?");
    $cours->execute([$admstatus,$level,$session]);
    $title = "Report for all Semester of ".$admstatus. " - Semester". $session;
}else
if($admstatus != 'No' AND $level =='all' AND $session != 'all'){
    $cours = $pdo->prepare("SELECT * FROM `applicant` WHERE `adm_status`=? AND `year`=?");
    $cours->execute([$admstatus,$session]);
    $title = "Report for all Level of ".$admstatus. "for Semester". $session;
}else
if($admstatus != 'No' AND $level !='all' AND $session != 'all'){
    $cours = $pdo->prepare("SELECT * FROM `applicant` WHERE `adm_status`=? AND `level`=?  AND `year`=?");
    $cours->execute([$admstatus,$level,$session]);
    $title = "ADMISSION REPORT<br>LEVEL: ".$level. "<br>SESSION: ". $session;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>STUDENTS REPORT</title>
	<style>
		table {
			border-collapse: collapse;
			width: 100%;
			margin-top: 20px;
			margin-bottom: 20px;
			font-family: Arial, sans-serif;
			font-size: 14px;
			color: #333;
			border: 1px solid #ccc;
		}

		table th, table td {
			padding: 8px;
			text-align: justify;
			border: 1px solid #ccc;
		}

		table th {
			background-color: #f2f2f2;
			color: #333;
			font-weight: bold;
		}

		table tr:nth-child(even) {
			background-color: #f2f2f2;
		}

		table tr:hover {
			background-color: #ddd;
		}
	</style>
</head>
<body>
    <!-- 
//$_GET[""] SELECT `id`, `adm_status`, `title`, `code`, `unit`, `level`, `semester`, `sessions`, `staff_id`, `option`, `remstatus`, `college_id`, `school_id`, `dept_id`, `semesters`, `insert-date`, `update-date` FROM `students` WHERE 1 -->
	<h4><?php echo strtoupper($title);?></h4>
	<table>
		<tr>
			<th>#</th>
			<th>Programme </th>
			<th>AppNo</th>
			<th>Names</th>
			<th>Gender </th>
			<th>DOB </th>
			<th>Level</th>
			<th>Email</th>
			<th>PhoneNo </th>
			<th>Admitted </th>

		</tr>
        <?php  $sn=0;
        while($courses = $cours->fetch()){ $sn++;?>
		<tr>
			<td><?php echo $sn;?></td>
			<td><?php echo $courses["programme"];?></td>
			<td><?php echo $courses["application_no"];?></td>
			<td><?php echo $courses["names"];?></td>
			<td><?php echo $courses["gender"];?></td>
			<td><?php echo $courses["dob"];?></td>
			<td><?php echo $courses["level"];?></td>
			<td><?php echo $courses["email"];?></td>
			<td><?php echo $courses["gsm"];?></td>
			<td><?php echo $courses["adm_status"];?></td>
		</tr>
        <?php }?>
	</table>
</body>
</html>
