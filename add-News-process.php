<!--Start Incolode Head  -->  
<?php
  session_start();
  $PageTitle = 'Add News-process';
  include "init.php";?>
<!--End Incolode Head  -->

<!--start Content-->      
<div class="container"> 
<!--start Content-->
  <div class="content">
    <div class="containers">
      <?php

########################################
//Create Variable Errors :
      $error_AD = '' ;
      $_SESSION['send_err'][] = "";
########################################

// ====>  Validate Form don't Empty Title <====== //
         // Secuirty Input Title
            $title = CheckInput($_POST['title']);
            
            if(empty($title)){
              $error_AD = 1;
              $_SESSION['send_err'][] = "Sorry , Dont leave Title Empty";
            }//if(empty($_POST['title'])){

// ====>  Validate Form don't Empty Content <====== //
          // Secuirty Input Content
          $content = CheckInput($_POST['content']);            

            if (empty($content)) {
              $error_AD = 1 ;
              $_SESSION['send_err'][] = "Sorry , Dont leave content Empty";
            }//if (empty($_POST['content'])) {
###############################################
##  Statr ==>  Create Code Profile Uploade   ##
###############################################

            if(isset($_FILES['profile'])) {
           
  // Uploade Variable
              $profile_name = $_FILES['profile']['name'];
              $profile_size = $_FILES['profile']['size'];
              $profile_tmp  = $_FILES['profile']['tmp_name'];
              $profile_type = $_FILES['profile']['type'];

  // List Of Allowed File Typed TO Upoade
              $allowed = [ 'jpeg','JPG','png','gif','txt' ];
              $tmp = explode('.', $profile_name);
              $file_extension = end($tmp);
              $pro_ext = strtolower($file_extension);

    // GET Profile extension
            if(in_array($pro_ext, $allowed)){
              // echo "extension-in";
              $error_AD = 1 ;
              $_SESSION['send_err'][] = "This Extension is Not Allowed";
            }//if(in_array($pro_ext, $allowed) and !empty($profile_name)){

            if($profile_size >= 5242880 ){
              $error_AD = 1 ;
              $_SESSION['send_err'][] = "Sorry , File larger Than 5 MB";
            }//if($profile_size >= 5242880 ){

            if ( $error_AD  == 0 ){
              $profile_new_name = uniqid('',true) . '.' . $pro_ext ;
              // move_uploaded_file($profile_tmp, "./uploade\\".$profile_new_name);
                 $file_destin = "./layout/images\\". $profile_new_name ;
  // echo "out-uploade<br>"; 
                 if(move_uploaded_file($profile_tmp, $file_destin)){
             //echo "In - Good";
           
                 }//if(move_uploaded_file($profile_tmp, $file_destin))

              } //if ( $error_AD  != 1)

          } //if (isset($_FILE['profile']))

  #################################                ######################################
          // Creating condition comfirm show errors
            if($error_AD == 1){
              // header('location:add-News.php?erros_Advertising');
            } // if($error_AD == 1)
  ########################################################################################

        if(isset($_SESSION['user_id'])){
          echo'mesha3awez leh';

          $user_id = $_SESSION['user_id'];
        }else{
          $user_id = null;
        }//if(isset($_SESSION['user_id'])){

  // Create function date()
              $date = date('Y:m:d h:i:s');
              $sql   ="insert into `News` (`title`,`content`,`date`,`profile`,`user_id`)
                        value
                       ('$title','$content','$date','$profile_new_name','$user_id')";

              if ($error_AD == 0) {

                $query = mysqli_query($con,$sql) or die( error() );
                echo"<h2><b> Thank You For Recode News in DataBase </b></h2>" ;
               // header('refresh:7;url=News.php');
              }        
   
          
          ?>
          <br />
          <h2>Do you want to add another piece of news or not</h2>
          <br />
          <a class="input" href="add-News.php">Yes</a>
          <a href="show-all-News.php">No</a>      

       </div> <!-- div class="containers" -->
      </div> <!-- div id="content" -->
  
<!--END content-->

<!-- Start Include Footer  -->
<? include $tpl . "footer.php";?>
<!-- End Include Footer  -->


