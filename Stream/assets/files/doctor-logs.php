<?php
session_start();
//error_reporting(0);
include('../../include/config.php');
include('include/checklogin.php');
check_login();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Pharmacist - Pharmacist list </title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="../../vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../../vendor/fontawesome/css/font-awesome.min.css">
		<link href="../../vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="../../vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="../../vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link href="../../vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		<link href="../../vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="../../vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="../../vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="../../assets/css/styles.css">
		<link rel="stylesheet" href="../../assets/css/plugins.css">
		<link rel="stylesheet" href="../../include/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" href="../../include/DataTables/Buttons-1.5.6/css/buttons.bootstrap4.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="include/sidebar-menu.css">


		<style media="screen">
			div#table_filter label::before{
					content:"🔍 ";
					font-size: 18px;
			}
		</style>
		</head>
	<body>
		<div id="app">
<?php include('include/sidebar-menu.php');?>
			<div class="app-content">


				
				<!-- end: TOP NAVBAR -->
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title" style="border-bottom:1px solid #4d79ff; background-color:#d6f5d6;">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Admin  | Doctor Session Logs</h1>
																	</div>
								<ol class="breadcrumb">
									<li>
										<span>Admin </span>
									</li>
									<li class="active">
										<span>Doctor Session Logs</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
						<div class="container-fluid container-fullw bg-white">


									<div class="row">
								<div class="col-md-12">

									<p style="color:red;"><?php echo htmlentities($_SESSION['msg']);?>
								<?php echo htmlentities($_SESSION['msg']="");?></p>
									<table class="table table-hover" id="sample-table-1">
										<thead>
											<tr>
												<th class="center">#</th>
												<th class="hidden-xs">User id</th>
												<th>Username</th>
												<th>User IP</th>
												<th>Login time</th>
												<th>Logout Time </th>
												<th> Status </th>


											</tr>
										</thead>
										<tbody>
<?php
$sql=mysqli_query($con,"select * from doctorslog ");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>

											<tr>
												<td class="center"><?php echo $cnt;?>.</td>
												<td class="hidden-xs"><?php echo $row['uid'];?></td>
												<td class="hidden-xs"><?php echo $row['username'];?></td>
												<td><?php echo $row['userip'];?></td>
												<td><?php echo $row['loginTime'];?></td>
												<td><?php echo $row['logout'];?>
												</td>

												<td>
<?php if($row['status']==1)
{
	echo "Success";
}
else
{
	echo "Failed";
}?>

</td>

											</tr>

											<?php
$cnt=$cnt+1;
											 }?>


										</tbody>
									</table>
								</div>
							</div>
								</div>

						<!-- end: BASIC EXAMPLE -->
						<!-- end: SELECT BOXES -->

					</div>
				</div>
			</div>
			<!-- start: FOOTER -->
	<?php include('../../include/footer.php');?>
			<!-- end: FOOTER -->

			<!-- start: SETTINGS -->


			<!-- end: SETTINGS -->
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
		<script src="../../vendor/jquery/jquery.min.js"></script>
		<script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="../../vendor/modernizr/modernizr.js"></script>
		<script src="../../vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="../../vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="../../vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="../../vendor/maskedinput/jquery.maskedinput.min.js"></script>
		<script src="../../vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="../../vendor/autosize/autosize.min.js"></script>
		<script src="../../vendor/selectFx/classie.js"></script>
		<script src="../../vendor/selectFx/selectFx.js"></script>
		<script src="../../vendor/select2/select2.min.js"></script>
		<script src="../../vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="../../vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="../../assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="../../assets/js/form-elements.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>
</html>
