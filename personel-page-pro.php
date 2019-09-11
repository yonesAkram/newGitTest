<!--Start Incolode Head  -->
<?php
	session_start();
	$PageTitle = 'Personel Page Process';
	include "init.php";
 ?>
	<div class="container">  
<!--End Incolode Head  -->

<!--start Content-->
<?php
  // Create Variable Errors :
        // $_SESSION['send_errors'][]  = '' ;
        $errors = '' ;
###########################################################################################

        //secuirty input
        $name = mysqli_real_escape_string($con,$_POST['name']);
// Make sure the user does not repeat Username 
        $sql_select   = " select * from `Student` where `name` = '$name' ";   
        $query_select = mysqli_query($con,$sql_select) or die(mysqli_error($con));        
        $count        = mysqli_num_rows($query_select);                                  
// Send error username for page register                                                 
        if($count > 0 ){                  

          $errors = 1 ;                                                                
          $_SESSION['send_errors'][]  = "Count-User".'<br />';
          header('location:personel_page.php');                                                   
        
        }// if($count > 0 )                                                              
                                                                                                
// Send error username for page register                                                  
        if(empty($name)){                                                    

          $_SESSION['send_errors'][]  = "empty-Name<br>";                                                               
          $errors = 1 ;                                                                   

        }//if(empty($_POST['username'])                                                 

###########################################################################################

###########################################################################################
// security Input password
        $pass = mysqli_real_escape_string($con,$_POST['password']);                                                                                       
// Send error username for page register
        if($pass == 5 ){                                                     
            $_SESSION['send_errors'][]  = "larger than 6 password <br />";                                                               
            $errors = 1 ;                                                                 
        }// if($count > 0 )                                                                    
                                                                                                
// Send error username for page register                                                  
        if(empty($pass)){                                                    
            $errors = 1 ;                                                                   
            $_SESSION['send_errors'][]  = "empty-password<br />";

        }//if(empty($_POST['username'])      
                                                     
###########################################################################################

###########################################################################################
// security Input email
        $email = mysqli_real_escape_string($con,$_POST['email']);                                                                                       
// Make sure the user does not repeat                                                     
        $sql_select   = " select * from `Student` where `email` = '$email' ";         
        $query_select = mysqli_query($con,$sql_select) or die(mysqli_error($con));        
        $count        = mysqli_num_rows($query_select);                                   
// Send error email for page register                                                     
        if($count > 0 ){                                                                  
            
            $_SESSION['send_errors'][]  = "count-email<br />";

        }// if($count > 0 )                                                                     
                                                                                                
// Send error email for page register                                                     
        if(empty($email)){    

          $_SESSION['send_errors'][]  = "empty-email<br />";                                                                    
        
        }//if(empty($_POST['username'])               

###########################################################################################
 
###########################################################################################
// security Input email
$Address = mysqli_real_escape_string($con,$_POST['Address']);                                                                                       
// Make sure the user does not repeat                                                     
        $sql_select   = " select * from `Student` where `Address` = '$Address' ";         
        $query_select = mysqli_query($con,$sql_select) or die(mysqli_error($con));        
        $count        = mysqli_num_rows($query_select);                                                                                                       
                                                                                                
// Send error email for page register                                                     
        if(empty($Address)){    

          $_SESSION['send_errors'][]  = "empty-Address<br />";                                                                    
        
        }//if(empty($_POST['username'])                            
###########################################################################################   

        // Rcorde data in Database
              $sql_user  = " insert INTO `Student`(`name`,`password`,`email`,`Address`)
                              VALUES
                            ('$name','$pass','$email','$Address') " ;

        if( $errors == 1 ) {
          header('location:personel_page.php?errors');
        } //if( $errors == 1 )

      // Send data to the database after confirmation that there are no Erroes
        if($errors == 0 ){        
          $query_ins = mysqli_query($con,$sql_user) or die(error());
          $row          = mysqli_fetch_assoc($query_ins);

          $_SESSION['Name_student'] = $row['name'];
            echo "thanks";
        }
      ?>

      </div> <!-- div class containers -->

  <!--END content-->
<!-- Start Include Footer  -->
  <?php include("inc/footer.php");  ?>
<!-- End Include Footer  -->

</html>