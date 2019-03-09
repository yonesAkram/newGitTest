<?php
session_start();
if(isset($_SESSION['Username'])):
    $PageTitle = 'Dashboard';

    include "init.php";
    
//Number Of Latest Users    
    $NumUsers = 6 ;
//Function Getlatest Dinamec **** Latest User Array
    $latestUser = Getlatest("*" , "users" , "UserID", $NumUsers );

//Number Of Latest Users    
    $NumItems = countItem( "Name", "items") ;    
//Function Getlatest Dinamec **** Latest Items Array
    $latestItems = Getlatest("*" , "items" , "item_ID", $NumItems );
//Number Of Comments    
    $NumComments = 4 ;

?>
<!-- Start Dashboard Page -->
    <div class="container home-stats text-center">
        <h1>Dashboard</h1>
        <div class="row">
            <div class="col-md-3">
                <div class="stat st-members">
                    <i class="fa fa-users"></i>
                    <div class="info">
                        Total Members
                    <span> 
                        <a href="member.php">
                         <?php echo countItem( "Username", "users");?> 
                        </a> 
                    </span>
                    </div>
                </div><!-- div class="stat" -->
            </div><!-- div class="col-md-3" -->

            <div class="col-md-3">
                <div class="stat st-pending">
                    <i class="fa fa-user-plus"></i>
                    <div class="info">
                        Pending Members
                        <span>
                            <a href="member.php?do=Mange&page=pending"> 
                                <?php echo  checkItem("RegStatus" , "users" , 0 ) ; ?>
                            </a> 
                        </span>
                    </div><!--<div class="info">-->    
                </div><!-- div class="stat" -->
            </div><!-- div class="col-md-3" -->
            
            <div class="col-md-3">
                <div class="stat st-item">
                    <i class="fa fa-tag"></i>
                    <div class="info">  
                        Total Items
                        <span>
                            <a href="items.php?do=Manage"> 
                                <?php echo  countItem( "Name", "items"); ?>
                            </a> 
                        </span>
                    </div><!--<div class="info">-->                        
                </div><!-- div class="stat" -->
            </div><!-- div class="col-md-3" -->
            
            <div class="col-md-3">
                <div class="stat st-comments">
                    <i class="fa fa-comments"></i>
                    <div class="info">                          
                        Total Comments
                        <span>
                            <a href="comments.php?do=Mange"> 
                                <?php echo  countItem( "c_id", "comments"); ?>
                            </a><!-- <a href=".php?do=Manage"> -->
                        </span>
                    </div> <!--<div class="info">   -->    
                </div><!-- div class="stat" -->
            </div><!-- div class="col-md-3" -->
        </div><!-- div class="row" -->
    </div><!-- div class="container" -->

    <div class="container latest">
        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-users"></i> Latest <?php echo '<b>' .$NumUsers ."</b>";?> Registerd Users
                        <span class="toggle-info pull-right" >
                            <i class="fa fa-minus fa-lg"></i>
                        </span> <!-- <span class=" toggle-info pull-right">-->
                    </div><!-- div class="panel-heading"-->
                    <div class="panel-body">
                         <ul class="list-unstyled latest-users" >
                            <?php 
                            if(!empty($latestUser)){
                                foreach ($latestUser as $user) {
                                    echo'<li>';
                                        echo $user['Username'] ;
                                        echo '<a href="member.php?do=edit&userid=' .$user['UserID'].'">';
                                            echo '<span class="btn btn-success pull-right ">';
                                                echo '<i class="fa fa-edit"></i>  Edit ';
                                               if($user['RegStatus']==0){
                                                    echo'<a href="member.php?do=activate&userid=' .$user['UserID']. '" class="btn  btn-info pull-right activate"> <i class ="fa fa-check "></i> Activate</a>';
                                                } //if($row['RegStatus']==0){
                                            echo '</span>';//'<span class="btn btn-success pull-right ">';
                                        echo '</a>';//'<a href="member.php?do=edit&userid=' .$user['UserID'].'">';
                                    echo'</li>' ;
                                }//foreach($latestUser as $user){
                            }else{//if(!empty($latestItems)){
                                echo 'There\'s No Record To Show';
                            }//if(!empty($latestItems)){                                   
                            ?>
                        </ul><!--<ul class="list-unstyled latest-users" >-->                                            
                    </div><!-- <div class="panel-body"> -->
                </div><!-- div class="panel panel-default" -->
            </div><!--div class="col-sm-6"-->

            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-tag"></i> Latest <?php echo '<b>' .$NumItems ."</b>";?> Registerd Items
                        <span class=" toggle-info pull-right " >
                            <i class="fa fa-minus fa-lg" ></i>
                        </span> <!-- <span class=" toggle-info pull-right " > -->                    
                    </div><!-- div class="panel-heading" -->
                    <div class="panel-body">
                        <ul class="list-unstyled latest-users" >
                            <?php
                            if(!empty($latestItems)){ 
                                foreach ($latestItems as $item) {
                                    echo'<li>';
                                    echo $item['Name'] ;
                                    echo '<a href="items.php?do=edit&itemid=' . $item['item_ID'].'">';
                                        echo '<span class="btn btn-success pull-right ">';
                                            echo '<i class="fa fa-edit"></i>  Edit ';
                                           if($item['Approve']==0){
                                                echo'<a href="items.php?do=Approve&itemid=' .$item['item_ID']. '" class="btn  btn-info pull-right activate"> <i class ="fa fa-check"></i> Activate</a>';
                                            } //if($row['RegStatus']==0){
                                        echo '</span>';
                                    echo '</a>';
                                    echo'</li>' ;
                                }//foreach($latestUser as $user){
                            }else{//if(!empty($latestUser)){
                                
                                echo 'There\'s No Items To Show';

                            }//if(!empty($latestUser)){
                            ?>
                         </ul> <!-- <ul class="list-unstyled latest-users" > -->                          
                    </div> <!-- <div class="panel-body"> -->
                </div><!-- div class="panel panel-default" -->
            </div><!--div class="col-sm-6"-->
        </div><!-- div class="row" -->
