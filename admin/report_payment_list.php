<?php
include("../data/db.php");
if (!isset($_SESSION))
{
  session_start();
}?>
<?php 
$programme = $_GET["programme"];
$level = $_GET["level"];
$semester = $_GET["semester"];
$type = $_GET["type"];
$session = $_GET["session"];
$status = $_GET["status"];
if($programme == 'all' AND $level =='all' AND $type =='all'){
    $cours = $pdo->prepare("SELECT * FROM `stu_payloader` WHERE `session`=? AND `semester`=? AND `status`=?");
    $cours->execute([$session, $semester, $status]);
    $title = "Report of all Payment";
}else
if($programme == 'all' AND $level =='all' AND $type != 'all'){
    $cours = $pdo->prepare("SELECT * FROM `stu_payloader` WHERE `semester`=? AND `session`=? AND`type`=? AND `status`=?");
    $cours->execute([$semester,$session, $type,$status]);
    $title = "Report for all Courses in Semester: ".$semester;
}
else
if($programme == 'all' AND $level !='all' AND $type == 'all'){
    $cours = $pdo->prepare("SELECT * FROM `stu_payloader` WHERE `level`=? AND `semester`=? AND `session`=?  AND `status`=?");
    $cours->execute([$level,$semester,$session,$status]);
    $title = "Report for all Semester of ".$programme. "for ". $level;
}else
if($programme != 'all' AND $level =='all' AND $type == 'all'){
    $cours = $pdo->prepare("SELECT * FROM `stu_payloader` WHERE `programme`=? AND `semester`=? AND `session`=? AND `status`=?");
    $cours->execute([$programme,$semester,$session,$status]);
    $title = "Report for all Semester of ".$programme. "for ". $level;
}
else
if($programme == 'all' AND $level !='all' AND $type != 'all'){
    $cours = $pdo->prepare("SELECT * FROM `stu_payloader` WHERE `level`=? AND `type`=? AND `semester`=? AND `session`=? AND `status`=?");
    $cours->execute([$level,$type,$semester,$session,$status]);
    $title = "Report for all Level of ".$programme. "for Semester". $semester;
}
if($programme != 'all' AND $level !='all' AND $type == 'all'){
    $cours = $pdo->prepare("SELECT * FROM `stu_payloader` WHERE `programme`=? AND `level`=? AND `semester`=? AND `session`=? AND `status`=?");
    $cours->execute([$programme,$level,$semester,$session,$status]);
    $title = "Report for all Semester of ".$programme. " - Semester". $semester;
}else
if($programme != 'all' AND $level =='all' AND $type != 'all'){
    $cours = $pdo->prepare("SELECT * FROM `stu_payloader` WHERE `programme`=? AND  `type`=? AND `semester`=? AND `session`=? AND `status`=?");
    $cours->execute([$programme,$type,$semester,$session,$status]);
    $title = "Report for all Level of ".$programme. "for Semester". $semester;
}else
if($programme != 'all' AND $level !='all' AND $type != 'all'){
    $cours = $pdo->prepare("SELECT * FROM `stu_payloader` WHERE `programme`=? AND `level`=? AND `semester`=?,`session`=? AND `status`=?");
    $cours->execute([$programme,$level,$type,$semester,$session,$status]);
    $title = "COURSE REPORT<br>LEVEL: ".$level."<br>PROGRAMME: ".$programme. "<br>SEMESTER: ". $semester;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>PAYMENT REPORT</title>
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
//$_GET[""] SELECT `id`, `programme`, `title`, `code`, `unit`, `level`, `semester`, `sessions`, `staff_id`, `option`, `remstatus`, `college_id`, `school_id`, `dept_id`, `semesters`, `insert-date`, `update-date` FROM `course` WHERE 1 -->
	<h4><?php echo strtoupper($title);?></h4>
	<table>
		<tr>
			<th>#</th>
			<th>matno</th>
			<th>Names </th>
			<th>Pay Type </th>
			<th>Level </th>
			<th>Amount </th>
			<th>Semester </th>
			<th>Session </th>
			<th>Status </th>
			<th>TranxID </th>

		</tr>
        <?php  $sn=0;
        while($courses = $cours->fetch()){ $sn++;?>
		<tr>
			<td><?php echo $sn;?></td>
			<td><?php echo $courses["matno"];?></td>
			<td><?php echo $courses["pay_type"];?></td>
			<td><?php echo $courses["type"];?></td>
			<td><?php echo $courses["level"];?></td>
			<td><?php echo $courses["amount"];?></td>
			<td><?php echo $courses["semester"];?></td>
			<td><?php echo $courses["session"];?></td>
			<td><?php echo $courses["status"];?></td>
			<td><?php echo $courses["txid"];?></td>
		</tr>
        <?php }?>
	</table>
</body>
</html>
