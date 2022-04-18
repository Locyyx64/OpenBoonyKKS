<?php 
	$connection = mysqli_connect("localhost", "root", "", "Ecommerce");
	if(!$connection){
		die("Connection Failed, ".mysqli_error($connection));
	} 
?>