<!----------------- Start Latest Comments ---------------------------> 
      <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-comments-o fa-lg"></i>
                         Latest <b><?php echo  countItem( "comment", "comments"); ?></b> Comments
                        <span class=" toggle-info pull-right " >
                            <i class="fa fa-comments fa-lg" ></i>
                        </span> <!-- <span class=" toggle-info pull-right">-->
                    </div><!-- div class="panel-heading"-->
                    <div class="panel-body">
                        <?php
                            // Select All User Except Admin 
                            $stmtCom = $con->prepare("  SELECT 
                                    comments.*,users.Username AS Member
                                FROM
                                    comments
                                INNER JOIN
                                    users            
                                ON     
                                    users.UserID = comments.user_id
                                ORDER BY `c_id` DESC                                        
                            ");
                    // Execute Statement                
                            $stmtCom->execute();
                    // Assign To Variable                
                            $Coms = $stmtCom->fetchAll();
                            if(!empty($Coms)){
                                foreach($Coms AS $comment){
                                    echo'<div class="comment-box">';
                                        echo '<a href="member.php?do=edit&userid='.$comment['user_id'].'">'.'<span class="member-n" >' . $comment['Member'] .'</span>' . '</a>';
                                        echo '<p class="member-c" >' . $comment['comment'] .'</p>';
                                    echo "</div>";    
                                }//foreach($Coms AS $comment){

                            }else{//if(!empty($Coms))
                                
                                echo 'There\'s No Comments To Show';

                            }//if(!empty($Coms))  
                        ?>
                    </div><!-- <div class="panel-body"> -->
                </div><!-- div class="panel panel-default" -->
            </div><!--div class="col-sm-6"-->
        </div><!-- div class="row" -->
<!----------------- END Latest Comments ---------------------------> 
    </div><!-- div class="container latest" -->
<!-- End Dashboard Page -->

<?php include $tpl . 'footer.php';


else :// if(isset($_SESSION['Username'])):
    header('location: index.php');
endif; //if(isset($_SESSION['Username']))


        
?>




        