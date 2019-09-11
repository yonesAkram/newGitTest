<?php

	function getTitle(){
		 	GLOBAL $PageTitle ; 
		 	if(isset($PageTitle)){
		 		echo $PageTitle;
		 	}else{
		 		echo "School";		 	
		 	}//if(isset($PageTitle))
	} // function getTitle()

// ========================================================================================================
// ========================================================================================================

	/* Home Redirect Function V1.0
	*  This Function Accept Parameters 
	*  $errorMsg = Echo The Error Message 
	*  $seconds = Seconds Before Redirecting 
	*/
	function redirect_Home($errorMsg , $url , $seconds = null ){
		
		echo "<div class='alert alert-danger'>$errorMsg</div>";
		echo "<div class='alert alert-info'>You Will Be Redirected to Homepage After $seconds Seconds</div>";
		header("refresh:$seconds;url=$url");
		exit();

	}//function redirect_Home($errorMsg , $seconds = 5){
	

// ========================================================================================================
// ========================================================================================================
	
	function create_link( $page_name ,$domain, $link_title ){
		echo "<a href='" . $domain . "/" . $page_name . ".php'>$link_title</a>";
	}


	function C_link( $page_name , $do , $link_title ){
		echo "<a  href='". $page_name .".php?do=".$do."'>$link_title</a>";	
	}
	
	// function C_link( $page_name , $do, $AcadamicYear = null , $link_title ){
	// 	echo "<a  href='". $page_name .".php?do=".$do."&Academic_Year=". $AcadamicYear ."'>$link_title</a>";

	// }

	
// ========================================================================================================
// ========================================================================================================
	/* Home Redirect Function V2.0
	*  This Function Accept Parameters 
	*  $theMsg 	= Echo The Message [Error | Success | Warning]
	*  $url    	= The Link you want To Riderct	
	*  $seconds = Seconds Before Redirecting 
	*/
	function redirectHome($theMsg , $url = null , $seconds = null){

		if($url == null){

			$url = 'home.php' ;
			$Link 	= 'Homepage'; 

		}else{
			if(isset($_SERVER['HTTP_REFERER']) and $_SERVER['HTTP_REFERER'] !== '' ){
			
				$url	= $_SERVER['HTTP_REFERER'];
				$Link	= 'Previous Page' ;	
				
			}else{
				
				$url 	= 'index.php';
				$Link 	= 'Homepage'; 

			}//if(isset($_SERVER['HTTP_REFERER']) and $_SERVER['HTTP_REFERER'] = '' ){

		}//if($url === null){

		echo "<div class='alert alert-info'>" . $theMsg . "</div>" ;
		echo "<div class='alert alert-info'>You Will Be Redirected to $Link After $seconds Seconds</div>";
		header("refresh:$seconds;url=$url");
		exit();

	}//

// ========================================================================================================
// ========================================================================================================

	/* Check DataBase Function V1.0
	*  Function To Check Item In DataBase [Function Accept Parameters] 
	*  $select = The Item To Select [Example : User , item , Category]
	*  $from   = The Table To Select From [Example : User , item , Category]
	*  $value  = The Value Of Select [Example : Osama , Box , Electronics]
	*/	
	function CheckRow($from , $select1 , $value1 , $select2 = null  , $value2 = null ,$operator2 = "and" ){
		GLOBAL $con ;
		// $sql   = " SELECT * FROM `$from` WHERE `$select1` = '$value1' AND `$select2` = '$value2' ";
		$sql   = "SELECT * FROM $from WHERE `$select1` = '$value1' ";
		if($select2 != null){
				$sql   .= " $operator2 `$select2` = '$value2' ";

		}
		$query = mysqli_query($con,$sql) OR die(mysqli_error($con));
		$count = mysqli_num_rows($query);
		
		if($count > 0 ){
			$row   = mysqli_fetch_assoc($query);
		} else{
			return false;
		}
		// return $count;	
		return $row;
		
	}//function checkItem($select , $from , $value){


// ========================================================================================================
// ========================================================================================================
	/* Check DataBase Function V1.0
	*  Function To Check Item In DataBase [Function Accept Parameters] 
	*  $select = The Item To Select [Example : User , item , Category]
	*  $from   = The Table To Select From [Example : User , item , Category]
	*  $value  = The Value Of Select [Example : Osama , Box , Electronics]
	*/	
	function CheckCount($from , $select1 , $value1 ){
		GLOBAL $con ;
		$sql   = "SELECT * FROM $from WHERE `$select1` = '$value1' ";
		$query = mysqli_query($con,$sql) or die(mysqli_error($con));
		$count = mysqli_num_rows($query);
		return $count;	
		
	}//function checkItem($select , $from , $value){

