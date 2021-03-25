<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Select for login or signup</title>
    <link rel="stylesheet" href="homecss/login.css">

    <!-- <style media="screen">
      *{
        margin:0;
        padding:0;
      }

    </style> -->
  </head>
  <body>
<section class="total-bdy">
      <header>
          <a href="index.html" class="logo"><h2>PUASH</h2> Proper Use of Antibiotic & Safe Health</a>
          <!-- <a href="#" class="contact">Contact</a> -->
      </header>

      <?php

session_start();
					include('include/config.php');
					include('PUASH/doctor/Post.php');
					include('PUASH/doctor/User.php');

					$data_query = mysqli_query($con, "SELECT * FROM posts WHERE deleted='no' ORDER BY id DESC");

					if(mysqli_num_rows($data_query) > 0) {

						$str = "";
						$num_iterations = 0; //Number of results checked (not necasserily posted)
						$count = 1;

						while($row = mysqli_fetch_array($data_query)) {
					$id = $row['id'];
					$title=$row['title'];
					$body = $row['description'];
					$added_by = $row['author'];
					$date_time = $row['upload_date'];
					$imagePath = $row['image'];

				
					
						$user_to_obj = new User($con, $row['author']);
						// $user_to_name = $user_to_obj->getFirstAndLastName();
						$user_to = "to <a href='" . $row['author'] ."'>  </a>";
					


						


						$user_details_query = mysqli_query($con, "SELECT doctorname, docEmail, specilization FROM doctors WHERE doctorname='$added_by'");
						$user_row = mysqli_fetch_array($user_details_query);
						$first_name = $user_row['doctorname'];
						$last_name = $user_row['specilization'];
						$profile_pic = $user_row['docEmail'];


						?>
					
						<?php



						//Timeframe
						$date_time_now = date("Y-m-d H:i:s");
						$start_date = new DateTime($date_time); //Time of post
						$end_date = new DateTime($date_time_now); //Current time
						$interval = $start_date->diff($end_date); //Difference between dates 
						if($interval->y >= 1) {
							if($interval->y == 1)
								$time_message = $interval->y . " year ago"; //1 year ago
							else 
								$time_message = $interval->y . " years ago"; //1+ year ago
						}
						else if ($interval->m >= 1) {
							if($interval->d == 0) {
								$days = " ago";
							}
							else if($interval->d == 1) {
								$days = $interval->d . " day ago";
							}
							else {
								$days = $interval->d . " days ago";
							}


							if($interval->m == 1) {
								$time_message = $interval->m . " month ". $days;
							}
							else {
								$time_message = $interval->m . " months ". $days;
							}

						}
						else if($interval->d >= 1) {
							if($interval->d == 1) {
								$time_message = "Yesterday";
							}
							else {
								$time_message = $interval->d . " days ago";
							}
						}
						else if($interval->h >= 1) {
							if($interval->h == 1) {
								$time_message = $interval->h . " hour ago";
							}
							else {
								$time_message = $interval->h . " hours ago";
							}
						}
						else if($interval->i >= 1) {
							if($interval->i == 1) {
								$time_message = $interval->i . " minute ago";
							}
							else {
								$time_message = $interval->i . " minutes ago";
							}
						}
						else {
							if($interval->s < 30) {
								$time_message = "Just now";
							}
							else {
								$time_message = $interval->s . " seconds ago";
							}
						}

						if($imagePath != "") {
							$imageDiv = "<div class='postedImage'>
											<img src='PUASH/doctor/$imagePath'>
										</div>";
						}
						else {
							$imageDiv = "";
						}
						?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Medical Tips </title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="../../vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../../vendor/fontawesome/css/font-awesome.min.css">
		<link href="../../vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="../../vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="../../vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link href="../../vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		<link href="../../vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="../../vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="../../vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="../../assets/css/styles.css">
		<link rel="stylesheet" href="../../assets/css/plugins.css">
		<link rel="stylesheet" href="../../include/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" href="../../include/DataTables/Buttons-1.5.6/css/buttons.bootstrap4.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="include/sidebar-menu.css">


		<style media="screen">
			div#table_filter label::before{
					content:"🔍 ";
					font-size: 18px;
			}
		</style>
		</head>
	<body>

							<div class="posts_area">
							
							<div class='status_post' onClick='javascript:toggle$id()'>
									<div class='post_profile_pic'>
										<?php echo $profile_pic; ?>
									</div>

									<div class='posted_by' style='color:#ACACAC;'>
										<a href='$added_by'><?php echo $first_name; echo ' ';echo $last_name ;?> </a>  &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $time_message;?>
										
									</div>
									<div id='post_body'>
										<?php echo $body; ?>
										<br>
										<?php echo $imageDiv; ?>
										<br>
										<br>
									</div>

								</div>
							
								<hr>
							
							</div>
					
						


					<?php 
						} //End while loop
					}



					?>


					





    </section>



<!-- footer -->
    <div class="copyrightText">
      <p>
        Copyright © 2020 By PUASH Team. All Rights Reserved.
      </p>
    </div>

    <script type="text/javascript">
      // For Sticky Nav Bar
      window.addEventListener("scroll", function(){
          var header = document.querySelector("header");
          header.classList.toggle("sticky", window.scrollY > 0);
        })

    </script>

  </body>
</html>
