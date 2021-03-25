<?php

//logout.php

require_once 'config.php' ;
unset($_SESSION['access_code']);
//Reset OAuth access token
header('location:index.php');
$google_client->revokeToken();

//Destroy entire session data.
session_destroy();

//redirect page to index.php

exit();

?>