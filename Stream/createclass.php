<?php

include("includes/header.php");
if($_SESSION['id']==null){
    header("Location:../homepage.php");
}


if(isset($_POST['submit'])){
    $filecount= count($_FILES['files']['name']);
        $msg_by_code=$_SESSION['stored'];
    
    $keyLength= 10;
    $swap="1234567890";
    $randstr=substr(str_shuffle($swap),0,$keyLength);
    $keyExist="";
    while ($keyExist==  true) {
        $randstr=substr(str_shuffle($swap),0,$keyLength);
        
        $ch= "SELECT * FROM assignment";
    $res= mysqli_query($con,$ch);
    while($row = mysqli_fetch_assoc($res)){
        if($row['filesid']==$randstr){
            $keyExist= true;
            
        }
        else{
            $keyExist= false;
            break;
        }

    }
    }
    
    $title=$_POST['title'];
    $inst=$_POST['instruct'];
    $uploadedby=$_SESSION['id'];
    $keyLength= 5;
    $swap="1234567890";
    $randstr=substr(str_shuffle($swap),0,$keyLength);
    $keyExist="";
    while ($keyExist==  true) {
        $randstr=substr(str_shuffle($swap),0,$keyLength);
        
        $ch= "SELECT * FROM assignment";
    $res= mysqli_query($con,$ch);
    while($row = mysqli_fetch_assoc($res)){
        if($row['assignmentID']==$randstr){
            $keyExist= true;
            
        }
        else{
            $keyExist= false;
        }

    }
        
    }
    $date=$_POST['birth_date'];
    $c=$_FILES['files']['name'][0] ;
    if($c!=''){
        for($i=0;$i<$filecount;$i++){
            $filename=$_FILES['files']['name'][$i];
            $targetDir = "assets/files/";
            $filename = basename($filename);
            mysqli_query($con,"insert into files (assignmentID,files) values('$randstr','$filename')");
        move_uploaded_file($_FILES['files']['tmp_name'][$i],$targetDir.$filename);
        }
        
    }
    $sql=mysqli_query($con,"INSERT into assignment (title,instruction,duedate,uploadedby,filesid,class_code,assignmentID,deleted) values('$title','$inst','$date',' $uploadedby','$randstr','$msg_by_code','$randstr','')");
        $ch2= "SELECT * FROM users where gid='$uploadedby'";
        $res2= mysqli_query($con,$ch2);
        $row1 = mysqli_fetch_assoc($res2);
        $up=$row1['username'];
        $ch3= "SELECT * FROM assignment where assignmentID='$randstr'";
        $res3= mysqli_query($con,$ch3);
        $row3 = mysqli_fetch_assoc($res3);
        $up2=$row3['id'];
        $notification = new Notification($con, $userLoggedIn);

        $notification->insertNotification($up2, $up, "assignment",$msg_by_code);
    
    header('Location:classwork.php');
    
}

?>

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


	<!-- CSS -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	
	<!-- <link rel="stylesheet" type="text/css" href="assets/css/style.css"> -->
	<link rel="stylesheet" href="assets/css/jquery.Jcrop.css" type="text/css" />
 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>






</div>
<div class="container">
<div class="col-md-3" style="margin:0 auto"><h3>Assignment</h3></div>

    <div class="col-md-6" style="padding: 30px;
    /* display: flex; */
    border-radius: 10px;
    border: 1px solid #afa9a9;
    margin: 0 auto;">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-12">
                <label for="inputEmail4">Title</label>
                <input type="text" class="form-control" id="inputEmail4" name="title" placeholder="Title">
                </div>
                <div class="form-group col-md-12">
                <label for="inputPassword4">Instructions</label>
                <textarea type="text" class="form-control" id="inputPassword4" name="instruct" placeholder="Write Your Instructions"></textarea>
                </div>
            </div>
            <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputState">Due</label>
                           
                            <input type="datetime-local" autocomplete="off" name="birth_date" class="form-control datepicker1 birth_date hasDatepicker" placeholder="Birth date" id="dp1603524379919">
                            <div class="fileup col-md-12">
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
             
                        
                        <!-- <div class="form-group col-md-6">
                            <label for="inputStates">Topic</label>
                            <select id="inputStates" class="form-control">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div> -->
            </div>
        
        
        
        <input type="submit" class="btn btn-primary"  name="submit" id="submit" value="submit">
        </form>
        </div>
        <script>var upload = new FileUploadWithPreview("myUniqueUploadId");</script>
        <script src=https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.js>
					</script><script src=https://cdnjs.cloudflare.com/ajax/libs/fetch/2.0.3/fetch.js></script>
					<script type=text/javascript src=./vendor.fb499262a9e09dc42cef.js></script>
					<script type=text/javascript src=./main.546310cb9577066438f3.js></script>
   
   
    
</body></html>