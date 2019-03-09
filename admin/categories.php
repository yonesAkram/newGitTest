<?php

/*
    ====================================================
    == Categories Page                                 =   
    == You Can Add | Edit | Delete Categories From Here   =
    ====================================================
*/

session_start();
if(isset($_SESSION['Username'])):
    $PageTitle = 'Categories';
    include "init.php";
    $do = isset($_GET['do']) ? $_GET['do'] : 'Mange' ;
      
// Start  Mamge Page =>
     if ($do == 'Mange'){

        $sort = 'ASC' ;    

        $sort_array = array("ASC","DESC");
        if (isset($_GET['sort']) && in_array($_GET['sort'], $sort_array)) {
            
            $sort =$_GET['sort'];

        }//if (isset($_GET['sort']) && in_array($_GET['sort'], $sort_array)) {
        
// // Select All Categories  
        $stmt2 = $con->prepare("SELECT * FROM  `categories` ORDER BY `Ordering` $sort ");
// // Execute Statement                
        $stmt2->execute();
// // Assign To Variable                
        $cats = $stmt2->fetchAll();
        if(!empty($cats)){
                 
 ?>
            <div class='container . categories' >
                <h1 class="text-center">Manage Category</h1>
            <a href='categories.php?do=add' class="btn btn-primary"><i class="fa fa-plus"> </i> Add New Category </a>    
            <a href='categories.php?do=add' class="btn btn-primary"><i class="fa fa-plus"> </i> Add New Category </a>    
            <a href='categories.php?do=add' class="btn btn-primary"><i class="fa fa-plus"> </i> Add New Category </a><br /><br />    
                <div class="panel panel-default">
                <div class="panel-heading"> 
                    <i class="fa fa-edit" ></i> Manage Catergories 
                    <div class="ordering pull-right">
                        <i class="fa fa-sort"></i>Ordering : [
                        <a class="<?php if($sort == 'ASC'){echo"active" ;} ?>" href="?sort=ASC">ASC</a> |                                
                        <a class="<?php if($sort == 'DESC'){echo"active" ;} ?>" href="?sort=DESC">DESC</a> ]                                
                    </div>
                </div><!-- div class="panel-heading" -->
                    <div class="panel-body">
    <?php
                        foreach ($cats as $Cat) {
                            echo "<div class='cat'>";
                                echo "<div class='hidden-buttons'>";

                                    echo "<a href='categories.php?do=edit&catid=" . $Cat['ID'] ."' class='btn btn-xs btn-primary'><i class='fa fa-edit'></i> Edit </a>";
                                    echo "<a href='categories.php?do=delete&catid=".$Cat['ID']."' class='confirm btn btn-xs btn-danger'><i class='fa fa-close'></i> Delete </a>";

                                echo "</div>";
                                echo "<h3>". $Cat['Name'] ."</h3>" ;
                                echo '<p>' . $Cat['Description'] .'</p>';
                                if($Cat['Visibility'] == 1){echo '<span class="Visibility" ><i class="fa fa-eye"></i> Hidden </span>'; } 
                                if($Cat['Allow_Comment'] == 1){echo '<span class="commenting" ><i class="fa fa-close"></i> Comment Disabled </span>'; } 
                                if($Cat['Allow_Ads'] == 1){echo '<span class="advertises" > <i class="fa fa-close"></i> ADS Disabled </span>'; } 
                            echo "</div> <hr />";    
                         }//foreach ($cats as $Cat) {
                            
    ?>                            
                    </div> <!-- <div class="panel-body"> -->
                </div><!-- div class="panel panel-default" -->
            </div> <!-- <div class='container'> -->
<?php   }else{//if(!empty($cats)){
            print'<div class="container">';
                echo "<div class='nice-message'>There is No Category To Show  </div>";
                echo '<a href="categories.php?do=add" class="btn btn-primary"><i class="fa fa-plus"> </i> Add Nem Category</a><br />';
            print'</div>';
        }//if(!empty($cats)){


// Start ADD  Page ====================================================================================================================================================>
    }elseif ($do == 'add') {?>

        <h1 class="text-center">Add New Category</h1>
        <div class="container">
            <form class="form-horizontal" action="?do=insert" method="POST">
        
<!-- Start Name Field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10 col-md-5">
                        <input type="text" name="Name" value="" class="form-control" autocomplete="off" placeholder="Name Of The Category"  />
                    </div><!-- <div class="col-sm-10 col-md-5"> -->
                </div><!-- <div class="form-group form-group-lg"> -->
<!-- End Name Field -->
<!-- Start Description Field -->
                <div class="form-group form-group-lg" >
                    <label class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10 col-md-5">
                        <input type="text" name="description"  class="form-control" placeholder="Describe The Category "  />
                    </div><!-- <div class="col-sm-10 col-md-5"> -->
                </div><!-- <div class="form-group form-group-lg"> -->
<!-- End Description Field -->
<!-- Start Ordering Field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Ordering</label>
                    <div class="col-sm-10 col-md-5">
                        <input type="text" name="ordering" class="form-control" placeholder="Number To Arrane Ordering The Categories "  />
                    </div><!-- <div class="col-sm-10 col-md-5"> -->
                </div><!-- <div class="form-group form-group-lg"> -->
<!-- End Ordering Field -->
<!-- Start Visibility Field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Visible</label>
                    <div class="col-sm-10 col-md-5">
                        <div>
                            <input id="vis-yes" type="radio" name="Visibility" value="0" checked />
                            <label for="vis-yes"> Yes</label>
                        </div>
                        <div>
                            <input id="vis-no" type="radio" name="Visibility" value="1" />
                            <label for="vis-no"> No</label>

                        </div>
                    </div><!-- <div class="col-sm-10 col-md-5"> -->
                </div><!-- <div class="form-group form-group-lg"> -->
<!-- End Visibility Field -->
<!-- Start Commenting Field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Allow Comment</label>
                    <div class="col-sm-10 col-md-5">
                        <div>
                            <input id="com-yes" type="radio" name="Commenting" value="0" checked />
                            <label for="com-yes"> Yes</label>
                        </div>
                        <div>
                            <input id="com-no" type="radio" name="Commenting" value="1" />
                            <label for="com-no"> No</label>

                        </div>
                    </div><!-- <div class="col-sm-10 col-md-5"> -->
                </div><!-- <div class="form-group form-group-lg"> -->
<!-- End Commenting Field -->
<!-- Start Allow Ads Field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label"> Allow Ads</label>
                    <div class="col-sm-10 col-md-5">
                        <div>
                            <input id="ads-yes" type="radio" name="ads" value="0" checked />
                            <label for="ads-yes"> Yes</label>
                        </div>
                        <div>
                            <input id="ads-no" type="radio" name="ads" value="1" />
                            <label for="ads-no"> No</label>

                        </div>
                    </div><!-- <div class="col-sm-10 col-md-5"> -->
                </div><!-- <div class="form-group form-group-lg"> -->
<!-- End Commenting Field -->

<!-- Start Submit Field -->
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="Submit" value="Add Category" class="btn btn-primary btn-lg" />
                    </div><!-- <div class="col-sm-offset-2 col-sm-10"> -->
                </div>
<!-- End Submit Field -->
            </form>
        </div><!-- div class="container" -->
<?php
// Start insert  Page ====================================================================================================================================================>
    }elseif ($do == 'insert') {


        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          print '<h1 class="text-center">Insert Category</h1>';  
          print '<div class="container" >';
// Get Variable From Te From                     
            $name       = $_POST['Name'];
            $desc       = $_POST['description'];
            $order      = $_POST['ordering'];
            $Visible    = $_POST['Visibility'];
            $Comment    = $_POST['Commenting'];
            $Ads        = $_POST['ads'];
            
            
// Check IF Category Exits in DataBase            
            $check = checkItem("Name","categories", $name);

            if($check == 1){
                $theMsg = "<div class='alert alert-danger'>Sorry This Category Is Exits</div>" ;
                redirectHome($theMsg,'Back');
            
            }else{ //if($check == 1){

// Insert Category Info in DataBase                       
                $stmt = $con->prepare("INSERT INTO `categories` (Name , Description , Ordering , Visibility , Allow_Comment    ,Allow_Ads, `Date`) VALUES (:zname, :zdesc, :zorder, :zVisible, :zComment , :zAds ,now() ) ");
    // Exexute The Statement                         
                $stmt->execute(array(   'zname'     => $name,
                                        'zdesc'     => $desc,
                                        'zorder'    => $order,
                                        'zVisible'  => $Visible,
                                        'zComment'  => $Comment,
                                        'zAds'      => $Ads
                                     ));    
    // ECHO Success Message 
                 $theMsg =  "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Inserted Member </div>'  ;
                redirectHome($theMsg , 'Back'  );

            }//if($check == 1){
        
            }else{
              
              print '<div class="container" >';
                $MsgInsert =  '<div class = "alert alert-danger">Sorry You Can\'t Browse This Page Directly </div>';

                redirectHome($MsgInsert , 'Back'  );
              print'</div>'; // print '<div class="container" >';
                
            }//if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
        print'</div>'; // print '<div class="container" >';
      
