<?php
 
/*
    ============ ===================================
*/

session_start();
if(isset($_SESSION['Username'])):
    $PageTitle = 'Member';
    include "init.php";
    $do = isset($_GET['do']) ? $_GET['do'] : 'Mange' ;
      
// Start  Mamge Page =>
     if ($do == 'Mange'){

        $query = '';
        if (isset($_GET['page']) && $_GET['page'] == 'pending') {
            $query = 'AND RegStatus = 0 ' ;
        }//if (isset($_GET['page']) && $_GET['page'] == 'pending') {

// Select All User Except Admin 
        $stmt = $con->prepare("SELECT * FROM  `users` WHERE `GroupID` != 1 $query ");
// Execute Statement                
        $stmt->execute();
// Assign To Variable                
        $rows = $stmt->fetchAll();
        if(!empty($rows)){         
 ?>
            <div class='container'>
                <h1 class="text-center">Manage Members</h1>
                <a href='member.php?do=add' class="btn btn-primary"><i class="fa fa-plus"> </i> Add New Member</a><br /><br />
                <div class="table-responsive">
                    <table class="main-table text-center table table-bordered">
                        <tr>
                                <td>#ID</td>
                                <td>Username</td>
                                <td>Email</td>
                                <td>Full Name</td>
                                <td>Registerd Date</td>
                                <td>Control</td>
                        </tr>
    <?php    
                    foreach($rows as $row){
                     print'<tr>' ;
                        print'<td>'.$row['UserID'].'</td>';
                        print'<td>'.$row['Username'].'</td>';
                        print'<td>'.$row['Email'].'</td>';
                        print'<td>'.$row['FullName'].'</td>';
                        print'<td>'.$row['Date'].'</td>';
                        print'<td>';    
                        
                        print'<a href="member.php?do=edit&userid='.$row['UserID'].'" class="btn btn-primary"><i class ="fa fa-edit "></i> Edit</a>';
                        
                        print'<a href="member.php?do=delete&userid='.$row['UserID'].'" class="btn btn-danger activate confirm "><i class ="fa fa-close "></i> Delete</a>';
                    
                        if($row['RegStatus']==0){
                            print'<a href="member.php?do=activate&userid=' .$row['UserID']. '" class="btn btn-info activate"> <i class ="fa fa-info "></i> Activate</a>';

                        } //if($row['RegStatus']==0){
                        
                            print'</td>';
                     print'</tr>';
                    }//foreach($rows as $row){
    ?>            
                    </table> <!-- table class="main-table text-center table table-bordered" -->
                </div> <!-- div class="table-responsive" -->			
            </div> <!-- <div class='container'> -->
<?php   }else{//if(!empty($rows)){
            print'<div class="container">';
                echo "<div class='nice-message'>There is No Member To Show  </div>";
                echo '<a href="member.php?do=add" class="btn btn-primary"><i class="fa fa-plus"> </i> Add Nem Member</a><br />';

            print'</div>';

        }//if(!empty($rows)){


// Start ADD  Page ====================================================================================================================================================>
    }elseif ($do == 'add') {?>

        <h1 class="text-center">Add New Member</h1>

        <div class="container">
            <form class="form-horizontal" action = "?do=insert" method="POST">
         
<!-- Start Username Field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10 col-md-5">
                        <input type="text" name="username" value="" class="form-control" auplete="off" placeholder="Username To Login Into Shop"  />
                    </div>
                </div>
<!-- End Username Field -->

<!-- Start password Field -->
                <div class="form-group form-group-lg" >
                    <label class="col-sm-2 control-label">password</label>
                    <div class="col-sm-10 col-md-5">
                        <input type="password" name="password"  class="password form-control" autocomplete="new-password" placeholder="Password Must Be Hard & Complex "  />
                        <i class="show-pass fa fa-eye fa-2x"></i>
                    </div> 
                </div>
<!-- End password Field -->

<!-- Start Email Field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10 col-md-5">
                        <input type="email" name="email"  class="form-control" placeholder="Email Must Be Valid"  />
                    </div>
                </div>
<!-- End Email Field -->

<!-- Start Full Name Field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Full Name</label>
                    <div class="col-sm-10 col-md-5">
                        <input type="text" name="full" class="form-control" placeholder="Full Name Appear In Your Profile Page"   />
                    </div>
                </div>
<!-- End Full Name Field -->

<!-- Start Submit Field -->
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="Submit" value="Add Member" class="btn btn-primary btn-lg" />
                    </div>
                </div>
<!-- End Submit Field -->
            </form>
        </div><!-- div class="container" -->
<?php
// Start insert  Page ====================================================================================================================================================>
    }elseif ($do == 'insert') {

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
        print '<h1 class="text-center">Update Member</h1>';  
        print '<div class="container" >';
    // Get Variable From Te From                     
            $user   = $_POST['username'];
            $pass   = $_POST['password'];
            $email  = $_POST['email'];
            $name   = $_POST['full'];
            
            $hashpass = sha1($_POST['password']); // Hashed Password
            
    // Validate the Form
            $erForm = array(); // Create Array Form

            if(strlen($user) < 2 ){
                $erForm[] = '<strong> Username </strong>cant Be Less Than <strong>4 char </strong>';
            }//if(strlen($user) < 4 ){

            if(strlen($user) > 27 ){
                $erForm[] = '<strong>Username</strong> cant Be More Than <strong>11 char</strong>';
            }//if(strlen($user) > 27 ){
            
            if(empty($user)){
                $erForm[] = "<strong>Username</strong> Cant Be Empty";
            }//if(empty($user)){
            if(empty($pass)){
                $erForm[] = "<strong>Password</strong> Cant Be Empty";
            }//if(empty($pass)){                        
            if(empty($email)){
                $erForm[] ="<strong>Email</strong> Cant Be Empty";
            }//if(empty($email)){
            
            if(empty($name)){
                $erForm[] ="<strong>Name</strong> Cant Be Empty";
            }//if(empty($name)){
            
    // Loop Into Errors Array  And Echo IT                       
            foreach ($erForm as $vaForm){
                echo '<div class="alert alert-danger">' . $vaForm . '</div>' ;
            }//foreach ($erForm as $vaForm){
            
    // Check IF There's No Error Proceed The Update Operation 
        if(empty($erForm)){    
            $check = checkItem("Username","users", $user);

            if($check == 1){
                $theMsg = "<div class = 'alert alert-danger'>Sorry This User Is Exits</div>" ;
                redirectHome( $theMsg , 'Back'  );
            
            }else{ //if($check == 1){

    // Insert The DataBase wirh This Info                      
                $stmt = $con->prepare("INSERT INTO `users` (Username , Password , Email , FullName ,RegStatus, `Date`) VALUES (:zuser, :zpass, :zemail, :zname, 1,now() ) ");
    // Exexute The Statement                         
                $stmt->execute(array('zuser' => $user, 'zpass' => $hashpass, 'zemail' => $email, 'zname' => $name ));    
    // ECHO Success Message 
                 $theMsg =  "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Inserted Member </div>'  ;
                redirectHome($theMsg , 'Back'  );

            }//if($check == 1){

        }//if(empty($erForm)){    
        
            }else{
              
              print '<div class="container" >';
                $MsgInsert =  '<div class = "alert alert-danger">Sorry You Can\'t Browse This Page Directly </div>';

                redirectHome($MsgInsert);
              print'</div>'; // print '<div class="container" >';
                
            }//if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
        print'</div>'; // print '<div class="container" >';


