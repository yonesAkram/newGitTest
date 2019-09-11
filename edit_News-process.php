<!--Start Incolode Head  -->
<?php
  session_start();
  $PageTitle = 'Edite News Process';
  include "init.php";
?>

<!--start Content-->
    <div class="container">
    	<?php
########################################
      $error_AD = '' ;
      $_SESSION['send_err'][] = "";
########################################

// ====>  Validate Form don't Empty Title <====== //
      // Secuirty Input Title
        $title = mysqli_real_escape_string($con,$_POST['title']);            
        
        if(empty($title)){
          $error_AD = 1;
          $_SESSION['send_err'][] = "Sorry , Dont leave Title Empty";
        }//if(empty($_POST['title'])){

// ====>  Validate Form don't Empty Content <====== //
      // Secuirty Input Title
        $content = mysqli_real_escape_string($con,$_POST['content']);            

        if (empty($content)) {
          $error_AD = 1 ;
          $_SESSION['send_err'][] = "Sorry , Dont leave content Empty";
        }//if (empty($_POST['content'])) {
###############################################
##  Statr ==>  Create Code Profile Uploade   ##
###############################################


        if(isset($_FILES['profile'])) {
              // print_r($_FILES['profile']);
// Uploade Variable
          $profile_name = $_FILES['profile']['name'];
          $profile_size = $_FILES['profile']['size'];
          $profile_tmp  = $_FILES['profile']['tmp_name'];
          $profile_type = $_FILES['profile']['type'];

// ====>  Validate Form don't Empty Uploade Profile <====== //
          if( empty($profile_name)){
            $error_AD = 1 ;
            $_SESSION['send_err'][] = "Sorry , Dont leave profile Empty";
          }//if(!empty($_POST['profile'])){

// List Of Allowed File Typed TO Upoade
          $allowed = [ 'jpeg','JPG','png','gif','txt' ];
          $tmp = explode('.', $profile_name);
          $file_extension = end($tmp);
          $pro_ext = strtolower($file_extension);

          // $pro_ext = strtolower(end(explode('.' , $profile_name))) ; // ليه مش شغاله

          // echo "extension-out<br>" . $pro_ext . '<br>';
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
              $file_destin = "./layout/images\\".$profile_new_name ;
// echo "out-uploade<br>"; 
              if(move_uploaded_file($profile_tmp, $file_destin)){
// echo "In - Good";
        
              }//if(move_uploaded_file($profile_tmp, $file_destin))

          } //if ( $error_AD  != 1)

      } //if (isset($_FILE['profile']))

#################################                ######################################
      // Creating condition comfirm show errors
        if($error_AD == 1){
          header('location:add-News.php?erros_Advertising');
        } // if($error_AD == 1)
########################################################################################
// Create function date()
          $date = date('Y:m:d h:i:s');
          $sql   ="update `News` set `title` = '$title',`content` = '$content'  where `id` = '$_POST[id]' ";

          if ($error_AD == 0) {

            $query = mysqli_query($con,$sql) or die( error() );
            echo"<h1><b> Thank You For Recode advertising in DataBase </b></h1>" ;
            // header('refresh:2;url=show-all-advertising.php');
          }

      ?>
          
    </div> <!-- div class containers -->
<!--END content-->


<!-- Start Include Footer  -->
<? include $tpl . "footer.php";?>
<!-- End Include Footer  -->
