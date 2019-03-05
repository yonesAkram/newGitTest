<nav class="navbar navbar-inverse"> 
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="dashboard.php"><?php echo lang('Home_Admin') ?> </a>
    </div>  
    <div class="collapse navbar-collapse" id="app-nav">
      <ul class="nav navbar-nav">
        <li><a href="categories.php"><?php echo lang('CATERGRIES') ?><span class="sr-only">(current)</span></a></li>
        <li><a href="items.php"><?php echo lang('ITEMS') ?><span class="sr-only">(current)</span></a></li>
        <li><a href="member.php"><?php echo lang('MEMBERS') ?><span class="sr-only">(current)</span></a></li>
        <li><a href="comments.php"><?php echo lang('COMMENTS') ?><span class="sr-only">(current)</span></a></li>
        <li><a href="#"><?php echo lang('STATISTICS') ?><span class="sr-only">(current)</span></a></li>
        <li><a href="#"><?php echo lang('LOGS') ?><span class="sr-only">(current)</span></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?php echo $_SESSION['Username'];?><span class="caret"></span></a>
          <ul class="dropdown-menu"> 
            <li><a href="../index.php">Visit Shop</a></li>
            <li><a href="member.php?do=edit&userid=<?php echo $_SESSION['ID'] ?>">Edit profile</a></li>
            <li><a href="#">Settings action</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul> <!-- <ul class="dropdown-menu"> -->
        </li>  <!-- <li class="dropdown"> --> 
      </ul>  <!-- <ul class="nav navbar-nav navbar-right"> -->
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav> <!-- <nav class="navbar navbar-default"> -->

