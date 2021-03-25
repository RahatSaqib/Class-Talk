<?php session_start();
include('include/config.php');


    $author=$_SESSION['author'];




    $md_name='N/A';
       
            $_SESSION['name']=$_POST['name'];
            $_SESSION['day']=$_POST['day'];
            $_SESSION['p_id']=$_POST['p_id'];
            $_SESSION['phone']=$_POST['phone'];
            $_SESSION['birth_date']=$_POST['birth_date'];
            $_SESSION['age']=$_POST['age'];
            $_SESSION['gender']=$_POST['gender'];
            $_SESSION['Weight']=$_POST['Weight'];
            $_SESSION['Pressure']=$_POST['Pressure'];
            $_SESSION['Problem']=$_POST['Problem'];
            $_SESSION['history']=$_POST['history'];
            $_SESSION['oex']=$_POST['oex'];
            $_SESSION['pd']=$_POST['pd'];
           
          
            
            
           
            $_SESSION['comments']=$_POST['prescription_comment'];
            






          
            $pid=$_SESSION['uniqueid'];
            $name=$_POST['name'];
            $phone=$_POST['phone'];
            // $birth_date=$_POST['birth_date'];
            $age=$_POST['age'];
            $gender=$_POST['gender'];
            $Problem=$_POST['Problem'];
            $Weight =$_POST['Weight'];
            $Pressure =$_POST['Pressure'];
            $temperature =$_POST['temperature'];
            $history =$_POST['history'];
            $oex =$_POST['oex'];
            $pd =$_POST['pd'];
            $type =[];
            $md_name =[];
            $mg =[];
            $dose =[];
            $day =[];
            $comments=[];
            $prescription_comment =$_POST['prescription_comment'];
            $te_name = [];
            $test_description =[];
            $adv =[];


            $number = count($_POST['te_name']);
			$num2 = count($_POST['test_description']);
			
			$mdname = count($_POST['md_name']);
			$mgnum = count($_POST['mg']);
			$dosenum = count($_POST['dose']);
			$daynum = count($_POST['day']);
			$comnum = count($_POST['comments']);
			$adnum = count($_POST['adv']);


		
                if($mdname >= 1)
                {
                    for($i=0; $i<$mdname; $i++)
                    {
                        $count=$i+1;
                        if(trim($_POST['md_name'][$i] != ''))
                        {
                            // $sql = "INSERT INTO tbl_name(name) VALUES('".mysqli_real_escape_string($connect, $_POST["name"][$i])."')";
                            // mysqli_query($connect, $sql);
                            if($i==0){
                                $md_name=  $count . "." .  $_POST['md_name'][$i];
                            }
                            else{
                                $md_name=    $md_name . " " .$count .".". $_POST['md_name'][$i];
                            }
                           
                            
                            
                        }

                    }


				

				if($mgnum >= 1)
                {
                    for($i=0; $i<$mgnum; $i++)
                    {
                        $count=$i+1;
                        if(trim($_POST['mg'][$i] != ''))
                        {
                            // $sql = "INSERT INTO tbl_name(name) VALUES('".mysqli_real_escape_string($connect, $_POST["name"][$i])."')";
                            // mysqli_query($connect, $sql);
                            if($i==0){
                                $mg=  $count .  "." . $_POST['mg'][$i];
                            }
                            else{
                                $mg=    $mg . " " .$count .".". $_POST['mg'][$i];
                            }
                           
                            
                            
                        }

                    }


				}
				if($dosenum >= 1)
                {
                    for($i=0; $i<$dosenum; $i++)
                    {
                        $count=$i+1;
                        if(trim($_POST['dose'][$i] != ''))
                        {
                            // $sql = "INSERT INTO tbl_name(name) VALUES('".mysqli_real_escape_string($connect, $_POST["name"][$i])."')";
                            // mysqli_query($connect, $sql);
                            if($i==0){
                                $dose=  $count .  "." . $_POST['dose'][$i];
                            }
                            else{
                                $dose=    $dose . " " .$count .".". $_POST['dose'][$i];
                            }
                           
                            
                            
                        }

                    }


				}
				if($daynum >= 1)
                {
                    for($i=0; $i<$daynum; $i++)
                    {
                        $count=$i+1;
                        if(trim($_POST['day'][$i] != ''))
                        {
                            // $sql = "INSERT INTO tbl_name(name) VALUES('".mysqli_real_escape_string($connect, $_POST["name"][$i])."')";
                            // mysqli_query($connect, $sql);
                            if($i==0){
                                $day=  $count .  "." . $_POST['day'][$i];
                            }
                            else{
                                $day=    $day . " " .$count .".". $_POST['day'][$i];
                            }
                           
                            
                            
                        }

                    }


				}
				if($comnum >= 1)
                {
                    for($i=0; $i<$comnum; $i++)
                    {
                        $count=$i+1;
                        if(trim($_POST['comments'][$i] != ''))
                        {
                            // $sql = "INSERT INTO tbl_name(name) VALUES('".mysqli_real_escape_string($connect, $_POST["name"][$i])."')";
                            // mysqli_query($connect, $sql);
                            if($i==0){
                                $comments=  $count . "." .  $_POST['comments'][$i];
                            }
                            else{
                                $comments=    $comments . " " .$count .".". $_POST['comments'][$i];
                            }
                           
                            
                            
                        }

                    }


				}
				


			}
			if($adnum >= 1)
                {
                    for($i=0; $i<$adnum; $i++)
                    {
                        $count=$i+1;
                        if(trim($_POST['adv'][$i] != ''))
                        {
                            // $sql = "INSERT INTO tbl_name(name) VALUES('".mysqli_real_escape_string($connect, $_POST["name"][$i])."')";
                            // mysqli_query($connect, $sql);
                            if($i==0){
                                $adv=  $count .  "." . $_POST['adv'][$i];
                            }
                            else{
                                $adv=    $adv . " " .$count .".". $_POST['adv'][$i];
                            }
                           
                            
                            
                        }

                    }


				}

           
            if($number >= 1)
            {
                for($i=0; $i<$number; $i++)
                {
                    $count=$i+1;
                    if(trim($_POST['te_name'][$i] != ''))
                    {
                        // $sql = "INSERT INTO tbl_name(name) VALUES('".mysqli_real_escape_string($connect, $_POST["name"][$i])."')";
                        // mysqli_query($connect, $sql);
                        if($i==0){
                            $te_name=  $count ."." .$_POST['te_name'][$i];
                        }
                        else{
                            $te_name= $te_name . " " . $count . ".". $_POST['te_name'][$i];
                            

                        }
                      
                        
                    }

                }
                if($num2 >= 1)
                {
                    for($i=0; $i<$num2; $i++)
                    {
                        $count=$i+1;
                        if(trim($_POST['test_description'][$i] != ''))
                        {
                            // $sql = "INSERT INTO tbl_name(name) VALUES('".mysqli_real_escape_string($connect, $_POST["name"][$i])."')";
                            // mysqli_query($connect, $sql);
                            if($i==0){
                                $test_description=  $count . "." . $_POST['test_description'][$i];
                            }
                            else{
                                $test_description=    $test_description . " " .$count .".". $_POST['test_description'][$i];
                            }
                           
                            
                            
                        }

                    }
                    


                        

                }
            }
            $_SESSION['permission']='no';
            if($name!=null && $te_name!=null && $adv!=null && $md_name!=null && $Problem!=null){
               $_SESSION['permission']='Yes';

               $sql=mysqli_query($con,"INSERT into prescription(pid,name,phone,age,gender,Problem,Weight,Pressure,temperature,history,oex,pd,type,md_name,
               mg,dose,day,comments,prescription_comment,te_name,test_description,adv,doctorsauthor) 
               values('$pid','$name','$phone','$age','$gender','$Problem','$Weight','$Pressure','$temperature','$history','$oex'
               ,'$pd','','$md_name','$mg','$dose','$day','$comments','$prescription_comment','$te_name','$test_description','$adv','$author' )");
               if($sql)
               {
               echo "<script>alert('Prescription info added Successfully');</script>";
              

               }

               else{
                   echo "<script>alert('Prescription info not added');</script>";
   }


            }
            
            $_SESSION['te_name']=$te_name;
            $_SESSION['adv']=$adv;
            // $_SESSION['type']=$type;
            $_SESSION['md_name']=$md_name;
            $_SESSION['mg']=$mg;
            $_SESSION['dose']=$dose;
            $_SESSION['day']=$day;
            $_SESSION['dose']=$dose;
			
            $_SESSION['current_date']= date("Y-m-d H:i:s");
            
           
            
					







