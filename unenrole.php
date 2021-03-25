<?php 
require_once 'config.php' ;

mysqli_select_db($con,"onlineclass") ;   

if(isset($_POST['phis'])){
    $history_post=$_POST['phis'];
    $_SESSION['phis']=$history_post;
}



  
  // header("Location: index.php");



?>