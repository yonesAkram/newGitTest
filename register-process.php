<!--Start Incolode Head  -->
<?session_start();
$PageTitle = 'Register Process';
include "init.php";
//<!--End Incolode Head  -->

//<!--Start content-->

//Create Variable Errors :
  $_SESSION['send_errors'][]  = '' ;
  $errors = '' ;
###########################################################################################
// Secuirty Sanitize Input 
  $users = CheckInput($_POST['name']);

// Make sure the user does not repeat Name 
  $count = CheckCount("Student" , "name" , "$users" );
                            
// Send error Name for page register                                                 
  if($count > 0 ){                  
    $errors = 1 ;                                                                
    $_SESSION['send_errors'][]  = "* Sorry Your Username is Exist " .'<br />';                                                   
  }// if($count > 0 )                                                              

// Send error Name for page register                                                  
  if(!empty($users)){                                                    
    // Make sure that the user name is written in permittivity
    if(strlen($users) <= 2 || strlen($users) > 36){
      $_SESSION['send_errors'][]  = " * The user must name no more than 36 characters Ahrvh for not less than Hrgin " ; 
      $errors = 1 ;      
    } // if(strlen($users) <= 2 || strlen($users) > 36)
    if(is_numeric($users[0])){
        $_SESSION['send_errors'][]  = '<strong>* Name must begin with a letter</strong><br />';
        $errors = 1 ;      
    }//if(is_numeric($users[0]))
  }else{
    $_SESSION['send_errors'][]  = " * Please Dont leave the field Name Empty<br>";                                                               
    $errors = 1 ;                                                                   
  }//(!empty($users)){                                                 
  
#############################################################################################################

###########################################################################################
// Secuirty Input password
$passw = CheckInput($_POST['password']);                                                                                      
// Send error Name for page register                                                  
if(empty($passw)){                                                    
    $errors = 1 ;                                                                   
    $_SESSION['send_errors'][]  = " * Please Dont leave the field password Empty<br />";
}else{    
// Send error Name for page register
  if(strlen($passw) < 3  || strlen($passw) > 30  ){                                                     
      $_SESSION['send_errors'][]  = "* larger than 3 password <br />";                                                               
      $errors = 1 ;                                                                 
  }// if($count > 0 )                                                                    
}//if(empty($passw)      
                                                     
###########################################################################################

###########################################################################################

// Secuirty Input Email &  Secuirty Sanitize Input
 
 $email = CheckInput($_POST['email']);

// Make sure the user does not repeat Name 
echo $EmailC = CheckCount("Student" , "email" , "$email" );
                           
// Send error Name for page register                                                 
 if($EmailC > 0 ){                  
   $errors = 1 ;                                                                
   $_SESSION['send_errors'][]  = "* Sorry Your Email is Exist " .'<br />';                                                   
 }// if($EmailC > 0 )                                                              

// Send error Name for page register                                                  
 if(!empty($email)){                                                    
   // Make sure that the user name is written in permittivity
   if(strlen($email) <= 2 || strlen($email) > 46){
     $_SESSION['send_errors'][]  = " * Email must name no more than 46 characters Ahrvh for not less than Hrgin " ; 
     $errors = 1 ;      
   } // if(strlen($users) <= 2 || strlen($users) > 26)
   if(is_numeric($email[0])){
       $_SESSION['send_errors'][]  = '<strong>* Email must begin with a letter</strong><br />';
       $errors = 1 ;      
   }//if(is_numeric($email[0]))
 }else{
   $_SESSION['send_errors'][]  = " * Please Dont leave the field Email Empty<br>";                                                               
   $errors = 1 ;                                                                   
 }//(!empty($users)){                                                 
 
###########################################################################################

###########################################################################################
// Secuirty Input Address
  $Address = CheckInput($_POST['Address']);
// Send error Address for page register                                                     
  if(empty($Address)){    
    $errors = 1 ;
    $_SESSION['send_errors'][]  = " * Please Dont leave the field Address Empty<br />";                                                                    
  }//  if(empty($Address)){ 
###########################################################################################
                            
###########################################################################################   
  // Send data to the database after confirmation that there are no Erroes
  if( $errors == 1 ){
    header('location:register.php?errors');
  }else{//if( $errors == 1 )
    $sql_Register = " insert into `Student` (`name`,`password`,`email`,`Address`,`GroupID`,`privilege`)
                      VALUES
                    ('$users','$passw','$email','$Address',0,0) " ;
    $query_Neme = mysqli_query($con,$sql_Register) or die(error()); 
    
      $_SESSION['Name_student'] = $_POST['name'];
      header('location:home.php');

  } //if( $errors == 1 )
?>

  <!--END content-->

<!-- Start Include Footer  -->
<? include $tpl . "footer.php";?>
<!-- End Include Footer  -->