<!--Start Incolode Head  -->
<?php
	session_start();
	$PageTitle = 'personel page';
	include "init.php";
 ?>
	<div class="container">  
<!--End Incolode Head  -->

<!--start Content-->
	<div class="containers">
		<?php
		// Check Acount in DataBase
			$sql_user 	= " select * from `Student` where `id` = '$_SESSION[user_id]' ";
			$query_user	= mysqli_query($con,$sql_user) or die(error());
			$row		= mysqli_fetch_assoc($query_user);
?>

	<!-- Start Register -->
	      <div class="form">
	        <div class="error_red">
	        <?php
	        // print_r($_SESSION['send_errors']);
	          if(isset($_GET['errors'])){

	            if(isset($_SESSION['send_errors'])){

	              foreach($_SESSION['send_errors'] as $key => $error){
	               echo $error;
	              }//foreach($_SESSION['send_error'] as $error)

	               // session_unset(); 
	               // session_destroy();

	            }//if(isset($_SESSION['send_error']))  

	          }//if(isset($_GET['errors'])){
	        ?>
	      </div>
	        <h2>Create an account</h2>
	        <form class="form-horizontal" action="personel-page-pro.php" method="POST">
				<!-- Start Name Field -->
				<div class="form-group form-group-lg">
					<label class="col-sm-2 control-label">Name</label>
					<div class="col-sm-10 col-md-5">
						<input type="text" name="name" value="<?php echo $row['name'] ; ?>" class="form-control" autocomplete="off" placeholder="Name To Login Into School"  />
					</div>
				</div><!-- <div class="form-group form-group-lg"> -->
			<!-- End Name Field -->
			
			<!-- Start password Field -->
				<div class="form-group form-group-lg" >
					<label class="col-sm-2 control-label">password</label>
					<div class="col-sm-10 col-md-5">
						<input type="password" name="password"  class="password form-control" autocomplete="new-password" placeholder="Password Must Be Hard & Complex "  />
						<i class="show-pass fa fa-eye fa-2x"></i>
					</div> 
				</div><!-- <div class="form-group form-group-lg"> -->
			<!-- End password Field -->
			
			<!-- Start Email Field -->
				<div class="form-group form-group-lg">
					<label class="col-sm-2 control-label">Email</label>
					<div class="col-sm-10 col-md-5">
						<input type="email" name="email" value="<?php echo $row['email'] ; ?>" class="form-control" placeholder="Email Must Be Valid"  />
					</div>
				</div><!-- <div class="form-group form-group-lg"> -->
			<!-- End Email Field -->
						
			<!-- Start Address Field -->
			<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Address</label>
							<div class="col-sm-10 col-md-5">
								<input type="text" name="Address" value="<?php echo $row['Address'] ; ?>" class="form-control" placeholder="Address Appear In Your Profile Page"   />
							</div>
						</div>
			<!-- End Address Field -->

			<!-- Start Submit Field -->
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<input type="Submit" value="Update" class="btn btn-primary btn-lg" />
							</div>
						</div>
			<!-- End Submit Field -->
	        </form> <!-- form action="register-process.php" method="POST" -->
	      </div><!-- div class="form" -->
	<!-- End Register -->	

</div> <!-- div class containers -->
<!--END content-->
<!-- Start Include Footer  -->
	<? include $tpl . "footer.php";?>  
<!-- End Include Footer  -->

</html>