// Start Edit  Page
//=======================================>
//=======================================>
    }elseif ($do == 'edit') {

//Check if Get Request CatID Is Numeric & Get The integar Value Of It 
        $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;
// Select All Data Depend On This ID
        $stmt = $con->prepare("SELECT * FROM `categories` WHERE `ID` = ?  ");
// Execute Query
        $stmt->execute(array($catid));
//Fetch The Data         
        $cat = $stmt->fetch();
        $count = $stmt->rowCount();
/*=============================================================================*/
// Check if The user Exits in DataBase
     if($count > 0 ){  ?>
        
        <h1 class="text-center"> Edit Category </h1>
        <div class="container">

            <form class="form-horizontal" action="?do=update" method="POST">
                <input type="Hidden" name="catid" value="<?php echo $catid ; ?>" />                                       
<!-- Start Name Field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10 col-md-5">
                        <input type="text" name="Name" value="<?php echo $cat['Name']; ?>" class="form-control" auplete="off" placeholder="Name Of The Category"  />
                    </div><!-- <div class="col-sm-10 col-md-5"> -->
                </div><!-- <div class="form-group form-group-lg"> -->
<!-- End Name Field -->
<!-- Start Description Field -->
                <div class="form-group form-group-lg" >
                    <label class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10 col-md-5">
                        <input type="text" name="description" value="<?php echo $cat['Description']; ?>" class="form-control" placeholder="Describe The Category "  />
                    </div><!-- <div class="col-sm-10 col-md-5"> -->
                </div><!-- <div class="form-group form-group-lg"> -->
<!-- End Description Field -->
<!-- Start Ordering Field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Ordering</label>
                    <div class="col-sm-10 col-md-5">
                        <input type="text" name="ordering" value="<?php echo $cat['Ordering']; ?>" class="form-control" placeholder="Number To Arrane Ordering The Categories "  />
                    </div><!-- <div class="col-sm-10 col-md-5"> -->
                </div><!-- <div class="form-group form-group-lg"> -->
<!-- End Ordering Field -->
<!-- Start Visibility Field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Visible</label>
                    <div class="col-sm-10 col-md-5">
                        <div>
                            <input id="vis-yes" type="radio" name="Visibility" value="0" <?php if($cat['Visibility'] == 0){echo "Checked" ;} ?> />
                            <label for="vis-yes"> Yes</label>
                        </div>
                        <div>    
                            <input id="vis-no" type="radio" name="Visibility" value="1" <?php if($cat['Visibility']== 1){echo "checked";} ?> />
                            <label for="vis-no"> No</label>
                        </div>
                    </div><!-- <div class="col-sm-10 col-md-5"> -->
                </div><!-- <div class="form-group form-group-lg"> -->
<!-- End Visibility Field -->
<!-- Start Commenting Field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Allow Comment</label>
                    <div class="col-sm-10 col-md-5">
                        <div>
                            <input id="com-yes" type="radio" name="Commenting" value="0" <?php if($cat['Allow_Comment']== 0){echo "checked";} ?> />
                            <label for="com-yes"> Yes</label>
                        </div>
                        <div>
                            <input id="com-no" type="radio" name="Commenting" value="1" <?php if($cat['Allow_Comment'] == 1 ){echo "checked";} ?> />
                            <label for="com-no"> No</label>
                        </div>
                    </div><!-- <div class="col-sm-10 col-md-5"> -->
                </div><!-- <div class="form-group form-group-lg"> -->
<!-- End Commenting Field -->
<!-- Start Allow Ads Field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label"> Allow Ads</label>
                    <div class="col-sm-10 col-md-5">
                        <div>
                            <input id="ads-yes" type="radio" name="ads" value="0"  <?php if($cat['Allow_Ads']== 0){echo "checked";} ?> />
                            <label for="ads-yes"> Yes</label>
                        </div>
                        <div>
                            <input id="ads-no" type="radio" name="ads" value="1"  <?php if($cat['Allow_Ads']== 1){echo "checked";} ?> />
                            <label for="ads-no"> No</label>
                        </div>
                    </div><!-- <div class="col-sm-10 col-md-5"> -->
                </div><!-- <div class="form-group form-group-lg"> -->
<!-- End Commenting Field -->
<!-- Start Submit Field -->
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="Submit" value="Save Category" class="btn btn-primary btn-lg" />
                    </div><!-- <div class="col-sm-offset-2 col-sm-10"> -->
                </div>
<!-- End Submit Field -->
            </form>
        </div><!-- div class="container" -->

<?php }else{ // if(count > 0 ) {Edit Check DataBase

        $theMsg = "<div class = 'alert alert-danger'> There\'s No Such ID </div>";
        redirectHome($theMsg  );
    
     }//if(count > 0 ) { Edit Member
 //====================
 //====================
// Start Update  Page =
//=====================
//=====================
    }elseif ($do == 'update') {

        print '<h1 class="text-center">Update Category</h1>';
        
        print '<div class="container" >';
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
// Get Variable From Te From                     
                $id        = $_POST['catid'];
                $name      = $_POST['Name'];
                $desc      = $_POST['description'];
                $order     = $_POST['ordering'];

                $Visible   = $_POST['Visibility'];
                $Comment   = $_POST['Commenting'];
                $Ads       = $_POST['ads'];
                
// Update The DataBase wirh This Info                      
                $stmt = $con->prepare("UPDATE `categories` SET  `Name`=? ,`Description` =? ,`Ordering`=?,`Visibility` =?,`Allow_Comment` =?,`Allow_Ads` =?, `Date`=now() WHERE `ID` = ?  ");
                $stmt->execute(array( $name ,$desc , $order , $Visible , $Comment , $Ads , $id   ));
// ECHO Success Message 
                $theMsg ="<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Update </div>'  ;
                
                redirectHome($theMsg , 'Back');    

  
            }else{
                $theMsg = '<div class="alert alert-danger"> Sorry You Can\'t Browse This Page Directly </div> ';
                redirectHome($theMsg );    

            }//if($_SERVER['REQUEST_METHOD'] == 'POST'){
        print'</div>'; //  print '<div class="container" >';
 //====================
 //====================
