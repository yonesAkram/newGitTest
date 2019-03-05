$(function (){

	'use strict';

	//DashBoard

	$('.toggle-info').click(function (){

		$(this).toggleClass('selected').parent() .next('.panel-body').fadeToggle(100);
		
		if($(this).hasClass('selected')){
		
			$(this).html('<i class="fa fa-plus fa-lg" ></i>');
		
		}else{//if($(this).hasClass('selected')){
		
			$(this).html('<i class="fa fa-minus fa-lg" ></i>');

		}//if($(this).hasClass('selected')){

	});

	// Hide placeholder On Form Focus

	$('[placeholder]').focus(function(){

		$(this).attr('data-text',$(this).attr('placeholder'));

		$(this).attr('placeholder','');

	}).blur(function(){

		$(this).attr('placeholder' , $(this).attr('data-text'));

	})

	//Add Astreisk On Required Filed 
  
	$('input').each(function () {

		if($(this).attr('required') === 'required' ){

			$(this).after('<span class="astreisk">*</span>'); 

		}

	});

	// convert Password Filed To Text Filed On Hover

	var passfiled = $('.password');

	$('.show-pass').hover(function () {

		passfiled.attr('type', 'text') ;
	
	}, function (){

		passfiled.attr('type', 'password') ;
		

	});

	// confirmation Message On Button

  	$('.confirm').click(function (){

		return confirm('Are You Sure :) ');

	});

})