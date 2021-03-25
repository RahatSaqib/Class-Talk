<?php
include('includes/header.php');

if(isset($_GET['as_id'])){
    $_SESSION['as_id']=$_GET['as_id'];
}
if(isset($_GET['cancel']))
		  {
				  mysqli_query($con,"delete from submission where assignmentID='".$_GET['upid']."' AND submittedBy='".$_GET['sid']."' ");
		          mysqli_query($con,"delete from files where submittedID='".$_GET['upid']."' AND submittedby='".$_GET['sid']."' ");
				  
							//echo "<script>alert('Your appointment canceled !!');window.location='appointment-history.php'</script>";
                  //$_SESSION['msg']=" Your appointment canceled !!";

		  }
$user_obj = new User($con, $userLoggedIn);

		$userLoggedIn = $user_obj->getUsername();

		

        $stored=$_SESSION['stored'];
        $asid=$_SESSION['as_id'];
        

		$opened_query = mysqli_query($con, "UPDATE notifications SET opened='yes' WHERE user_to='$userLoggedIn' AND link LIKE '%=$asid'");

		$str = ""; //String to return 
		$data_query = mysqli_query($con, "SELECT * FROM assignment WHERE id='$asid'");

		if(mysqli_num_rows($data_query) > 0) {


			$row = mysqli_fetch_assoc($data_query); 
				$id = $row['id'];
				$title = $row['title'];
				$instruction = $row['instruction'];
                $date_time = $row['date'];
				$user = $row['uploadedby'];
				$fileid=$row['filesid'];
				$due_date=$row['duedate'];
				if(strtotime(date("Y-m-d")) > strtotime($due_date)){
					$due='Late';
					
					
				}
				elseif(strtotime(date("Y-m-d")) < strtotime($due_date)){
					$due='Assigned';
					
					
				}
				$data_query3 = mysqli_query($con, "SELECT * FROM submission WHERE assignmentID='$asid' AND submittedBy='".$_SESSION['id']."'");
				$row12=mysqli_fetch_array($data_query3);
				$grade=$row12['mark'];
				


				//Prepare user_to string so it can be included even if not posted to a user
				// if($row['user_to'] == "none") {
				// 	$user_to = "";// }
        	$data_query1 = mysqli_query($con, "SELECT username FROM users WHERE gid='$user'");
			$row1 = mysqli_fetch_array($data_query1); 
        
        
				$added_by=$row1['username'];
					$user_to_obj = new User($con, $row1['username']);
					$user_to_name = $user_to_obj->getFirstAndLastName();
					$user_to = "to <a href='" . $row1['username'] ."'>" . $user_to_name . "</a>";
				

				//Check if user who posted, has their account closed
				$added_by_obj = new User($con, $added_by);
				// if($added_by_obj->isClosed()) {
				// 	return;
				// }

				$user_logged_obj = new User($con, $userLoggedIn);
				


					if($userLoggedIn == $added_by)
						$delete_button = "<button class='delete_button btn-danger' id='post$id'>X</button>";
					else 
						$delete_button = "";


					$user_details_query = mysqli_query($con, "SELECT first_name, last_name, profile_pic FROM users WHERE username='$added_by'");
					$user_row = mysqli_fetch_array($user_details_query);
					$first_name = $user_row['first_name'];
					$last_name = $user_row['last_name'];
					$profile_pic = $user_row['profile_pic'];


					?>
					
					<?php

					$comments_check = mysqli_query($con, "SELECT * FROM comments WHERE assignmentID='$id'");
					$comments_check_num = mysqli_num_rows($comments_check);


					//Timeframe
					$date_time_now = date("Y-m-d H:i:s");
					$start_date = new DateTime($date_time); //Time of post
					$end_date = new DateTime($date_time_now); //Current time
					$interval = $start_date->diff($end_date); //Difference between dates 
					if($interval->y >= 1) {
						if($interval == 1)
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

					


				?>
				<script>

					$(document).ready(function() {

						$('#post<?php echo $id; ?>').on('click', function() {
							bootbox.confirm("Are you sure you want to delete this post?", function(result) {

								$.post("includes/form_handlers/delete_post.php?post_id=<?php echo $id; ?>", {result:result});

								if(result)
									location.reload();

							});
						});


					});

				</script>
				<?php
				
				
		}
		else {
			echo "<p>No post found. If you clicked a link, it may be broken.</p>";
					return;
		}

		if(isset($_POST['submit'])){
			
			$msg_by_code=$_SESSION['stored'];
			$submittedby=$_SESSION['id'];
			$status=$due;
			$c=$_FILES['files']['name'][0] ;
			// echo $c;
			
				$query=mysqli_query($con,"select * from submission where assignmentID='$asid' and submittedBy='$submittedby'");
				if(mysqli_num_rows($query)==0){
					if($c !='')
					{
					mysqli_query($con,"insert into submission (assignmentID,submittedBy,status) values('$asid','$submittedby','$status')");
		
	
					for($i=0;$i<count($_FILES['files']['name']);$i++){
						$filename= $_FILES['files']['name'][$i];
						$targetDir = "assets/files/";
						$filename = basename($filename);
						mysqli_query($con,"insert into files (files,submittedID,submittedby) values('$filename','$asid','$submittedby')");
		
					move_uploaded_file($_FILES['files']['tmp_name'][$i],$targetDir.$filename);
					}
					// header("Location:assign_assignment.php?as_id=$asid");
				}
			}
			

			
		
		}

	
?>

<link href='file-upload-with-preview.min.css' rel=stylesheet>
<script src="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.js"></script>
<div class="container-fluid">
<div class='status_post' onClick='javascript:toggle<?php echo $id;?>()'>
								<!-- <div class='post_profile_pic'>
									<img src='<?php
									
									
									
									?>$profile_pic' width='50'>
								</div> -->
								<?php
								
								
								
								?>
							<div class="row assign">
							<div class="col-md-9">
							<div class='posted_by' style='color:#ACACAC;'>
									<?php echo $time_message ;?>
									<?php echo $delete_button ; ?>
									

                                </div>
								
								
								<?php
								if($due=='Late'){
									?>
									
									<h4 style="color:red"><?php echo $due ;?></h4>
									<?php
								}
								else{
									?>
									
									<h4 style="color:#08a268"><?php echo $due ;?></h4>
									<?php
								}
								
								 ?>
								<h3 style="width: 100%"> <?php echo $title;?></h3>
								<?php
								if($grade!=''){
									?><h5> Mark : <?php echo $grade; ?></h5><?php
								}
								
								?>
								
								<div id='post_body'>
                                <?php echo $instruction ;?>
									<br>
									<br>
									<br>
								</div>
                                <div class="files col-md-12">
                                	<?php
									
									$filequery = mysqli_query($con, "SELECT * FROM files WHERE assignmentID ='$fileid'");
									

									if(mysqli_num_rows($filequery) > 0){
										while($idrow=mysqli_fetch_assoc($filequery)){
											?>
											<div class="row filetype">
											
												<a href="download.php?file=assets/files/<?php echo $idrow['files']?>">
												<i class="fa fa-file" aria-hidden="true"></i>
												<?php 
												$filename = $idrow['files'];
												$dots = (strlen($filename) >= 12) ? "..." : "";
										$split = str_split($filename, 12);
										$split = $split[0] . $dots;
												
												echo $split;?></a>
											</div>
											<?php

										}
									}
									?>
                                </div>
								
							</div>
							<div class="col-md-3" style="border-left:1px solid #b5b4b4">
							<form action="" method="POST" enctype="multipart/form-data">
								<h4>Attach Files</h4>
								
								<div class="custom-file-container" data-upload-id="myUniqueUploadId">
									<label
										>Upload File
										<a
											href="javascript:void(0)"
											class="custom-file-container__image-clear"
											title="Clear Image"
											>&times;</a
										></label
									>
									<label class="custom-file-container__custom-file">
										<input
											type="file"
											class="custom-file-container__custom-file__custom-file-input" name="files[]" id="files"
											accept="*"
											multiple=""
											aria-label="Choose File"
										/>
										<input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
										<span
											class="custom-file-container__custom-file__custom-file-control"
										></span>
									</label>
									<div class="custom-file-container__image-preview"></div>
								</div>
								<?php
								$user_data_query1 = mysqli_query($con, "SELECT gid FROM users WHERE username='$userLoggedIn'");
								$row1 = mysqli_fetch_array($user_data_query1);
								$gid = $row1['gid'];
								
								$user_data_query = mysqli_query($con, "SELECT assignmentID, submittedBy FROM submission WHERE assignmentID='$asid' AND submittedBy='$gid'");
								
								if(mysqli_num_rows($user_data_query)>0)
								{
									$row = mysqli_fetch_array($user_data_query);
									?>
				<a href="assign_assignment.php?upid=<?php echo $asid?>&sid=<?php echo $gid?>&cancel=update" onClick="return confirm('Are you sure you want to cancel the submission ?')"class="" title="Cancel Submission" tooltip-placement="top" tooltip="Remove">
				<div style="padding: 5px;
												border-radius: 20px;
												border: 1px solid #59a1ff;
												color: #59a1ff;
												margin-bottom: 10px;
												width: 100%;
												text-align: center;
												top: -30px;
												text-align:center;
												position: relative;">
									Unsumbit
									
									</div>
				
				
				</a>
									
									
									<?php
								}
								else{
									?>
									<style>
										.btn{
											background-color: #27ac5c;
    border-color: #fff;
										}
									</style>
									<input type="submit" class="btn btn-danger" name="submit" id="submit" value="Submit" onClick='submitted();'>	<?php
								}
							
								// $first_name = $row['title'];
								// $last_name = $row['class_name'];
								// $code = $row['class_code'];
								
								
								?>
							
						
												</div>
									<div class=demo-info-container role=contentinfo><div>
														</div>
														
														
														</form>
													
														</div>
														
													</div>
														<div class='newsfeedPostOptions'>
														Comments(<?php echo $comments_check_num ;?>)&nbsp;&nbsp;&nbsp; 
															<iframe src='like.php?post_id=<?php echo $id;?>' scrolling='no'></iframe>
														</div>

													
													</div>
													<div class='post_comment' id='toggleComment<?php echo $id;?>' style='display:none;'>
														<iframe src='comment_assignment.php?post_id=<?php echo $id;?>' id='comment_iframe' frameborder='0'></iframe>
													</div>
													<hr>

<!-- modal for edit remark -->
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10.12.6/dist/sweetalert2.all.min.js'></script>
<script>
	function submitted(){
		Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'Your Assignment  has been Submitted',
  showConfirmButton: false,
  timer: 4000
});
	}
</script>
<script> 
 var upload = new FileUploadWithPreview("myUniqueUploadId");
						function toggle<?php echo $id; ?>(e) {

 							if( !e ) e = window.event;

							var target = $(e.target);
							if (!target.is("a")) {
								var element = document.getElementById("toggleComment<?php echo $id; ?>");

								if(element.style.display == "block") 
									element.style.display = "none";
								else 
									element.style.display = "block";
							}
						}


					</script><script src=https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.js>
					</script><script src=https://cdnjs.cloudflare.com/ajax/libs/fetch/2.0.3/fetch.js></script>
					<script type=text/javascript src=./vendor.fb499262a9e09dc42cef.js></script>
					<script type=text/javascript src=./main.546310cb9577066438f3.js></script>