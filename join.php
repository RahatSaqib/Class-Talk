<?php

require_once 'config.php' ;

mysqli_select_db($con,"onlineclass") ;   
//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received

// if ($google_client->isAccessTokenExpired()) {
//     $oldAccessToken=$google_client->getAccessToken();
//     $google_client->fetchAccessTokenWithRefreshToken($google_client->getRefreshToken());
//     $accessToken=$google_client->getAccessToken();
//     $accessToken['refresh_token']=$oldAccessToken['refresh_token'];
//     file_put_contents($credentialsPath, json_encode($accessToken));
// }

$credentialsPath = 'token.json';
	$credentialsPath2 = 'refreshToken.json';
  if(isset($_GET["code"]))
  {
    $_SESSION["code"]=$_GET["code"];
    $authCode =$_SESSION["code"];

    $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
    $_SESSION['access_code'] = $accessToken;
    $refreshToken = $client->getRefreshToken();

  
  
    if (!file_exists(dirname($credentialsPath))) {
      mkdir($credentialsPath, 0700);
      if (!file_exists(dirname($credentialsPath2))) {
        mkdir($credentialsPath2, 0700);
      }
    }
   
    file_put_contents($credentialsPath, json_encode($accessToken));
    file_put_contents($credentialsPath2, json_encode($refreshToken));
   
header("Location:join.php");

  }
  else{
    $authCode =$_SESSION["code"];
  
		if (file_exists($credentialsPath)) {
      // $accessToken = json_decode(file_get_contents($credentialsPath), true);
      $accessToken= $_SESSION['access_code'] ;
    } 
    else {
			
  	// Exchange authorization code for an access token.
      $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
      $_SESSION['access_code'] = $accessToken;
			$refreshToken = $client->getRefreshToken();
	
		
		
			if (!file_exists(dirname($credentialsPath))) {
        mkdir($credentialsPath, 0700);
        if (!file_exists(dirname($credentialsPath2))) {
          mkdir($credentialsPath2, 0700);
        }
      }
     
			file_put_contents($credentialsPath, json_encode($accessToken));
			file_put_contents($credentialsPath2, json_encode($refreshToken));
			
    }
  }
 
    $client->setAccessToken($accessToken);
    $refreshToken = $client->getRefreshToken();
	
		if ($client->isAccessTokenExpired()) {
			// $refreshToken = json_decode(file_get_contents($credentialsPath2), true);
      $client->fetchAccessTokenWithRefreshToken($refreshToken);
      $_SESSION['access_code'] = $client->getAccessToken();
			file_put_contents($credentialsPath, json_encode($client->getAccessToken()));
    }
    // $accessToken = $client->fetchAccessTokenWithAuthCode($_GET["code"]);
    
 

 //It will Attempt to exchange a code for an valid authentication token.
//  $token = $client->fetchAccessTokenWithAuthCode($_GET["code"]);
  //Store "access_token" value in $_SESSION variable for future use.
 


  
 

if(isset($_SESSION['access_code']))
{
   
 //Create a URL to obtain user authorization
//  $client->setAccessToken();

//  $accessToken = json_decode();


	
		// Refresh the token if it's expired.
		
 

  


  //Create Object of Google Service OAuth 2 class
  $google_service = new Google_Service_Oauth2($client);
  

  //Get user profile data from google
  $data = $google_service->userinfo->get();
  

  //Below you can find Get profile data and store into $_SESSION variable
  if(!empty($data['given_name']))
  {
   $fname = $data['given_name'];
   $_SESSION['given_name'] = $fname;
  }
  if(!empty($data['id']))
  {
   $fid = $data['id'];
   $_SESSION['id'] = $fid;
  }

  if(!empty($data['family_name']))
  {
   $lname = $data['family_name'];
  }

  if(!empty($data['email']))
  {
   $fem = $data['email'];
  }

  if(!empty($data['gender']))
  {
   $gender = $data['gender'];
  }

  if(!empty($data['picture']))
  {
   $fimage = $data['picture'];
   $_SESSION['picture'] = $fimage;
  }
  $_SESSION['username'] =$data['given_name']. '_' .$data['family_name'];

  $check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email='".$data['email']."'");
  $check_login_query = mysqli_num_rows($check_database_query);
  if($check_login_query == 0) {
//This is for check user has login into system by using Google account, if User not login into system then it will execute if block of code and make code for display Login link for Login using Google account.
$sql="insert into users(gid,first_name,last_name,username,email,profile_pic,gender,user_closed)
                            values('".$data['id']."','".$data['given_name']."','".$data['family_name']."','".$data['given_name']. '_' .$data['family_name']."',
                            '".$data['email']."',
                            '".$data['picture']."','".$data['gender']."','no')";

                            mysqli_query($con,$sql);
  }


}


