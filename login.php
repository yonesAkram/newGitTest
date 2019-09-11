<?php
session_start();
// $NoNavbar = '';
$PageTitle = 'Login';
include "init.php"; 

  if(isset($_SESSION['Name_student'])){
      header("location:home.php");
  }else{
?>

    <div class="wrapper fadeInDown">
      <div id="formContent">

        <!-- Tabs Titles -->
        <h1 class="text-center">
          <span class="selected" data-class="login" >Login</span> 
        </h1>
        <?php
        // Create a login so you can add news
          if(isset($_GET['add_news']) ):
            echo "<div class='ChEr'>Sorry Login To Continue Add News</div>";?>
            <form action="login-process.php?add_news" method="POST"><?  
          endif;//if(isset($_GET['error_empty']) ):
        ?>
        <!-- Login Form -->
        <form action="login-process.php" method="POST">
          <?
          
        
          if(isset($_GET['error_empty']) ):
            echo "<div class='ChEr'>Sorry Make Sure Your Data</div>";
          endif;//if(isset($_GET['error_empty']) ):
            

          if(isset($_GET['check_login']) ):
            echo "<div class='ChEr'>Sorry Check Username & Password</div>";
          endif; //if(isset($_GET['check_login']) ):?> 
          
          <input type="text" id="login" class="fadeIn second" autocomplete="off" name="username"  placeholder="Username"  >
          <input type="password" id="password" class="fadeIn third" name="password"  autocomplete="new-password" placeholder="password">
          <input type="submit" class="btn btn-primary btn-lg" name="login" value="Log In"> <br /><br />
           
        </form><!-- <form action="login-process.php" method="POST"> -->
           

        <!-- Remind Passowrd -->
        <div id="formFooter">
          <a class="underlineHover" href="#">Forgot Password?</a><br />
          <a class="underlineHover" href="#">Register</a>
        </div><!--<div id="formFooter">  -->

      </div><!-- <div id="formContent"> -->  
    </div><!-- <div class="wrapper fadeInDown"> -->
            
<?}//if(isset($_SESSION['User'])):?>

<!-- Start Include Footer  -->
<? include $tpl . "footer.php";?>
<!-- End Include Footer  -->

<!-- ====================================================================== 
    <div class="container login-page">
    	<h1 class="text-center">
            <span class="selected" data-class="login" >Login</span> </h1>
     Start Login Form 
        <form class="login"action="login-process.php" method="POST">
        	<input class="form-control" type="text" autocomplete="off" name="username"  placeholder="Username">
        	<input class="form-control" type="password" name="password" autocomplete="new-password" placeholder="Password">
        	<input class="btn btn-primary btn-block" name="login" type="submit" value="Login">
        </form>
   End Login Form  
fatal: Unable to create '/home/akram/.git/index.lock': File exists.

Another git process seems to be running in this repository, e.g.
an editor opened by 'git commit'. Please make sure all processes
are terminated then try again. If it still fails, a git process
may have crashed in this repository earlier:
remove the file manually to continue. -->