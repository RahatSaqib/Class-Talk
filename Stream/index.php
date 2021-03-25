<?php
	
	
		
include("includes/header.php");


if(isset($_POST['post'])){

	$uploadOk = 1;
	
	$randstr='';
	$errorMessage = "";

	if(isset($_FILES['files']['name'])) {
		// $targetDir = "assets/images/posts/";
		// $imageName =  basename($imageName);
		// $imageFileType = pathinfo($imageName, PATHINFO_EXTENSION);


		// if(strtolower($imageFileType) != "jpeg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpg") {
		// 	$errorMessage = "Sorry, only jpeg, jpg and png files are allowed";
		// 	$uploadOk = 0;
		// }
		$keyLength= 10;
			$swap="1234567890";
			$randstr=substr(str_shuffle($swap),0,$keyLength);
			$keyExist="";
			while ($keyExist==  true) {
				$randstr=substr(str_shuffle($swap),0,$keyLength);
				
				$ch= "SELECT * FROM files";
			$res= mysqli_query($con,$ch);
			while($row = mysqli_fetch_assoc($res)){
				if($row['postid']==$randstr){
					$keyExist= true;
					
				}
				else{
					$keyExist= false;
					break;
				}
		
			}
			}
			$c=$_FILES['files']['name'][0] ;
			if($c!=''){
			for($i=0;$i<count($_FILES['files']['name']);$i++){
			$filename= $_FILES['files']['name'][$i];
			$targetDir = "assets/files/";
			$filename = basename($filename);

			

			mysqli_query($con,"insert into files (files,postid) values('$filename','$randstr')");

		move_uploaded_file($_FILES['files']['tmp_name'][$i],$targetDir.$filename);
		}

		}

	}
	

	if($uploadOk) {
		  $sub_post =$_SESSION['stored']  ;
		$post = new Post($con, $userLoggedIn);
		$post->submitPost($_POST['post_text'], 'none', $randstr,$sub_post);
		header("Location:index.php?$msg_by_code");
	}
	else {
		echo "<div style='text-align:center;' class='alert alert-danger'>
				$errorMessage
			</div>";
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
			<a href="">
			Title :<?php 
			echo $row['title'];?><br>
			
			Class Name :<?php
			echo $row['class_name'];


			 ?>
			</a>
			<br>
			
			<p name="code">Class Code :<?php
				echo $_SESSION['stored'];
			
	 ?></p>
		</div>

	</div>
	<div class="user_details column">

		<div style='display:flex;justify-content:space-between;align-item:center;padding-bottom:10px'><h5 style='margin-bottom:0'>Recent Classworks</h5>
		<i style= 'color:red'class="fa fa-star" aria-hidden="true"></i>
		<i style= 'color:red'class="fa fa-star" aria-hidden="true"></i>
		<i style= 'color:red'class="fa fa-star" aria-hidden="true"></i>
		</div>

		<div class="trends">
			<?php 
		$count=0;
			$query = mysqli_query($con, "SELECT * from assignment where class_code='$msg_by_code' ");

			while($row=mysqli_fetch_array($query)) {
				$due_date=$row['duedate'];
				if(strtotime(date("Y-m-d")) > strtotime($due_date)){
					
					
					
				}
				else{
					$word1 = $row['title'];
					$code = $row['id'];

					echo "<div style'padding: 1px'>
					
					<a href='assign_assignment.php?as_id=$code'>
					<p>$word1</p>
					</a>
					 </div>
					 ";
					 $count++;
					 
				}
				
					
				
				


			}
			if($count==0){
			echo '	<p>No classworks.</p>	';
			}

			?>
		</div>


	</div>

	<div class="user_details column">

<h4>Courses</h4>

<div class="trends">
	<?php 
	$s_id=$_SESSION['id'];
	$sql=mysqli_query($con,"select id from users where gid='$s_id'");
	$fetch=mysqli_fetch_array($sql);
	$user_id=$fetch['id'];
	$query = mysqli_query($con, "SELECT * FROM enrolled_class where PersonID='$user_id' and status='enroled'");

	while($row=mysqli_fetch_array($query)) {
		
		$word = $row['class_id'];
		
		$query1 = mysqli_query($con, "SELECT * FROM classes where class_code='$word'");
		while($fetch_row=mysqli_fetch_array($query1)){
			$word1 = $fetch_row['class_name'];
			$code = $fetch_row['class_code'];

			echo "<div style'padding: 1px'>
			
			<a href='index.php?id=$code'>
			<h4>$word1</h4>
			</a>
			 </div>
			 ";
			 
		}
		


	}

	?>
</div>


</div>
 
 <style>
 .main_column {
	float:right;
	width: 100%;
	z-index: -1;
	min-height: 170px;
	/* position: relative; */
}
	.attach{
		display: flex;
    align-items: center;
    justify-content: space-around;
  
	padding: 10px;
	cursor: pointer;
    border-radius: 20px;
    border: 1px solid #d8d0d0;
	height: 50px;
    padding-top: 15px;
    width: 20%;

	}
	.attach:hover{
		background:#138f61;
		color:white;
		transition:0.1s;
	}
	.row .filetype {
		width: 200px;
		float: left;
		height: 40px;
		overflow: hidden;
		border: 1px solid #d9d4d4;
		margin: 10px;
		border-radius: 10px;
		padding: 10px;
	}
</style>
<link href='file-upload-with-preview.min.css' rel=stylesheet>
<script src="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.js"></script>
 </div>
 <div class="col-md-8">
 	<div class="main_column column" style="">
		<form class="post_form" action="index.php" method="POST" enctype="multipart/form-data">
		<div class="col-md-12">
		<div class="attach" onClick="togglemenu();" style="">
			<h2>+</h2><h6>Attach Files</h6>
		</div>
			<div id="content">

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
			</div>



		
				</div>
				
		
		<div class="form-froup" style="display:flex;">
			<div class="col-md-10"><textarea name="post_text" id="post_text" placeholder="Got something to say?"></textarea></div>

			<div class="send col-md-2">
			<label for="post_button">
			<div class="send-icon">
			<img src="img/arrow.png" style="width: 40px;height: 40px;" alt="">
			</div>
			
			</label>
			<input style="display:none" type="submit" class="btn" name="post" id="post_button">
			</div>
		</div>
		
		

		

		</form>

		<div class="posts_area col-md-12"></div>
		<!-- <button id="load_more">Load More Posts</button> -->
		<img id="loading" src="assets/images/icons/loading.gif">


	</div>
	</div>
 
 </div>
 <script src=https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.js>
					</script><script src=https://cdnjs.cloudflare.com/ajax/libs/fetch/2.0.3/fetch.js></script>
					<script type=text/javascript src=./vendor.fb499262a9e09dc42cef.js></script>
					<script type=text/javascript src=./main.546310cb9577066438f3.js></script>
<script>
	
	var upload = new FileUploadWithPreview("myUniqueUploadId");
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

	<script>
	var userLoggedIn = '<?php echo $userLoggedIn; ?>';

	$(document).ready(function() {
		var temp = $('.user_details_left_right p').text();
	

		$('#loading').show();

		//Original ajax request for loading first posts 
		$.ajax({
			url: "includes/handlers/ajax_load_posts.php",
			type: "POST",
			data: "page=1&userLoggedIn=" + userLoggedIn,
			cache:false,

			success: function(data) {
				$('#loading').hide();
				$('.posts_area').html(data);
			}
		});
		


		$(window).scroll(function() {
		//$('#load_more').on("click", function() {

			var height = $('.posts_area').height(); //Div containing posts
			var scroll_top = $(this).scrollTop();
			var page = $('.posts_area').find('.nextPage').val();
			var noMorePosts = $('.posts_area').find('.noMorePosts').val();

			if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
			//if (noMorePosts == 'false') {
				$('#loading').show();

				var ajaxReq = $.ajax({
					url: "includes/handlers/ajax_load_posts.php",
					type: "POST",
					data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
					cache:false,

					success: function(response) {
						$('.posts_area').find('.nextPage').remove(); //Removes current .nextpage 
						$('.posts_area').find('.noMorePosts').remove(); //Removes current .nextpage 
						$('.posts_area').find('.noMorePostsText').remove(); //Removes current .nextpage 

						$('#loading').hide();
						$('.posts_area').append(response);
					}
				});

			} //End if 

			return false;

		}); //End (window).scroll(function())


	});

	</script>




	</div>
</body>
</html>