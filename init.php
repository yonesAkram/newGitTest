<?php

	
	include "connect.php";	


//Routs
	$tpl  = "include/templates/"; // template Directory
        $lang = "include/languages/"; // Lang Directory
        $func = "include/functions/";//Function Dierctory
        $css  = "layout/css/"; // Css Directory
	$js   = "layout/js/"; // JS Directory
	$domain   = "akram.com"; // JS Directory
	// $domain   = "akram.com"; // JS Directory

// Include The Important Files
        include $func . 'function.php';
	include $lang . "english.php";
//	include "include/languages/arabic.php";
        include $tpl . "header.php";
        include $tpl . 'footer.php';
        
        if(!isset($NoNavbar)){ include $tpl . "Navbar.php"; }    
        
//          echo lang('MESSAGE') . ' ' .lang('ADMIN') . '<br />';



