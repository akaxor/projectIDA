<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset = "utf-8">	
		<link rel="stylesheet" type="text/css" href="desktop.css"/>
		<title>Joakim Designs</title>
	</head>
	<body>
		<div id="header">
			<div class="alignment">
				<a href="home.php"><img id="logoHead" src="images/jdLogoSmall.png" alt="JD logo"></a>
				<div id="mainMenu">
					<ul>
						<li><a href="home.php">Home</a></li>
					</ul>
					<ul>
						<li>
							<a id='logInOutBtn' href='admin.php'><img src='images/logInIcon.png' alt='adminlänk' id='logInOutBtn'></a>
						</li>
						<li>
							<?php
								//Hämtar våra knappar, lägger i menyn
								include_once("logInOutBtn.php");
							?>
						</li>
					</ul>
				</div>
			</div>		
		</div>
		<div id="body">
			<div class="alignment">
				<?php
					session_start(); // Startar Sesssion
					include_once("dbConn.php");//connectar till DB
					include_once("common.library.php");//inkluderar common funktioner
					if(! isset($_SESSION["name"])){ //kolla om det finns en session med name variabler
						if(isset($_POST["username"])){ //kollar om det skickats ett form med "username" fält i fyllt
							
							//lagrar användarnamn och PW i separata variabler
							$username=$_POST["username"]; 
							$password=addslashes($_POST["password"]);
							//lagrar SQL kod
							$query= "SELECT first_name, last_name FROM user WHERE user_email='$username' AND password=md5('$password')";
							//skickar query till server/DB, lagrar i $result
							$result = mysqli_query($dbConn, $query);
							
							//kollar om det finns ett resultat(num rows == 1), annars är infon skickad felaktigt, går till else
							if(mysqli_num_rows($result)==1){
								//lagrar session info(namn(fnamn och lnamn, email)
								$_SESSION['name'] = mysqli_result($result,0,"first_name") . " " . mysqli_result($result,0,"last_name");
								$_SESSION['user'] = $username;
								//"laddar om" sidan
								header("location:admin.php");
							}
							else{
//Skriver ut felmeddelande samt formulär
echo<<<EOT
						<p>Fel användarnamn eller lösenord</p>
						<div id="logInBox">
							<form class="logInForm" method="post" action="admin.php">
								<em>Användarnamn:
								<input type="text" name="username"></em>
								<em>Lösenord:
								<input type="password" name="password"></em>
								<input type="submit" value="Logga in">
							</form>
						</div>
EOT;
								
								
							}	
						}
						else{
//skriver ut form							
echo <<<EOT
						<div id="logInBox">
							<form class="logInForm" method="post" action="admin.php">
								<em>Användarnamn:
								<input type="text" name="username"></em>
								<em>Lösenord:
								<input type="password" name="password"></em>
								<input type="submit" value="Logga in">
							</form>
						</div>
EOT;

						}
					}
					else{
						//visa: Title - författare - editeringsdatum - publiceringsdatum - redigeringsknapp - delete knapp

						echo "<a id='adminNav' href='createPost.php'>Nytt Inlägg</a></br>";
						$sql = "SELECT * FROM post";
						$result = mysqli_query($dbConn, $sql);
						if (mysqli_num_rows($result) > 0) {
						// Outputtar listan med knappar, $_GETar pIdt
							while($row = mysqli_fetch_assoc($result)) {
								echo $row["title"]." - ". $row["author"]." - ". $row["datePublish"]." - ". $row["dateEdit"]. " - " . "<a href=\"deletePost.php?pId=" .$row["pId"]. "\">Ta Bort Artikel</a>" . " - " . "<a href=\"editPost.php?pId=" .$row["pId"]. "\">Redigera Artikel</a>" . "<br>";
							}
						}
						else {
							echo "0 results";
						}
					}
				?>
			</div>
		</div>
		<div id="foot">
			<div class="alignment">
				<ul>
					<li class="copyTitle">Copyright &copy; Ida Designs</li>
					<li><a href="mailto:joakimdesigns@gmail.com">idadesigns@gmail.com</a></li>
					<li>Allégatan 22</li>
					<li>504 55 Borås</li>
					<li><a class="underlineLinkFoot" href="aboutUs.php">About us</a></li>
				</ul>
				<ul id="socialMediaMenu">
					<li class="heading">Sociala Medier</li>
					<li><a href="http://www.facebook.com" target="_blank"><img src="images/facebook.png" alt="FB">Facebook</a></li>
					<li><a href="http://www.twitter.com" target="_blank"><img src="images/twitter.png" alt="Twitter">Twitter</a></li>
					<li><a href="http://www.instagram.com" target="_blank"><img src="images/instagram.png" alt="Instagram">Instagram</a></li>
				</ul>
			</div>
		</div>
	</body>
</html>