// Start Edit  Page ====================================================================================================================================================>
    }elseif ($do == 'edit') {
        
//Check if Get Request userid Is Numeric & Get The integar Value Of It 
        $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

        $stmt = $con->prepare("SELECT * FROM `users` WHERE `UserID` = ? LIMIT 1 ");
        $stmt->execute(array($userid));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
/*=============================================================================*/
// Check if The user Exits in DataBase
     if($count > 0 ){       
        ?>
        <h1 class="text-center">Edit Member</h1>
        <div class="container">
            <form class="form-horizontal" action = "?do=update" method="POST">
                <input type="Hidden" name="userid" value="<?php echo $userid ; ?>" />                                       
<!-- Start Username Field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10 col-md-5">
                        <input type="text" name="username" value="<?php echo $row['Username'] ;?>" class="form-control" autocomplete="off" />
                        <!--<input type="text" name="username" value="<?php // echo $row['Username'] ;?>" class="form-control" autocomplete="off" required="required"/>-->
                    </div>
                </div>
<!-- End Username Field -->

<!-- Start password Field -->
                <div class="form-group form-group-lg" >
                    <label class="col-sm-2 control-label">password</label>
                    <div class="col-sm-10 col-md-5">
                        <input type="hidden" name="oldpassword" value ="<?php echo$row['Password'] ; ?>" />
                        <input type="password" name="newpassword"  class="form-control" autocomplete="new-password" placeholder="Leave Blank if You Dont Want To Change"/>
                    </div> 
                </div>
<!-- End password Field -->

<!-- Start Email Field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10 col-md-5">
                        <input type="email" name="email" value="<?php echo $row['Email']; ?>" class="form-control" />
                    </div>
                </div>
<!-- End Email Field -->

<!-- Start Full Name Field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Full Name</label>
                    <div class="col-sm-10 col-md-5">
                        <input type="text" name="full" value="<?php echo $row['FullName'] ?>" class="form-control" />
                    </div>
                </div>
<!-- End Full Name Field -->



<!-- Start Submit Field -->
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="Submit" value="Save" class="btn btn-primary btn-lg" />
                    </div>
                </div>
<!-- End Submit Field -->
            </form>
        </div><!-- div class="container" -->	
        
<?php }else{ // if(count > 0 ) {

        $theMsg = "<div class = 'alert alert-danger'> There\'s No Such ID </div>";
        redirectHome($theMsg  );
    
     }//if(count > 0 ) { Edit Member

// Start Update  Page =================================================================================================================================================>
    }elseif ($do == 'update') {
        
        print '<h1 class="text-center">Update Member</h1>';
        
        print '<div class="container" >';
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
// Get Variable From Te From                     
                $id     = $_POST['userid'];
                $user   = $_POST['username'];
                $email  = $_POST['email'];
                $name   = $_POST['full'];
// Password Trick
                $pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']) ;

// Validate the Form
                $erForm = []; // Create Array Form

                if(strlen($user) < 2 ){
                    $erForm[] = '<strong> Username </strong>cant Be Less Than <strong>4 char </strong>';
                }//if(strlen($user) < 4 ){

                if(strlen($user) > 27 ){
                    $erForm[] = '<strong>Username</strong> cant Be More Than <strong>11 char</strong>';
                }//if(strlen($user) > 27 ){
                
                if(empty($user)){
                    $erForm[] = "<strong>Username</strong> Cant Be Empty";
                }//if(empty($user)){
                if(empty($email)){
                    $erForm[] ="<strong>Email</strong> Cant Be Empty";
                }//if(empty($email)){
                
                if(empty($name)){
                    $erForm[] ="<strong>Name</strong> Cant Be Empty";
                }//if(empty($name)){
                
// Loop Into Errors Array  And Echo IT                       
                foreach ($erForm as $vaForm){
                    echo '<div class="alert alert-danger">' . $vaForm . '</div>' ;
                }//foreach ($erForm as $vaForm){
                
// Check IF There's No Error Proceed The Update Operation 
            if(empty($erForm)){    
                
// Update The DataBase wirh This Info                      
                $stmt = $con->prepare("UPDATE `users` SET  `Password`=? ,`Username` =? ,`Email`=?,`FullName` =?, `Date`=now() WHERE UserID = ?  ");
                $stmt->execute(array( $pass ,$user , $email , $name , $id   ));
// ECHO Success Message 
                $theMsg ="<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Update </div>'  ;
                
                redirectHome($theMsg , 'Back');    

            }//if(empty($erForm)){    
                }else{
                    $theMsg = '<div class="alert alert-danger"> Sorry You Can\'t Browse This Page Directly </div> ';
                redirectHome($theMsg );    

                }//if($_SERVER['REQUEST_METHOD'] == 'POST'){
            print'</div>'; //  print '<div class="container" >';
    


    }elseif ($do = 'delete') {
        
        print '<div class="container" >';        
//Check if Get Request userid Is Numeric & Get The integar Value Of It 
        $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
// Select All Data Depend On This ID
        $check = checkItem("UserID","`users`", $userid);
/*=============================================================================*/
// Check if The user Exits in DataBase
     if($check > 0 ){ //$do = 'delete'

        if($_GET['do'] == 'activate'){
        print '<h1 class="text-center">Activate Member</h1>';

        $stmt = $con->prepare("UPDATE `users` SET `RegStatus` = 1 WHERE `UserID` = ?");
        
        $stmt->execute(array($userid));
         
// ECHO Success Message 
        $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Activated </div>'  ;  
        redirectHome($theMsg , 'Back'); 
        }else{// if($_GET['do'] == 'activate'){
        
        print '<h1 class="text-center">Delete Member</h1>';
        $stmt = $con->prepare("DELETE FROM `users` WHERE `UserID` = :zuser ");

        $stmt->bindParam(":zuser",$userid);
        
        $stmt->execute();
         
// ECHO Success Message 
        $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Deleted </div>'  ;  
        redirectHome($theMsg);               

       }//if($_GET['do'] == 'activate'){

     }else{  //if($check > 0 ){ //$do = 'delete'
     
        $theMsg = '<div class="alert alert-danger"> This ID Is Not Exist </div>';
        redirectHome($theMsg);               

     }//if($check > 0 ){
            
        
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
        