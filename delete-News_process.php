<!--Start Incolode Head  -->  
<?php
  session_start();
  $PageTitle = 'Delete News process';
  include "init.php";
?>
<!--End Incolode Head  -->

<!--start Content-->
  <div class="content">
    <div class="container">
    	<?php
    		$sql_news   = "	delete from `News` where `id` = '$_GET[id]' ";
        $query_news = mysqli_query($con,$sql_news) or die(mysqli_error($con));
        
        header('location:show-all-News.php');      		

    	?>
    </div> <!-- div class containers -->
  </div> <!--div class Content-->
<!--END content-->
<!-- Start Include Footer  -->
  <?php include_once("inc/footer.php");  ?>
<!-- End Include Footer  -->

</html>