<?php 
session_start();

if( !isset($_SESSION['id']) ){
	header("location: ?p=1&session=session-invalid");
	exit();	
} 



if ( !file_exists('config') ) {
	header("location: ?p=1&config=notset");
	exit();	
}
