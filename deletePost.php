<?php
	//Startar session, includar nödvändiga filer
	session_start();
	include_once("dbConn.php");
	
	if(! isset($_SESSION["name"])){
		//kollar om man är  inloggad, om inte gå till admin.php för att logga in
		header("location:admin.php");
	}
	else{
		//Hämtar pID från GET(inte säkerhetsbrist pga. ovan if sats som kollar efter inloggad användare(admin))	
		if ($_GET['pId']) {
			$pId = $_GET['pId'];
			//tart bort posten som matchar pIdt
			$sql = "DELETE FROM post WHERE pId='$pId'";
			$result = mysqli_query($dbConn, $sql);	
		}
		//gå tbx till admin.php
		header("location:admin.php");
	}	
?>	