if(isset($_POST['join_class']))
{
  $SESSIONID= $_SESSION['id'];
        $search=mysqli_query($con,"SELECT id from users where gid='$SESSIONID'");
        $row=mysqli_fetch_array($search);
        $mid=$row['id'];
        $cls_code=$_POST['class_code'];
  $search1=mysqli_query($con,"SELECT * from enrolled_class where PersonID='$mid' and class_id='$cls_code'");
  $sql_en=mysqli_query($con,"SELECT * from enrolled_class where PersonID='$mid' and class_id='$cls_code' and status ='Unenrolled'");

if(mysqli_num_rows($search1)>0){
  if(mysqli_num_rows($sql_en)>0){
    mysqli_query($con,"UPDATE enrolled_class SET status='enroled' where PersonID='$mid' and class_id='$cls_code'");
  
  }
  else{
    echo "<script>alert('Already enroled');</script>";
    header("Location: join.php");
  }



}


else{
  $ins="insert into enrolled_class(class_id,PersonID,status) values('$cls_code','$mid','enroled')";
  $add=mysqli_query($con,$ins);
  $_SESSION['stored']=$cls_code;
  header("Location: Stream/index.php?id=$randstr");
}
        
 
}
if(isset($_POST['unenrole']))
{
$SESSIONID= $_SESSION['id'];
  $search=mysqli_query($con,"SELECT id from users where gid='$SESSIONID'");
        $row=mysqli_fetch_array($search);
        $mid=$row['id'];
  $unenrole=$_POST['cls'];
        
  $sqli=mysqli_query($con,"UPDATE enrolled_class set status='Unenrolled' where PersonID='$mid' AND class_id='$unenrole'");
  if($sqli){
    echo"<script>Swal.fire({
      position: 'top-end',
      icon: 'success',
      title: 'Your Assignment  has been Submitted',
      showConfirmButton: false,
      timer: 4000
    });</script>";
    header("Location: join.php");
  }
  

}
//-----create class----//
if(isset($_POST['create']))
{
    $keyLength= 5;
    $swap="abcdefghijklmnopqrstuvwxyz1234567890";
    $randstr=substr(str_shuffle($swap),0,$keyLength);
    $keyExist="";
    while ($keyExist==  true) {
        $randstr=substr(str_shuffle($swap),0,$keyLength);
        
        $ch= "SELECT * FROM keystring";
    $res= mysqli_query($con,$ch);
    while($row = mysqli_fetch_assoc($res)){
        if($row['keystring']==$randstr){
            $keyExist= true;
            
        }
        else{
            $keyExist= false;
        }

    }
        
    }
    $class_name= $_POST['class_name'];
    $secname= $_POST['sec_name'];
    $title= $_POST['title_name'];
    $SESSIONID= $_SESSION['id'];
       $mid=$row['id'];
    $search=mysqli_query($con,"SELECT id from users where gid='$SESSIONID'");
    
    $row=mysqli_fetch_array($search);
    $mid=$row['id'];
   $picture_a= $_SESSION['picture'] ;
    $sql="insert into classes(title,class_name,section,created_by,class_code,picture) 
    values('$title',' $class_name','$secname',' $mid','$randstr','$picture_a')";
    mysqli_query($con,$sql);
    
    $sql="insert into keystring (keystring) values ('$randstr')";
    mysqli_query($con,$sql);
    
     
        
        $ins="insert into enrolled_class(class_id,PersonID,status) values('$randstr','$mid','enroled')";
        $add=mysqli_query($con,$ins);
        $_SESSION['stored']=$randstr;
        header("Location: Stream/index.php?id=$randstr"); /* Redirect browser */
        

}

