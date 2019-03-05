<?php
/*
    ====================================================
    == Mange Comments Page                               =   
    == You Can Add | Edit | Delete Comments From Here   =
    ====================================================
*/
session_start();
if(isset($_SESSION['Username'])):
    $PageTitle = 'Member';
    include "init.php";
    $do = isset($_GET['do']) ? $_GET['do'] : 'Mange' ;
      
// Start  Mamge Page =>
     if ($do == 'Mange'){

// Select All User Except Admin 
        $stmtCom = $con->prepare("  SELECT 
                                        comments.*, items.Name AS ITEMS_NAME ,users.Username AS USERNAME
                                    FROM
                                        comments
                                    INNER JOIN
                                        items
                                    ON
                                        items.item_ID = comments.item_id
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
 ?>
            <div class='container'>
                <h1 class="text-center">Manage Comments</h1>
                <div class="table-responsive">
                    <table class="main-table text-center table table-bordered">
                        <tr>
                                <td>Comment</td>
                                <td>Item Name</td>
                                <td>User Name</td>
                                <td>Comment Date</td>
                                <td>Control</td>
                        </tr>
    <?php    
                    foreach($Coms as $Com){
                     print'<tr>' ;
                        print'<td>'.$Com['comment'].'</td>';
                        print'<td>'.$Com['ITEMS_NAME'].'</td>';
                        print'<td>'.$Com['USERNAME'].'</td>';
                        print'<td>'.$Com['comment_date'].'</td>';
                        print'<td>';                      
                        print'<a href="comments.php?do=edit&commentid='.$Com['c_id'].'" class="btn btn-primary"><i class ="fa fa-edit "></i> Edit</a>';
                        print'<a href="comments.php?do=delete&commentid='.$Com['c_id'].'" class="btn btn-danger activate confirm" ><i class ="fa fa-close "></i> Delete</a>';
                    
                        if($Com['Approve']==0){
                            print'<a href="comments.php?do=Approve&commentid=' .$Com['c_id']. '" class="btn btn-info activate"> <i class ="fa fa-check "></i> Activate</a>';
                        } //if($row['RegStatus']==0){
                            print'</td>';
                     print'</tr>';
                    }//foreach($rows as $row){ ?>            
                    </table> <!-- table class="main-table text-center table table-bordered" -->
                </div> <!-- div class="table-responsive" -->			
            </div> <!-- <div class='container'> -->
<?php   }else{//if(!empty($Coms)){ 
            print'<div class="container">';
                echo "<div class='nice-message'>There is No Comments To Show </div>"; 
            print'</div>';

        }//if(!empty($Coms)){ 
// Start Edit  Page ====================================================================================================================================================>
    }elseif ($do == 'edit') {
        
//Check if Get Request Comment Is Numeric & Get The integar Value Of It 
        $commentid = isset($_GET['commentid']) && is_numeric($_GET['commentid']) ? intval($_GET['commentid']) : 0;

        $stmt = $con->prepare("SELECT * FROM `comments` WHERE `c_id` = ?");
        $stmt->execute(array($commentid));
        $row = $stmt->fetch();
        $countEdite = $stmt->rowCount();
/*=============================================================================*/
// Check if The user Exits in DataBase
     if($countEdite > 0 ){       
        ?>
        <h1 class="text-center">Edit Commment</h1>
        <div class="container">
            <form class="form-horizontal" action = "?do=update" method="POST">
                <input type="Hidden" name="commentid" value="<?php echo $commentid ; ?>" />                                       
<!--Start Comment Field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Comment</label>
                    <div class="col-sm-10 col-md-5">
                        <textarea class="form-control" name="comment" >
                            <?php
                                echo $row['comment'];
                            ?>
                        </textarea>
                    </div><!--<div class="col-sm-10 col-md-5">-->
                </div>
<!--End Comment Field -->

<!--Start Submit Field -->
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="Submit" value="Save" class="btn btn-primary btn-lg" />
                    </div>
                </div>
<!--End Submit Field -->
            </form> <!--<form class="form-horizontal" action = "?do=update" method="POST">-->
        </div><!--div class="container" -->	
        
<?php }else{ // if(countEdite > 0 ) {

        $theMsg = "<div class = 'alert alert-danger'> There\'s No Such ID </div>";
        redirectHome($theMsg  );
    
     }//if(countEdite > 0 ) { Edit Member

// Start Update  Page =================================================================================================================================================>
    }elseif ($do == 'update') {
        
        print '<h1 class="text-center">Update Comment</h1>';
        print '<div class="container" >';
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
// Get Variable From Te From                     
                $id     = $_POST['commentid'];
                $Comm   = $_POST['comment'];

// Update The DataBase wirh This Info                      
                $stmt = $con->prepare("UPDATE `comments` SET  `comment`=? , `comment_date`=now() WHERE c_id = ?  ");
                $stmt->execute(array( $Comm,$id));
// ECHO Success Message 
                $theMsg ="<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Update </div>'  ;
                
                redirectHome($theMsg , 'Back');    
 
                }else{
                    $theMsg = '<div class="alert alert-danger"> Sorry You Can\'t Browse This Page Directly </div> ';
                redirectHome($theMsg );    

            }//if($_SERVER['REQUEST_METHOD'] == 'POST'){
            print'</div>'; //  print '<div class="container" >';

 // Start Delete  Page ====================================================
//=========================================================================>
   
    }elseif ($do = 'delete') {

        print '<div class="container" >';        
//Check if Get Request Comment ID Is Numeric & Get The integar Value Of It 
        $commentid = isset($_GET['commentid']) && is_numeric($_GET['commentid']) ? intval($_GET['commentid']) : 0;
// Select All Data Depend On This ID
        $checkComm = checkItem("c_id","`comments`", $commentid);
/*=============================================================================*/
// Check if The user Exits in DataBase
     if($checkComm > 0 ){ //$do = 'delete'

        if($_GET['do'] == 'Approve'){

            print '<h1 class="text-center">Approve Items</h1>';     
            $stmt = $con->prepare("UPDATE `comments` SET `Approve` = 1 WHERE `c_id` = ?");
            $stmt->execute(array($commentid));
             
//ECHO Success Message      
            $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Approve </div>'  ;  
            redirectHome($theMsg, 'Back'); 
        }else{// if($_GET['do'] == 'Approve'){

            print '<h1 class="text-center">Delete Items</h1>';             

            $stmt = $con->prepare("DELETE FROM `comments` WHERE `c_id` = :zid ");
            $stmt->bindParam(":zid",$commentid);
            $stmt->execute();
// ECHO Success Message 
            $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Deleted Items </div>'  ;  
            redirectHome($theMsg , 'Back');  
        }//if($_GET['do'] == 'Approve'){

     }else{  //if($check > 0 ){ //$do = 'delete'    
        $theMsg = '<div class="alert alert-danger"> This ID Is Not Exist </div>';
        redirectHome($theMsg);               
        
     }//if($checkDel > 0 ){
        
    print'</div>'; //  print '<div class="container" >';                               
    
    }else{ //if ($do == 'Mange'){
        $theMsg = '<div class="alert alert-danger">Error There\'s No Paeg With This Name </div>' ;
        redirectHome($theMsg);               
    }//if ($do == 'Mange'){
    
    include $tpl . 'footer.php';

    
else :
    header('location: index.php');
endif; //if(isset($_SESSION['Username']))



?>
        