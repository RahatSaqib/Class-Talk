
<?php
require_once 'config.php' ;


//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
if(isset($_GET["code"]))
{
 //It will Attempt to exchange a code for an valid authentication token.
 $token = $client->fetchAccessTokenWithAuthCode($_GET["code"]);
 $_SESSION["code"] =$_GET["code"];


 //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
 
}


//This is for check user has login into system by using Google account, if User not login into system then it will execute if block of code and make code for display Login link for Login using Google account.
if(!isset($_SESSION['access_code']))
{
 //Create a URL to obtain user authorization
 $login_button = '<a href="'.$client->createAuthUrl().'"><img src="sign-in-with-google.png" /></a>';
 header("Location: homepage.php");
}

else if(isset($_SESSION['access_code']))
{
 //Create a URL to obtain user authorization
 header('location:join.php');
 exit();


}

?>
