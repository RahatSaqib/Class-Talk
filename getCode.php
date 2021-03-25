<?php

session_start();
include('config.php');
$get_Code=$_POST['getCode'];
$_SESSION['store']=$get_Code;

?>