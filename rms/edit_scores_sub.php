<?php 
if (!isset($_SESSION)) 
{
  session_start();
}
require_once("../data/db.php");
$sid = $_REQUEST["sid"];
$mat_no = $_REQUEST["matno"];
// for($rw = 0; $rw < count($_REQUEST["matno"]); $rw++)
foreach($mat_no as $rw=> $matnos)
{
    $id = $sid[$rw];
    $scores = $_REQUEST["score"];
    $score = $scores[$rw];
    include("scoregrade.php");
    $point = $n[$grade1];
    // insert results 
    // $mat_no = $matno[$rw];
    $matno = encryptor('decrypt',$matnos);
    $prst = $pdo->prepare("SELECT * FROM `results` WHERE  `matno` = ? && `code` = ?");
    $prst->execute([$matno, $_REQUEST["code"]]);         
    if($prst->rowCount() == 0)
    {
        //echo '<div class="alert alert-info">Update Exist!</div>';
        echo '';
    }
    else
    {
       $mqry = $pdo->prepare("UPDATE `results` SET `score` = ?, `grade` = ?,`points` = ?, `gp` = (`unit`*`points`)  WHERE `id` = ?");
        $mqry->execute([$scores[$rw], $grade1, $point, $id]);
    }
}
if($mqry) 
{   
    $update_cunit = $pdo->query("UPDATE `results` set `cunit` = `unit` where `score` != 'AE' OR `grade` != 'AE'");
    $update_cunit1 = $pdo->query("UPDATE `results` set `cunit` = 0 where `score` = 'AE' OR `grade` = 'AE';");
    echo '<div class="alert alert-success">Successfull, Please wait...</div>';
}
?>