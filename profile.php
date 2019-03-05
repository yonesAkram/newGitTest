<?php
session_start();
$PageTitle = 'Home Page';
include "init.php";
if (isset($_SESSION['user'])) {

	$getUser = $con->prepare("SELECT * FROM `users` WHERE `Username` =? ");

	$getUser->execute(array($_SESSION['user']));

	$info = $getUser->fetch();
?>
	<h1 class="text-center"><?php echo $_SESSION['user'] . ' Profile'; ?></h1>
    <div class="information block">
    	<div class="container">
    		<div class="panel panel-primary">
	    		<div class="panel-heading">My Information</div>
	    		<div class="panel-body">
	    			<ul class="list-unstyled">
		    			<li>
		    				<i class="fa fa-unlock-alt fa-fw" ></i>
		    				<span>Login Name</span>				:  <?php echo$info['Username'] ;?>
		    			</li>
		    			<li>
		    				<i class="fa fa-envelope-o fa-fw" ></i>
		    				<span>Email</span> 	 			:  <?php echo$info['Email'] ;?>
		    			</li>
		    			<li>
		    				<i class="fa fa-user fa-fw" ></i>
		    				<span>Full Name</span> 			:  <?php echo$info['FullName'] ;?>
		    			</li>
		    			<li>
		    				<i class="fa fa-calendar fa-fw" ></i>
		    				<span>Register Date</span> 		:  	<?php echo$info['Date'] ;?>
		    			</li>
		    			<li>
		    				<i class="fa fa-tags fa-fw" ></i>
		    				<span>Favourite Category</span> :
		    			</li>
		    		</ul>
    			</div>
    		</div><!-- <div class="panel panel-primary"> -->
    	</div><!-- <div class="container"> -->
	</div><!-- <div class="information block"> -->

    <div class="my-ads block">
    	<div class="container">
    		<div class="panel panel-primary">
	    		<div class="panel-heading">My Advertismenets</div>
	    		<div class="panel-body">
<?php
	    			if(!empty(getItems('Member_ID', $info['UserID']))){
	    				echo '<div class="row">';
				      		foreach(getItems('Member_ID', $info['UserID']) AS $item ){
				      			echo '<div class="col-sm-6 col-md-4">';
					      			echo '<div class="thumbnail item-box">';
					      				echo "<span class='price-tag' >". $item['Price'] ."</span>";
					      				echo "<img class='img-responsive' src='aassdd.jpg' alt='' />";
					      				echo '<div class="caption">';
					      					echo "<h3>". $item['Name'] ."</h3>";
					      					echo "<p>". $item['Desciption'] ."</p>";
					      				echo '</div>';//echo '<div class="">';
					      			echo '</div>';//echo '<div class="thumbnail">';
				      			echo '</div>';//echo '<div class="col-sm-6 col-md-4">';
				      		}//foreach(getItems($_GET['pageid']) AS $item ){
			      		echo '</div>';//<div class="row">
		      		}else{
		      			echo "Sorry There\'s No Ads To Show , Create <a href='newad.php'> New Ad</a>";
		      		}//if(!empty(getItems('Member_ID', $info['UserID']))){
?>
    			</div><!--<div class="panel-body">-->
    		</div><!--<div class="panel panel-primary"> -->
    	</div><!--<div class="container"> -->
	</div><!--<div class="information block"> -->

    <div class="Comment block">
    	<div class="container">
    		<div class="panel panel-primary">
	    		<div class="panel-heading">Latest Comments </div>
	    		<div class="panel-body">
	    			<?php
				        $stmtCom = $con->prepare("  SELECT comment FROM Comments WHERE user_id = ? ");
				// Execute Statement
				        $stmtCom->execute(array($info['UserID']));
				// Assign To Variable
				        $Coms = $stmtCom->fetchAll();

				        if(! empty($Coms)) {
				        	foreach ($Coms as $Com) {
				        			echo '<p>'.$Com['comment'] .'</p>';
				        	}
				        }else{
				        	echo "There\'s No Comments To Show";

				        }//if(! empty($Coms)) {
	    			?>
    			</div>
    		</div><!-- <div class="panel panel-primary"> -->
    	</div><!-- <div class="container"> -->
	</div><!-- <div class="information block"> -->

<?php
}else{

	// header('location: login.php');
	exit();

}//if (isset($_SESSION['user'])) {

 include $tpl . "footer.php";
 ?>
