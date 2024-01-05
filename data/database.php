<?php
include('config.php');

$conn = mysqli_connect ($dbHost, $dbUser, $dbPass, $dbName) or die ('MySQL connect failed. ' . mysqli_connect_errno());
//mysqli_select_db($dbName) or die('Cannot select database. ' . mysql_error());
//$mysql= mysqli("localhost", "root", "123456","aims");
//if ($mysql->connect_errno) {
//	    die('<div class="alert alert-danger">MySQL connect failed. ' . $mysql->connect_errno.'</div>');
//}
function dbQuery($sql)
{
	$result = mysqli_query($conn, $sql) or die(mysqli_error());
	return $result;
}

function dbAffectedRows()
{
	global $dbConn;
	return mysql_affected_rows($conn);
}

function dbFetchArray($result, $resultType = MYSQL_NUM) {
	return mysql_fetch_array($result, $resultType);
}

function dbFetchAssoc($result)
{
	return mysqli_fetch_assoc($result);
	//return mysql_fetch_assoc($result);
}

function dbFetchRow($result) 
{
	return mysqli_fetch_row($result);
}

function dbFreeResult($result)
{
	return mysql_free_result($result);
}

function dbNumRows($result)
{
	return mysqli_num_rows($result);
}

function dbSelect($dbName)
{
	return mysql_select_db($dbName);
}

function dbInsertId()
{
	return mysql_insert_id();
}
?>