$str='';
$str1='';
$SESSIONID= $_SESSION['id'];
$search=mysqli_query($con,"SELECT id ,profile_pic from users where gid='$SESSIONID'");
$row=mysqli_fetch_array($search);
$mid=$row['id'];
$CL_CD='';
if(isset($_SESSION['store'])){
    $CL_CD=$_SESSION['store'];
}






?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styles.css">
   
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</head>

    <title>Online Classroom</title>
</head>

<body>
  
<div class="wrapper">
  <div class="navbar">
    <div class="navbar_left">
      <div class="logo">
      <a class="navbar-brand" href="#">
      <img src="img/LOGO1.png" alt="logo">
  </a>
      </div>
    </div>

    <div class="navbar_right">
    <div class="dropdown">
<button type="button" class="btn btn1 dropdown-toggle" data-toggle="dropdown">
Manage Class
</button>
<div class="dropdown-menu">
<a class="dropdown-item"data-toggle="modal" data-target="#addclass" href="#">Join Class</a>
<a class="dropdown-item" data-toggle="modal" data-target="#createclass"href="#">Add Class</a>

</div>

</div>
      
      <div class="profile">
        <div class="icon_wrap">
          <img src="<?php echo $fimage;?>" alt="profile_pic">
          <span class="name"><?php echo $fname;?></span>
          <i class="fas fa-chevron-down"></i>
        </div>

        <div class="profile_dd" style='z-index: 1;'>
          <ul class="profile_ul">
            <li class="profile_li"><a class="profile" href="#"><span class="picon"><i class="fas fa-user-alt"></i>
                </span>Profile</a>
              
            </li>
          
            <li><a class="logout" href="logout.php"><span class="picon"><i class="fas fa-sign-out-alt"></i></span>Logout</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  
  
  
</div> 

<!--signinModal-->
<div class="modal fade text-dark" id="addclass">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header text-center">
        <h5 class="modal-title text-center" id="addclass">Join Class</h5>
        <button class="close" data-dismiss="modal"><span>&times;</span></button>
    </div>
    <div class="modal-body">
        <form class="" action="join.php" method="post">

            <div class="form-group">
                <p>Ask your teacher for the class code, then enter it here.</p>
                <label for="classcode">Class Code</label>
                <input type="text" class="form-control" name="class_code" placeholder="Enter class code" >
                
            </div>
            <input type="submit" value='Join' style='width:100%' name="join_class" class="btn btn-primary"></input>
            
           
            
        </form>
    </div>          
</div>
</div>
</div>
<!--Create class-->
<div class="modal fade text-dark" id="createclass">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header text-center">
        <h5 class="modal-title text-center" id="addclass">Create Class</h5>
        <button class="close" data-dismiss="modal"><span>&times;</span></button>
    </div>
    <div class="modal-body">
        <form class="" action="join.php" method="post">

            <div class="form-group">
                <label for="classcode">Class Name</label>
                <input type="text" name="class_name"class="form-control" placeholder="Enter class name" >
                
            </div>
            <div class="form-group">
                <label for="classcode">Section</label>
                <input type="text"name="sec_name" class="form-control" placeholder="Enter Section" >
                
            </div>
            <div class="form-group">
                <label for="classcode">Title</label>
                <input type="text" name="title_name" class="form-control" placeholder="Enter Title" >
                
            </div>
            <input type="submit" style='width:100%' class="btn btn-primary" name ="create"id="create" value='Create'></input>
            
           
            
        </form>
    </div>          
