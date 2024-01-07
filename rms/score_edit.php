<?php include('../data/db.php');
$scores = $_POST['scores'];
$sid = $_POST['sid'];
foreach($sid as $sn => $id)
{
    $score = $scores[$sn];
    include("scoregrade.php");
    $point = $n[$grade1];
    #if($score == 'AE'){ $cunit = 0;}
    $updt =$pdo->query("UPDATE `results` SET `score` = '$score', `grade`='$grade1', `points`='$point', `gp`= (`points`*`unit`) WHERE  `id`='$id'");
}
	if($updt)
    { 
        $update_cunit = $pdo->query("UPDATE `results` set `cunit` = `unit` where `score` != 'AE' OR `grade` != 'AE'");
        $update_cunit1 = $pdo->query("UPDATE `results` set `cunit` = 0 where `score` = 'AE' OR `grade` = 'AE';");
        echo '<div class="alert alert-success">Updated</div>';
    }
?>