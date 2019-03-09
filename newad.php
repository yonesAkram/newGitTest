<?php
session_start();
$PageTitle = 'Create New Item';
include "init.php";
if (isset($_SESSION['user'])){
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$formErrors = array();
//Fillter ALL Request Method
		$name  	 	= filter_var($_POST['name'] , FILTER_SANITIZE_STRING);
		$desc  	 	= filter_var($_POST['desciption'] , FILTER_SANITIZE_STRING);
		$price   	= filter_var($_POST['price'] , FILTER_SANITIZE_NUMBER_INT);
		$country   	= filter_var($_POST['country'] , FILTER_SANITIZE_STRING);
		$status   	= filter_var($_POST['status'] ,FILTER_SANITIZE_NUMBER_INT );
		$category   = filter_var($_POST['category'] , FILTER_SANITIZE_NUMBER_INT);

		if(strlen($name) < 4){
			$formErrors[] = 'Item Title Must Be At Least 4 Char';
		}//if(strlen($name) < 4){

		if(strlen($desc) < 10){
			$formErrors[] = 'Item desciption Must Be At Least 10 Char';
		}//if(strlen($desc) < 4){

		if(strlen($country) < 2){
			$formErrors[] = 'Item country Must Be At Least 2 Char';
		}//if(strlen($country) < 4){

		if(empty($price)){
			$formErrors[] = 'Item Price Must Be Not Empty';
		}//if(empty($price) {

		if(empty($status)){
			$formErrors[] = 'Item Status Must Be Not Empty';
		}//if(empty($status) {

		if(empty($category)){
			$formErrors[] = 'Item category Must Be Not Empty';
		}//if(empty($price){

// Check IF There's No Error Proceed The Update Operation
        if(empty($formErrors)){

// Insert The DataBase wirh This Info
            $stmt = $con->prepare("INSERT INTO `items` (Name ,  Desciption , Price , Country_Made , Status, `Add_Date`,`Member_ID`,`Cat_ID`) VALUES (:zname, :zdesc, :zprice, :zcountry, :zstatus, now(),:zmember  ,:zcategory ) ");
// Exexute The Statement
            $stmt->execute(array('zname' => $name , 'zdesc' => $desc, 'zprice' => $price, 'zcountry' => $country , 'zstatus' => $status, 'zmember' => $_SESSION['uid'] , 'zcategory' => $category ));
// ECHO Success Message
            $theMsg =  "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record // Item Add </div>'  ;
            if($stmt){
// echo $theMsg;=====================================================================================
            }//if($stmt){
            
        }//if(empty($erForm)){	
		 			
	}//if($_SERVER['REQUEST_METHOD'] == 'POST'){

?>
	<h1 class="text-center"><?php echo $PageTitle; ?></h1>
    <div class="information block">
    	<div class="container">
    		<div class="panel panel-primary">
	    		<div class="panel-heading"><?php echo $PageTitle; ?></div>
	    		<div class="panel-body">
					<div class="row">
						<div class="col-md-8">
							<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
	<!-- Start Name Field -->
	                <div class="form-group form-group-lg">
	                    <label class="col-sm-3 control-label">Name</label>
	                    <div class="col-sm-10 col-md-9">
	                        <input type="text" name="name" class="form-control live" placeholder="Name Of The Item" data-class=".live-title" />
	                    </div><!-- <div class="col-sm-10 col-md-5"> -->
	                </div><!-- <div class="form-group form-group-lg"> -->
	<!-- End Name Field -->
	<!-- Start Desciption Field -->
	                <div class="form-group form-group-lg">
	                    <label class="col-sm-3 control-label">Desciption</label>
	                    <div class="col-sm-10 col-md-9">
	                        <input type="text" name="desciption" class="form-control live" placeholder="Desciption Of The Item" data-class=".live-desc" />
	                    </div><!-- <div class="col-sm-10 col-md-5"> -->
	                </div><!-- <div class="form-group form-group-lg"> -->
	<!-- End Desciption Field -->
	<!-- Start Price Field -->
	                <div class="form-group form-group-lg">
	                    <label class="col-sm-3 control-label">Price</label>
	                    <div class="col-sm-10 col-md-9">
	                        <input type="text" name="price" class="form-control live" placeholder="Price Of The Item " data-class=".live-price" />
	                    </div><!-- <div class="col-sm-10 col-md-5"> -->
	                </div><!-- <div class="form-group form-group-lg"> -->
	<!-- End Price Field -->
	<!-- Start Country_Made Field -->
	                <div class="form-group form-group-lg">
	                    <label class="col-sm-3 control-label">Country</label>
	                    <div class="col-sm-10 col-md-9">
	                        <input type="text" name="country" class="form-control" placeholder="Country Of Made "  />
	                    </div><!-- <div class="col-sm-10 col-md-5"> -->
	                </div><!-- <div class="form-group form-group-lg"> -->
	<!-- End Country_Made Field -->
	<!-- Start Status Field -->
	                <div class="form-group form-group-lg">
	                    <label class="col-sm-3 control-label">Status</label>
	                    <div class="col-sm-10 col-md-9">
	                        <select class="form-control" name="status">
	                            <option value="0" >...</option>
	                            <option value="1" >New</option>
	                            <option value="" >Like New</option>
	                            <option value="3" >Used</option>
	                            <option value="4" >Very Old</option>
	                        </select><!-- <select class="form-control" name="status"> -->
	                    </div><!-- <div class="col-sm-10 col-md-5"> -->
	                </div><!-- <div class="form-group form-group-lg"> -->
	<!-- End Status Field -->
	<!-- Start Category Field -->
	                <div class="form-group form-group-lg">
	                    <label class="col-sm-3 control-label">Category</label>
	                    <div class="col-sm-10 col-md-9">
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
	                    <div class="col-sm-offset-3 col-sm-11">
	                        <input type="Submit" value="Add Items" class="btn btn-primary btn-sm" />
	                    </div><!-- <div class="col-sm-offset- col-sm-10"> -->
	                </div>
	<!-- End Submit Field -->
							</form><!-- <form class="form-horizontal" action="?do=insert" method="POST"> -->
						</div><!-- <div class="col-md-8"> -->
						<div class="col-md-4">
							<div class="thumbnail item-box live-preview">';
								<span class='price-tag' >
									$<span class="live-price"></span>
								</span>
								<img class='img-responsive' src='aassdd.jpg' alt='' />
								<div class="caption">
									<h3 class="live-title">Test</h3>
									<p class="live-desc">test</p>
								</div><!-- <div class="caption"> -->
							</div><!-- <div class="thumbnail item-box">'; -->
						</div><!-- <div class="col-sm-6 col-md-4"> -->
					</div><!-- <div class="row"> -->
    			<!-- Start Looping Through Errors -->
    			<?php 
    				if(!empty($formErrors)){
    					foreach ($formErrors as $error) {
    						echo "<div class='alert alert-danger' >";
    							echo $error;
    						echo "</div>";

    					}//foreach ($formErrors as $error) {
    				}//if(!empty($formErrors)){

    			?>
    			<!-- Start Looping Through Errors -->
    			</div><!--<div class="panel-body"> -->
     		</div><!-- <div class="panel panel-primary"> -->
    	</div><!-- <div class="container"> -->
	</div><!-- <div class="information block"> -->

<?php
}else{

	header('location: login.php');
	exit();

}//if (isset($_SESSION['user'])) {

 include $tpl . "footer.php";
 ?>
