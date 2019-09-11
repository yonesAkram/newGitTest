<?php
session_start();
$PageTitle = 'Edite News';
include "init.php";
?>

<!--start Content-->
  
<div class="container"> 
  <?php $sql_products   = " select * from `News` WHERE `id` = '$_GET[id]' ";
    		$query_news	    = mysqli_query($con,$sql_products) or die(error());
    		$row 			      = mysqli_fetch_assoc($query_news);?>
    	        
  <!-- End Login Form -->

    <div class="container">
    <?php
      if(isset($_GET['erros_Advertising'])){     
        if(isset($_SESSION['send_err'] ) ){

          foreach ($_SESSION['send_err'] as  $errors) {
            echo $errors . '<br />';
          }//foreach ($_SESSION['send_err'] as  $errors)
          session_destroy();
          session_unset();
        }//if(isset($_GET['erros_Advertising']))
      }//if(isset($_SESSION['send_err'] ) )

    ?>
              
    <form class="form-horizontal" action="edit_News-process.php" method="POST" enctype="multipart/form-data">
      <h1>Page Edit NEWS</h1>
      <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
      <!-- Start Title Field -->
        <div class="form-group form-group-lg">
          <label class="col-sm-2 control-label">Title</label>
          <div class="col-sm-10 col-md-5">
            <input class="form-control" type="text" name="title" value="<?php echo$row['title']; ?>"/>
          </div>
        </div>
      <!-- End Title Field -->   
      <!-- Start content Field -->
        <div class="form-group form-group-lg" >
          <label class="col-sm-2 control-label">Content</label>
          <div class="col-sm-10 col-md-5">
            <textarea class="form-control " name="content" ><?php echo $row['content']; ?> </textarea>
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
            </div>
        </div>
      <!-- End Submit Field -->

    </form> <!--form action="add-advertising-process.php" method="POST" enctype="multipart/form-data" -->

  <!-- End Login Form --> 
</div> <!-- div class containers -->
  
<!--END content-->

<!-- Start Include Footer  -->
<? include $tpl . "footer.php";?>
<!-- End Include Footer  -->
