<?php
	//hämta/starta session
	session_start();
	//kollar om det finns en session
	if(isset($_SESSION["name"])){
	//sätt variablar till logout datan/sökvägar
	$iconSrc = "images/logOutIcon.png";
	$iconSrcTxt = "log out button";
	echo "<a id='logInOutBtn' href='logOut.php'><img src='$iconSrc' alt='$iconSrcTxt'></a>";
	}
?>