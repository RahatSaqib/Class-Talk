<?php
include('includes/header.php');
$msg_by_code=$_SESSION['stored'];
$sql= mysqli_query($con,"SELECT * from assignment where class_code='$msg_by_code' and deleted='' order by id desc");



$userLoggedIn = $user_obj->getUsername();
$query=mysqli_query($con,"select created_by from classes where class_code='$msg_by_code'");
$row=mysqli_fetch_array($query);
$msg=$row['created_by'];
$userc = strip_tags($msg); //Remove html tags
$userc = str_replace(' ', '', $userc); //remove spaces
$Uquery=mysqli_query($con,"select username,id from users where username='$userLoggedIn'");
$row1=mysqli_fetch_array($Uquery);
$msg_UNAME=$row1['id'];
$userl = strip_tags($msg_UNAME); //Remove html tags
$userl = str_replace(' ', '', $userl); //remove spaces
if($userl == $userc){
$create_assignment= "<a href='createclass.php' style='color: #f8f9fa;text-decoration:none'>
<div class='col-md-1' style='    background: #27ac5c;
color: #f8f9fa;
margin: 0 auto;
display: flex;
justify-content: space-around;
border-radius: 20px;
cursor: pointer;
align-items: center;
align-content: center;
padding:10px'>

+&nbsp;Create</div></a>";
$src="view_assignment.php";
}
else{
$create_assignment='';
$src="assign_assignment.php";

}


?>
<div class="container-fluid">

<?php echo $create_assignment; ?>

<div class="col-md-12">
    <h2>Classworks</h2>
    <div class="assignment row">
    <?php
    if(mysqli_num_rows($sql)>0){
        while($row=mysqli_fetch_assoc($sql)){
            ?>
            <div class="wrap">
                <div class='a-image'>
                    <img src="assets/images/icons/assign2.png" alt="" style="max-width:25px;">
                </div>
                <a href="<?php echo $src;?>?as_id=<?php echo $row['id']?>" style="width: calc(100% - 4.75rem - 2.5rem - 1rem);    color: #105f9a;
    font-weight: 900;margin-top:10px">
                <div class='title'>
                   <h4> <?php echo $row['title']?></h4>
                </div>
                </a>
                <div class="date">
                Posted on <?php echo $row['date']?>

                </div>

                </div>
        
        <?php
        }
        
    }
    else{
        ?>
        <center style="margin:0 auto;padding-top:200px;"><h1>No classworks!!</h1></center>
        <?php
    }
    
    ?>
    </div>


</div>
</div>