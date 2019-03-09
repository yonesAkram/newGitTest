<?php
   include "init.php"; ?>
    <div class="container">	
        <h1 class="text-center">Show Category </h1>
       	<div class="row">
       		<?php
	      		foreach(getItems('Cat_ID',$_GET["pageid"]) AS $item ){

	      			echo '<div class="col-sm-6 col-md-4">';
		      			
		      			echo '<div class="thumbnail item-box">';
		      				echo "<span class='price-tag' >". $item['Price'] ."</span>";
		      				echo "<img class='img-responsive' src='aassdd.jpg' alt='' />";	
		      				echo '<div class="caption">';
		      					echo "<h3><a href='items.php?itemid=".$item['item_ID']." '>". $item['Name'] ."</a></h3>";
		      					echo "<p>". $item['Desciption'] ."</p>";
		      				echo '</div>';//echo '<div class="">';
		      			echo '</div>';//echo '<div class="thumbnail">';

	      			echo '</div>';//echo '<div class="col-sm-6 col-md-4">';

	      		}//foreach(getItems($_GET['pageid']) AS $item ){
	      		
	    	?>
	    </div>	  		
    </div><!--<div class="container">-->


<?php include $tpl . "footer.php";
?>        