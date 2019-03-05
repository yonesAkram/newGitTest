<?php

	class AppleDevice {

		public $ram   = '2GB' ;
		public $inch  = '3 inch';		
		public $spase =	'442 MB';
		public $color = 'Silver';
		public $ownername ;

		//Constatn 

		const ownername = 7 ;

		//Method

		public function setownername(){

			if(strlen($this->ownername < self::ownername )){

				echo 'Owner Name Cant Be less Than ' . self::ownername .  ' Chars <br >'. strlen($this->ownername) .'<'.self::ownername .  '<br >';

			}else{
				echo 'Your Name Has Been Set Very Good' . strlen($this->ownername) .'>'.self::ownername ;

			}//if
		}//puplic function setownername(){


		public function getspci(){
			echo "This Iphone Ram Is " . $this-> ram . '<br />';

		}//public function doublehomepressed(){
		public function whichthis(){		
			echo "Because " . $this-> ram . '<br />';
		}		

	}//class AppleDevice

	$iphone6plus = new AppleDevice();
	
	$iphone6plus -> ram 	= "102 GB";
	$iphone6plus -> inch 	= "5 inch";
	$iphone6plus -> spase 	= "12MB";
	$iphone6plus -> color 	= "Gold";
	$iphone6plus -> iphone6plus = "2GB";
	$iphone6plus -> ownername = 'yonesAkram';
	$iphone6plus -> getspci();
	$iphone6plus-> whichthis();
	$iphone6plus-> setownername();
	echo $iphone6plus::ownername . '<br />' ;

	$iphone7plus = new AppleDevice();

	$iphone7plus -> ram 	= "311GB";
	$iphone7plus -> inch 	= "7 inch";
	$iphone7plus -> spase 	= "142MB";
	$iphone7plus -> color 	= "silver";
	$iphone7plus -> iphone7plus = "911GB";
	$iphone7plus -> getspci();

	

	echo "<pre>";
	var_dump($iphone6plus);	
	var_dump($iphone7plus);	
	echo "</pre>";	

	echo "<pre>";
	print_r($iphone6plus);	
	print_r($iphone7plus);	
	echo "</pre>";	


?>
