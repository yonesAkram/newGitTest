<?php
session_start();
$PageTitle = 'Future School';
include "init.php";

?>
<!--start Content-->
    <div class="container">
        <?php
            if(isset($_SESSION['GroupID']) AND $_SESSION['GroupID'] == 1){
                echo'Welcom Admin';
                 include "dashboard.php";
            }
        ?>
        <?php
            // create_link('login','Login');
        ?>
  
    <div id="lt-side">
            <h1>Home Page</h1>
            <p>Member of Qalaa CAPITAL, inaugurated in Egypt since 2008 and located in Sadat city Area 7057&7059,
                at equal distance from Cairo and Alexandria.
            </p>
             <a href="#" >Read More</a>

        </div>
        <div id="main-content">
            <div class="z">
                    <img src="./layout/images/AQ9A0953-1 (1).jpg" class="image-News" />     
            </div>
            <div id="clear"></div>
            <div class="x">
                <hr />
                <img src="./layout/images/AQ9A0764-1.jpg" class="image-News" /> <hr />     
            </div>
            
            <div class="c">
                <img src="./layout/images/mce-width-build.jpg"class="image-News"  />    <br />

            </div>
         </div>
        <div id="rt-side">
            <h2>Mineral Wool</h2>
            <p>
                There are two basic types of mineral wool that are applied for insulation where every type has its own 
                characteristics. The user/applicator should be able to determine the right type to apply. 
            </p>
            <a href="aboutus.html" >Read More</a>
        </div> <!-- div class containers -->
    </div> <!--div class Content-->
<!--END content-->

<? include $tpl . "footer.php";
