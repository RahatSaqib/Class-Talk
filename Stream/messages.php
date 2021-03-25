
 <body id="main_body">
 <?php 
include("includes/header.php");
$msg_by_code=$_SESSION['stored'];

$message_obj = new Message($con, $userLoggedIn);
$message_obj2 = new User($con, $userLoggedIn);
$typeof='';

if(isset($_GET['u'])){
	$user_to = $_GET['u'];
	if(isset($_GET['name'])){
		$user_name = $_GET['name'];
	}
	// if(isset($_GET['op'])){
	// 	$op = $_GET['op'];
	// 	$set_viewed_query = mysqli_query($con, "UPDATE messages SET viewed='yes' AND opened='yes' WHERE id='$op'");

	// }
	
	

	$_SESSION['user']=$user_to;
	$typeof='';
	$type='';
	$_SESSION['types']='';
	if(isset($_GET['type'])){
		$type='group';
		$typeof=$_GET['type'];
		$_SESSION['types']=$_GET['type'];
	}

}
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
		if(isset($_FILES['files']['name'])){
			for($i=0;$i<count($_FILES['files']['name']);$i++){
				$filename= $_FILES['files']['name'][$i];
				$targetDir = "assets/files/";
				$filename = basename($filename);
				$message_obj->sendMessage($user_to, $filename, $date,$msg_by_code,$type,'files');
				

			move_uploaded_file($_FILES['files']['tmp_name'][$i],$targetDir.$filename);
			}
		}
		$message_obj->sendMessage($user_to, $body, $date,$msg_by_code,$type,'');
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
			<div class="col-md-12">
			<a href="messages.php?u=new">New Message</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php
			
				echo $message_obj->getGroup($msg_by_code);
			
			?>
			</div>

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
		<?php  
		if($user_to != "new" & $typeof !='group'){
			echo "<h4>You and <a href='profile.php?profile_username=$user_to'>" . $user_to_obj->getFirstAndLastName() . "</a></h4><hr><br>";

			echo "<div class='loaded_messages' id='scroll_messages'>";
				echo $message_obj->getMessages($user_to,$msg_by_code);
			echo "</div>";
		}
		else if($typeof=='group'){

			$_SESSION['us_to']=$user_to;
				echo "<div class='' style='    display: flex;
				justify-content: space-between;
				padding: 10px;'>
				<h4>You and <a href='$user_to'>$user_name</a></h4>
				<a href='#exampleModal' data-toggle='modal' data-target='' data-whatever='hi'><i class='fa fa-users' aria-hidden='true'></i> Members</a>
				</div>";
			echo "<div class='loaded_messages' id='scroll_messages'>";
				echo $message_obj->getGroupMessages($user_to,$msg_by_code);
			echo "</div>";
		}
		else {
			echo "<h4>New Message</h4>";
		}
		
		?>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<?php
	
	
	?>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Group Members</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
			<?php
			$sqli=mysqli_query($con,"select * from group_messages where group_id='".$_SESSION['us_to']."'");
			while($mem=mysqli_fetch_array($sqli)){
				$name=$mem['userid'];
				$sqli2=mysqli_query($con,"select * from users where id='$name'");
				$list=mysqli_fetch_array($sqli2);

?>
<div class='search_result'>
	<div class='result_profile_pic'>
						<a href='profile.php?profile_username=<?php echo $list['username'] ?>'><img src='<?php echo $list['profile_pic'] ?>' style='height: 100px;border-radius:80px;'></a>
					</div>

						<a href='profile.php?profile_username=<?php echo $list['username'] ?>'> <?php echo $list['first_name'] ?> <?php echo $list['last_name'] ?>"
						
						</a>
						<br>
			</div>

<?php

			}
			?>
	
        </form>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div> -->
    </div>
  </div>
</div>
<script>$('#exampleModal').on('shown.bs.modal', function () {
   var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})</script>

		<div class="message_post">
			<form action="" method="POST" enctype="multipart/form-data">
				<?php
				if($user_to == "new") {
					echo "Select the friend you would like to message <br><br>";
					?> 
					To: <input type='text' onkeyup='getUsers(this.value, "<?php echo $userLoggedIn; ?>")' name='q' placeholder='Name' autocomplete='off' id='seach_text_input'>

					<?php
					echo "<div class='results'></div>";
				}
				else {
					?>
					<textarea name='message_body' id='message_textarea' placeholder='Write your message ...'></textarea>";
					<input type='submit' name='post_message' class='info' id='message_submit' value='Send'>";
					<div class="col-md-12">
					<div class='attach' style='    display: flex;
    align-items: center;
    justify-content: space-around;
    width: 15%;
    padding: 5px;
    border-radius: 30px;
    border: 1px solid #e0dada;
	cursor:pointer'onClick='togglemenu();' style=''>
					+  &nbsp;&nbsp;Attach Files</h6>
				</div>
					
					<div id='content'>
					<div class='custom-file-container' data-upload-id='posting'>
						<label
							>Upload File
							<a
								href='javascript:void(0)'
								class='custom-file-container__image-clear'
								title='Clear Image'
								>&times;</a
							></label
						>
						<label class='custom-file-container__custom-file'>
							<input
								type='file'
								class='custom-file-container__custom-file__custom-file-input' name='files[]' id='files'

								accept='*'
								multiple=''
								aria-label='Choose File'
							/>
							<input type='hidden' name='MAX_FILE_SIZE' value='10485760' />
							<span
								class='custom-file-container__custom-file__custom-file-control'
							></span>
						</label>
						<div class='custom-file-container__image-preview'></div>
					</div>
					</div>
					</div>
					
					<?php
				}

				?>
			</form>

		</div>
 
 </div>
 

	

		<script>
			 var upload = new FileUploadWithPreview("posting");
			var div = document.getElementById("scroll_messages");
			div.scrollTop = div.scrollHeight;

			var attach_list= document.getElementById("content");
		attach_list.style.transition="0.1s";
		attach_list.style.display="none";
		
           function togglemenu(){
              if(attach_list.style.display=='none'){
				attach_list.style.transition="1s";
				attach_list.style.display= 'block';
				attach_list.style.marginTop="10px";
              } 
              else{
				
				attach_list.style.transition="1s";
				attach_list.style.display='none';
				attach_list.style.marginTop="10px";
              }
           }
		</script>
	
</div>
	
			<br>
	</div>		

 </body>

 
		<script type="text/javascript">
		$(document).ready(function(){
			setInterval(function()  {
				$('#scroll_messages').load('Msg_load.php')
				
			}, 3000);
			
		});
		</script>
</html>