<?php 
session_start();
session_destroy();
 echo '<script>setTimeout(function(){location.href="app/"},1000)</script>';
?>