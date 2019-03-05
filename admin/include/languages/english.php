<?php


	function lang($phrase) {

		static $lang = array(

			// navbar links

			'Home_Admin' 	=> 'Home',
			'CATERGRIES'   	=> 'Categories',
			'ITEMS'	 		=> 'Items',
			'MEMBERS' 		=> 'members',
			'COMMENTS' 		=> 'Comments',
			'STATISTICS' 	=> 'statistics',
			'LOGS' 			=> 'logs',
			'' => '',


			);
		return $lang[$phrase];


	}//function lang($phrase){


?>