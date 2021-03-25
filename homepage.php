<?php
require_once 'config.php' ;
// if(isset($_SESSION['access_code']))
// {
//  //Create a URL to obtain user authorization
//  header('location:join.php');
//  exit();


// }

//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received

$login_button = $client->createAuthUrl();

?>



<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width-device-width,intial-scale=1.0">
        <title>Online Classroom Management System</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container container1">
            <div class="navbar1">
                <img src="img/LOGO1.png" class="logooo">
                <nav class="home_nav">
                    <ul id="menu-list">
                        <li><a href="">Log In</a></li>
                        <li><a href="">Create Account</a></li>
                    </ul>
                </nav>
                <img src="img/menu.png" class="menu-icon" onclick="togglemenu()">
            </div>
            <div class="roww">
                <div class="col-1">
                    <h2>Join Classroom</h2>
                    <h3>Create a communication between Teachers and Students.</h3>
                    <button type="button" class="log_in" onClick="window.location= '<?php echo $login_button ?>'">Log In With Google<img src="img/arrow.png"> </button>
                </div>
                <div class="col-2">
                    <img src="img/Online.png" class="online_img" alt="">
                    <div class="color-box"></div>
                </div>
            </div>
            
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
    </body>
</html>