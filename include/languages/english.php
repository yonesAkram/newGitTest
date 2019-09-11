<?php


	function lang($phrase) {

		static $lang = array(

			// navbar links

			'Home_Admin' 	=> 'Home',
			'ABOUT'   		=> 'about',
			'NEWS'	 		=> 'News',
			'ADMISSION' 	=> 'Admission',
			'All_Results' 	=> 'All_Results',
			'RESULTS' 		=> 'Result',
			'LOGIN' 	 	=> 'Login',
			'REGISTER' 		=> 'Register',
			'LOGOUT' 		=> 'Logout',
			);
		return $lang[$phrase];


	}//function lang($phrase){


?>