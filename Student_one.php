<?php
  session_start();
  $PageTitle = 'Result Student';
  include "init.php";
?>
<!-- Start Incolode Head  -->  
<?
/////////////////////////////////////////////////////////////////////////////////
// $s = "2";
// echo $ds = chrsrs($s) . '  <br />sdfsdfs <br />';
/////////////////////////////////////////////////////////////////////////////////
// $str = '<cacac><as/.>In My Cart : 11 12 items';
// preg_match_all('!\0:9+!', $str, $matches);
// print_r($matches);
// echo 	$str ;
// $Academic_year = CheckInt($_GET['Academic_Year']);

// security input
$PCode = CheckInt($_GET['do']);

//Function To return All Data in Table Student
$name_Student = CheckRow("Student" , "id" , $PCode);
if($name_Student == false){

	die('eee');

}
if($name_Student['Academic_Year'] == 2 ){
	$year = "Two_Year" ;
}elseif($name_Student['Academic_Year'] == 3) {
	$year = "Three_Year" ;
}elseif($name_Student['Academic_Year'] == 1){
	$year = "First_year" ;
}
// check input empty or No
    $sql_select   = " SELECT * FROM `$year` WHERE `SNum` = $PCode ";
    $query_select = mysqli_query($con,$sql_select) or die(error());
	$row = mysqli_fetch_assoc($query_select);
	$count        = mysqli_num_rows($query_select);
    if($count == 0){
		// echo "No Studnet has year";
		header('location:Results.php?NoSearch');
    }//if($count == 0){   	
		// echo '<br />'. $year .'<br />';
?>
<!-- =================================================================================== -->
<br />
<div class="container">
		<div class="col-md-15">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">Result Student</h3>
					<h3 class="panel-title">
						<?
							// $name_Student = CheckRow("Student" , "id" , $_GET['do']);
							echo 'Name :' .' ' . $name_Student['name'] . '<br />';
							echo 'Academic Year	 :' .' ' .  $name_Student['Academic_Year'] . '<br />';
							echo 'Num :' .' ' . $name_Student['id'];
						?>
					</h3>
				</div>
				<table class="table table-hover" id="task-table">
					<thead>	
						<tr>
							<th><? echo $name_Student['id']; ?></th>
							<? echo Check_row1($year);  ?>						
						</tr>
					</thead>
					<tbody>
						<tr>	
							<td>All</td>
							<?php echo Check_row2($year); ?>	
						</tr>
						
							<?php  Fetch_Piont($year , $PCode) ;?>	
						
						<tr>
							<td>%</td>
							<?php  Fetch_percent($year , $PCode) ;?>	
						</tr>
						<tr>
							<td>Degrees</td>
							<?php  Fetch_Degrees($year , $PCode) ;?>	
						</tr>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>