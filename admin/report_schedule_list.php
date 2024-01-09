<?php
include("../data/db.php");
if (!isset($_SESSION))
{
  session_start();
}?>
<?php 
$category = $_GET["category"];
$level = $_GET["level"];
$semester = $_GET["semester"];
$session = $_GET["session"];
if($category == 'all' AND $level =='all' AND $semester == 'all'){
    $cours = $pdo->prepare("SELECT * FROM `payment_schedule` WHERE `session`=?");
    $cours->execute([$session]);
    $title = "Report of all Courses";
}else
if($category == 'all' AND $level =='all' AND $semester != 'all'){
    $cours = $pdo->prepare("SELECT * FROM `payment_schedule` WHERE `semester`=? AND  `session`=?");
    $cours->execute([$semester,$session]);
    $title = "Report for all Courses in Semester: ".$semester;
}
else
if($category == 'all' AND $level !='all' AND $semester == 'all'){
    $cours = $pdo->prepare("SELECT * FROM `payment_schedule` WHERE  `level`=? AND `session`=?");
    $cours->execute([$level,$session]);
    $title = "Report for all Semester of ".$category. "for ". $level;
}else
if($category != 'all' AND $level =='all' AND $semester == 'all'){
    $cours = $pdo->prepare("SELECT * FROM `payment_schedule` WHERE `category`=? AND  `session`=?");
    $cours->execute([$category,$session]);
    $title = "Report for all Semester of ".$category. "for ". $level;
}
else
if($category == 'all' AND $level !='all' AND $semester != 'all'){
    $cours = $pdo->prepare("SELECT * FROM `payment_schedule` WHERE `level`=? AND `semester`=? AND  `session`=?");
    $cours->execute([$level,$semester,$session]);
    $title = "Report for all Level of ".$category. "for Semester". $semester;
}
if($category != 'all' AND $level !='all' AND $semester == 'all'){
    $cours = $pdo->prepare("SELECT * FROM `payment_schedule` WHERE `category`=? AND `level`=? AND `session`=?");
    $cours->execute([$category,$level,$session]);
    $title = "Report for all Semester of ".$category. " - Semester". $semester;
}else
if($category != 'all' AND $level =='all' AND $semester != 'all'){
    $cours = $pdo->prepare("SELECT * FROM `payment_schedule` WHERE `category`=? AND  `semester`=? AND `session`=?");
    $cours->execute([$category,$semester,$session]);
    $title = "Report for all Level of ".$category. "for Semester". $semester;
}else
if($category != 'all' AND $level !='all' AND $semester != 'all'){
    $cours = $pdo->prepare("SELECT * FROM `payment_schedule` WHERE `category`=? AND `level`=? AND `semester`=? AND `session`=?");
    $cours->execute([$category,$level,$semester,$session]);
    $title = "COURSE REPORT<br>LEVEL: ".$level."<br>category: ".$category. "<br>SEMESTER: ". $semester;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>PAYMENT SCHEDULE REPORT</title>
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
//$_GET[""] SELECT `id`, `category`, `title`, `code`, `unit`, `level`, `semester`, `sessions`, `staff_id`, `option`, `remstatus`, `college_id`, `school_id`, `dept_id`, `semesters`, `insert-date`, `update-date` FROM `payment_schedule` WHERE 1 -->
	<h4><?php echo strtoupper($title);?></h4>
	<table>
		<tr>
			<th>#</th>
			<th>Category</th>
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
			<td><?php echo $courses["category"];?></td>
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
