<?php
session_start();
$PageTitle = 'Login Process';
include "init.php";
?>
<div class="container" >
<?
  if($_SERVER['REQUEST_METHOD'] != "POST"){
    $errorMsg =' Sorry You Cant Browse This Page Directry ';  
    redirect_Home($errorMsg , 5);
    die();  
  }
    // security input
    $user = $_POST['username'];
    $pass = $_POST['password'];
    // security input With Function
    $user = CheckInput($user);
    $pass =   CheckInt($pass);
    
  if(empty($user) or empty($pass)){
    // Direct To Check Input
    header('location:login.php?error_empty');      
  }else{ //if(empty($user) or empty($pass)){ 

    //Create select database user
    $count = CheckRow("Student" , "name" , "$user" , "password" , "$pass" ) ;

    $rowDB    = strtolower($count['name']);
    $UserInp  = strtolower($user);
    //Check in DataBase ::
    if($rowDB !== $UserInp ):
        header('location:login.php?check_login');
    else: // if($count == 0 )
    
      $_SESSION['user_id']  = $count['id'];
      $_SESSION['Name_student'] = $count['name'];
      $_SESSION['GroupID'] = $count['GroupID'];
// Function For Redirect News         
      if(isset($_GET['add_news']) ){
        $theMsg = "Thanks For Login" ;
        redirect_Home($theMsg , "add-News.php" , 3);        
        die();  
      }
      
      header('location:home.php');

    endif; // if($count == 0 )
  }//if(empty($_POST['username']) and empty($_POST['password'])):

    // redirectHome("Thanks For Login" , 'back'  );
  
  ?>
</div>