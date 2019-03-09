<?php
session_start();
$PageTitle = 'Show Items';
include "init.php";
//Check if Get Request itemid Is Numeric & Get The integar Value Of It
    $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

    $stmt 	= $con->prepare("SELECT items.* , categories.Name AS Category_name , users.Username AS Client_user 
								FROM `items`  
								INNER JOIN `categories`
								ON categories.ID = items.Cat_ID 
								INNER JOIN `users` 
								ON users.UserID = items.Member_ID  
    							WHERE `item_ID` = ? ");
    $stmt->execute(array($itemid));//
    $count  = $stmt->rowCount();
    if($count > 0){
	    $item 	= $stmt->fetch();//Fetch The Date 

?>
		<h1 class="text-center"><?php echo $item['Name']; ?></h1>
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<img class='img-responsive img-thumbnail center-block' src='aassdd.jpg' alt='' />
				</div><!-- <div class="col-md-3"> -->
				<div class="col-md-9 item-info">
					<h2><?php echo $item['Name']?></h2>	 	
					<p><?php echo $item['Desciption']?></p>
					<ul class="list-unstyled">	 	
						<li>
							<i class="fa fa-calendar fa-fw"></i>
							<span>Added Date</span ><?php echo $item['Add_Date']?>
						</li>	 	
						<li>
							<i class="fa fa-money fa-fw"></i>
							<span>Price :</span> $<?php echo $item['Price']?>
						</li>	 	
						<li>
							<i class="fa fa-building fa-fw"></i>
							<span>Made In :</span>Made In :<?php echo $item['Country_Made']?>
						</li>	 	
						<li>
							<i class="fa fa-tags fa-fw"></i>
							<span>Category :</span><a href="categories.php?pageid=<?php echo $item['Cat_ID']?>"><?php echo $item['Category_name']?></a>
						</li>	 	
						<li>
							<i class="fa fa-user fa-fw"></i>
							<span>Added By:</span><a href=""><?php echo $item['Client_user']?></a>
						</li>	 	
					</ul><!-- <ul class="list-unstyled"> -->	
				</div><!--<div class="col-md-9">-->
			</div><!--<div class="row">-->
			<hr class="Custom-hr" />
			<?php if (isset($_SESSION['user'])) { ?>
<!-- Start Add Comment -->	
				<div class="row">
					<div class="col-md-offset-3">
						<div class="add-comment">
							<h3>Add Your Comment</h3>
							<form class="" action="<?php echo $_SERVER['PHP_SELF'] .'?itemid='. $item['item_id'] ?>" method="POST">
								<textarea name="comment"></textarea>
								<input class="btn btn-primary" type="submit" value="Add Comment" name=""  />
							</form><!--<form class="" action="<?php //echo $_SERVER['PHP_SELF'] ?>"method="POST">-->
							<?php
								if($_SERVER['REQUEST_METHOD'] == 'POST'){

									$comment = filter_var($_POST['comment'] , FILTER_SANITIZE_STRING);
									$itemid  = $item['item_ID'];
									$userid  = $_SESSION['uid'];

									if(!empty($comment)){
										$stmt = $con->prepare("INSERT INTO 
														`comments`(comment, status, comment_date, item_id, user_id)  
														VALUES(:zcomment, 0, NOW(), :zitemid, :zuserid)	");
										$stmt->execute(array(
											'zcomment' => $comment,
											'zitemid'  => $itemid,
											'zuserid'  => $userid
										));//$stmt->execute(array(
										if($stmt){
											echo "<div class = 'alert alert-success'> Comment Add </div>";
										}

									}//if(!empty($comment)){

								}//if($_SERVER['REQUEST_METHOD'] == 'POST'){
							?>	
						</div><!-- <div class="add-comment"> -->
					</div><!-- <div class="col-md-offset-3"> -->
				</div><!-- <div class="row"> -->
<!-- End Add Comment -->
			<?php }else {
				echo "<a href='login.php'> Login </a> Or <a href='login.php'> Register </a> To Add Comment";
			}?>

			<hr class="Custom-hr" />
			<?php
					
// Select All User Except Admin 
    		$stmtCom = $con->prepare("  SELECT 
                                    comments.*, users.Username AS USERNAME
                                FROM
                                    `comments`
                                INNER JOIN
                                    `users`            
                                ON     
                                    users.UserID = comments.user_id
                                WHERE `item_id` = ?
                                AND `status` = 1    
                                ORDER BY `c_id` DESC   
                            ");
// Execute Statement                
    		$stmtCom->execute(array($item['item_ID']));
// Assign To Variable                
	        $Coms = $stmtCom->fetchAll();

	        foreach($Coms AS $com) {
	        	echo '<div class="row">';
	        		echo '<div class="col-md-3">' 
	        			. $com['USERNAME'] . 
	        		'</div>';//div class="col-md-3"> 
	        		echo '<div class="col-md-9">';
		        		echo $com['comment']. '<br />';
		        		echo $com['comment_date']. '<br />';
		        	echo '</div>';//<div class="col-md-9">
	        	echo '</div>';//<!-- <div class="row"> -->	
	        }//foreach($Coms AS $com) {
?>
		</div><!--<div class="container">-->
<?php
	}else{////if($count > 0){
		echo "There\'s No Such ID";
    }//if($count > 0){
 include $tpl . "footer.php";
 ?>