<?php 
include("includes/header.php");
$msg_by_code=$_SESSION['stored'];
$sqli=mysqli_query($con,"select * from classes where class_code='$msg_by_code'");
$TEACHER=mysqli_fetch_array($sqli);
$name=$TEACHER['created_by'];
$sqli2=mysqli_query($con,"select * from users where id='$name'");
$list=mysqli_fetch_array($sqli2);

$message_obj = new Message($con, $userLoggedIn);
$message_obj2 = new User($con, $userLoggedIn);

if(isset($_GET['u']))
	$user_to = $_GET['u'];
else {
	$user_to = $message_obj->getMostRecentUser();
	if($user_to == false)
		$user_to = 'new';
}



if($user_to != "new")
	$user_to_obj = new User($con, $user_to);

if(isset($_POST['post_message'])) {

	if(isset($_POST['message_body'])) {
		$body = mysqli_real_escape_string($con, $_POST['message_body']);
		$date = date("Y-m-d H:i:s");
		$message_obj->sendMessage($user_to, $body, $date,$msg_by_code);
	}

}
if(isset($_REQUEST["submit"])){
	
	$count_query=mysqli_query($con,"select * from groups");
	$count=mysqli_num_rows($count_query);
	$grp_name=$_POST['grp_name'];
	if($count==0){
		$grp_id="Group1";
	}
	else{
		$count=$count+1;
		$grp_id="Group$count";
	}
	if($grp_name==null){
		echo "<script>Please Give A Group Name</script>";
	}
	else{
		mysqli_query($con,"insert into groups values('','$grp_id','','$name','$grp_name','$msg_by_code')");
		mysqli_query($con,"insert into group_messages values('','$grp_id','$name','$msg_by_code')");

	$chk=$_REQUEST['check'];
    foreach($chk as $uID){
		mysqli_query($con,"insert into group_messages values('','$grp_id','$uID','$msg_by_code')");
		header("Location:groupselection.php");
		
	}
	}


	

}

 ?>
 <div class="col-md-3">
 <?php
 $user_data_query = mysqli_query($con, "SELECT title, class_name,class_code  FROM classes WHERE class_code='$msg_by_code'");
 $row = mysqli_fetch_array($user_data_query);

 $first_name = $row['title'];
 $last_name = $row['class_name'];
 $code = $row['class_code'];
 ?>
 
 <div class="user_details column">
		<a href="profile.php?profile_username=<?php echo $userLoggedIn?>">  <img src="<?php echo $user['profile_pic']; ?>"> </a>

		<div class="user_details_left_right">
			<a href="<?php echo $userLoggedIn; ?>">
			<?php 
			echo $row['title'];?><br>
			<?php
			echo $row['class_name'];


			 ?>
			</a>
			<br>
			
			<p name="code"><?php
				echo $_SESSION['stored'];
			
	 ?></p>
		</div>

	</div>
    <div class="user_details column" id="conversations">
			<h4>Conversations</h4>

			<div class="loaded_conversations">
				<?php echo $message_obj->getConvos(); ?>
			</div>
			<br>
			<a href="messages.php?u=new">New Message</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php
			
				echo $message_obj->getGroup($msg_by_code);
			
			?>

		</div>
		<div class="user_details column" id="group_messages">
			<h4>Group Messages</h4>

			<div class="loaded_conversations">
				<?php
							$userLoggedIn =$message_obj2->getUsername();
					$return_string = "";
					$convos = array();
					$msg_code=$_SESSION['stored'];
					$find=mysqli_query($con,"select * from users where username='$userLoggedIn'");
					$find_row=mysqli_fetch_array($find);
					$get_id=$find_row['id'];
					$find_id=mysqli_query($con,"select * from group_messages where userid='$get_id' AND class_code='$msg_by_code'");
					$num_rows=mysqli_num_rows($find_id);
					
					if($num_rows>0){
						while($find_id_row=mysqli_fetch_array($find_id)){
							$grp_id=$find_id_row['group_id'];
							$find_g=mysqli_query($con,"select * from groups where groupid='$grp_id'");
					$rowg=mysqli_fetch_array($find_g);
					$grp_name=$rowg['groupname'];
							$return_string .= "<a href='messages.php?u=$grp_id&type=group&name=$grp_name'> <div class='user_found_messages'>
											<img src='img/group.png' style='border-radius: 5px; margin-right: 5px;'>
											$grp_name
											<span class='timestamp_smaller' id='grey'> </span>
											<p id='grey' style='margin: 0;'></p>
											</div>
											</a>";
							echo $return_string;
						}
					}

				// $query = mysqli_query($con, "SELECT * FROM group_messages WHERE user_to='$userLoggedIn' OR user_from='$userLoggedIn' AND class_code='$msg_code' ORDER BY id DESC");

				// while($row = mysqli_fetch_array($query)) {
				// 	$user_to_push = ($row['user_to'] != $userLoggedIn) ? $row['user_to'] : $row['user_from'];

				// 	if(!in_array($user_to_push, $convos)) {
				// 		array_push($convos, $user_to_push);
				// 	}
				// }

				// foreach($convos as $username) {
				// 	$user_found_obj = new User($con, $username);
				// 	$msg_code=$_SESSION['stored'];
				// 	$latest_message_details = getLatestMessage($userLoggedIn, $username,$msg_code);
				// 	;
				// 	$dots = (strlen($latest_message_details[1]) >= 12) ? "..." : "";
				// 	$split = str_split($latest_message_details[1], 12);
				// 	$split = $split[0] . $dots; 

					
				// }

		 		?>
			</div>
 		</div>
    </div>

<div class="col-md-9">
<div class="main_column column" id="main_column">
<form action="" method="POST" class="group-form">
<label for="inputEmail4">Group Name</label>
                <input type="text" class="form-control" id="inputEmail4" name="grp_name" placeholder="">
                
		<table class="table">
		<tr>
		<th></th>
		<th>Students</th>
		<th></th>
		</tr>
		<?php  

	$query = mysqli_query($con, "SELECT * FROM enrolled_class where class_id='$msg_by_code'");
	if(mysqli_num_rows($query) == 0)
		echo "You have no classmates at this time!";
	else {

		while($row = mysqli_fetch_array($query)) {
			$personid=$row['PersonID'];
			$sql=mysqli_query($con,"select * from users where id='$personid'");
			$class=mysqli_fetch_array($sql);
			if($list['id']!=$class['id']){
				?>
				<tr>
				<td><img src="<?php echo $class['profile_pic']?>" style="height:50px;border-radius:50px"></td>
				<td><?php echo $class['first_name']?></td>
				<td><input type="checkbox" name="check[]" class="form-check-input" id="exampleCheck1" value="<?php echo $class['id']?>"></td>
				</tr>
				<?php
			}
		}
	}
				?>

		</tr>
		</table>
		<hr>
		<input type="submit" class="btn btn-primary float-right" name="submit" value="Create">
		</form>

		</div>

		<script>
			var div = document.getElementById("scroll_messages");
			div.scrollTop = div.scrollHeight;
		</script>

	</div></div>

	
   

	
