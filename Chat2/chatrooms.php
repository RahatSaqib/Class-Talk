<?php 
    
    // session_start();

    require_once("dbcon.php");

    if (checkVar($_SESSION['userid'])): 
 
        $getRooms = "SELECT *
        			 FROM chat_rooms";
        $roomResults = mysqli_query($con,$getRooms);		  

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <title>Chat Rooms</title>
    
    <link rel="stylesheet" type="text/css" href="main.css"/>
</head>

<body>

    <div id="page-wrap"> 
    
    	<div id="header">
    	
        	<h1><a href="/examples/Chat2/">Chat v2</a></h1>
        	
        	<div id="you"><span>Logged in as:</span> <?php echo $_SESSION['userid']?></div>
        	
        </div>
        
    	<div id="section">
    	
            <div id="rooms">
            	<h3>Rooms</h3>
                <ul>
                    <?php 
                        while($rooms = mysqli_fetch_array($roomResults)):
                            $room = $rooms['name'];
                            $query = i("SELECT * FROM `chat_users_rooms` WHERE `room` = '$room' ") or die("Cannot find data". mysqli_error());
                            $numOfUsers = mysqli_num_rows($query);
                    ?>
                    <li>
                        <a href="room/?name=<?php echo $rooms['name']?>"><?php echo $rooms['name'] . "<span>Users chatting: <strong>" . $numOfUsers . "</strong></span>" ?></a>
                    </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
        
    </div>

</body>

</html>

<?php 

    else: 
	   header('Location: http://css-tricks.com/examples/Chat2/');
	   
	endif;
	
?>