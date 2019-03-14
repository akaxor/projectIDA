<?php
//Db loginInfo
$servername = "localhost";
$username = "s151425";
$password = "vFuwqUaX";
$dbname = "s151425";

// Create connection
$dbConn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$dbConn) {
	die("Connection failed, get fucked");
}
?>