<?php
session_start();
$PageTitle = 'Login';
if(isset($_SESSION['user'])){
    header('location: index.php');
}  //if(isset($_SESSION['User'])):

include "init.php"; 

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if (isset($_POST['login'])) {
                            
            $user   = $_POST['username'];
            $pass   = $_POST['password'];
            $hashedPass = sha1($pass); 

    //Check if the User Exits In DataBase
                 $stmt = $con->prepare("SELECT `Username`,`Password` FROM `users` WHERE `Username` = ? AND `Password` = ? ");
                 $stmt->execute([$user,$hashedPass] );
                 $count = $stmt->rowCount();
    // If count > 0 This Mean  The DataBase Contain Record  About This UserName 
                if($count > 0 ){
                    $_SESSION['user'] = $user ;
                    header('location: profile.php'); 
                    exit();
                    
                } // If ($count > 0 ){ 
            }else{ //(isset($_POST['signup']))

                $formErrors = [];

                if (isset($_POST['username'])) {
                    
                    $FilterUser = filter_var($_POST['username'] , FILTER_SANITIZE_STRING);

                    if(strlen($FilterUser) < 4){

                        $formErrors[] = 'Username Must Be Larger Than 4 Characters ';
                    }
                }//if (isset($_POST['username'])){


                if (isset($_POST['password']) && isset($_POST['password2'])) {
                    
                    $FilterUser = filter_var($_POST['username'] , FILTER_SANITIZE_STRING);

                    if (sha1($_POST['password']) !== sha1($_POST['password2'])) {

                        $formErrors[] = 'Sorry Password Is Not Match';

                    }//if (sha1($_POST['password']) !== sha1($_POST['password2'])) {                    

                }//if (isset($_POST['username'])){                    

                if (isset($_POST['email'])) {
                    
                    $FilterEmail = filter_var($_POST['email'] , FILTER_SANITIZE_EMAIL);
                    if(filter_var($FilterEmail , FILTER_VALIDATE_EMAIL) != true){
                        $formErrors[] = 'This Email Is Not Valid ';
                    }// if(filter_var($filterEmail , Filter_VALIDATE_EMAIL))
                    
                }//if (isset($_POST['username'])){  
                // Check IF There's No Error Proceed The User Add 
                if(empty($formErrors)){    
                    $check = checkItem("Username","users", $_POST['username']);

                    if($check == 1){
                        $formErrors[] = 'Ooh Sorry This User This Exits ';
                    
                    }else{ //if($check == 1){

// Insert The DataBase wirh This Info                      
                        $stmt = $con->prepare("INSERT INTO `users` (Username, Password, Email, RegStatus, `Date`) VALUES (:zuser, :zpass, :zemail, 0,now() ) ");
// Exexute The Statement                         
                        $stmt->execute(array('zuser' => $_POST['username'], 'zpass' => sha1($_POST['password']), 'zemail' => $_POST['email'] ));    
// ECHO Success Message 
                         $succesMsg =  "<div class='alert alert-success'>Congrats You Are Registerd User </div>"  ;

                    }//if($check == 1){

                }//if(empty($formErrors)){    

            }//if (isset($_POST['login'])) {

    } //if($_SERVER['REQUEST_METHOD'] == 'POST'){
?>
    <div class="container login-page">
    	<h1 class="text-center">
            <span class="selected" data-class="login" >Login</span> | <span data-class="login-signeup">Sign Up</span> </h1>
    <!-- Start Login Form  -->
        <form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        	<input class="form-control" type="text" name="username"  placeholder="Username">
        	<input class="form-control" type="password" name="password" autocomplete="new-password" placeholder="Password">
        	<input class="btn btn-primary btn-block" name="login" type="submit" value="Login">
        </form>
    <!-- End Login Form  -->

    <!-- Start signeup Form  -->
        <form class="login-signeup" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" >
            
            <input class="form-control" type="text" name="username" autocomplete="off" placeholder="Username" required>

            <!--minlength="4" <input pattern=".{4,}" title="Username Must Be Bettween 4 & 8 Chars" class="form-control" type="text" name="username" autocomplete="off" placeholder="Username" required> -->
        	
            <input  class="form-control" type="password" name="password" autocomplete="new-password" placeholder="Type Complex Password">
        	<input class="form-control" type="password" name="password2" autocomplete="new-password" placeholder="Type Password Again">
        	<input class="form-control" type="email" name="email"  placeholder="Type A Valid Email">
        	<input class="btn btn-success btn-block" name="signup" type="submit" value="Sign Up">
        </form> <!-- <form class="login-signeup"> -->       
    <!-- End signeup Form  -->
        <div class="the-errors text-center">
            <?php 
                if (!empty($formErrors)) {

                    foreach ($formErrors as $error) {
                        echo'<div class="msg">'. $error . '</div>' ;
                    }

                }//if (!empty($formErrors)) {
                if(isset($succesMsg)){
                    echo $succesMsg ;
                }

                
            ?>
        </div>
    </div> <!-- <div class="container login-page"> -->

<?php
include $tpl . "footer.php";
?>