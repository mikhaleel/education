<?php
include("../data/db.php");
if (!isset($_SESSION))
{
  session_start();
}?>
<?php 
$programme = $_GET["programme"];
$level = $_GET["level"];
$session = $_GET["session"];
if($programme == 'all' AND $level =='all' AND $session == 'all'){
    $cours = $pdo->prepare("SELECT * FROM `students`");
    $cours->execute([]);
    $title = "Report of all Courses";
}else
if($programme == 'all' AND $level =='all' AND $session != 'all'){
    $cours = $pdo->prepare("SELECT * FROM `students` WHERE `session`=?");
    $cours->execute([$semester,$session]);
    $title = "Report for all Courses in Semester: ".$session;
}
else
if($programme == 'all' AND $level !='all' AND $session == 'all'){
    $cours = $pdo->prepare("SELECT * FROM `students` WHERE `level`=?");
    $cours->execute([$level,$session]);
    $title = "Report for all Semester of ".$programme. "for ". $level;
}else
if($programme != 'all' AND $level =='all' AND $session == 'all'){
    $cours = $pdo->prepare("SELECT * FROM `students` WHERE `programme`=?");
    $cours->execute([$programme,$session]);
    $title = "Report for all Semester of ".$programme. "for ". $level;
}
else
if($programme == 'all' AND $level !='all' AND $session != 'all'){
    $cours = $pdo->prepare("SELECT * FROM `students` WHERE `level`=?  AND  `session`=?");
    $cours->execute([$level,$session]);
    $title = "Report for all Level of ".$programme. "for Semester". $session;
}
if($programme != 'all' AND $level !='all' AND $session == 'all'){
    $cours = $pdo->prepare("SELECT * FROM `students` WHERE `programme`=? AND `level`=?");
    $cours->execute([$programme,$level,$session]);
    $title = "Report for all Semester of ".$programme. " - Semester". $session;
}else
if($programme != 'all' AND $level =='all' AND $session != 'all'){
    $cours = $pdo->prepare("SELECT * FROM `students` WHERE `programme`=? AND `session`=?");
    $cours->execute([$programme,$session]);
    $title = "Report for all Level of ".$programme. "for Semester". $session;
}else
if($programme != 'all' AND $level !='all' AND $semester != 'all'){
    $cours = $pdo->prepare("SELECT * FROM `students` WHERE `programme`=? AND `level`=?  AND `session`=?");
    $cours->execute([$programme,$level,$session]);
    $title = "COURSE REPORT<br>LEVEL: ".$level."<br>programme: ".$programme. "<br>SESSION: ". $session;
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
//$_GET[""] SELECT `id`, `programme`, `title`, `code`, `unit`, `level`, `semester`, `sessions`, `staff_id`, `option`, `remstatus`, `college_id`, `school_id`, `dept_id`, `semesters`, `insert-date`, `update-date` FROM `students` WHERE 1 -->
	<h4><?php echo strtoupper($title);?></h4>
	<table>
		<tr>
			<th>#</th>
			<th>programme</th>
			<th>Level </th>
			<th>Amount (ind)</th>
			<th>Amount (non)</th>
			<th>Session </th>
			<th>Semester </th>

		</tr>
        <?php  $sn=0;
        while($courses = $cours->fetch()){ $sn++;?>
		<tr>
			<td><?php echo $sn;?></td>
			<td><?php echo $courses["programme"];?></td>
			<td><?php echo $courses["level"];?></td>
			<td><?php echo $courses["amount_indigene"];?></td>
			<td><?php echo $courses["amount_nonindigene"];?></td>
			<td><?php echo $courses["session"];?></td>
			<td><?php echo $courses["semester"];?></td>
		</tr>
        <?php }?>
	</table>
</body>
</html>
