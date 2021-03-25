<?php
class Message {
	private $user_obj;
	private $con;

	public function __construct($con, $user){
		$this->con = $con;
		$this->user_obj = new User($con, $user);
	}

	public function getMostRecentUser() {
		$userLoggedIn = $this->user_obj->getUsername();
		
		$query = mysqli_query($this->con, "SELECT user_to, user_from FROM messages WHERE user_to='$userLoggedIn' OR user_from='$userLoggedIn' ORDER BY id DESC LIMIT 1");

		if(mysqli_num_rows($query) == 0)
			return false;

		$row = mysqli_fetch_array($query);
		$user_to = $row['user_to'];
		$user_from = $row['user_from'];

		if($user_to != $userLoggedIn)
			return $user_to;
		else 
			return $user_from;

	}

	public function sendMessage($user_to, $body, $date,$msg_by_code,$typeof,$files) {

		if($body != "") {
			$userLoggedIn = $this->user_obj->getUsername();
			$im_query=mysqli_query($this->con,"select profile_pic from users where username='$userLoggedIn'");
			$image1=mysqli_fetch_array($im_query);
			$img1=$image1['profile_pic'];
			$query = mysqli_query($this->con, "INSERT INTO messages VALUES('', '$user_to', '$userLoggedIn', '$body', '$date', 'no', 'no', 'no','$msg_by_code','$typeof','$files','$img1')");
		}
	}

