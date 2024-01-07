<?php 
if (!isset($_SESSION)) 
{
  session_start();
}
require_once("../connections.php");
require_once("../functionQuery.php");


$sid = $_REQUEST["sid"];
$matno = $_REQUEST["matno"];


for($rw = 0; $rw < count($_REQUEST["matno"]); $rw++)
{
    $id = $sid[$rw];
    $scores = $_REQUEST["score"];
    $score = $scores[$rw];
    include("scoregrade.php");
    $point = $n[$grade1];
    // insert results 

    $prst = $pdo->prepare("SELECT * FROM `results` WHERE  `matno` = ? && `code` = ?");
    $prst->execute([$matno[$rw], $_REQUEST["code"]]);         
    if($prst->rowCount() > 0)
    {
        //echo '<div class="alert alert-info">Update Exist!</div>';
        echo '';
    }
    else
    {
       // $mqry = $pdo->prepare("UPDATE `results` SET `score` = ?, `grade` = ?,`points` = ?, `gp` = (`unit`*`points`)	WHERE `matno` = ? && `code`  = ? && `unit` = ? && `semester`  = ? && `session`  = ?"); 
        // $mqry->execute([$scores[$rw], $grade1, $point, $matno[$rw], $_REQUEST["code"], $_REQUEST["unit"], $_REQUEST["semester"],$_REQUEST["session"]]);  
        $mqry = $pdo->prepare("UPDATE `results` SET `score` = ?, `grade` = ?,`points` = ?, `gp` = (`unit`*`points`)  WHERE `id` = ?"); 
        $mqry->execute([$scores[$rw], $grade1, $point, $id]);  
        if($mqry) 
        {   
			echo '<div class="alert alert-info">'.$_REQUEST["code"].' score edited to '. $scores[$rw].' for '. $matno[$rw].'</div>,';	
           
        }
       
    }
        
}

echo '<div class="alert alert-success">Successfull, Please wait...</div>,';
echo '<script>setTimeout(function(){location.href="editscore_by_course.php?programme='.$_REQUEST["programme"].'&year='.$_REQUEST["year"].'&Submitf=Submit&semester='.$_REQUEST["semester"].'&session='.$_REQUEST["session"].'"},10000)</script>';
    

?>