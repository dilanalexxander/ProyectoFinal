<?php
	$conn = new mysqli("localhost", "root", "root", "prograweb");	
	if($conn->connect_error){
		echo $error -> $conn->connect_error;
		exit();
	}

?>