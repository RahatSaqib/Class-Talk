<?php 
include("includes/header.php");

$message_obj = new Message($con, $userLoggedIn);
$msg_by_code=$_SESSION['stored'];

if(isset($_GET['profile_username'])) {
	$username = $_GET['profile_username'];
	$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
	$user_array = mysqli_fetch_array($user_details_query);

	$num_friends = (substr_count($user_array['friend_array'], ",")) - 1;
}



if(isset($_POST['remove_friend'])) {
	$user = new User($con, $userLoggedIn);
	$user->removeFriend($username);
}

if(isset($_POST['add_friend'])) {
	$user = new User($con, $userLoggedIn);
	$user->sendRequest($username);
}
if(isset($_POST['respond_request'])) {
	header("Location: requests.php");
}

if(isset($_POST['post_message'])) {
  if(isset($_POST['message_body'])) {
    $body = mysqli_real_escape_string($con, $_POST['message_body']);
    $date = date("Y-m-d H:i:s");
    $type='';
    $message_obj->sendMessage($username, $body, $date,$msg_by_code,$type,'');
  }

  $link = '#profileTabs a[href="#messages_div"]';
  echo "<script> 
          $(function() {
              $('" . $link ."').tab('show');
          });
        </script>";


}

 ?>

 	<style type="text/css">
	 	.wrapper {
	 		margin-left: 0px;
			padding-left: 0px;
     }
     .nav-tabs > li  {
  margin-right: 2px;
  line-height: 1.42857143;
  border: 1px solid #c7c7c74a;
  border-radius: 4px 4px 0 0;
  
  padding:10px;
}
@import url("https://fonts.googleapis.com/css?family=Poppins&display=swap");
@import url("https://fonts.googleapis.com/css?family=Bree+Serif&display=swap");


.profile-header{
  background: #fff;
  height: 190px;
  width: 100%;
  display: flex;
  position: relative;
  box-shadow: 0px 3px 4px rgba(0,0,0,.2);
}
.profile-img{
  float: left;
  width: 340px;
  height: 200px;
}
.profile-img img{
  border-radius: 50%;
  height: 230px;
  width: 230px;
  border: 4px solid #fff;
  box-shadow: 0px 5px 10px rgba(0,0,0,.2);
  position: absolute;
  left: 50px;
  top: 20px;
  z-index: 5;
  background: #fff;
}
.profile-nav-info{
  float: left;
  flex-direction: column;
  justify-content: center;
  padding-top: 60px;
}
.profile-nav-info h3{
  font-variant: small-caps;
  font-size: 2rem;
  font-family: sans-serif;
  font-weight: bold;
}
.profile-nav-info .address{
  display: flex;
  font-weight: bold;
  color: #777;
}
.profile-nav-info .address p{
  margin-right: 5px;
}
.profile-option{
  width: 40px;
  height: 40px;
  background: var(--color);
  position: absolute;
  right: 50px;
  top: 50%;
  transform: translateY(-50%);
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
  transition: all .5s ease-in-out;
  outline: none;
}
.profile-option .notification i{
  color: #fff;
  font-size: 1.2rem;
  transition: all .5s ease-in-out;
}