// ========================================================================================================
// ========================================================================================================

	/* Check Item Function V1.0
	** Function To Count Number OF Rows 
	** $item  = The Item To Count 
	** $row   = The Row To Count 
	** $table = The Table To Choose From
	*/ 	

	// function countItem($item , $row , $table ){
	// 	GLOBAL $con;
	// 	$statment2 	= "SELECT COUNT(`$item`) AS `$row` FROM `$table`";
	// 	$query2		= mysqli_query($con,$statment2);
	// 	$value		= mysqli_fetch_assoc($query2);
	// 	if (isset($value['Username'])){
	// 	$count 		= $value['Username'];
	// 	}else{
	// 	$count 		= $value['RegStatus'];

	// 	}
	// 	return $count ; 

	// }


	// /////////////////////////////// //  

	/* Get Latest Records Function V1.0
	** Function To Get Latest Items From DataBase [ Users , Items , Comments] 
	** $select   = Field To Select 
	** $table 	 = The Table To Choose From
	** $limit    = Number Of Record To Get 
	*/

		function getlatest($select , $table , $order){

			GLOBAL $con;

			$getStmt = " SELECT $select FROM $table Order By $order DESC " ;
			$query2  = mysqli_query($con , $getStmt) or die(mysqli_error($con)) ; 
			$Rows    = mysqli_fetch_all($query2);

			return $Rows ;	
		}
 //////////////////////////////////////////////////////////////////

	function prepareValueForDB($val){
		return htmlspecialchars(trim(mysqli_real_escape_string($con,$val)));	
		

	}
	function CheckInput($str){
		GLOBAL $con;
		if(!empty($str)){
			$str = filter_var($str,FILTER_SANITIZE_STRING	) ;	
		}//if(!empty($str)){
		return $str;
		//preg_match(“/[a-zA-Z0-9]/” , $str);

	}
 //////////////////////////////////////////////////////////////////
	function CheckInt( $int ){
		GLOBAL $con;
		if(!empty($int)){
			$int = htmlspecialchars(trim(mysqli_real_escape_string($con,filter_var($int,FILTER_VALIDATE_INT))));
		} else{
			return false;
		}
		return $int ;	
	}
function chrsrs($int){
	$dddd = is_numeric($int);
	return $dddd;

	// $str = 'In My Cart : 11 12 items';
	// preg_match_all('!\d+!', $str, $matches);
	// print_r($matches);
}
 //////////////////////////////////////////////////////////////////

	function Cal_Total($one , $two , $three , $four , $five){
		$total = $one + $two + $three + $four + $five ;
		return $total;
	}

	//////////////////////////////////////////////////////////////////

	function Cal_Result( $Tootal , $Number ){
		$mlti = $Tootal / $Number ;
		$result = $mlti * 100 ;

		if($result > 85){
			$Deg = ' Excellence ' ; 
		}elseif($result > 75 and $result < 85 ){
			$Deg = ' very good ' ;

		}elseif($result > 65 and $result < 75){
			$Deg = ' Good ' ;
		}elseif($result > 60 and $result < 65){
			$Deg = ' Acceptable ' ;
		}else{
			$Deg = 'fallen ' ;
		}
		
		return $Deg ;
	}//function	
	
	///////////////////////////////////////////////////////////////////////////////////////
	  
	function Cal_Percent( $Resl , $Number){
		$mlti = $Resl / $Number ;
		
		$avag = $mlti * 100 ;
		
		return $avag ;
	}//function	

	///////////////////////////////////////////////////////////////////////////////////////

	function Cal_avg_total( $Resl , $Number){
		$mlti = $Resl / $Number ;
		
		$avag = $mlti * 100 ;
		
		return $avag ;
	}//function	
	
	// //////////////////////////////////////////////////////////////////////////////////////
function Check_row1($Educational_level){
	if($Educational_level == "First_year" ){
?>		
		<th>Topic_Math</th>
		<th>artificial_intelegance</th>
		<th>biodegradation</th>
		<th>NetworkEnginering</th>
		<th>SensorNetwork</th>
		<th>Total</th>
<?;
	}elseif($Educational_level == "Two_Year"){

?>		
		<th>Behavior_based_robotics</th>
		<th>Fuzzy_logic</th>
		<th>Cognitive_science</th>
		<th>Genetic algorithm</th>
		<th>Bionics</th>
		<th>Total</th>
<?
	}elseif($Educational_level == "Three_Year"){
?>
		<th>DataBB</th>
		<th>DataStructure</th>
		<th>Compiler</th>
		<th>SoftwareEnginering</th>
		<th>OperateSystem</th>
		<th>Total</th>
<?
	}
}//function Check_row1($Educational_level){
//////////////////////////////////////////////////////////////////////////////////

