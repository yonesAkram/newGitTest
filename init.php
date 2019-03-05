<?php
include "admin/connect.php";  

// Error RePorting
	// ini_set('display_errors','On');
	// error_reporting('E_All');
	$sessionuser ='';
	if(isset($_SESSION['user'])){ $sessionuser= $_SESSION['user'];}


//Routs
	$tpl  = "include/templates/"; // template Directory
    $lang = "include/languages/"; // Lang Directory
    $func = "include/functions/";//Function Dierctory
    $css  = "layout/css/"; // Css Directory
	$js   = "layout/js/"; // JS Directory

// Include The Important Files
    include $func . 'function.php';
	include $lang . "english.php";
//	include "include/languages/arabic.php";

    include $tpl . "header.php";
?>
