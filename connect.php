<?php

//======== Connect Database ======= //

$con = mysqli_connect("localhost","root","","school"); 
// Evaluate The Connection
if(mysqli_connect_errno()){
	// echo Some Error Occured;
	return mysqli_connect_error() ;
}//if(mysqli_connect_errno()){

// Create Function Errors for Mysqli in Application
function error(){

	 GLOBAL $con;

	return mysqli_error($con);

  // return "Some Error Occured";
}