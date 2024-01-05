<?php
require_once("db.php");
if (!isset($_SESSION))
{
  session_start();
}
if( isset($_POST["offer"]))
{ 
    $appid = $_POST["appid"];
    $actn = $_POST["act"];

    $updtapp = $pdo->prepare("UPDATE `applicant` SET `adm_status`= ? WHERE `id`=?");
    $updtapp->execute([$act, $appid]);
    if($updtapp)
    {
        echo '<div class="alert alert-success outline alert-dismissible fade show" role="alert"><i data-feather="thumbs-up"></i><b>Wait,</b> loading dashboard....</div><script>setTimeout(function(){location.href="dashboard.php"},1000)</script>';

    }
}