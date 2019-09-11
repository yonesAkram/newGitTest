<!--Start Incolode Head  -->
  <?php include("config/config.php");  ?>
<!--End Incolode Head  -->

<!DOCTYPE html>
<html>
<!--Start Incolode Head  -->
  <?php include("inc/head.php");  ?>
<!--End Incolode Head  -->

<!-- Start include Header -->
  <?php include('inc/header.php'); ?>
<!-- End include Header -->
<!--start Content-->
  <div class="content">
    <div class="containers">
      <div id="show-ad">
    	<?php 

      //Getting show one Advevtising in Page
        $sql_select    = " select * from `products` where `id` = $_GET[id] " ;
        $query_select  = mysqli_query($con,$sql_select) or die(error());
        $row       = mysqli_fetch_assoc($query_select);

      //Getting show username
        $sql_user   = " select * from `user` where `id` = '$row[user_id]' ";
        $query_user = mysqli_query($con,$sql_user) or die(error());
        $row_user   = mysqli_fetch_assoc($query_user);
    		
    			echo $row['title'] . '<br />';
    			echo "<div id='image-AD'>"." <img src='./uploade/".$row['profile'] . "' /> ".'</div>';
    			echo $row['content'] . '<br />';
    			echo $row['date'] . '<br />';
    			echo $row_user['username'] . '<br />'. '<br />'. '<br />';
    					
    	?>
<!-- Start create Links Delete And Edit -->
    	<div class="del_edit">
    		<?php
        // echo $_SESSION['user_id']  . '=>' .$row['user_id'] . '<br />' ;
        
          if($_SESSION['user_id'] == $row_user['id']):  

      	     echo"<a href='delete-advertising.php?id=$row[id]'>Del</a>" . 
      	     "<a href='edit_advert.php?id=$row[id]'>Update</a>" ;

          endif;    
    		?>
    	</div>	
<!-- End create Links Delete And Edit -->
      </div>
    </div> <!-- div class containers -->
  </div> <!--div class Content-->
<!--END content-->
<!-- Start Include Footer  -->
  <?php include("inc/footer.php");  ?>
<!-- End Include Footer  -->

</html>
