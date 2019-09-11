<!-- Start Incolode Head  -->  
<?php
    session_start();
    $PageTitle = 'Results';
    include "init.php";
?>
<!-- End Incolode Head  -->  

<!--start Content-->
<div class="container">
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
<?
                if(isset($_POST['Year'])){
                    echo $_POST['Year'];
                }    
  
                if(isset($_GET['NoSearch']) ){ 
                    echo "<div class='ChEr'>* Please Check Your Name </div>" ;
                }else{    
                    echo "<h2> please Enter Your Personal code </h2>";
                }//if(isset($_GET['noPcode']) ){                       
?> 
            </div><!--<div class="fadeIn first" -->
            <!------------------------------------------ Login Form -------------------------------->
            <form action ="Result-process.php" method="GET">
                <input type="hidden" name="year" value ="<?php echo $_POST['Year'] ; ?>" />            
                <input type="text" id="login" class="fadeIn second"   name="PCode"    placeholder="Personal Code" />
                <input type="text" id="login" class="fadeIn second"   name="name"    placeholder="Name To Result" />
                <input type="submit" class="btn btn-primary " value=" Result "><br /><br />
            </form><!--<form action ="Result-process.php" method="GET"> -->

        </div><!--<div id="formContent"> -->
    </div><!--<div id="wrapper fadeInDown"> -->
</div> <!-- div class containers -->
<!--END content-->

<!-- Start Include Footer  -->
    <? include $tpl . "footer.php";?>
<!-- End Include Footer  -->
            