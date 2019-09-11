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
                if(isset($_GET['noPcode']) ){ 
                    echo "<div class='ChEr'>* Please Check Your Code </div>" ;
                }elseif(isset($_GET['EmpInput'])){
                    echo "<div class='ChEr'> * Code Cant Be Empty </div>";
                
                }else{    
                    echo "";
                }      
                ?>
            </div><!--<div class="fadeIn first" -->
            <!------------------------------------------ Login Form -------------------------------->
            <form action ="Results.php" method="POST">
                <div class="form-group form-group-lg">
                    <div class="col-md-18">
                        <div class="col-md-12">
                            <h2> Please choose the school year </h2>
                            <div class="funkyradio">
                                <div class="funkyradio-primary">
                                    <input type="radio" name="Year" id="radio2" value="1" checked/>
                                    <label for="radio2">First year of school</label>
                                </div>
                                <div class="funkyradio-success">
                                    <input type="radio" name="Year" id="radio3" value="2" />
                                    <label for="radio3">Second year of school 2</label>
                                </div>
                                <div class="funkyradio-danger">
                                    <input type="radio" name="Year" id="radio4" value="3" />
                                    <label for="radio4">Third year of school 3</label>
                                </div>
                            </div>                    
                    </div>
                <input type="submit" class="btn btn-primary " value=" Next "><br /><br />
            </form><!--<form action ="Result-process.php" method="GET"> -->
                
                    <!-- ////////////////////////////////////////////////////////////// -->
        </div><!--<div id="formContent"> -->
    </div><!--<div id="wrapper fadeInDown"> -->
    
</div> <!-- div class containers -->
<!--END content-->

<!-- Start Include Footer  -->
    <? include $tpl . "footer.php";?>
<!-- End Include Footer  -->
            