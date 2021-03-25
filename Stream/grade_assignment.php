<?php
include('includes/header.php');
if(isset($_GET['as_id'])){
    $_SESSION['as_id']=$_GET['as_id'];
    $asid=$_SESSION['as_id'];
}
if(isset($_GET['studentid'])){
    $_SESSION['sid']=$_GET['studentid'];
    $sub=$_SESSION['sid'];
}
if(isset($_GET['fileid'])){
    $_SESSION['grade']=$_GET['fileid'];
    $gradefile=$_SESSION['grade'];
    $asid=$_SESSION['as_id'];
    $sub=$_SESSION['sid'];
}
else{ 
    $asid=$_SESSION['as_id'];
     $sub=$_SESSION['sid'];
    }
        $search_name=mysqli_query($con,"select * from users where gid='$sub'");
								$sub_name=mysqli_fetch_array($search_name);
								$s_pic=$sub_name['profile_pic'];
								$s_name=$sub_name['first_name'];

?>
                    <div class="container-fluid">
                <div class="col-md-12">
                    <!-- <embed src="https://drive.google.com/viewerng/
                    viewer?embedded=true&url=" type="" width="100%" height="600px" /> -->
                    <div class="col-md-6" style="float:left">
                    <?php
                     $as=mysqli_query($con,"select * from assignment where id='$asid'");
                     $as_n=mysqli_fetch_array($as);
                     $ass_n=$as_n['title'];
                    ?>
                    <h3><?php echo $ass_n;?></h3>
                    <hr>
                    <div style="    position: relative; display: flex;
													align-items: center;
													justify-content: ;
													margin-bottom: 10px;">
					<img src="<?php echo $s_pic?>" alt="" style="width: 10%; border-radius: 50px;margin:20px">
                    <h5><?php echo $s_name;?></h5>
					</div>
                    <div class="form-row">
                    <h4>Files</h4>
                    <?php
                    $search_file=mysqli_query($con,"select * from files where submittedID='$asid' AND  submittedby='$sub'");
                    if(mysqli_num_rows($search_file)>0){
                        while($sub_file=mysqli_fetch_array($search_file)){
                            $files=$sub_file['files'];
                            ?>
                            <div class="s_file" style="    padding: 10px;
                                                            /* border-bottom: 1px solid #d0cccc; */
                                                            width: 100%;
                                                            border: 1px solid #d0cccc;">
                            <a href="grade_assignment.php?fileid=<?php echo $files;?>" style="color:grey"><?php echo $files;?></a>
                            </div>
                            <?php
                        
                        }
                    }
                    
                    ?>
                    </div>
                    <div class="form-row">
                    <form action="" method="POST">
                    <label for="inputEmail4"><h3>Mark</h3></label>
                     <input type="text" class="form-control" id="inputEmail4" name="mark" placeholder="?/100">
                     <input type="submit" class="form-control" id="inputEmail4" name="submit" value="Add Mark">
                     </form>
                     <?php
                     if(isset($_POST['submit'])){
                         $mark=$_POST['mark'];
                         mysqli_query($con,"update submission set mark='$mark' where assignmentID='$asid' AND  submittedBy='$sub'");
                         header("Location:grade_assignment.php?as_id=$asid&studentid=$sub");
                     }
                     ?>
                                    </div>
                                        
                                    </div>
                
                <div class="col-md-6" style="float:left"><embed src="assets/files/<?php echo $gradefile;?>" style="width:100%; height:700px;" frameborder="0"></embed>
            </div>
                </div>
</div>
    </div>
</body></html>