function Check_row2($Educational_level){
	if($Educational_level == "First_year" ){
	?>		
		<td>100</td>
		<td>100</td>
		<td>100</td>
		<td>100</td>
		<td>100</td>
		<td>500</td>		
	<?
	}elseif($Educational_level == "Two_Year"){
		?>		
		<td>200</td>
		<td>200</td>
		<td>200</td>
		<td>200</td>
		<td>200</td>
		<td>1000</td>		
	<?
	}elseif($Educational_level == "Three_Year"){
	?>		
		<td>200</td>
		<td>200</td>
		<td>200</td>
		<td>200</td>
		<td>200</td>
		<td>1000</td>		
	<?
	}

}//function Check_row2($Educational_level){

	//////////////////////////////////////////////////////////////////////////////////
function Fetch_Piont($year_F , $PCode_F){
	GLOBAL $con ;
	$sql_select   = " SELECT * FROM `$year_F` WHERE `SNum` = $PCode_F ";
	$query_select = mysqli_query($con,$sql_select) or die(error());
	$row = mysqli_fetch_assoc($query_select);
	if($year_F	 == "First_year" ){

?>		
	<tr>
		<td> result </td>
		<td><? echo $row['Topic_Math'] ; ?></td>
		<td><? echo $row['artificial_intelegance'] ; ?></td>
		<td><? echo $row['biodegradation'] ; ?></td>
		<td><? echo $row['NetworkEnginering'] ; ?></td>
		<td><? echo $row['SensorNetwork'] ; ?></td>
		<td><? echo Cal_Total($row['Topic_Math'] , $row['artificial_intelegance'] , $row['biodegradation'] , $row['NetworkEnginering'] , $row['SensorNetwork'] ); ?></td>
	</tr>
	<tr>
		<? echo $row['Topic_Math'] ; ?></td>
		<td><? echo $row['artificial_intelegance'] ; ?></td>
		<td><? echo $row['biodegradation'] ; ?></td>
		<td><? echo $row['NetworkEnginering'] ; ?></td>
		<td><? echo $row['SensorNetwork'] ; ?></td>
		<td><? echo Cal_Total($row['Topic_Math'] , $row['artificial_intelegance'] , $row['biodegradation'] , $row['NetworkEnginering'] , $row['SensorNetwork'] ); ?></td>

	</tr>
<?	
	}elseif($year_F	 == "Two_Year" ){

		?>
			<td><? echo $row['Behavior_based_robotics'] ; ?></td>
			<td><? echo $row['Fuzzy_logic'] ; ?></td>
			<td><? echo $row['Cognitive_science'] ; ?></td>
			<td><? echo $row['Genetic algorithm'] ; ?></td>
			<td><? echo $row['Bionics'] ; ?></td>
			<td><? echo $row['Total'] ; ?></td>
			<!-- <td><?// echo Cal_Total($row[''] , $row[''] , $row[''] , $row[''] , $row[''] ); ?></td> -->
		<?	
	}elseif($year_F	 == "Three_Year" ){
		?>

			<td><? echo $row['DataBB'] ; ?></td>
			<td><? echo $row['DataStructure'] ; ?></td>
			<td><? echo $row['Compiler'] ; ?></td>
			<td><? echo $row['SoftwareEnginering'] ; ?></td>
			<td><? echo $row['OperateSystem'] ; ?></td>
			<td><? echo $row['Total'] ; ?></td>
			<!-- <td><?// echo Cal_Total($row[''] , $row[''] , $row[''] , $row[''] , $row[''] ); ?></td> -->
		<?	
	}
}//function Fetch_row(E_level)

//////////////////////////////////////////////////////////////////////////////////

