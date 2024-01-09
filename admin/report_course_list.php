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
if($programme == 'all' AND $level =='all' AND $semester == 'all'){
    $cours = $pdo->prepare("SELECT * FROM `course` ");
    $cours->execute();
    $title = "Report of all Courses";
}else
if($programme == 'all' AND $level =='all' AND $semester != 'all'){
    $cours = $pdo->prepare("SELECT * FROM `course` WHERE `semester`=?");
    $cours->execute([$semester]);
    $title = "Report for all Courses in Semester: ".$semester;
}
else
if($programme == 'all' AND $level !='all' AND $semester == 'all'){
    $cours = $pdo->prepare("SELECT * FROM `course` WHERE `programme`=? AND `level`=? AND `semester`=?");
    $cours->execute([$level]);
    $title = "Report for all Semester of ".$programme. "for ". $level;
}else
if($programme != 'all' AND $level =='all' AND $semester == 'all'){
    $cours = $pdo->prepare("SELECT * FROM `course` WHERE `programme`=?");
    $cours->execute([$programme]);
    $title = "Report for all Semester of ".$programme. "for ". $level;
}
else
if($programme == 'all' AND $level !='all' AND $semester != 'all'){
    $cours = $pdo->prepare("SELECT * FROM `course` WHERE `level`=? AND `semester`=?");
    $cours->execute([$level,$semester]);
    $title = "Report for all Level of ".$programme. "for Semester". $semester;
}
if($programme != 'all' AND $level !='all' AND $semester == 'all'){
    $cours = $pdo->prepare("SELECT * FROM `course` WHERE `programme`=? AND `level`=? ");
    $cours->execute([$programme,$level]);
    $title = "Report for all Semester of ".$programme. " - Semester". $semester;
}else
if($programme != 'all' AND $level =='all' AND $semester != 'all'){
    $cours = $pdo->prepare("SELECT * FROM `course` WHERE `programme`=? AND  `semester`=?");
    $cours->execute([$programme,$semester]);
    $title = "Report for all Level of ".$programme. "for Semester". $semester;
}else
if($programme != 'all' AND $level !='all' AND $semester != 'all'){
    $cours = $pdo->prepare("SELECT * FROM `course` WHERE `programme`=? AND `level`=? AND `semester`=?");
    $cours->execute([$programme,$level,$semester]);
    $title = "COURSE REPORT<br>LEVEL: ".$level."<br>PROGRAMME: ".$programme. "<br>SEMESTER: ". $semester;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>COURSE REPORT</title>
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
			<th>Programme</th>
			<th>Title </th>
			<th>Code </th>
			<th>Unit </th>
			<th>Level </th>
			<th>Semester </th>

		</tr>
        <?php  $sn=0;
        while($courses = $cours->fetch()){ $sn++;?>
		<tr>
			<td><?php echo $sn;?></td>
			<td><?php echo $courses["programme"];?></td>
			<td><?php echo $courses["title"];?></td>
			<td><?php echo $courses["code"];?></td>
			<td><?php echo $courses["unit"];?></td>
			<td><?php echo $courses["level"];?></td>
			<td><?php echo $courses["semester"];?></td>
		</tr>
        <?php }?>
	</table>
</body>
</html>
