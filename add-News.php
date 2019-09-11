<!--Start Incolode Head  -->  
<?php
  session_start();
  $PageTitle = 'Add News';
  include "init.php";?>
<!--End Incolode Head  -->
<!--start Content-->      
<div class="container">  

<!-- ======================================================================================== -->
<!--Start Form News -->
<!-- ======================================================================================== -->
<?
//Create Writing the next condition of settings from the database With Function CheckRow
$row = CheckRow( "settings" , 'id' , 2 );
// Direct user To Login And Continue Add News
    if($row['allow'] !== 1 AND !isset($_SESSION['Name_student']) ){
      header('location:login.php?add_news');
      die();
    }//if($row['allow'] !== 1 AND !isset($_SESSION['Name_student'])){
?>
  <h1 class="text-center">Please Add News</h1>
<?php
  
  if(isset($_GET['erros_Advertising'])){          
    if(isset($_SESSION['send_err'] ) ){

      foreach ($_SESSION['send_err'] as $errors) {
        echo "<div class='ChEr text-center'>". $errors . '</div> <br />';
      }//foreach ($_SESSION['send_err'] as  $errors)        
      session_unset();

    }//if(isset($_GET['erros_Advertising']))
  }//if(isset($_SESSION['send_err'] ) )

?>
<!-- ======================================================================================== -->
<!--End Form News -->
<!-- ======================================================================================== -->          

<form class="form-horizontal" action="add-News-process.php" method="POST" enctype="multipart/form-data" >

<!-- Start Title Field -->
  <div class="form-group form-group-lg">
          <label class="col-sm-2 control-label">Title</label>
          <div class="col-sm-10 col-md-5">
            <input class="form-control" type="text" name="title" placeholder="Title" />
          </div>
  </div>
<!-- End Title Field --> 

<!-- Start content Field -->
            <div class="form-group form-group-lg" >
                <label class="col-sm-2 control-label">content</label>
                <div class="col-sm-10 col-md-5">
                  <textarea class="form-control" placeholder="Content" name="content"></textarea>
                </div> 
            </div>
<!-- End content Field -->
<!-- Start Choose file Field -->
<div class="form-group">
      <label class="col-sm-2 control-label">Choose File</label>
      <div class="col-sm-offset-2 col-sm-">
        <input class="btn btn-primary btn-lg-file"  type="file" name="profile" value="upload"/>
      </div>
    </div>
<!-- End Choose file Field --> 
<!-- Start Submit Field -->
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <input class="btn btn-primary btn-lg" type="submit" name="submit" value="Save" />
    </div ><!-- <div class="col-sm-offset-2 col-sm-10"> -->
</div><!-- <div class="form-group"> -->
<!-- End Submit Field -->
  </form> <!--form action="add-News-process.php" method="POST" enctype="multipart/form-data" -->

<!-- End Login Form -->

<!--END content-->

<!-- Start Include Footer  -->
  <? include $tpl . "footer.php";?>
<!-- End Include Footer  -->
