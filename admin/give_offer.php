<?php
require_once("db.php");
if (!isset($_SESSION))
{
  session_start();
}