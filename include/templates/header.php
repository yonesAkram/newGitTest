<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title> <?php getTitle(); ?> </title>
		<link rel="stylesheet" type="text/css" href="<?php echo $css; ?>bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $css; ?>font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $css; ?>front.css" />
	</head>
	<body>
	<div class="upper-bar">
		<div class="container">
			<?php

				if(isset($_SESSION['user'])){
					echo "<span class='pull-right' >Welcom  " . $_SESSION['user'].'</span>';

					echo '<a href="profile.php" >My Profile</a>';

					echo ' - <a href="newad.php" >New Ad </a>';
					echo ' - <a href="logout.php" >Logout </a>';
					if(checkUserStatus($_SESSION['user']) == 1)
					{
						 // User Is Active
					}
				} else{ //if(isset($_SESSION['User'])){
?>
			<a href="login.php">
				<span class="pull-right">Login / Sign Up </span>
			</a>
		<?php }//if(isset($_SESSION['user'])){  ?>
		</div>
	</div>
	<nav class="navbar navbar-inverse">
	  <div class="container">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="index.php">HomePage </a>
	    </div>
	    <div class="collapse navbar-collapse" id="app-nav">
	      <ul class="nav navbar-nav navbar-right">
	      	<?php

	      		foreach(  getCat() AS $cat ){

            		echo '<li>
            				<a href="categories.php?pageid='.$cat['ID'].'&pagename='.str_replace(' ','/' , $cat['Name']).'">'
            					.$cat['Name'].
            				'</a>
        				  </li> ';

	      		}//foreach(  getCat() AS $cat ){

	      	?>
	      </ul>
<!-- 	      <ul class="nav navbar-nav navbar-right">
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?php// echo $_SESSION['Username'];?><span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="../index.php">Visit Shop</a></li>
	            <li><a href="member.php?do=edit&userid=<?php //echo $_SESSION['ID'] ?>">Edit profile</a></li>
	            <li><a href="#">Settings action</a></li>
	            <li><a href="logout.php">Logout</a></li>
	          </ul> <!-- <ul class="dropdown-menu">
	        </li>   <li class="dropdown"> -->

	      </ul>  <!-- <ul class="nav navbar-nav navbar-right"> -->
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav> <!-- <nav class="navbar navbar-default"> -->
