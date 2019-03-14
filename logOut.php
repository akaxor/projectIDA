<?php
	//Hämtar session
	session_start();
	//Tar bort session
	session_destroy();
	//tar anv. hem
	header("location:home.php");
?>