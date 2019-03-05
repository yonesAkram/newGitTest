<?php session_start();
        if(isset($_SESSION['Username'])):
            include "init.php";
        
        else :
            header('location: index.php');
        endif; //if(isset($_SESSION['Username']))
	include $tpl . "header.php";
        
        $do = isset($_GET['do']) ? $_GET['do'] : 'Mange' ;

        if ($do == 'Mange'){
            
            echo 'Welcome You are in Mange category';
            echo '<a href="page.php?do=add" >ADD New Category +</a>';

        }elseif ($do == 'add') {
            
                echo 'Welcome You are in edit category';
 
        }elseif ($do == 'del') {
            echo 'Welcome You are in del sssssssssss category';
        }else{
            echo 'Error There\'s No Paeg With This Name ' ;
        }
?>




<?php
	include $tpl . "footer.php";
        