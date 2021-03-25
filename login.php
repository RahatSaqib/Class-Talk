<?php
session_start();

$myConnection= mysqli_connect("localhost","root","");
mysqli_select_db($myConnection,"onlineclass") ;   
?>
<?php




	$email 			= $_POST['email'];
	// $phonenumber	= $_POST['phonenumber'];
    $password 		= $_POST['password'];
    

		$sql = "select * from users where email='$email' && password= '$password'";
        $stmtinsert = mysqli_query($myConnection,$sql);
        $result= mysqli_num_rows($stmtinsert);
		
		if($result==1){
            $_SESSION['email']=$email;
            header('location:join.php');
            
		}else{
			echo 'There were erros while saving the data.';
		}
?>