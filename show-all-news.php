<!--Start Incolode Head  -->  
<?php
  session_start();
  $PageTitle = 'News';
  include "init.php";
?>
<!--End Incolode Head  -->
<!--start Content-->      
<div class="container">  
 

<!--start Content-->
      <div class="containers">
        <?php
        if (isset($_SESSION['Name_student'])) {
          print '<h1>Latest News :</h1>';
        }//if (isset($_SESSION['Name_student'])) {
        if(!isset($_SESSION['Name_student'])):
            echo "<h1>Please Log in So We Can Add News :)</h1>";
            echo "<span><h1>"."<a href='login.php'>login</a>"."</span>" . " or <a href='register.php'>Sign UP</a>" . " </h1>";
            // $_SESSION['show-all-ad'] == 'show-all-advertising.php'  ;
        else:
// Get DATA in Data Base
          $row=selectAll('*','`News`','`id`');
          // $sql    = "select * from `News` order by `id` desc ";
          // $query  = mysqli_query($con,$sql) or die(error());
          
          while ($row) :
            // while ($row = mysqli_fetch_assoc($query) :

            print '<div id="show-ad">';
//Show All ADvertising
              print "<div id='image-AD'>"."<a href='view-one-advertising.php?id=$row[id]'>"."<img src='uploade/$row[profile]'>".'</a>'.'</div>' ;
              echo '<b>Title ==></b> '."<a href='view-one-advertising.php?id=$row[id]'>".$row['title']."</a>".' <br />' ;
//Returns the portion of string specified by the start and length parameters ==> Function Substr() .
              echo '<b>content ==></b> '.substr( $row['content'], 0 , 27 ) . ' <br />' ;
// Show the user name added advertisement
              $sql_name   = " select * from `Student` where `id` = '$row[user_id]'  ";
              $query_name = mysqli_query($con,$sql_name) or die(error());
              $row_name   = mysqli_fetch_assoc($query_name);
              echo'<b>Name ==></b> '. $row_name['name'];

              // echo "By :" . $row['name'] ;
              echo'<br />'.'Date ==> '.'  '. $row['date'] . '<hr />';

            print '</div>';  // div id="show-ad

          endwhile; //while ($row = mysqli_fetch_assoc($query)) :
         ?>
            <!--start Content-->
    <div class="container home-stats text-center">
    <div class="information block">
    	<div class="container">
    		<div class="panel panel-primary">
	    		<div class="panel-heading">News</div>
	    		<div class="panel-body">
                    <!--  -->
        <!--Start Content-->
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="Submit" value="Add News" class="btn btn-primary btn-sm" />
                    </div><!-- <div class="col-sm-offset-2 col-sm-10"> -->
                </div>          

                 <div class="img-news">
                    <img src="./layout/images/aassdd.jpg" class="image-News" />     
                </div>
		       
<?php
            $sql = " select *from `News` order by `id` desc ";
            $query = mysqli_query($con,$sql) or die( mysqli_error($con) );
            echo "<br />"."<h1> we Have Found: " . mysqli_num_rows($query) ." news in our DB<h1>". "<br />" ;
            while( $data= mysqli_fetch_assoc($query)):
                    
                        echo  "<a href ='view_one_news.php?id=$data[id]'>" . $data['title'] . "</a>" ;
                        echo  "<br />"
                            
                            ."<h5>Content :</h5> " .substr($data['content'], 0 , 150) ."<br />"
                            ."Name : " .$row['name'] ."<br />" . "<hr />"
                        
                            ."<div id='edit'>"

                                ."<a href='edit-news.php?id=$data[id]'>Edit </a>"    
                                ."<a href='delete-news.php?id=$data[id]'> Delete</a>"."<br />"."<br />"

                            ."</div>";
                endwhile;
       ?>
                    <!--  -->
    			</div>
    		</div><!-- <div class="panel panel-primary"> -->
    	</div><!-- <div class="container"> -->
        </div> <!-- div class containers -->
    </div> <!--div class Content-->
<!--END content-->
                <!--END content-->

        <?php  
        endif; // if(!isset($_SESSION['username'])):
        ?>

</div><!-- div class="containers" -->

  <!--END content-->

<!-- Start Include Footer  -->
<? include $tpl . "footer.php";?>
<!-- End Include Footer  -->
    

</html>
