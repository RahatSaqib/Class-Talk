<?php
require_once 'config.php' ;
if(isset($_SESSION['access_token']))
{
 //Create a URL to obtain user authorization
 header('location:join.php');
 exit();


}

//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received

$login_button = $client->createAuthUrl();

?>
<!DOCTYPE html>
<html>
<head>
	<title>User Registration | PHP</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="reg_box">

<div>
	<?php
	
	?>	
</div>

<div>
		<div align="center" style="height:100px;">
		<a href="index.php">
		<img src="img/logo.png" alt="logo" style="height:100px;"></img></a>
		</div>
	
		<div class="cont">
			
		<form action="registration.php" method="post">
			<div class="row">
				<div class="col-sm-6">
					<h1>Registration</h1>
					<p>Fill up the form with correct values.</p>
					<hr class="mb-3">
					<label for="firstname"><b>First Name</b></label>
					<input class="form-control" id="firstname" type="text" name="firstname" required>

					<label for="lastname"><b>Last Name</b></label>
					<input class="form-control" id="lastname"  type="text" name="lastname" required>

					<label for="email"><b>Email Address</b></label>
					<input class="form-control" id="email"  type="email" name="email" required>

					<label for="password"><b>Password</b></label>
					<input class="form-control" id="password"  type="password" name="password" required>
					<hr class="mb-3">
					<input class="btn btn-primary" type="submit" id="register1" name="create" value="Sign Up">
				
				</div>
			</div>
			</form>
			<input class="btn btn-primary" onClick="window.location= '<?php echo $login_button ?>'" type="submit" id="register" name="create" value="Sign Up with google">
		</div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
	$(function(){
		$('#register1').click(function(e){

			var valid = this.form.checkValidity();

			if(valid){


			var firstname 	= $('#firstname').val();
			var lastname	= $('#lastname').val();
			var email 		= $('#email').val();
			var phonenumber = $('#phonenumber').val();
			var password 	= $('#password').val();
			

				e.preventDefault();	

				$.ajax({
					type: 'POST',
					url: 'process.php',
					data: {firstname: firstname,lastname: lastname,email: email,phonenumber: phonenumber,password: password},
					success: function(data){
					Swal.fire({
								'title': 'Successful',
								'text': data,
								'type': 'success'
								})
							
					},
					error: function(data){
						Swal.fire({
								'title': 'Errors',
								'text': 'There were errors while saving the data.',
								'type': 'error'
								})
					}
				});

				
			}else{
				
			}

			



		});		

		
	});
	
</script>
</body>
</html>