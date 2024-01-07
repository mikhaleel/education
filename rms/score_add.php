<?php include('../data/db.php');
$scores = $_POST['scores'];
$matric = $_POST['matno'];
$code = $_POST['code'];
$programme = $_POST['programme'];
$level = $_POST['level'];
$unit = $_POST['unit'];
$title = $_POST['title'];
$session = $conf_session;
$semester = $conf_semester;
foreach($matric as $sn => $matno)
{
    $score = $scores[$sn];
    include("scoregrade.php");
    $point = $n[$grade1]; 
    $gp = $point*$unit;
    
    if($score == 'AE')
    {
        $cunit = 0;
    }
    else
    {
        $cunit = $unit;
    }
    $ifexst = $pdo->query("SELECT * FROM `results` WHERE `matno` = '$matno' AND `code` = '$code'"); 
    $fs = $ifexst->fetch();
    if($ifexst->rowCount() > 0)
    {
        if($fs["session"] != $conf_session)
        {
            $scoretype = 1;
        }
        else
        {
            $scoretype = 0;
        }
        $qry = $pdo->query("UPDATE `results` SET `title` = '$title',`unit`='$unit', `cunit`='$cunit',`score` = '$score', `grade` = '$grade1', `points` = '$point', `gp` = '$gp', `scoretype` = '$scoretype', `co_session` = '".$conf_session."' WHERE `matno`='$matno' AND `code` = '$code'");
        $msg = "Records Updated";
    }
    else
    {
         $qry =$pdo->query("INSERT INTO `results`(`matno`, `code`, `unit`, `cunit`, `title`, `score`, `grade`, `points`, `gp`, `programme`,`level`, `semester`, `session`) VALUES('$matno', '$code', '$unit', '$cunit', '$title', '$score', '$grade1', '$point', '$gp', '$programme', '$level', '$semester', '$session')");
        $msg = "Records Inserted";
    }
    if($qry)
    { 
        $update_cunit = $pdo->query("UPDATE `results` set `cunit` = `unit` where `score` != 'AE' OR `grade` != 'AE'");
        $update_cunit1 = $pdo->query("UPDATE `results` set `cunit` = 0 where `score` = 'AE' OR `grade` = 'AE';");
        //echo '<div class="alert alert-success">Updated</div>';
    }
}
	if($qry){ echo '<div class="alert alert-success">'.$msg.'</div>';}
?>