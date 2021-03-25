<?php 
include("includes/header.php");
include("includes/form_handlers/settings_handler.php");
?>
<div class="container">
<div class="main_column column col-md-11" style="z-index:inherit;    padding: 30px;">

	
	



	<?php
	$user_data_query = mysqli_query($con, "SELECT title, class_name,class_code,section  FROM classes WHERE class_code='$msg_by_code'");
	$row = mysqli_fetch_array($user_data_query);

	$first_name = $row['title'];
	$last_name = $row['class_name'];
	$code = $row['class_code'];
	$sec = $row['section'];

	?>

	<form action="settings.php" method="POST">
		<div class="form-row container">
		<div class="col-md-12">
		<h4 style='    color: #00b980;'>Class Details</h4>
		<hr>
<h4>Class Code : <?php echo $code;?></h4></div>
			<div class="form-group col-md-12">
			<label for="title">Title: </label> 
			<input type="text" name="title" id="title" class="form-control" value="<?php echo $first_name; ?>" id="settings_input"></div>
			<div class="form-group col-md-12">
			<label for="cls_name">Classname: </label>  <input type="text"class="form-control" id="cls_name"name="class_name" value="<?php echo $last_name; ?>" id="settings_input"><br>
			</div>
			<div class="form-group col-md-12">
			<label for="cls_name">Section: </label>  <input type="text"class="form-control" id="sec"name="sec" value="<?php echo $sec; ?>" id="settings_input"><br>
			</div>
		</div>
		
		<!-- -->

		<?php echo $message; ?>

		<input type="submit" name="update_details" id="save_details" value="Update Details" class="info settings_submit float-right " ><br>
	</form>

	




</div>
</div>
</div>
</body>
</html>