<?php  
require 'config/config.php';

include("includes/classes/User.php");
include("includes/classes/Post.php");
include("includes/classes/Message.php");
include("includes/classes/Notification.php");
if(isset($_GET['id'])){
	$_SESSION['stored']=$_GET['id'];
}
$msg_by_code=$_SESSION['stored'];

if (isset($_SESSION['username'])) {
	$userLoggedIn =  $_SESSION['username'];
	$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
	$user = mysqli_fetch_array($user_details_query);
	$user_obj = new User($con, $userLoggedIn);
	
				$edit_str='';
				
				$userLoggedIn = $user_obj->getUsername();
				$query=mysqli_query($con,"select created_by from classes where class_code='$msg_by_code'");
				$row=mysqli_fetch_array($query);
				$msg=$row['created_by'];
				$userc = strip_tags($msg); //Remove html tags
		$userc = str_replace(' ', '', $userc); //remove spaces
				$Uquery=mysqli_query($con,"select username,id from users where username='$userLoggedIn'");
				$row1=mysqli_fetch_array($Uquery);
				$msg_UNAME=$row1['id'];
				$userl = strip_tags($msg_UNAME); //Remove html tags
		$userl = str_replace(' ', '', $userl); //remove spaces
		if($userl == $userc){
			$edit_class= "<a href='settings.php'>
			<i class='fa fa-cog fa-lg'></i>
		</a>";
	}
	else{
		$edit_class='';
	}
}
// else {
// 	header("Location: register.php");
// }

?>

<html>
<head>
<style>
/* Paste this css to your style sheet file or under head tag */
/* This only works with JavaScript, 
if it's not present, don't show loader */
.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url(images/loader-64x/Preloader_2.gif) center no-repeat #fff;
}
</style>
	<title>Welcome to Online Classroom</title>

	<!-- Javascript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<!-- <script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/bootbox.min.js"></script> -->
	<script src="assets/js/bootbox.min.js"></script>
	<script src="assets/js/demo.js"></script>
	<script src="assets/js/jquery.jcrop.js"></script>
	<script src="assets/js/jcrop_bits.js"></script>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script> -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>

<link href='file-upload-with-preview.min.css' rel=stylesheet>
<script src="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.js"></script>
<script>
	//paste this code under head tag or in a seperate js file.
	// Wait for window load
	$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
	});
