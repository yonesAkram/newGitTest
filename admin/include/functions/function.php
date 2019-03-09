<?php    
// Title Function That Echo  The Page Title in Case The Page [V 1.0]

	function getTitle(){
    
	 	GLOBAL $PageTitle ; 

	 	if(isset($PageTitle)){

	 		echo $PageTitle;
	 	
	 	}else{
	 	
	 		echo "Ecommerce";
	 	
	 	}//if(isset($PageTitle))

	} // function getTitle()
	
        
/****
 *** Home Redirect Function [ This Function Accept Parameters ] / V 2.0 /
****/
	function redirectHome($theMsg , $url = 'null' , $seconds = 2){

		if($url == 'null'){

			$url = 'index.php';
			
			$link = '<strong> Home Page </strong>';
		}else{ //// if($url == nul){

			if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '' ){

				$url = $_SERVER['HTTP_REFERER'];

				$link = '<strong> Previous Page </strong>';
			}else{

				$url = 'index.php';

				$link = '<strong> Home Page </strong>';

			} // if(isset($_SERVER['HTTP_REFERER']) And empty($_SERVER['HTTP_REFERER'])){    

		}// if($url == nul){

		echo'<div class="container">' . $theMsg  ;	
		// echo "<div class = 'alert alert-danger'> $theMsg </div>" ;	

		echo "<div class = 'alert alert-info'> You Will Be Redirected To $link After $seconds Seconds </div>";

		header("refresh:$seconds;url=$url");

		echo "</div>";
		exit();
	
	}//function redirectHome($errorMsg , $seconds = 7){
	

/********************************************************************* 
 **** Check Item Function [V 1.0]  
 **** Function To Check Item In DataBase [ Function Accept Parameters] 
*********************************************************************/        
	
	function checkItem($select , $from , $value ){

		GLOBAL $con;
 		$statement = $con->prepare("SELECT $select FROM $from WHERE $select =?");
		$statement->execute(array($value));
		$row = $statement->rowCount();
		return $row ;


	}//	function checkItem($select , $from , $value){

/********************************************************************* 
	/* Count Number Of Item Function V1.0
	** Function To Count Number OF Rows 
	** $item  = The Item To Count 
	** $row   = The Row To Count 
	** $table = The Table To Choose From
/*********************************************************************/ 	

	function countItem( $count, $table){		
		
		GLOBAL $con;
	    $stmt2 =$con->prepare("SELECT COUNT(`$count`) FROM `$table`");
	    $stmt2->execute();
	    return $row = $stmt2->fetchcolumn();
	
	}//function countItem( , ){		

/********************************************************************* 
	/* Get Latest Records Function V1.0
	** Function To Get Latest Items From DataBase [users,Items,Comments] 
/*********************************************************************/ 	

	function Getlatest($select, $table, $order, $limit = 5){
		
		GLOBAL $con;

		$GetStmt = $con->prepare("SELECT $select FROM  $table  ORDER BY $order DESC LIMIT $limit  ");
		$GetStmt->execute();
		$rows = $GetStmt->fetchAll();
		return $rows ;

	}

