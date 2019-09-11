<?php
session_start();
$PageTitle = 'Register';
include "init.php";
?>
    <div class="container">
    <h1 class="text-center">Add New Result</h1>
    <form class="form-horizontal" action ="add_result_process.php" method="POST">
        
<!-- Start Student ID Field -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Student ID</label>
            <div class="col-sm-10 col-md-5">
                <input type="number" name="name" value="" class="form-control" autocomplete="off" placeholder="Name To Login Into School"  />
            </div>
        </div><!-- <div class="form-group form-group-lg"> -->
<!-- End Student ID Field -->

<!-- Start Student ID Field -->
<div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Student ID</label>
            <div class="col-sm-10 col-md-5">
                <input type="number" name="qw" value="" class="form-control" autocomplete="off" placeholder="Name To Login Into School"  />
            </div>
        </div><!-- <div class="form-group form-group-lg"> -->
<!-- End Student ID Field -->
<!-- Start Student ID Field -->
<div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Student ID</label>
            <div class="col-sm-10 col-md-5">
                <input type="number" name="er" value="" class="form-control" autocomplete="off" placeholder="Name To Login Into School"  />
            </div>
        </div><!-- <div class="form-group form-group-lg"> -->
<!-- End Student ID Field -->
<!-- Start Student ID Field -->
<div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Student ID</label>
            <div class="col-sm-10 col-md-5">
                <input type="number" name="ty" value="" class="form-control" autocomplete="off" placeholder="Name To Login Into School"  />
            </div>
        </div><!-- <div class="form-group form-group-lg"> -->
<!-- End Student ID Field -->
<!-- Start Student ID Field -->
<div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Student ID</label>
            <div class="col-sm-10 col-md-5">
                <input type="number" name="as" value="" class="form-control" autocomplete="off" placeholder="Name To Login Into School"  />
            </div>
        </div><!-- <div class="form-group form-group-lg"> -->
<!-- End Student ID Field -->
<!-- Start Student ID Field -->
<div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Student ID</label>
            <div class="col-sm-10 col-md-5">
                <input type="number" name="df" value="" class="form-control" autocomplete="off" placeholder="Name To Login Into School"  />
            </div>
        </div><!-- <div class="form-group form-group-lg"> -->
<!-- End Student ID Field -->





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
    