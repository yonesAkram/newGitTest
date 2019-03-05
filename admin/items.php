<?php
/*
    ====================================================
    == Mange Items Page                               =
    == You Can Add | Edit | Delete Members From Here   =
    ====================================================
*/

session_start();
if(isset($_SESSION['Username'])):
    $PageTitle = 'Items';
    include "init.php";
    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage' ;

// Start  Mamge Page =>
     if ($do == 'Manage'){

// Select All User Except Admin
        $stmt5 = $con->prepare(" SELECT items.* , categories.Name AS Category_name , users.Username AS Client_user FROM items INNER JOIN categories ON categories.ID = items.Cat_ID INNER JOIN users ON users.UserID = items.Member_ID  ORDER BY `item_ID` DESC");
// Execute Statement
        $stmt5->execute();
// Assign To Variable
        $items = $stmt5->fetchAll();
        if(!empty($items)){
?>
            <div class='container'>
                <h1 class="text-center">Manage Items</h1>
                <a href='items.php?do=add' class="btn btn-primary"><i class="fa fa-plus"> </i> New Items</a><br /><br />
                <div class="table-responsive">
                    <table class="main-table text-center table table-bordered">
                        <tr>
                            <td># item_ID</td>
                            <td>Name</td>
                            <td>Desciption</td>
                            <td>Price</td>
                            <td>Category</td>
                            <td>Username</td>
                            <td>Control</td>
                        </tr>
    <?php
                    foreach($items as $item){
                     print'<tr>' ;
                        print'<td>'.$item['item_ID'].'</td>';
                        print'<td>'.$item['Name'].'</td>';
                        print'<td>'.$item['Desciption'].'</td>';
                        print'<td>'.$item['Price'].'</td>';
                        print'<td>'.$item['Category_name'].'</td>';
                        print'<td>'.$item['Client_user'].'</td>';
                        print'<td>';

                        print'<a href="items.php?do=edit&itemid='.$item['item_ID'].'" class="btn btn-primary"><i class ="fa fa-edit "></i> Edit</a>';

                        print'<a href="items.php?do=delete&itemid='.$item['item_ID'].'" class="btn btn-danger activate confirm" ><i class ="fa fa-close "></i> Delete</a>';
                         if($item['Approve']==0){
                            print'<a href="items.php?do=Approve&itemid=' .$item['item_ID']. '" class="btn btn-info activate"> <i class ="fa fa-check "></i> Approve</a>';

                        }

                        print'</td>';
                     print'</tr>';
                    }//foreach($rows as $row){
    ?>
                    </table> <!-- table class="main-table text-center table table-bordered" -->
                </div> <!-- div class="table-responsive" -->
            </div> <!-- <div class='container'> -->
<?php   }else{//if(!empty($rows)){
            print'<div class="container">';
                echo "<div class='nice-message'>There is No Items To Show  </div>";
                echo '<a href="items.php?do=add" class="btn btn-primary"><i class="fa fa-plus"> </i> New Items</a><br />';
            print'</div>';

        }//if(!empty($rows)){

// Start ADD  Page ====================================================================================================================================================>
    }elseif ($do == 'add') { ?>

        <h1 class="text-center">Add New Items</h1>
        <div class="container">
            <form class="form-horizontal" action="?do=insert" method="POST">

<!-- Start Name Field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10 col-md-5">
                        <input type="text" name="name" class="form-control" placeholder="Name Of The Item"  />
                    </div><!-- <div class="col-sm-10 col-md-5"> -->
                </div><!-- <div class="form-group form-group-lg"> -->
<!-- End Name Field -->
<!-- Start Desciption Field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Desciption</label>
                    <div class="col-sm-10 col-md-5">
                        <input type="text" name="desciption" class="form-control" placeholder="Desciption Of The Item"  />
                    </div><!-- <div class="col-sm-10 col-md-5"> -->
                </div><!-- <div class="form-group form-group-lg"> -->
<!-- End Desciption Field -->
<!-- Start Price Field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Price</label>
                    <div class="col-sm-10 col-md-5">
                        <input type="text" name="price" class="form-control" placeholder="Price Of The Item "  />
                    </div><!-- <div class="col-sm-10 col-md-5"> -->
                </div><!-- <div class="form-group form-group-lg"> -->
<!-- End Price Field -->
<!-- Start Country_Made Field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Country</label>
                    <div class="col-sm-10 col-md-5">
                        <input type="text" name="country" class="form-control" placeholder="Country Of Made "  />
                    </div><!-- <div class="col-sm-10 col-md-5"> -->
                </div><!-- <div class="form-group form-group-lg"> -->
<!-- End Country_Made Field -->
<!-- Start Status Field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-10 col-md-5">
                        <select class="form-control" name="status">
                            <option value="0" >...</option>
                            <option value="1" >New</option>
                            <option value="2" >Like New</option>
                            <option value="3" >Used</option>
                            <option value="4" >Very Old</option>
                        </select><!-- <select class="form-control" name="status"> -->
                    </div><!-- <div class="col-sm-10 col-md-5"> -->
                </div><!-- <div class="form-group form-group-lg"> -->
<!-- End Status Field -->
<!-- Start Member Field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Member</label>
                    <div class="col-sm-10 col-md-5">
                        <select class="form-control" name="member">
                            <option value="0" >...</option>
                            <?php
                                $stmt3 = $con->prepare("SELECT * FROM `users` ");
                                $stmt3->execute();
                                $users = $stmt3->FetchAll();
                                foreach ($users as $user) {
                                    echo "<option value='".$user["UserID"]."' >".$user["Username"]."</option> ";
                                }
                            ?>
                        </select><!-- <select class="form-control" name="Member"> -->
                    </div> <!-- <div class="col-sm-10 col-md-5">-->
                </div> <!-- <div class="form-group form-group-lg">-->
<!--  End Member Field -->
<!-- Start Category Field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Category</label>
                    <div class="col-sm-10 col-md-5">
                        <select class="form-control" name="category">
                            <option value="0" >...</option>
                            <?php
                                $stmt4 = $con->prepare("SELECT * FROM `categories` ");
                                $stmt4->execute();
                                $cats = $stmt4->FetchAll();
                                foreach ($cats as $cat) {
                                    echo "<option value='".$cat["ID"]."' >".$cat["Name"]."</option> ";
                                }
                            ?>
                        </select><!-- <select class="form-control" name="category"> -->
                    </div> <!-- <div class="col-sm-10 col-md-5">-->
                </div> <!-- <div class="form-group form-group-lg">-->
<!--  End Category Field -->
<!-- Start Submit Field -->
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="Submit" value="Add Items" class="btn btn-primary btn-sm" />
                    </div><!-- <div class="col-sm-offset-2 col-sm-10"> -->
                </div>
<!-- End Submit Field -->
            </form><!-- <form class="form-horizontal" action="?do=insert" method="POST"> -->
        </div><!-- div class="container" -->
<?php

// Start insert  Page ====================================================================================================================================================>
    }elseif ($do == 'insert') {

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            print '<h1 class="text-center">Insert Items</h1>';
            print '<div class="container" >';
// Get Variable From Te From
            $name        = $_POST['name'];
            $descri      = $_POST['desciption'];
            $price       = $_POST['price'];
            $country     = $_POST['country'];
            $status      = $_POST['status'];
            $member      = $_POST['member'];
            $category    = $_POST['category'];


// Validate the Form
            $erForm = array(); // Create Array Form

            if(empty($name)){
                $erForm[] = '<strong> Name cant Be Empty </strong>';
            }//if(strlen($name)){

            if(empty($descri)){
                $erForm[] = '<strong> Desciption cant Be Empty </strong>';

            }//if(strlen($descri)){

            if(empty($price)){
                $erForm[] = '<strong> Price cant Be Empty </strong>';

            }//if(empty($price)){
            if(empty($country)){
                $erForm[] = '<strong> Country cant Be Empty </strong>';

            }//if(empty($country)){
            if($status == 0){
                $erForm[] = '<strong> You Must Choose The Status </strong>';

            }//if(empty($status)){
            if($member == 0){
                $erForm[] = '<strong> You Must Choose The member </strong>';

            }//if(empty($member)){
            if($category == 0){
                $erForm[] = '<strong> You Must Choose The Category </strong>';

            }//if(empty($Category)){
// Loop Into Errors Array  And Echo IT
            foreach ($erForm as $vaForm){
                echo '<div class="alert alert-danger">' . $vaForm . '</div>' ;
            }//foreach ($erForm as $vaForm){

// Check IF There's No Error Proceed The Update Operation
        if(empty($erForm)){

// Insert The DataBase wirh This Info
            $stmt = $con->prepare("INSERT INTO `items` (Name ,  Desciption , Price , Country_Made , Status, `Add_Date`,`Member_ID`,`Cat_ID`) VALUES (:zname, :zdescri, :zprice, :zcountry, :zstatus, now(),:zmember  ,:zcategory ) ");
// Exexute The Statement
            $stmt->execute(array('zname' => $name , 'zdescri' => $descri, 'zprice' => $price, 'zcountry' => $country , 'zstatus' => $status, 'zmember' => $member, 'zcategory' => $category ));
// ECHO Success Message
            $theMsg =  "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Inserted Item </div>'  ;
            redirectHome($theMsg , 'Back');

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

//Check if Get Request itemid Is Numeric & Get The integar Value Of It
        $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

        $stmt = $con->prepare("SELECT * FROM `items` WHERE `item_ID` = ? ");
        $stmt->execute(array($itemid));
        $item = $stmt->fetch();
        $count = $stmt->rowCount();
/*=============================================================================*/
// Check if The user Exits in DataBase
     if($count > 0 ){  ?>

        <h1 class="text-center">Edit Items</h1>
        <div class="container">
            <form class="form-horizontal" action="?do=update" method="POST">
                <input type="Hidden" name="itemid" value="<?php echo $itemid ; ?>" />

<!-- Start Name Field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10 col-md-5">
                        <input type="text" name="name" value="<?php echo $item['Name'] ; ?>" class="form-control"  />
                    </div><!-- <div class="col-sm-10 col-md-5"> -->
                </div><!-- <div class="form-group form-group-lg"> -->
<!-- End Name Field -->
<!-- Start Desciption Field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Desciption</label>
                    <div class="col-sm-10 col-md-5">
                        <input type="text" name="desciption" value="<?php echo $item['Desciption'] ; ?>" class="form-control"   />
                    </div><!-- <div class="col-sm-10 col-md-5"> -->
                </div><!-- <div class="form-group form-group-lg"> -->
<!-- End Desciption Field -->
<!-- Start Price Field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Price</label>
                    <div class="col-sm-10 col-md-5">
                        <input type="text" name="price" value="<?php echo $item['Price'] ; ?>" class="form-control"  />
                    </div><!-- <div class="col-sm-10 col-md-5"> -->
                </div><!-- <div class="form-group form-group-lg"> -->
<!-- End Price Field -->
<!-- Start Country_Made Field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Country</label>
                    <div class="col-sm-10 col-md-5">
                        <input type="text" name="country" value="<?php echo $item['Country_Made'] ; ?>" class="form-control"/>
                    </div><!-- <div class="col-sm-10 col-md-5"> -->
                </div><!-- <div class="form-group form-group-lg"> -->
<!-- End Country_Made Field -->
<!-- Start Status Field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-10 col-md-5">
                        <select class="form-control" name="status">
                            <option value="1" <?php if($item['Status'] == 1){echo "selected";}  ?>>New</option>
                            <option value="2" <?php if($item['Status'] == 2){echo "selected";}  ?>>Like New</option>
                            <option value="3" <?php if($item['Status'] == 3){echo "selected";}  ?>>Used</option>
                            <option value="4" <?php if($item['Status'] == 4){echo "selected";}  ?>>Very Old</option>
                        </select><!-- <select class="form-control" name="status"> -->
                    </div><!-- <div class="col-sm-10 col-md-5"> -->
                </div><!-- <div class="form-group form-group-lg"> -->
<!-- End Status Field -->
<!-- Start Member Field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Member</label>
                    <div class="col-sm-10 col-md-5">
                        <select class="form-control" name="member">
                            <?php
                                $stmt3 = $con->prepare("SELECT * FROM `users` ");
                                $stmt3->execute();
                                $users = $stmt3->FetchAll();
                                foreach ($users as $user) {
                                    echo "<option value='".$user["UserID"]."'";
                                        if($item['Member_ID'] == $user["UserID"] ){echo "selected";}
                                    echo">". $user['Username'] ."</option> ";

                                }//foreach ($users as $user) {
                            ?>
                        </select><!-- <select class="form-control" name="Member"> -->
                    </div> <!-- <div class="col-sm-10 col-md-5">-->
                </div> <!-- <div class="form-group form-group-lg">-->
<!--  End Member Field -->
<!-- Start Category Field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Category</label>
                    <div class="col-sm-10 col-md-5">
                        <select class="form-control" name="category">
                            <?php
                                $stmt4 = $con->prepare("SELECT * FROM `categories` ");
                                $stmt4->execute();
                                $cats = $stmt4->FetchAll();
                                foreach ($cats as $cat) {

                                    echo "<option value='".$cat["ID"]."'";
                                        if($item['Cat_ID'] == $cat["ID"] ){echo "selected";}
                                    echo">". $cat["Name"] ."</option> ";

                                }// foreach ($cats as $cat) {
                            ?>
                        </select><!-- <select class="form-control" name="category"> -->
                    </div> <!-- <div class="col-sm-10 col-md-5">-->
                </div> <!-- <div class="form-group form-group-lg">-->
<!--  End Category Field -->
<!-- Start Submit Field -->
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="Submit" value="Save Items" class="btn btn-primary btn-sm" />
                    </div><!-- <div class="col-sm-offset-2 col-sm-10"> -->
                </div><!--<div class="form-group">-->
<!-- End Submit Field -->
            </form>
<?php
// Select All User Except Admin
        $stmtCom = $con->prepare("  SELECT
                                        comments.*,users.Username AS USERNAME
                                    FROM
                                        comments
                                    INNER JOIN
                                        users
                                    ON
                                        users.UserID = comments.user_id
                                    WHERE
                                        item_id = ?
                                ");
// Execute Statement
        $stmtCom->execute(array($itemid));
// Assign To Variable
        $Coms = $stmtCom->fetchAll();
        if (! empty($Coms)) {
 ?>
            <div class='container'>
                <h1 class="text-center">Manage [ <?php echo $item['Name'] ; ?> ] Comments</h1>
                <div class="table-responsive">
                    <table class="main-table text-center table table-bordered">
                        <tr>
                                <td>Comment</td>
                                <td>User Name</td>
                                <td>Comment Date</td>
                                <td>Control</td>
                        </tr>
    <?php
                    foreach($Coms as $Com){
                     print'<tr>' ;
                        print'<td>'.$Com['comment'].'</td>';
                        print'<td>'.$Com['USERNAME'].'</td>';
                        print'<td>'.$Com['comment_date'].'</td>';
                        print'<td>';

                        print'<a href="comments.php?do=edit&commentid='.$Com['c_id'].'" class="btn btn-primary"><i class ="fa fa-edit "></i> Edit</a>';

                        print'<a href="comments.php?do=delete&commentid='.$Com['c_id'].'" class="btn btn-danger activate" confirm ><i class ="fa fa-close "></i> Delete</a>';

                        if($Com['Approve']==0){
                            print'<a href="comments.php?do=Approve&commentid=' .$Com['c_id']. '" class="btn btn-info activate"> <i class ="fa fa-check "></i> Activate</a>';

                        } //if($row['RegStatus']==0){

                            print'</td>';
                     print'</tr>';
                print'</table>';// <table class="main-table text-center table table-bordered">
                }//foreach($rows as $row){?>
            </div><!-- div class="container" -->
<?php   }//if (! empty($Coms)){

     }else{ // if(count > 0 ) {

        $theMsg = "<div class = 'alert alert-danger'> There\'s No Such ID </div>";
        redirectHome($theMsg ,'Back' );

     }//if(count > 0 ) { Edit Member

// Start Update  Page =================================================================================================================================================>
    }elseif ($do == 'update') {

        print '<h1 class="text-center">Update Items</h1>';
        print '<div class="container" >';
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

// Get Variable From Te From
            $id          = $_POST['itemid'];
            $name        = $_POST['name'];
            $descri      = $_POST['desciption'];
            $price       = $_POST['price'];
            $country     = $_POST['country'];
            $status      = $_POST['status'];
            $member      = $_POST['member'];
            $category    = $_POST['category'];

            // Validate the Form
            $erForm = []; // Create Array Form

            if(empty($name)){
                $erForm[] = '<strong> Name cant Be Empty </strong>';
            }//if(strlen($name)){

            if(empty($descri)){
                $erForm[] = '<strong> Desciption cant Be Empty </strong>';

            }//if(strlen($descri)){

            if(empty($price)){
                $erForm[] = '<strong> Price cant Be Empty </strong>';

            }//if(empty($price)){
            if(empty($country)){
                $erForm[] = '<strong> Country cant Be Empty </strong>';

            }//if(empty($country)){
            if($status == 0){
                $erForm[] = '<strong> You Must Choose The Status </strong>';

            }//if(empty($status)){
            if($member == 0){
                $erForm[] = '<strong> You Must Choose The member </strong>';

            }//if(empty($member)){
            if($category == 0){
                $erForm[] = '<strong> You Must Choose The Category </strong>';

            }//if(empty($Category)){

// Loop Into Errors Array  And Echo IT
            foreach ($erForm as $vaForm){
                echo '<div class="alert alert-danger">' . $vaForm . '</div>' ;
            }//foreach ($erForm as $vaForm){

// Check IF There's No Error Proceed The Update Operation
            if(empty($erForm)){

// Update The DataBase wirh This Info
                $stmt = $con->prepare("UPDATE `items` SET  `Name`=? ,`Desciption` =? ,`Price`=?,`Country_Made` =?,`Status` =?,`Member_ID` =?,`Cat_ID` =?, `Add_Date`=now() WHERE item_ID = ?  ");
                $stmt->execute(array( $name ,$descri , $price , $country , $status ,$member ,$category , $id   ));
// ECHO Success Message
                $theMsg ="<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Update To Item </div>'  ;

                redirectHome($theMsg );

            }//if(empty($erForm)){
                }else{
                    $theMsg = '<div class="alert alert-danger"> Sorry You Can\'t Browse This Page Directly </div> ';
                redirectHome($theMsg );

                }//if($_SERVER['REQUEST_METHOD'] == 'POST'){
            print'</div>'; //  print '<div class="container" >';

    }elseif ($do = 'delete') {

        print '<div class="container" >';
//Check if Get Request itemid Is Numeric & Get The integar Value Of It
            $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
// Select All Data Depend On This ID
            $checkDel = checkItem("item_ID","`items`", $itemid);
    /*=============================================================================*/
// Check if The Name Exits in DataBase
         if($checkDel > 0 ){ //$do = 'delete'

            if($_GET['do'] == 'Approve'){

                print '<h1 class="text-center">Approve Items</h1>';
                $stmt = $con->prepare("UPDATE `items` SET `Approve` = 1 WHERE `item_ID` = ?");
                $stmt->execute(array($itemid));

                // // ECHO Success Message
                $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Approve </div>'  ;
                redirectHome($theMsg);
            }else{// if($_GET['do'] == 'activate'){

                print '<h1 class="text-center">Delete Items</h1>';

                $stmt = $con->prepare("DELETE FROM `items` WHERE `item_ID` = :zid ");
                $stmt->bindParam(":zid",$itemid);
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