</div>
</div>
</div>
<div class="teachers">
<div class="container-fluid">

<div class="row"> 
        <?php $data_query=mysqli_query($con,"SELECT * from enrolled_class where PersonID='$mid' and status='enroled'");
while($row=mysqli_fetch_assoc($data_query))
{
    $class_codesss=$row['class_id'];

    $class_id_search=mysqli_query($con,"SELECT * from classes where class_code='$class_codesss'");
    $class_row=mysqli_fetch_array($class_id_search);
   
    $class_n= $class_row['class_name'];
    $section_name= $class_row['section'];
    $title_name= $class_row['title'];
    $pic=$class_row['picture'];
    $idn=$class_row['created_by'];
    $clas_name_search=mysqli_query($con,"SELECT * from users where id='$idn'");
    $class_name_row=mysqli_fetch_array($clas_name_search);
    $Name=$class_name_row['first_name'];

        ?><div style='    margin-right: 20px;'>
                             
                             
            <div class="profilee">
               <form method="POST">
                 <a href="Stream/index.php?id=<?php echo $class_codesss; ?>">         
                    <div class="title-row"> 
                    <img src="<?php echo $pic;?>" class="user img-fluid">
                    <h5><?php echo $Name; ?></h5>
                    <h6><?php echo $class_n; ?></h6>
                    <p class="cls_code"><?php echo $class_codesss; ?></p>
                    
                    </a>

                   </div>


            <div style=" bottom: 10px;
            position: absolute;" data-toggle="dropdown" ><i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </div>
            <div class="dropdown-menu">
           
            <a class="dropdown-item" data-toggle="modal" data-target="#<?php echo $row['class_id'];?>" data-bookid="hhh">Unenroll</a>
            </div>
            
            </div>
</form>
            </div>
           
            <div class="modal fade text-dark" id="<?php echo $row['class_id'];?>"  >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header text-center">
              <h5 class="modal-title text-center" id="addclass">Unenroll Class</h5>
              <button class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
              <form action="" method='POST'>

                  <div class="form-group">
                      <p>Do you want to unenroll class ?</p>
                
                    
                      <input type="text" name="cls" style='display:none;'class='cls form-control' id="bookId" value="<?php echo $row['class_id'];?>">
                      <!-- <p name="cls" class='cls' id="bookId" value=""></p> -->
                  </div>
                  
                  <input type="submit" name="unenrole"  class="btn btn-primary" value="Yes"></input>
                  
                
                  </form> 
              </div>
            </div>          
            </div>
            </div>         
            

<?php
}?>
     
</div>

</div>

</div>







  <script>

$('#unenroll').on('show.bs.modal', function (event) {
  var bookId = $(event.relatedTarget).data('bookid') 
  $(this).find('input[name="cls"]').val(bookId);
});
    
</script>

   
    <script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

</script>

 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    
</body>
<script>
$(document).on('click','.submit',function(){
         // get the current row
         var currentRow=$(this).closest("tr"); 
         
         var col1=currentRow.find("td:eq(1)").text(); // get current row 1st TD value
		 
		
         $.ajax({
            url:'getCode.php',
                        method:'POST',
                        data:{getCode:col2}
		}).done(function(data){
			$('#result').html(data);
        });
        
        
    });
});


                </script>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10.12.6/dist/sweetalert2.all.min.js'></script>

                <script>
		$(document).ready(function(){
			$(".profile .icon_wrap").click(function(){
			  $(this).parent().toggleClass("active");
			  $(".notifications").removeClass("active");
			});

			$(".notifications .icon_wrap").click(function(){
			  $(this).parent().toggleClass("active");
			   $(".profile").removeClass("active");
			});

			$(".show_all .link").click(function(){
			  $(".notifications").removeClass("active");
			  $(".popup").show();
			});

			$(".close").click(function(){
			  $(".popup").hide();
			});
		});
	</script>


</html>

