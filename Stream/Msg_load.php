<?php

require 'config/config.php';
include("includes/classes/Message.php");
include("includes/classes/User.php");
$userLoggedIn =  $_SESSION['username'];
$user_obj = new User($con, $userLoggedIn);
$userLoggedIn = $user_obj->getUsername();
$message_obj = new Message($con, $userLoggedIn);
$msg_by_code=$_SESSION['stored'];
$user_to=$_SESSION['user'];
if($_SESSION['types']=='group'){
    echo $message_obj->getGroupMessages($user_to,$msg_by_code);
}
else{
    echo $message_obj->getMessages($user_to,$msg_by_code);
}

?>