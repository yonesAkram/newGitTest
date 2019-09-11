<?php
session_start();
$PageTitle = 'Register';
include "init.php";
?>
    <div class="container">
    <h1 class="text-center">Add New Member</h1>
<?          

// print_r($_SESSION['send_errors']);
    if(isset($_GET['errors'])){

        if(isset($_SESSION['send_errors'])){

            foreach($_SESSION['send_errors'] as $key => $error){
            
            echo "<div class='ChEr_Reg container'> ". $error . "</div>";
            }//foreach($_SESSION['send_error'] as $error)

            session_unset(); 

        }//if(isset($_SESSION['send_error']))  
    }//if(isset($_GET['errors'])){
?>    
    <form class="form-horizontal" action ="register-process.php" method="POST">
        
<!-- Start Name Field -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10 col-md-5">
                <input type="text" name="name" value="" class="form-control" autocomplete="off" placeholder="Name To Login Into School"  />
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
                <input type="email" name="email" class="form-control" placeholder="Email Must Be Valid"  />
            </div>
        </div><!-- <div class="form-group form-group-lg"> -->
<!-- End Email Field -->

<!-- Start Address Field -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Address</label>
            <div class="col-sm-10 col-md-5">
                <input type="text" name="Address" class="form-control" placeholder="Address Appear In Your Profile Page"   />
            </div>
        </div>
<!-- End Address Field -->

<!-- Start Submit Field -->
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="Submit" value="Add Member" class="btn btn-primary btn-lg" />
            </div>
        </div>
<!-- End Submit Field -->
    </form><!-- <form class="form-horizontal" action = "?do=insert" method="POST"> -->
</div><!-- div class="container" -->


<!-- Start Include Footer  -->
    <? include $tpl . "footer.php";?>
<!-- End Include Footer  -->
    