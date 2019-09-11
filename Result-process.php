<!-- Start Incolode Head  -->  
<?php
  session_start();
  $PageTitle = 'Result Student';
  include "init.php";
?>
<div class="container">
<!-- Start Incolode Head  -->  
	<?
	if ($_SERVER['REQUEST_METHOD'] != 'GET') {
		$errorMsg =' Sorry You Cant Browse This Page Directry ';   
		redirect_Home($errorMsg , 5);
		die();  	
	}?>
</div>
<?
// security input
$PCodes = CheckInt($_GET['PCode']);
$name  = CheckInput($_GET['name']);

// if (empty($PCodes) OR empty($name) ) {
// 	header('location:Results.php?NoSearch');	
// }
// check input empty or No
// عايز اكتب رقم الجلوس او اسمي مش عايز اﻻثنين مع بعض  انا مجبتش جيت بتاعت السنه

if($name == "" or empty($name)){
	$name = "kmsdjfh2376712jn32h476";

}
    $sql_select   = " SELECT * FROM `Student`
					  WHERE `id` = '$PCodes' OR `name` LIKE '%$name%' 
					  AND   `Academic_Year`  =  '$_GET[year]' ";
    $query_select = mysqli_query($con,$sql_select) or die(error());
    $count        = mysqli_num_rows($query_select);
    if($count == 0){
      header('location:Results.php?NoSearch');
    }//if($count == 0){   



// 		$sql_select   = " SELECT * FROM `Student`
// 		WHERE `id` = '$PCodes' ";
// if(!empty($name) && $name != ""  ){
// $sql_select   .=   "OR `name` LIKE '%$name%' ";

// }					  
// $sql_select   .= " AND   `Academic_Year`  =  '$_GET[year]' ";
// $query_select = mysqli_query($con,$sql_select) or die(error());
// $count        = mysqli_num_rows($query_select);





?>
<div class="container"> 
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h1 class="panel-title"><? echo ' We found <span class="red">'. $count .'</span> similar names [ '. $name.'	 ] ' ; ?></h1>
					<div class="pull-right">
						<span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
							<i class="glyphicon glyphicon-filter"></i>
						</span>
					</div>
				</div>
				<table class="table table-hover center"  id="dev-table" >
					<thead>
						<tr>
							<th class="center color">P Code</th>
							<th class="center color">Name</th>
						</tr>
					</thead>
					<tbody>
					<? while( $row = mysqli_fetch_assoc($query_select)){?>
					<tr>
						<td><? echo $row['id']; ?></td>
						
						<td><? C_link( "Student_one" , $row['id'] ,$row['name']  ) ; ?></td>

<!-- <a href="test.php?module=users&action=edit&id=3"> Click here </a> -->
<!-- <a href="test.php?module=users&action=edit&id=3"> Click here </a> -->
<!-- <a href="test.php?module=users"> Click here </a> -->
<!-- <a href="test.php?name=ahmed"> Click here </a> -->
<!-- <a href="test.php"> Click here </a> -->
<!-- <a href="search.php?q=ali"> Click here </a> -->
<!-- <a href="search.php?q=ali&search_in=results"> Click here </a> -->
<!-- <a href="search.php?q=ali&search_in=results&page=3&sort_by=name&dir=asc"> Click here </a> -->

					<?}?>
					</tr>
					</tbody>
				
				</table>
			</div>
		</div>
	</div>
</div>	