// Start Delete  Page =
//=====================
//=====================
    }elseif ($do = 'delete') {
        print '<h1 class="text-center">Delete Category</h1>';        
        print '<div class="container" >';        
//Check if Get Request catid Is Numeric & Get The integar Value Of It 
        $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;
// Select All Data Depend On This ID
        $check = checkItem("ID","`categories`", $catid);
/*=============================================================================*/
// Check if The Name Exits in DataBase
     if($check > 0 ){ //$do = 'delete'

        $stmt = $con->prepare("DELETE FROM `categories` WHERE `ID` = :zid ");
        $stmt->bindParam(":zid",$catid);
        $stmt->execute();
// ECHO Success Message 
        $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Deleted Category </div>'  ;  
        redirectHome($theMsg , 'Back');                   
     }else{  //if($check > 0 ){ //$do = 'delete'    
        $theMsg = '<div class="alert alert-danger"> This ID Is Not Exist </div>';
        redirectHome($theMsg);               
     }//if($check > 0 ){


    }else{ //if ($do == 'Mange'){
        
        $theMsg = '<div class="alert alert-danger">Error There\'s No Paeg With This Name </div>' ;
        redirectHome($theMsg , 'Back');               
    
    }//if ($do == 'Mange'){
    
    include $tpl . 'footer.php';

    
else :
    header('location: index.php');
endif; //if(isset($_SESSION['Username']))



?>
        