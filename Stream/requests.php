<?php
include("includes/header.php"); //Header 

$class_code=$_SESSION['stored'];
?>
<div class="container">
<div class="main_column column" id="main_column">
<?php 
$sqli=mysqli_query($con,"select * from classes where class_code='$class_code'");
$TEACHER=mysqli_fetch_array($sqli);
$name=$TEACHER['created_by'];
$sqli2=mysqli_query($con,"select * from users where id='$name'");
$list=mysqli_fetch_array($sqli2);
?>

<h4>Teacher</h4>


<div class='search_result'>
					<div class='searchPageFriendButtons'>
						<form action='' method='POST'>
							<!-- " . $button . " -->
							<br>
						</form>
					</div>


					<div class='result_profile_pic'>
						<a href='profile.php?profile_username=<?php echo $list['username'] ?>"'><img src='<?php echo $list['profile_pic'] ?>' style='height: 100px;border-radius:80px;'></a>
					</div>

						<a href='profile.php?profile_username=<?php echo $list['username'] ?>'> <?php echo $list['first_name'] ?> <?php echo $list['last_name'] ?>"
						<p id='grey'> <?php echo $list['username']?></p>
						</a>
						<br>
						

				</div>
				<hr id='search_hr'>
				<?php


		

	

	?>


</div>


<div class="main_column column" id="main_column">

	<h4>Classmates</h4>

	<?php  

	$query = mysqli_query($con, "SELECT * FROM enrolled_class where class_id='$class_code' and status='enroled'");
	if(mysqli_num_rows($query) == 0)
		echo "You have no classmates at this time!";
	else {

		while($row = mysqli_fetch_array($query)) {
			$personid=$row['PersonID'];
			$sql=mysqli_query($con,"select * from users where id='$personid'");
			$class=mysqli_fetch_array($sql);
			if($list['id']!=$class['id']){

				?>
			<div class='search_result'>
					<div class='searchPageFriendButtons'>
						<form action='' method='POST'>
							<!-- " . $button . " -->
							<br>
						</form>
					</div>


					<div class='result_profile_pic'>
						<a href='profile.php?profile_username=<?php echo $class['username'] ?>'><img src='<?php echo $class['profile_pic'] ?>' style='height: 100px;border-radius:80px;'></a>
					</div>

						<a href='profile.php?profile_username=<?php echo $class['username'] ?>'> <?php echo $class['first_name'] ?> <?php echo $class['last_name'] ?>"
						<p id='grey'> <?php echo $class['username']?></p>
						</a>
						<br>
						

				</div>
				<hr id='search_hr'>
				<?php
			}
			


		}

	}

	?>


</div></div>
</div>

</body>
</html>