.profile-option:hover{
  background: #fff;
  border: 1px solid var(--color);
}
.profile-option:hover .notification i{
  color: var(--color);
}
.profile-option .notification .alert-message{
  position: absolute;
  top: -5px;
  right: -5px;
  background: #fff;
  color: var(--color);
  border: 1px solid;
  padding: 5px;
  border-radius: 50%;
  height: 20px;
  width: 20px;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: .8rem;
  font-weight: bold;

}
.main-bd{
  width: 100%;
  display: flex;
  padding-right: 15px;
}
.profile-side{
  /* width: 300px; */
  background: #fff;
  box-shadow: 0px 3px 5px rgba(0,0,0,.2);
  padding: 90px 30px 20px;
  font-family: 'Bree serif', serif;
  /* margin-left: 10px; */
  z-index: 99;
  height: 100%;

}
.profile-side p{
  margin-bottom: 7px;
  color: #333;
  font-size: 14px;
}
.profile-side p i{
  color: var(--color);
  margin-right: 10px;
}
.mobile-no i{
  transform: rotateY(180deg)
}
.profile-btn{
  display: flex;
}
button.chatbtn{
  color:black;
}
button.chatbtn,
button.createbtn{
  border: 0;
  padding: 10px;
  width: 100%;
  border-radius: 3px;
  background: var(--color);
  font-family: 'Bree serif', serif;
  font-size: 1rem;
  margin: 5px 2px;
  cursor: pointer;
  outline: none;
  margin-bottom: 10px;
  transition: background .3s ease-in-out;
  box-shadow: 0px 5px 7px 0px rgba(0,0,0,.3);
  color: #fff;
}
button.chatbtn:hover,
button.createbtn:hover{
  background: rgba(288,0,70,.9);
}
button.chatbtn i,
button.createbtn i{
  margin-right: 5px;
}
.user-rating{
  display: flex;
}
.user-rating h3{
  font-size: 2.5rem;
  font-weight: 200;
  margin-right: 5px;
  letter-spacing: 1px;
  color: #666;
}
.user-rating .no-user{
  font-size: .9rem;
}
.rate{
  padding-top: 6px;
}
.rate i{
  font-size: .9rem;
  color: var(--color);
}
.nav{
  width: 100%;
  z-index: -1;
}
.nav ul{
  display: flex;
  justify-content: center;
  list-style-type: none;
  height: 40px;
  background: #fff;
  box-shadow: 0px 2px 5px rgba(0,0,0,.3);
}
.nav ul li{
  padding: 10px;
  width: 100%;
  cursor: pointer;
  text-align: center;
  transition: all .2s ease-in-out;

}
.nav ul li.active,
.nav ul li:hover{
  box-shadow: 0px -3px 0px rgba(288,0,70,.9) inset;
}
.profile-body{
  width: 100%;
  z-index: -1;

}
.tab{
  padding: 20px;
  width: 100%;
  text-align: center;
  display: none;
}
#see-more-bio,
#see-less-bio{
  color: blue;
  cursor: pointer;
  text-transform: lowercase;
}
@media (max-width: 1100px) {
  .profile-side{
    width: 250px;
    padding: 90px 15px 20px;
  }
  profile-img img{
    height: 200px;
    width: 200px;
    left: 50px;
    top: 50px;
  }
}
@media (max-width: 900px) {
  body{
    margin: 0 20px;
  }
  .profile-header{
    display: flex;
    height: 100%;
    flex-direction: column;
    text-align: center;
    padding-bottom: 20px;
  }
  .profile-img{
    float: left;
    width: 100%;
    height: 200px;
  }
  .profile-img img{
    position: relative;
    left: 0;
  }
  .profile-nav-info{
    text-align: center;
  }
    .profile-nav-info .address{
      justify-content: center;
    }
  .profile-option{
    right: 20px;
    top: 75%;
    transform: translateY(50%)
  }
  .main-bd{
    flex-direction: column;
    padding-right: 0px;
  }
  .profile-side{
    width: 100%;
    text-align: center;
    padding: 20px;
    margin: 5px 0;
  }
  .user-rating{
    justify-content: center;
  }
  @media (max-width: 400px) {
    body{
      margin: 5px;
    }
    .profile-header h3{
      font-size: 1.7rem;
    }
    .profile-header p,
    .profile-header span{
      font-size: .9rem;
    }
    .profile-option{
      width: 30px;
      height: 30px;
      position: absolute;
      right: 15px;
      top: 83%;
    }
    .profile-option .notification .alert-message{
      top: -3px;
      right: -4px;
      padding: 4px;
      height: 15px;
      width: 15px;
      font-size: .7rem;
    }
  }
}


   </style>
   <div class="container-fluid">
   <div class="col-md-12"> 
     <div class="profile-header">
            <div class="profile-img">
            <img src="<?php echo $user_array['profile_pic']; ?>">
            </div>
            <div class="profile-nav-info">
                <h3 class="user-name"><?php echo $username; ?></h3>
                <div class="address">
                    <!-- <p class="state">Dhaka,</p>
                    <span class="country">Bangladesh.</span> -->
                </div>
            </div>
            <!-- <div class="profile-option">
                <div class="notification">
                    <i class="fa fa-bell"></i>
                    <span class="alert-message">1</span>
                </div>
            </div> -->
        </div>
      </div>
    <div style='display:flex'>
	<div class="col-md-4">
  <div class="">
  <div class="left-side">
                <div class="profile-side">
                    <!-- <p class="mobile-no"><i class="fa fa-phone"></i>01267383999</p>
                    <p class="user-mail"><i class="fa fa-envelope"></i>abc234@gmail.com</p> -->
                   
                    <div class="profile_info">
 			<p><?php echo "Posts: " . $user_array['num_posts']; ?></p>
 		
 		</div>

 		<form action="<?php echo $username; ?>" method="POST">
 			<?php 
 			$profile_user_obj = new User($con, $username); 
 			if($profile_user_obj->isClosed()) {
 				header("Location: user_closed.php");
 			}

 			$logged_in_user_obj = new User($con, $userLoggedIn); 

 			if($userLoggedIn != $username) {

 				if($logged_in_user_obj->isFriend($username)) {
 					echo '<input type="submit" name="remove_friend" class="danger" value="Remove Friend"><br>';
 				}
 			
 				

 			}

 			?>
 		</form>
 		

    <?php  
    if($userLoggedIn != $username) {
      echo '<div class="profile_info_bottom">';
        echo $logged_in_user_obj->getMutualFriends($username) . " Mutual friends";
      echo '</div>';
    }


    ?>
                    <div class="profile-btn">
                        <button class="chatbtn" data-toggle="modal" data-target="#post_form" value="Post Something"><i class="fa fa-plus">Post Something</i></button>
                        
                    </div>
                    
                </div>
            </div>
 		

 	

 	</div>
  </div>
 
