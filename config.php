<?php 
//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';


	$client = new Google\Client();
	$client->setAuthConfig('client_secret.json');

	$client->setRedirectUri('http://localhost/project/join.php');
	$client->addScope('email');

	$client->addScope('profile');
	// $client->setScopes(array('https://www.googleapis.com/auth/drive'));
	$client->setApprovalPrompt('force');
	$client->setAccessType('offline'); 
	
	  // $accessToken = $client->fetchAccessTokenWithAuthCode($_GET["code"]);
  
		//    $_SESSION['access_token'] = $accessToken;
		


		
	   
		// $client->setIncludeGrantedScopes(true); 
	
// $client->setClientId('52858973416-namp8r8pulq7m5v9gmhupudsste70egr.apps.googleusercontent.com');

// 		//Set the OAuth 2.0 Client Secret key
// 		$client->setClientSecret('OqVgrxZgnYLjrWlJUzPnJ4Sq');

		//Set the OAuth 2.0 Redirect URI
		

		//
		// $client->addScope(Google_Service_Drive::DRIVE);

		
		




//start session on web page
session_start();

$timezone = date_default_timezone_set("Europe/London");

$con = mysqli_connect("localhost", "root", "", "onlineclass"); //Connection variable

if(mysqli_connect_errno()) 
{
	echo "Failed to connect: " . mysqli_connect_errno();
}
?>
