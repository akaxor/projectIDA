<?php
	
	//Startar session, hämtar filer, kollar if inloggad.
	session_start();
	include_once("common.library.php");
	include_once("dbConn.php");
	if(! isset($_SESSION["name"])){
		header("location:admin.php");
	}
	else{
		
		//Hämtar data från server baserat på skickad pID via $_GET
		if ($_GET['pId']) {
			$pId = $_GET['pId'];
			$sql = "SELECT * FROM post WHERE pId = '$pId'";
			$result = mysqli_query($dbConn, $sql);
			
			while($row = mysqli_fetch_assoc($result)) {
				//Lagrar info i variablar
				$title = $row["title"];
				$description = $row["description"];
				$textBody = $row["textBody"];
			}
		
		if (isset($_POST['submit'])) { //för att kontrollera om formuläret är ifyllt
			//spara data i variablar via trimString
			$title = trim_string($_POST['title'] );
			$description = trim_string($_POST['description']);
			$textBody = trim_string($_POST['textbody']) . "<br/>";
			$dateEdit = date("Y-m-d");
			
			//SQL sträng, updaterar databasen
			$sql = "UPDATE post SET title='$title', description='$description', textBody='$textBody',  dateEdit='$dateEdit' WHERE pId = '$pId'";
			$result = mysqli_query($dbConn, $sql);
			
			//FelCheckar result
			if ($result != 1){
							echo "<p>Nått gick fel försök igen LOL</p>";
						}
						else{
							header("location:admin.php");
						}
					
			}
		//Fromulär HTML med variablar
		$formHTML = <<<EOD
<form method="post" action="editPost.php?pId={$pId}" id="blogInput">
	<p>Titel:</p>
	<input type="text" name="title" value="{$title}">
	<p>Ingress:</p>
	<textarea name="description" rows="5" cols="100">{$description}</textarea> 
	<p>Brödtext:</p>
	<textarea name="textbody" rows="35" cols="100">{$textBody}</textarea> 
	<input type="submit" name="submit" value="Publicera">
</form>
EOD;
		
		//skriv ut form
		echo $formHTML;
		}
		
	}	
?>