<div class="col-md-8">
<div class="profile_main_column column">

    <ul class="nav nav-tabs" role="tablist" id="profileTabs">
      <li role="presentation" class="active"><a href="#newsfeed_div" aria-controls="newsfeed_div" role="tab" data-toggle="tab">Newsfeed</a></li>
      <li role="presentation"><a href="#messages_div" aria-controls="messages_div" role="tab" data-toggle="tab">Messages</a></li>
    </ul>

    <div class="tab-content">

      <div role="tabpanel" class="tab-pane active" id="newsfeed_div">
        <div class="posts_area"></div>
        <img id="loading" src="assets/images/icons/loading.gif">
      </div>


      <div role="tabpanel" class="tab-pane" id="messages_div">
        <?php  
        

          echo "<h4>You and <a href='" . $username ."'>" . $profile_user_obj->getFirstAndLastName() . "</a></h4><hr><br>";

          echo "<div class='loaded_messages' id='scroll_messages'>";
            echo $message_obj->getMessages($username,$msg_by_code);
          echo "</div>";
        ?>



        <div class="message_post">
          <form action="" method="POST">
              <textarea name='message_body' id='message_textarea' placeholder='Write your message ...'></textarea>
              <input type='submit' name='post_message' class='info' id='message_submit' value='Send'>
          </form>

        </div>

        <script>
          $('a[data-toggle="tab"]').on('shown.bs.tab', function () {
              var div = document.getElementById("scroll_messages");
              div.scrollTop = div.scrollHeight;
          });
        </script>
      </div>


    </div>
    </div>  
    
	</div>

</div>

	

<!-- Modal -->
<div class="modal fade" id="post_form" tabindex="-1" role="dialog" aria-labelledby="postModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="postModalLabel">Post something!</h4>
      </div>

      <div class="modal-body">
      	<p>This will appear on the user's profile page and also their newsfeed for your friends to see!</p>

      	<form class="profile_post" action="" method="POST" enctype="multipart/form-data">
      		<div class="form-group">
      			<textarea class="form-control" name="post_body"></textarea>
      			<input type="hidden" name="user_from" value="<?php echo $userLoggedIn; ?>">
      			<input type="hidden" name="user_to" value="<?php echo $username; ?>">
      		</div>
          <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="post_button" value='Post' id="submit_profile_post"></input>
      </div>
      	</form>
      </div>


     
      <?php if(isset($_POST['post_button'])){
          $randstr='';
          $sub_post =$_SESSION['stored']  ;
          $post = new Post($con, $userLoggedIn);
          $post->submitPost($_POST['post_body'], 'none', $randstr,$sub_post);
          header("Location:index.php?$msg_by_code");

        }?>
    </div>
  </div>
</div>

</div>
<script>
  var userLoggedIn = '<?php echo $userLoggedIn; ?>';
  var profileUsername = '<?php echo $username; ?>';

  $(document).ready(function() {

    $('#loading').show();

    //Original ajax request for loading first posts 
    $.ajax({
      url: "includes/handlers/ajax_load_profile_posts.php",
      type: "POST",
      data: "page=1&userLoggedIn=" + userLoggedIn + "&profileUsername=" + profileUsername,
      cache:false,

      success: function(data) {
        $('#loading').hide();
        $('.posts_area').html(data);
      }
    });

    $(window).scroll(function() {
      var height = $('.posts_area').height(); //Div containing posts
      var scroll_top = $(this).scrollTop();
      var page = $('.posts_area').find('.nextPage').val();
      var noMorePosts = $('.posts_area').find('.noMorePosts').val();

      if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
        $('#loading').show();

        var ajaxReq = $.ajax({
          url: "includes/handlers/ajax_load_profile_posts.php",
          type: "POST",
          data: "page=" + page + "&userLoggedIn=" + userLoggedIn + "&profileUsername=" + profileUsername,
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