</script>

	<!-- CSS -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<!-- <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css"> -->
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/jquery.Jcrop.css" type="text/css" />
</head>
<body>
<!-- <div class="se-pre-con"></div> -->

	<div class="top_bar"> 
	<nav class="container-fluid navs">
		<div class="logo" style="     padding-left: 20px;
    /* margin-bottom: 0px; */
    bottom: 20px;
    position: relative;">
			<a href="../index.php"><img src='assets/images/icons/LOGO1.png' style='height:60px;'alt='logo'></a>
		</div>


		
		
			<?php
				//Unread messages 
				$messages = new Message($con, $userLoggedIn);
				$num_messages = $messages->getUnreadNumber();

				//Unread notifications 
				$notifications = new Notification($con, $userLoggedIn);
				$num_notifications = $notifications->getUnreadNumber();

				//Unread notifications 
				
				$num_requests = $user_obj->getNumberOfFriendRequests();
			?>


		<ul id="menu-list" style="padding-bottom:10px">
		<li>
			<a href="index.php?id=<?php echo $msg_by_code?>">
					<!-- <i class="fa fa-home fa-lg"></i> -->
					Home
				</a>
		</li>
		<li>
		<a href="classwork.php">
				Classwork
			</a>
			
		</li>
		<li>
		
			<a href="requests.php">
				<!-- <i class="fa fa-users fa-lg"></i> -->Classmates
				
			</a>
		</li>
		
		</ul>
		<div class="nav-chat float-right" style="    display: flex;
			/* align-items: center; */
			justify-content: space-around;
			width: 7%;">
			<a href="javascript:void(0);" onclick="getDropdownData('<?php echo $userLoggedIn; ?>', 'message')">
			<i class="fa fa-comment" aria-hidden="true"></i>
				<?php
				if($num_messages > 0)
				 echo '<span class="notification_badge" id="unread_message">' . $num_messages . '</span>';
				?>
			</a>
			
			<a href="javascript:void(0);" onclick="getDropdownData('<?php echo $userLoggedIn; ?>', 'notification')">
				<i class="fa fa-bell fa-lg"></i>
				<?php
				if($num_notifications > 0)
				 echo '<span class="notification_badge" id="unread_notification">' . $num_notifications . '</span>';
				?>
			</a>
			<?php
			
			echo $edit_class;
			?>
			<?php $fimage=$_SESSION['picture']  ;
			$fname=$_SESSION['given_name'];
			?>

		</div>
		
		<img src="img/menu.png" class="menu-icon" onclick="togglemenu()">
		<div class="search" style='z-index:1;bottom: 10px;
    position: relative;'>	
		<form class="form-inline my-2 my-lg-0 ml-auto" action="search.php" method="GET" name="search_form">
        <input class="form-control" type="search" onkeyup="getLiveSearchUsers(this.value, '<?php echo $userLoggedIn; ?>')" name="q" placeholder="Search..." autocomplete="off" id="search_text_input" aria-label="Search">
        <button class="btn btn-outline-white btn-md my-2 my-sm-0 ml-3" type="submit">Search</button>
		
		
			
      </form>
	  <div class="search_results">
			</div>

			<div class="search_results_footer_empty">
			</div>
			</div>
	
		<!-- <div class="search">

			<form action="search.php" method="GET" name="search_form">
				

						<div class="searchbar">
				<input type="text" class="search_input" onkeyup="getLiveSearchUsers(this.value, '<?php
				//  echo $userLoggedIn;
				  ?>')" name="q" placeholder="Search..." autocomplete="off" id="search_text_input">
				<a href="#" class="search_icon"><i class="fas fa-search"></i></a>
				</div>

			</form>

			



		</div> -->
		</nav>
		<div class="dropdown_data_window" style="height:0px; border:none;"></div>
		<input type="hidden" id="dropdown_data_type" value="">
		

		
		


	</div>
	
	<script>
           var menu_list= document.getElementById("menu-list");
           menu_list.style.maxHeight="0px";
           function togglemenu(){
              if(menu_list.style.maxHeight=='0px'){
                  menu_list.style.maxHeight= '130px';
              } 
              else{
                  menu_list.style.maxHeight='0px';
              }
           }
       </script>

	<script>
	var userLoggedIn = '<?php echo $userLoggedIn; ?>';

	$(document).ready(function() {

		$('.dropdown_data_window').scroll(function() {
			var inner_height = $('.dropdown_data_window').innerHeight(); //Div containing data
			var scroll_top = $('.dropdown_data_window').scrollTop();
			var page = $('.dropdown_data_window').find('.nextPageDropdownData').val();
			var noMoreData = $('.dropdown_data_window').find('.noMoreDropdownData').val();

			if ((scroll_top + inner_height >= $('.dropdown_data_window')[0].scrollHeight) && noMoreData == 'false') {

				var pageName; //Holds name of page to send ajax request to
				var type = $('#dropdown_data_type').val();


				if(type == 'notification')
					pageName = "ajax_load_notifications.php";
				else if(type == 'message')
					pageName = "ajax_load_messages.php"


				var ajaxReq = $.ajax({
					url: "includes/handlers/" + pageName,
					type: "POST",
					data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
					cache:false,

					success: function(response) {
						$('.dropdown_data_window').find('.nextPageDropdownData').remove(); //Removes current .nextpage 
						$('.dropdown_data_window').find('.noMoreDropdownData').remove(); //Removes current .nextpage 


						$('.dropdown_data_window').append(response);
					}
				});

			} //End if 

			return false;

		}); //End (window).scroll(function())


	});

	</script>


	<div class="wrapper">