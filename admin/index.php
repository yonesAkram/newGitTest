<?php
        session_start();
        $NoNavbar ='' ;
        $PageTitle = 'Login';
        if(isset($_SESSION['Username'])):
            header('location: dashboard.php');
        endif; //if(isset($_SESSION['Username'])):
	include "init.php";
        

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		$username   = $_POST['user'];
		$password   = $_POST['pass'];
        $hashedPass = sha1($password); 
                
//Check if the User Exits In DataBase
             $stmt = $con->prepare("SELECT `UserID`,`Username`,`Password` FROM `users` WHERE `Username` = ? AND `Password` = ? AND GroupID = 1 LIMIT 1 ");
             $stmt->execute([$username,$hashedPass] );
             $row = $stmt->fetch();
             $count = $stmt->rowCount();
             echo $count;
// If count > 0 This Mean  The DataBase Contain Record  About This UserName 
            if($count > 0 ){
                $_SESSION['Username'] = $row['Username'] ;
                $_SESSION['ID']   = $row['UserID'];
                header('location: dashboard.php'); 
                exit();
                
            } // If ($count > 0 ){ 
	} //if($_SERVER['REQUEST_METHOD'] == 'POST'){
?>
<form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
	<h2 class="text-center">Admin Login</h2>
	<input class="form-control" type="text" name="user" placeholder="Username" autocomplete="autocomplete" />	
	<input class="form-control" type="Password" name="pass" placeholder="PassWord" autocomplete="none" />	
	<input class="btn btn-primary btn-block" type="submit" name="Login" value="Login">
</form>

<?php include $tpl . "footer.php";
        