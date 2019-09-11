
<nav class="navbar navbar-inverse"> 
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="home.php"><?php echo lang('Home_Admin') ?> </a>
    </div>  
    <div class="collapse navbar-collapse" id="app-nav">
      <ul class="nav navbar-nav">
        <li><a href="about.php"><?php echo lang('ABOUT') ?><span class="sr-only">(current)</span></a></li>
        <li><a href="News.php"><?php echo lang('NEWS') ?><span class="sr-only">(current)</span></a></li>
        <li><a href="Admission.php"><?php echo lang('ADMISSION') ?><span class="sr-only">(current)</span></a></li>
        <li><a href="Result.php"><?php echo lang('RESULTS') ?><span class="sr-only">(current)</span></a></li>
        <li><a href="All_Results.php"><?php echo lang('All_Results') ?><span class="sr-only">(current)</span></a></li>
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <? if(isset($_SESSION['Name_student'])) { ?>

          <? echo '<li><a href="personel_page.php" >Welcom '. $_SESSION["Name_student"].'</a></li>';?>
        <li><a href="logout.php"><?php echo lang('LOGOUT') ?><span class="sr-only">(current)</span></a></li>

      <?}else{?><!--if(isset($_SESSION['Name_student'])) { -->

        <li><a href="login.php"><?php echo lang('LOGIN') ?><span class="sr-only">(current)</span></a></li>
        <li><a href="register.php"><?php echo lang('REGISTER') ?><span class="sr-only">(current)</span></a></li>
      
      <?}?>
      </ul>  <!-- <ul class="nav navbar-nav navbar-right"> -->
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav> <!-- <nav class="navbar navbar-default"> -->

