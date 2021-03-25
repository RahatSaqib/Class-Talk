<?php

include('includes/header.php');
if(isset($_POST['phis'])){
    $history_post=$_POST['phis'];
    $query = mysqli_query($con, "UPDATE assignment SET deleted='yes' WHERE id='$history_post'");
    header("Location:index.php?id='$stored'");
}


?>