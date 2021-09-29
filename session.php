<?php 
session_start();

if( !isset($_SESSION['id']) ){
	header("location: ?p=1&session=session-invalid");
	exit();	
} else {
			
			
			$fullname = $_SESSION['fullname'];	
			$fname = $_SESSION['fname'];	
			$email_post = $_SESSION['email'];		
	
} 



if ( !file_exists('config') ) {
	header("location: ?p=1&config=notset");
	exit();	
}




