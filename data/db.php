<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
//session_start(); 
if(!isset($_SESSION)){  session_start(); }
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
    $db_host = "localhost";
    //$db_user = "eyaimas_root";
    $db_user = "root";
    //$db_pass = "#samiaye@12";
    $db_pass = "";
    $db_name = "eyaimas_dbase";
    
    $dsn = "mysql:host=$db_host;dbname=$db_name";
     try {
        $options = array(
        PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
    );
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
    $pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
    }catch (PDOException $pe) {
        die($pe->getMessage());
    }

    date_default_timezone_set("Africa/Lagos");

    $post = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    $get = filter_var_array($_GET, FILTER_SANITIZE_STRING);
    $request = (filter_var_array($_REQUEST, FILTER_SANITIZE_STRING));

function cleanstring($string){
  $string = htmlentities($string, ENT_COMPAT, 'utf-8');
  $string =filter_var($string,FILTER_SANITIZE_STRING );
  return (trim($string));
}

$error = '<div class="alert alert-danger"><a href="javascript:void" class="close" data-dismiss="alert">&times;</a>';
$success = '<div class="alert alert-success"><a href="javascript:void" class="close" data-dismiss="alert">&times;</a>';
$close = '</div>';
$refresh = '<script>setTimeout(function(){location.reload()}, 500)</script>';

$email_id = '';
    
$config = $pdo->prepare("SELECT * FROM `config`");
$config->execute();
$row_config= $config->fetch();

$_SESSION['session']=$row_config['sessions'];

$_SESSION['semester']=$row_config['semester'];
$site_title = $row_config['school'];

$school_names =$row_config['school'];
$school_address =$row_config['add'];
$school_abb =$row_config['abb'];
$school_gsm =$row_config['contact'];
$school_email =$row_config['email'];
$school_website =$row_config['website'];
$school_status =$row_config['status'];
$school_results =$row_config['results'];
$school_activesession =$row_config['sessions'];
$school_activesemester =$row_config['semester'];
$school_payment =$row_config['payment'];
$school_course_registration =$row_config['course_registration'];
$school_accommodation =$row_config['accomodation'];
$school_late_registration =$row_config['late_registration'];
$school_admission_batch =$row_config['admission_batch'];
$school_app_year = $row_config['application_year'];
if ($school_status <> "active") {
//echo'<script>window.location="maintenance";</script>';
die("<h1>UNDER MAINTENANCE! Kindly check back shortly... </h1>");
//break;
}
function encryptor($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    //pls set your unique hashing key
    $secret_key = date('dd MM yyyy');
    $secret_iv = date('dd MM yyyy');
    
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    //do the encyption given text/string/number
    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
    	//decrypt the given text/string/number
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}

$res_config = $pdo->query("SELECT * FROM `config_res`");
$res_conf = $res_config->fetch();

$conf_semester = $res_conf['semester'];
$conf_session = $res_conf['sessions'];
//$semester_arr = array(1=>"First Semester", 2=>"Second Semester", 3=>"Third Semester");
$semester_arr = array(1=>"First Semester", 2=>"Second Semester",3=>"Third Semester");?>