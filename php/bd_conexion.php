<?php
	$conn = new msqli('localhost', 'root', 'root', 'prograweb');	
	if($conn->connect_error){
		echo $error -> $conn->connect_error;
	}

?>