	public function getMessages($otherUser,$msg_by_code) {
		$userLoggedIn = $this->user_obj->getUsername();
		$data = "";

		 mysqli_query($this->con, "UPDATE messages SET opened='yes'  WHERE user_to='$userLoggedIn' AND user_from='$otherUser' AND class_code='$msg_by_code'");

		$get_messages_query = mysqli_query($this->con, "SELECT * FROM messages WHERE  (user_to='$userLoggedIn' AND user_from='$otherUser'AND class_code='$msg_by_code') OR (user_from='$userLoggedIn' AND user_to='$otherUser'AND class_code='$msg_by_code') ");
		$u_form='';
		$u_to='';
		$svg='';
				$result = mysqli_query($this->con, "SELECT * FROM messages WHERE  (user_to='$userLoggedIn' AND user_from='$otherUser'AND class_code='$msg_by_code') OR (user_from='$userLoggedIn' AND user_to='$otherUser'AND class_code='$msg_by_code') ORDER BY id DESC 
				LIMIT 1") ;
		$row11 = mysqli_fetch_array($result) ;
		$us_from = $row11['user_from'];
		$us_id = $row11['id'];

		$opened=$row11['opened'];
		if($opened=='yes'){
			$svg="<div style='float: right;
			font-size: 10px;
			display: flex;
			align-items: center;
			justify-content: space-around;
			margin-right: 10px;'><svg  style='    width: 20px;
			color: #1c901cc4;' xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye-fill' viewBox='0 0 16 16'>
			<path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z'/>
			<path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z'/>
		  </svg>Seen</div>";
		}
		else{
			$svg='';
		}

			$get_messages_query = mysqli_query($this->con, "SELECT * FROM messages WHERE  (user_to='$userLoggedIn' AND user_from='$otherUser'AND class_code='$msg_by_code') OR (user_from='$userLoggedIn' AND user_to='$otherUser'AND class_code='$msg_by_code') ");				
						
		while($row = mysqli_fetch_array($get_messages_query)) {
			$user_to = $row['user_to'];
			$user_from = $row['user_from'];
			$body = $row['body'];
			$id = $row['id'];
			$pic= $row['user_pic'];
			$r_files=$row['files'];
			


			
			if($user_to == $userLoggedIn){
				if($r_files=='files'){
					$imageFileType = pathinfo($body, PATHINFO_EXTENSION);


							if(strtolower($imageFileType) != "jpeg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpg") {
								$data .= "
								<div class='msg_style2' style=''>
								<img src='$pic' style='border-radius:50px;height:40px;'>
								<div class='message' id='grey' style=''>
								<a href='download.php?file=$body'style='color:#555;
								'>$body</a> 
								</div>
								</div>

								";
								
							}
							else{
								$data .= "
								<div class='msg_style2' style=''>
								<div  style='float:left'>
								<img src='$pic' style='border-radius:50px;height:40px;'></div>
								<div class='message' id='grey' style='float:left;margin-left:10px;style='width:100%;height:100%''>
								<a href='download.php?file=$body' style='color:#555;
						'><img src='assets/files/$body' style='width:100%;height:100%' alt''></a> 
								
								</div>
								</div>

								";
							}
										
				}
				else{
					if($u_to==$user_to){
						$data .= "
						<div class='msg_style2'style=''>
						<div style='width: 100%;
						/* float: left; */
						/* max-width: 50%; */
						left: 45px;
						position: relative;'>
						
						<div class='message' id='grey' style=''>
						$body 
						</div>
						</div>
						</div>
						";
					}
					else{
						$data .= "
					<div class='msg_style2'style=''>
					<img src='$pic' style='border-radius:50px;height:40px;'>
					<div class='message' id='grey' style=''>
					$body 
					</div>
					</div>
	
					";
					}
					
				}
				
			}
			else{
				if($r_files=='files'){
					$imageFileType = pathinfo($body, PATHINFO_EXTENSION);


					if(strtolower($imageFileType) != "jpeg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpg") {
					if($row['id']==$us_id){
						$data .= "
						<div class='msg_style'>
						
						<div class='message' id='grey2' style=''>
						<span class='deleteButton' style='float:right' onclick='deleteMessage($id, this)'>X</span>
						<a href='download.php?file=$body' style='color:#555;
						'>$body</a> 
						</div>
						$svg
						
						</div>
		
						";
					}
					else{
						$data .= "
						<div class='msg_style'>
						
						<div class='message' id='grey2' style=''>
						<span class='deleteButton' style='float:right' onclick='deleteMessage($id, this)'>X</span>
						<a href='download.php?file=$body' style='color:#555;
						'>$body</a> 
						</div>
						
						</div>
		
						";
					}
						
					}
					else{
						if($row['id']==$row11['id'])
						{$data .= "
							<div class='msg_style'>
							
							<div class='message' id='grey2' style='width:100%;height:100%'>
							<span class='deleteButton' style='float:right' onclick='deleteMessage($id, this)'>X</span>
							<a href='download.php?file=$body' style='color:#555;
							'><img src='assets/files/$body' style='width:100%;height:100%' alt''></a> 
							
							</div>
							$svg
							</div>
			
							";}
						else{$data .= "
							<div class='msg_style'>
							
							<div class='message' id='grey2' style='width:100%;height:100%'>
							<span class='deleteButton' style='float:right' onclick='deleteMessage($id, this)'>X</span>
							<a href='download.php?file=$body' style='color:#555;
							'><img src='assets/files/$body' style='width:100%;height:100%' alt''></a> 
							
							</div>
							
							</div>
			
							";}
						
						
					}



				}
				else{
					
						if($row['id']==$row11['id'])
						{
							$data .= "<div class='msg_style'>
						<div style='width: 100%;
						/* float: left; */
						/* max-width: 50%; */
						
						position: relative;'>
						<div class='message' id='blue'style=''>
						<span class='deleteButton' style='float:right' onclick='deleteMessage($id, this)'>X</span>
						$body 
						</div>
						</div>

						
						
						
						</div>
						$svg 
		
						";
						}
						else{
							$data .= "<div class='msg_style'>
							<div style='width: 100%;
							/* float: left; */
							/* max-width: 50%; */
							
							position: relative;'>
							<div class='message' id='blue'style=''>
							<span class='deleteButton' style='float:right' onclick='deleteMessage($id, this)'>X</span>
							$body 
							</div>
							</div>
	
							
							
							
							</div>
			
							";
						}
						
					
					
					
				}
				
			}
			$u_form=$user_from;
			$u_to=$user_to;


			
			
		}
		
		return $data;
	}
	public function getGroupMessages($otherUser,$msg_by_code) {
		$userLoggedIn = $this->user_obj->getUsername();
		$data = "";

		$query = mysqli_query($this->con, "UPDATE messages SET opened='yes'  WHERE (user_to='$userLoggedIn' AND user_from='$otherUser' ) ");
		$u_form='';
		$u_to='';
		$svg='';
				$result = mysqli_query($this->con, "SELECT * FROM messages WHERE user_to='$otherUser'AND class_code='$msg_by_code' ORDER BY id DESC 
				LIMIT 1") ;
		$row11 = mysqli_fetch_array($result) ;
		$us_from = $row11['user_from'];
		$us_id = $row11['id'];

		$opened=$row11['opened'];
		if($opened=='yes'){
			$svg="<div style='float: right;
			font-size: 10px;
			display: flex;
			align-items: center;
			justify-content: space-around;
			margin-right: 10px;'><svg  style='    width: 20px;
			color: #1c901cc4;' xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye-fill' viewBox='0 0 16 16'>
			<path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z'/>
			<path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z'/>
		  </svg>Seen</div>";
		}
		else{
			$svg='';
		}
		$get_messages_query = mysqli_query($this->con, "SELECT * FROM messages WHERE user_to='$otherUser'AND class_code='$msg_by_code'");

		while($row = mysqli_fetch_array($get_messages_query)) while($row = mysqli_fetch_array($get_messages_query)) {
			$user_to = $row['user_to'];
			$user_from = $row['user_from'];
			$body = $row['body'];
			$id = $row['id'];
			$pic= $row['user_pic'];
			$r_files=$row['files'];
			


			
			if($user_from != $userLoggedIn){
				if($r_files=='files'){
					$imageFileType = pathinfo($body, PATHINFO_EXTENSION);


							if(strtolower($imageFileType) != "jpeg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpg") {
								$data .= "
								<div class='msg_style2' style=''>
								<img src='$pic' style='border-radius:50px;height:40px;'>
								<div class='message' id='grey' style=''>
								<a href='download.php?file=$body'style='color:#555;
								'>$body</a> 
								</div>
								</div>

								";
								
							}
							else{
								$data .= "
								<div class='msg_style2' style=''>
								<div  style='float:left'>
								<img src='$pic' style='border-radius:50px;height:40px;'></div>
								<div class='message' id='grey' style='float:left;margin-left:10px;style='width:100%;height:100%''>
								<a href='download.php?file=$body' style='color:#555;
						'><img src='assets/files/$body' style='width:100%;height:100%' alt''></a> 
								
								</div>
								</div>

								";
							}
										
				}
				else{
					if($u_form==$user_from){
						$data .= "
						<div class='msg_style2'style=''>
						<div style='width: 100%;
						/* float: left; */
						/* max-width: 50%; */
						left: 45px;
						position: relative;'>
						
						<div class='message' id='grey' style=''>
						$body 
						</div>
						</div>
						</div>
						";
					}
					else{
						$data .= "
					<div class='msg_style2'style=''>
					<img src='$pic' style='border-radius:50px;height:40px;'>
					<div class='message' id='grey' style=''>
					$body 
					</div>
					</div>
	
					";
					}
					
				}
				
			}
			else{
				if($r_files=='files'){
					$imageFileType = pathinfo($body, PATHINFO_EXTENSION);


					if(strtolower($imageFileType) != "jpeg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpg") {
					if($row['id']==$us_id){
						$data .= "
						<div class='msg_style'>
						
						<div class='message' id='grey2' style=''>
						<span class='deleteButton' style='float:right' onclick='deleteMessage($id, this)'>X</span>
						<a href='download.php?file=$body' style='color:#555;
						'>$body</a> 
						</div>
						$svg
						
						</div>
		
						";
					}
					else{
						$data .= "
						<div class='msg_style'>
						
						<div class='message' id='grey2' style=''>
						<span class='deleteButton' style='float:right' onclick='deleteMessage($id, this)'>X</span>
						<a href='download.php?file=$body' style='color:#555;
						'>$body</a> 
						</div>
						
						</div>
		
						";
					}
						
					}
					else{
						if($row['id']==$row11['id'])
						{$data .= "
							<div class='msg_style'>
							
							<div class='message' id='grey2' style='width:100%;height:100%'>
							<span class='deleteButton' style='float:right' onclick='deleteMessage($id, this)'>X</span>
							<a href='download.php?file=$body' style='color:#555;
							'><img src='assets/files/$body' style='width:100%;height:100%' alt''></a> 
							
							</div>
							$svg
							</div>
			
							";}
						else{$data .= "
							<div class='msg_style'>
							
							<div class='message' id='grey2' style='width:100%;height:100%'>
							<span class='deleteButton' style='float:right' onclick='deleteMessage($id, this)'>X</span>
							<a href='download.php?file=$body' style='color:#555;
							'><img src='assets/files/$body' style='width:100%;height:100%' alt''></a> 
							
							</div>
							
							</div>
			
							";}
						
						
					}



				}
				else{
					
						if($row['id']==$row11['id'])
						{
							$data .= "<div class='msg_style'>
						<div style='width: 100%;
						/* float: left; */
						/* max-width: 50%; */
						
						position: relative;'>
						<div class='message' id='blue'style=''>
						<span class='deleteButton' style='float:right' onclick='deleteMessage($id, this)'>X</span>
						$body 
						</div>
						</div>

						
						
						
						</div>
						$svg 
		
						";
						}
						else{
							$data .= "<div class='msg_style'>
							<div style='width: 100%;
							/* float: left; */
							/* max-width: 50%; */
							
							position: relative;'>
							<div class='message' id='blue'style=''>
							<span class='deleteButton' style='float:right' onclick='deleteMessage($id, this)'>X</span>
							$body 
							</div>
							</div>
	
							
							
							
							</div>
			
							";
						}
						
					
					
					
				}
				
			}
			$u_form=$user_from;
			$u_to=$user_to;


			
			
		}
		return $data;
	}

	public function getLatestMessage($userLoggedIn, $user2,$msg_by_code) {
		$details_array = array();
		$result = substr($user2, 0, 5);
		if($result=='Group'){
			$query = mysqli_query($this->con, "SELECT body, user_to,user_from ,date FROM messages WHERE user_to='$user2' and class_code='$msg_by_code' ORDER BY id DESC LIMIT 1");

		$row = mysqli_fetch_array($query);
		$sent_by = ($row['user_from'] != $userLoggedIn) ? "" : "You: ";

		//Timeframe
		$date_time_now = date("Y-m-d H:i:s");
		$start_date = new DateTime($row['date']); //Time of post
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
				$time_message = $interval->m . " month". $days;
			}
			else {
				$time_message = $interval->m . " months". $days;
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

		array_push($details_array, $sent_by);
		array_push($details_array, $row['body']);
		array_push($details_array, $time_message);
		}
		else{
			$query = mysqli_query($this->con, "SELECT body, user_to, date FROM messages WHERE (user_to='$userLoggedIn' AND user_from='$user2') OR (user_to='$user2' AND user_from='$userLoggedIn') AND class_code='$msg_by_code' ORDER BY id DESC LIMIT 1");

		$row = mysqli_fetch_array($query);
		$sent_by = ($row['user_to'] == $userLoggedIn) ? "" : "You: ";

		//Timeframe
		$date_time_now = date("Y-m-d H:i:s");
		$start_date = new DateTime($row['date']); //Time of post
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
				$time_message = $interval->m . " month". $days;
			}
			else {
				$time_message = $interval->m . " months". $days;
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

		array_push($details_array, $sent_by);
		array_push($details_array, $row['body']);
		array_push($details_array, $time_message);
		}
		

		return $details_array;
	}

	public function getConvos() {
		$userLoggedIn = $this->user_obj->getUsername();
		$return_string = "";
		$convos = array();
		$msg_code=$_SESSION['stored'];
		$query = mysqli_query($this->con, "SELECT * FROM messages WHERE user_to='$userLoggedIn' OR user_from='$userLoggedIn' AND class_code='$msg_code' ORDER BY id DESC");

		while($row = mysqli_fetch_array($query)) {
			$user_to_push = ($row['user_to'] != $userLoggedIn) ? $row['user_to'] : $row['user_from'];
			$type=$row['type'];
			if($type!='group'){
				if(!in_array($user_to_push, $convos)) {
					array_push($convos, $user_to_push);
				}
			}
			
		}

		foreach($convos as $username) {
			$user_found_obj = new User($this->con, $username);
			$msg_code=$_SESSION['stored'];
			$latest_message_details = $this->getLatestMessage($userLoggedIn, $username,$msg_code);
			;
			$dots = (strlen($latest_message_details[1]) >= 12) ? "..." : "";
			$split = str_split($latest_message_details[1], 12);
			$split = $split[0] . $dots; 
			$return_string .= "<a href='messages.php?u=$username'> <div class='user_found_messages'>
				<img src='" . $user_found_obj->getProfilePic() . "' style='border-radius: 5px; margin-right: 5px;'>
				" . $user_found_obj->getFirstAndLastName() . "
				<span class='timestamp_smaller' id='grey'> " . $latest_message_details[2] . "</span>
				<p id='grey' style='margin: 0;'>" . $latest_message_details[0] . $split . " </p>
				</div>
				</a>";
		

			
		}

		return $return_string;

	}
	
	public function getGroup($msg_by_code){
		$grp_str='';
			$userLoggedIn = $this->user_obj->getUsername();
			$query=mysqli_query($this->con,"select created_by from classes where class_code='$msg_by_code'");
			$row=mysqli_fetch_array($query);
			$msg=$row['created_by'];
			$userc = strip_tags($msg); //Remove html tags
	$userc = str_replace(' ', '', $userc); //remove spaces
			$Uquery=mysqli_query($this->con,"select username,id from users where username='$userLoggedIn'");
			$row1=mysqli_fetch_array($Uquery);
			$msg_UNAME=$row1['id'];
			$userl = strip_tags($msg_UNAME); //Remove html tags
	$userl = str_replace(' ', '', $userl); //remove spaces
	
			
			if($userl == $userc){
				$grp_str .= "<a href='groupselection.php'>Group Message</a>";
			}
			else{
				$grp_str .='';
			}
				
			
			return $grp_str;

	}
	public function getEditable($msg_by_code){
	

	}

	public function getConvosDropdown($data, $limit) {

		$page = $data['page'];
		$userLoggedIn = $this->user_obj->getUsername();
		$return_string = "";
		$convos = array();
		$msg_code=$_SESSION['stored'];
		if($page == 1)
			$start = 0;
		else 
			$start = ($page - 1) * $limit;

		

		$query = mysqli_query($this->con, "SELECT * FROM messages WHERE viewed='no' and class_code='$msg_code'");
		while($row=mysqli_fetch_array($query)){
			$result = substr($row['user_to'], 0, 5);
			if($result=='Group'){
				
				$user_to=$row['user_to'];
				$query_m = mysqli_query($this->con, "SELECT userid FROM group_messages WHERE group_id='$user_to'");
				while($search=mysqli_fetch_array($query_m)){
				$userid=$search['userid'];
				$query_t= mysqli_query($this->con, "SELECT username FROM users WHERE id='$userid'");
				$searcht=mysqli_fetch_array($query_t);
						if($searcht['username']==$userLoggedIn){

							$set_viewed_query = mysqli_query($this->con, "UPDATE messages SET viewed='yes' WHERE user_to='$user_to'");
						}
					}
			}
			else if($row['user_to']==$userLoggedIn){
				$set_viewed_query = mysqli_query($this->con, "UPDATE messages SET viewed='yes' WHERE user_to='$userLoggedIn'");

			}

		}



		$query = mysqli_query($this->con, "SELECT user_to, user_from FROM messages WHERE  class_code='$msg_code' ORDER BY id DESC");

		while($row = mysqli_fetch_array($query)) {
			$result = substr($row['user_to'], 0, 5);
			if($result=='Group'){
				$user_to=$row['user_to'];
				$query_m = mysqli_query($this->con, "SELECT userid FROM group_messages WHERE group_id='$user_to'");
					while($search=mysqli_fetch_array($query_m)){
						$userid=$search['userid'];
				$query_t= mysqli_query($this->con, "SELECT username FROM users WHERE id='$userid'");
				$searcht=mysqli_fetch_array($query_t);
						if($searcht['username']==$userLoggedIn){


							$user_to_push = $row['user_to'] ;
							if(!in_array($user_to_push, $convos)) {
								array_push($convos, $user_to_push);
							}
						}
					}
				
				

				
			}
			else{

				if($row['user_to']==$userLoggedIn || $row['user_from']==$userLoggedIn){
					$user_to_push = ($row['user_to'] != $userLoggedIn) ? $row['user_to'] : $row['user_from'];

					if(!in_array($user_to_push, $convos)) {
						array_push($convos, $user_to_push);
					}

				}
				
			}
			
		}

		$num_iterations = 0; //Number of messages checked 
		$count = 1; //Number of messages posted

		foreach($convos as $username) {

			if($num_iterations++ < $start)
				continue;

			if($count > $limit)
				break;
			else 
				$count++;


			$is_unread_query = mysqli_query($this->con, "select opened,type,id FROM messages WHERE user_to='$userLoggedIn' AND user_from='$username' ORDER BY id DESC");
			$row = mysqli_fetch_array($is_unread_query);
			$style = ($row['opened'] == 'no') ? "background-color: #DDEDFF;" : "";
			$msg_code=$_SESSION['stored'];
			$idis=$row['id'];
			$user_found_obj = new User($this->con, $username);
			$latest_message_details = $this->getLatestMessage($userLoggedIn, $username,$msg_code);

			
			

			$dots = (strlen($latest_message_details[1]) >= 12) ? "..." : "";
			$split = str_split($latest_message_details[1], 12);
			$split = $split[0] . $dots; 
			$results = substr($username, 0, 5);
			if($results=='Group'){
				$is_unread_queryww = mysqli_query($this->con, "select groupname FROM groups WHERE groupid='$username'");
				$rowa = mysqli_fetch_array($is_unread_queryww);
				$name=$rowa['groupname'];
				$return_string .= "<a href='messages.php?u=$username&type=group&name=$name'> 
				<div class='user_found_messages' style='" . $style . "'>
				<img src='img/group.png' style='border-radius: 5px; margin-right: 5px;'>
				" . $user_found_obj->getFirstAndLastName() . "
				<span class='timestamp_smaller' id='grey'> " . $latest_message_details[2] . "</span>
				<p id='grey' style='margin: 0;'>" . $latest_message_details[0] . $split . " </p>
				</div>
				</a>";
			}
			else{
				$return_string .= "<a href='messages.php?u=$username&op=$idis'> 
								<div class='user_found_messages' style='" . $style . "'>
								<img src='" . $user_found_obj->getProfilePic() . "' style='border-radius: 5px; margin-right: 5px;'>
								" . $user_found_obj->getFirstAndLastName() . "
								<span class='timestamp_smaller' id='grey'> " . $latest_message_details[2] . "</span>
								<p id='grey' style='margin: 0;'>" . $latest_message_details[0] . $split . " </p>
								</div>
								</a>";
			}
			
		}


		//If posts were loaded
		if($count > $limit)
			$return_string .= "<input type='hidden' class='nextPageDropdownData' value='" . ($page + 1) . "'><input type='hidden' class='noMoreDropdownData' value='false'>";
		else 
			$return_string .= "<input type='hidden' class='noMoreDropdownData' value='true'> <p style='text-align: center;'>No more messages to load!</p>";

		return $return_string;
	}

	public function getUnreadNumber() {
		$userLoggedIn = $this->user_obj->getUsername();
		$msg_code=$_SESSION['stored'];
		$count=0;
		$query = mysqli_query($this->con, "SELECT * FROM messages WHERE viewed='no' and class_code='$msg_code'");
		while($row=mysqli_fetch_array($query)){
			$result = substr($row['user_to'], 0, 5);
			if($result=='Group'){
				
				$user_to=$row['user_to'];
				$query_m = mysqli_query($this->con, "SELECT userid FROM group_messages WHERE group_id='$user_to'");
				while($search=mysqli_fetch_array($query_m)){
				$userid=$search['userid'];
				$query_t= mysqli_query($this->con, "SELECT username FROM users WHERE id='$userid'");
				$searcht=mysqli_fetch_array($query_t);
						if($searcht['username']==$userLoggedIn){

							$count++;
						}
					}
			}
			else if($row['user_to']==$userLoggedIn){
				$count++;

			}

		}
		return $count;
	}

}

?>