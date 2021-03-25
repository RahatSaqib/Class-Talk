<?php
include('includes/header.php');

if(isset($_GET['as_id'])){
    $_SESSION['as_id']=$_GET['as_id'];
}
if(isset($_GET['student_id'])){
    $_SESSION['student_id']=$_GET['student_id'];
}
if(!isset($_SESSION['student_id'])){
	$_SESSION['student_id']='all';
}
if(isset($_GET['deletes'])){
	$history_post=$_GET['deletes'];
	$query = mysqli_query($con, "UPDATE assignment SET deleted='yes' WHERE id='$history_post'");
	$stored=$_SESSION['stored'];
    header("Location:index.php?id=$stored");
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

				//Prepare user_to string so it can be included even if not posted to a user
				// if($row['user_to'] == "none") {
				// 	$user_to = "";// }
        	$data_query1 = mysqli_query($con, "select username from users where gid ='".$_SESSION['id']."'");
			$rows = mysqli_fetch_array($data_query1); 
        
        
				$added_by=$rows['username'];
					
			
	


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
?>
<style>
    .content{
  width: 30%;
  height: auto;
  /* margin: 0 auto;
  padding: 30px; */
}
.nav-pills{
  width: 100%;
}
.nav-item{
  width: 50%;
}
.nav-pills .nav-link{
  font-weight: bold;
  padding-top: 13px;
  text-align: center;
  background: #fff;
  color: #000;
  border-radius: 30px;
  height: 100px;
  border: 1px solid #dbd4d4;
}
.nav-pills .nav-link.active{
    background: #27aa7b;
    color: #fefefe;
    font-size: 20px;
    box-shadow: 0px 0px 20px 0px #00000066;
}
.tab-content{
  position: absolute;
  width: 100%;
  height: auto;
  margin-top: -50px;
  background: #fff;
  color: #000;
  border-radius: 30px;
  /* z-index: 1000; */
  box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.4);
  /* padding: 30px; */
  margin-bottom: 50px;
}
.tab-content button{
  border-radius: 15px;
  width: 100px;
  margin: 0 auto;
  float: right;
}
</style>
<link href='file-upload-with-preview.min.css' rel=stylesheet>
<script src="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.js"></script>
  <div class="content">
    <!-- Nav pills -->
    <ul class="nav nav-pills" role="tablist">
      <li class="nav-item">
        <a class="nav-link" data-toggle="pill" href="#login">Details</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" data-toggle="pill" href="#regis">Student Classwork</a>
      </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div id="login" class="container tab-pane fade">
        <form>
          <div class="row">
         <div class='status_post' onClick='javascript:toggle<?php echo $id;?>()'>
								<!-- <div class='post_profile_pic'>
									<img src='<?php ?>$profile_pic' width='50'>
								</div> -->
							<div class="row assign">
							    <div class="col-md-12">
							        <div class='posted_by' style='color:#ACACAC;'>
									<?php echo $time_message ;?>



									<?php 
									
									if($userLoggedIn == $added_by) 
									{
										?>
													<a class='delete_button btn-danger' style='color: white;
    align-items: center;
    text-align: center;' data-toggle='modal' data-target='#<?php echo $id ?>' >X</a>
													
													<div class='modal fade text-dark' id='<?php echo $id?>'>
										<div class='modal-dialog'>
										<div class='modal-content'>
										<div class='modal-header text-center'>
										<h5 class='modal-title text-center' id='addclass'>Delete Class</h5>
										<button class='close' data-dismiss='modal'><span>&times;</span></button>
										</div>
										<div class='modal-body'>
										<form action='' method='POST' enctype="multipart/form-data" >

											<div class='form-group'>
												<p>Do you want to delete this assignment ?</p>
											
												
												<input type='text' name='cls' style='display:none'class='cls form-control' id='bookId' value='<?php echo $id?>'>
												<!-- <p name='cls' class='cls' id='bookId' value=''></p> -->
											</div>
											
											<a href='view_assignment.php?deletes=<?php echo $id?>' style='background: #26906b;
    padding: 10px;
    border-radius: 10px;
    color: white;
    cursor: pointer;
    float: right;' name='deletes' id='submit_n' class='submit_n'  class='btn btn-primary'>Yes</a>
											
											
											</form> 
											<?php
											
											
											?>
										</div>
										</div>          
										</div>
										</div>  
										<?php
									}
						
						
									?>
									
									
                                    </div>
									 <h3 style="width: 100%"> <?php echo $title;?></h3>
									 <?php
									 $data_query3 = mysqli_query($con, "SELECT * FROM submission WHERE assignmentID='$asid' AND submittedBy='".$_SESSION['id']."'");
									 $row12=mysqli_fetch_array($data_query3);
									 $grade=$row12['mark'];
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
                                
                                	<?php
									
									$filequery = mysqli_query($con, "SELECT * FROM files WHERE assignmentID ='$fileid'");
									

									if(mysqli_num_rows($filequery) > 0){
										while($idrow=mysqli_fetch_assoc($filequery)){
											?>
											<div class="row filetype">
											
												<a href="download.php?file=assets/files/<?php echo $idrow['files']?>">
												<i class="fa fa-file" aria-hidden="true"></i>
												<?php echo $idrow['files'] ;?></a>
											</div>
											<?php

										}
									}
									?>
                                </div>
								
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


        </form>
      </div>
      <div id="regis" class="container-fluid tab-pane active">
        <form>
        <div class="container-fluid "style="display:flex; overflow:scroll" >
    <div class="col-md-6">
            <table class="table">
		<tr>
		<th></th>
		<th>Students</th>
		<th></th>
        </tr>
        <tr>
            <td></td><td><h4><a href="view_assignment.php?as_id=<?php echo $asid ;?>&student_id=all">
            All Students</h4></td>
        <!-- <td><input type="checkbox" name="check[]" class="form-check-input" id="exampleCheck1" value="all"></td> -->
        </tr>
        <?php  
        $sqli=mysqli_query($con,"select * from classes where class_code='$msg_by_code'");
        $TEACHER=mysqli_fetch_array($sqli);
        $name=$TEACHER['created_by'];
                $sqli2=mysqli_query($con,"select * from users where id='$name'");
                $list=mysqli_fetch_array($sqli2);
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
                                <td><a href="view_assignment.php?as_id=<?php echo $asid ;?>&student_id=<?php echo $class['gid'] ;?>">
                <h4><?php echo $class['first_name']?></h4></a></td>
				<!-- <td><input type="checkbox" name="check[]" class="form-check-input" id="exampleCheck1" value="<?php echo $class['id']?>"></td> -->
				</tr>
				<?php
			}
		}
	}
				?>

		</tr>
		</table>
            </div>

           <div class="col-md-6" style="display:inline-grid">
		   		
               <?php
               $student_id=$_SESSION['student_id'];
               if($student_id=='all'){
				   ?>
				   <div class="status-s col-md-12">
						<div class="sub_row">
							<?php
								$query_s= mysqli_query($con,"select * from submission where assignmentID='$asid'");
								$count=mysqli_num_rows($query_s);
							?>
							<h3><?php echo $count?></h3>
							<h6>Total Submission</h6>
						</div>
						<div class="sub_row">
							<?php
								$query_s1= mysqli_query($con,"select * from enrolled_class where class_id='$stored'");
								$count1=mysqli_num_rows($query_s1) - 1;
							?>
							<h3><?php echo $count1?></h3>
							<h6>Total Students</h6>
						</div>
				   </div>

				  
				   <div class="col-md-12">
				   <div class="col-md-12">
				   <?php
						$query_s2= mysqli_query($con,"select * from submission where assignmentID='$asid'");
						if(mysqli_num_rows($query_s2)>0){
							$countid=mysqli_num_rows($query_s2);
							while($a_row=mysqli_fetch_array($query_s2)){

								$sub=$a_row['submittedBy'];
								$search_name=mysqli_query($con,"select * from users where gid='$sub'");
								$sub_name=mysqli_fetch_array($search_name);
								$s_name=$sub_name['first_name'];
								$s_pic=$sub_name['profile_pic'];



								$search_a=mysqli_query($con,"select * from files where submittedby='$sub' and submittedID='$asid'");
								$count_sub=mysqli_num_rows($search_a);
								

								?>
								<div class="row filetype" style="    width: 150px;
																	background: #edefee;
																	/* color: white; */
																	padding: 10px;
																	border-radius: 20px;
																	float:left;
																	margin:10px;
																	height: 120px;">
									<div style="    position: relative;
													display: flex;
													align-items: center;
													justify-content: space-around;
													margin-bottom: 10px;">
									<img src="<?php echo $s_pic?>" alt="" style="width: 30%; border-radius: 50px;">
									<h6><?php echo $s_name;?></h6>
									</div>
									<div style="    position: relative;
													display: flex;
													align-items: center;
													justify-content: space-around;
													margin-bottom: 10px;">
									<a href="grade_assignment.php?as_id=<?php echo $asid ?>&studentid=<?php echo $sub?>">
									<i class="fa fa-file" aria-hidden="true"></i>
									<?php echo $count_sub ;?> files added</a></div>
									
								</div>
								<?php
							}
						}
						
				   
				   ?>
				   </div>
				   
				   </div>
                   <?php
			   }
			   else{
				   ?>
<div class="col-md-12">
				   <div class="col-md-12">
				   <?php
				   $s_by=$_SESSION['student_id'];
						$query_s2= mysqli_query($con,"select * from submission where assignmentID='$asid' AND submittedBy='$s_by'");
						if(mysqli_num_rows($query_s2)>0){
							$countid=mysqli_num_rows($query_s2);
							while($a_row=mysqli_fetch_array($query_s2)){

								$sub=$a_row['submittedBy'];
								$search_name=mysqli_query($con,"select * from users where gid='$sub'");
								$sub_name=mysqli_fetch_array($search_name);
								$s_name=$sub_name['first_name'];
								$s_pic=$sub_name['profile_pic'];



								$search_a=mysqli_query($con,"select * from files where submittedby='$sub'");
								$count_sub=mysqli_num_rows($search_a);
								

								?>
								<div class="row filetype" style="    width: 150px;
																	background: #edefee;
																	/* color: white; */
																	padding: 10px;
																	border-radius: 20px;
																	float:left;
																	margin:10px;
																	height: 120px;">
									<div style="    position: relative;
													display: flex;
													align-items: center;
													justify-content: space-around;
													margin-bottom: 10px;">
									<img src="<?php echo $s_pic?>" alt="" style="width: 30%; border-radius: 50px;">
									<h6><?php echo $s_name;?></h6>
									</div>
									<div style="    position: relative;
													display: flex;
													align-items: center;
													justify-content: space-around;
													margin-bottom: 10px;">
									<a href="grade_assignment.php?as_id=<?php echo $asid ?>&studentid=<?php echo $sub?>">
									<i class="fa fa-file" aria-hidden="true"></i>
									<?php echo $count_sub ;?> files added</a></div>
									
								</div>
								<?php
							}
						}
						
				   
				   ?>
				   </div>
				   
				   </div>

				   <?php
				   
			   }
               ?>
           </div> 
        </div>
        </form>
      </div>
    </div>
  </div>
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
					
					
						</script>
							<script>
						jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
							$('#submit_n').click(function(){
							$name=<?php echo $id;?>;
							$.ajax({
							url:"name.php",
							method:"POST",
							data:{phis:name}
						}).done(function(data){
							$('#result').html(data);
						});

});});

					</script>
						
						
						
						<script src=https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.js>
					</script><script src=https://cdnjs.cloudflare.com/ajax/libs/fetch/2.0.3/fetch.js></script>
					<script type=text/javascript src=./vendor.fb499262a9e09dc42cef.js></script>
					<script type=text/javascript src=./main.546310cb9577066438f3.js></script>
 	</div>
</body>
</html>