<?php
session_start();
$PageTitle = 'News';
include "init.php";
?>
<!--start Content-->

<!-- ===================================================================== -->

<div class="information block">
    <div class="container">
        <a href='add-News.php' class="btn btn-primary"><i class="fa fa-plus"> </i> Add News </a><br /><br />

<?php
        $result_per_page = 5 ;
        $sql = "SELECT * FROM `News`  ";
        $result = mysqli_query($con,$sql);
        $number_of_result = mysqli_num_rows($result);
        // while($row = mysqli_fetch_assoc($result)){
        //     echo $row['id'] . ' ' . $row['title'] . '<br />' ;
        // }
         $number_of_page = ceil( $number_of_result / $result_per_page );

        if(!isset($_GET['page'])){
            $page = 1 ;
        }else{
            $page = $_GET['page'];
        }//if(!isset($_GET['page'])){
    
        $this_page_first_result = ($page-1)*$result_per_page ;
       
       $sql2     = "SELECT * FROM `News` LIMIT " . $this_page_first_result . ',' . $result_per_page ; 
       $result2  = mysqli_query($con , $sql2) ; 
       while($row = mysqli_fetch_assoc($result2)){
           echo $row['id'] .' ' . $row['title'] . '<br />';
       } 

        for ($page=1 ; $page <= $number_of_page ; $page++) {
            
            echo '<a href= "?page='. $page .'">' . $page . ' </a>' ;
        }


?>
    <!--Start Content-->
<?php
            $sql = " select *from `News` order by `id` desc ";
            $query = mysqli_query($con,$sql) or die( mysqli_error($con) );
            echo "<h1>"." We Have Found: <span> " . mysqli_num_rows($query) ." </span> news in our DB". "</h1> <br />" ;
        while($data= mysqli_fetch_assoc($query)):?>
            <div class="panel panel-primary">
                <div class="panel-heading">News</div>
                <div class="panel-body News">
                <?
                    print "<div id='image-AD'>"."<a href='view-one-News.php?id=$data[id]'>"."<img src='../layout/$data[profile]'>".'</a>'.'</div>' ;    
                    echo  "<a href ='view_one_news.php?id=$data[id]'>" . $data['title'] . "</a>" ;
                    echo  "<br />"
                        
                    ."<h3>Content :</h3> " .substr($data['content'], 0 , 50) ."<br />"
                
                    ."<h3>Date :</h3> " .$data['date'] 
                
                        ."<div id='edit'>"

                            ."<a class='btn btn-primary' href='edit_News.php?id=$data[id]'><i class ='fa fa-edit' ></i>Edit </a>"    
                            ."<a class='btn btn-danger activate confirm'  href='delete-News.php?id=$data[id]'><i class ='fa fa-close '></i> Delete</a>"."<br />";
                ?>    
                        </div>
                    
                </div> <!-- <div class="panel-body News"> -->
            </div><!-- <div class="panel panel-primary"> -->    
            
        <?endwhile   ?>

                <!--  -->
        
    </div><!-- <div class="container"> -->
    </div> <!-- div class containers -->
</div> <!--div class Content-->
<!--END content-->

<!-- Start Include Footer  -->
<? include $tpl . "footer.php";?>
<!-- End Include Footer  -->