function Fetch_percent($year_F , $PCode_F){
	GLOBAL $con ;
	$sql_select   = " SELECT * FROM `$year_F` WHERE `SNum` = $PCode_F ";
	$query_select = mysqli_query($con,$sql_select) or die(error());
	$row = mysqli_fetch_assoc($query_select);
	if($year_F	 == "First_year" ){

?>		
	<td><? echo Cal_Percent($row['Topic_Math'] , 100 ); ?>%</td>
	<td><? echo Cal_Percent($row['artificial_intelegance'] , 100 ); ?>%</td>
	<td><? echo Cal_Percent($row['biodegradation'] ,100 ); ?>%</td>
	<td><? echo Cal_Percent($row['NetworkEnginering'] , 100 ); ?>%</td>
	<td><? echo Cal_Percent($row['SensorNetwork'] ,100 ); ?>%</td>
	<td><? echo Cal_Percent($row['Total'] , 500 ); ?>%</td>

<?	
	}elseif($year_F	 == "Two_Year" ){

?>
	<td><? echo Cal_Percent($row['Behavior_based_robotics'] , 200 ); ?>%</td>
	<td><? echo Cal_Percent($row['Fuzzy_logic'] ,200 ); ?>%</td>
	<td><? echo Cal_Percent($row['Cognitive_science'],200 ); ?>%</td>
	<td><? echo Cal_Percent($row['Genetic algorithm'],200 ); ?>%</td>
	<td><? echo Cal_Percent($row['Bionics'],200 ); ?>%</td>
	<td><? echo Cal_Percent($row['Total'] , 1000 ); ?>%</td>
<?	
	}elseif($year_F	 == "Three_Year" ){
		?>
	<td><? echo Cal_Percent($row['DataBB'] ,200 ); ?>%</td>
	<td><? echo Cal_Percent($row['DataStructure'] ,200 ); ?>%</td>
	<td><? echo Cal_Percent($row['Compiler'] ,200 ); ?>%</td>
	<td><? echo Cal_Percent($row['SoftwareEnginering'],200 ); ?>%</td>
	<td><? echo Cal_Percent($row['OperateSystem'] ,200 ); ?>%</td>
	<td><? echo Cal_Percent($row['Total'] , 1000 ); ?>%</td>
<?	
	}
}//function Fetch_percent($year_F , $PCode_F){
////////////////////////////////////////////////////////////////////////////////////////////

function Fetch_Degrees($year_F , $PCode_F){
	GLOBAL $con ;
	$sql_select   = " SELECT * FROM `$year_F` WHERE `SNum` = $PCode_F ";
	$query_select = mysqli_query($con,$sql_select) or die(error());
	$row = mysqli_fetch_assoc($query_select);
	if($year_F	 == "First_year" ){

?>
	<td><? echo Cal_Result($row['Topic_Math'] , 100 ); ?></td>
	<td><? echo Cal_Result($row['artificial_intelegance'] , 100 ); ?></td>
	<td><? echo Cal_Result($row['biodegradation'] ,100 ); ?></td>
	<td><? echo Cal_Result($row['NetworkEnginering'] , 100 ); ?></td>
	<td><? echo Cal_Result($row['SensorNetwork'] ,100 ); ?></td>
	<td><? echo Cal_Result($row['Total'] , 500 ); ?></td>

<?	
	}elseif($year_F	 == "Two_Year" ){

?>
	<td><? echo Cal_Result($row['Behavior_based_robotics'] , 200 ); ?></td>
	<td><? echo Cal_Result($row['Fuzzy_logic'] ,200 ); ?></td>
	<td><? echo Cal_Result($row['Cognitive_science'],200 ); ?></td>
	<td><? echo Cal_Result($row['Genetic algorithm'],200 ); ?></td>
	<td><? echo Cal_Result($row['Bionics'],200 ); ?></td>
	<td><? echo Cal_Result($row['Total'] , 1000 ); ?></td>
<?	
	}elseif($year_F	 == "Three_Year" ){
		?>
	<td><? echo Cal_Result($row['DataBB'] ,200 ); 		  	 ?></td>
	<td><? echo Cal_Result($row['DataStructure'] ,200 ); 	 ?></td>
	<td><? echo Cal_Result($row['Compiler'] ,200 ); 	 	 ?></td>
	<td><? echo Cal_Result($row['SoftwareEnginering'],200 ); ?></td>
	<td><? echo Cal_Result($row['OperateSystem'] ,200 ); 	 ?></td>
	<td><? echo Cal_Result($row['Total'] , 1000 ); 			 ?></td>
<?	
	}
}//function Fetch_row(E_level)

/////////////////////////////////////////////////////////////////////////////////////////////////

//Function calculates the number of successful or repeaters in each material

function Ch_Successful($Year , $COLUMM,$one , $Other ){
GLOBAL $con ;
$sql_select   = " SELECT * FROM `$Year`  WHERE `$COLUMM`  between $one and $Other  ";
$query_select2 = mysqli_query($con,$sql_select) or die(error());
return $count3   = mysqli_num_rows($query_select2);

}//function Ch_Successful($Year , $COLUMM , $one , $Other){

////////////////////////////////////////////////////////////////////////////////////////////////

