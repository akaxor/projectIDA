<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset = "utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>		
		<script src="script.js"></script>
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
				//startar session, ikluderar filer
				session_start();
				include_once("common.library.php");
				include_once("dbConn.php");
				
				//Kollar efter inlog, if not tbx till admin för att logga in
				if(! isset($_SESSION["name"])){
					header("location:admin.php");
				}
				else{
					if (isset($_POST['submit'])) { //för att kontrollera om formuläret är ifyllt
						//spara data via trim_string
						$title = trim_string($_POST['title'] );
						$description = trim_string($_POST['description']);
						$textBody = trim_string($_POST['textbody']) . "<br />";
						$datePublish = date("Y-m-d");
						$author = $_SESSION['name'];
						$category = $_POST['category'];
						
						//skapar SQL sträng, pratar med server
						$sql = "INSERT INTO post SET author='$author', title='$title', description='$description', textBody='$textBody', datePublish='$datePublish', dateEdit='$datePublish', category='$category'";
						$result = mysqli_query($dbConn, $sql);
						
						//kollar om det lyckats, if ok gå till admin, annars kör igen
						if ($result != 1){
							echo "<p>Nått gick fel försök igen LOL</p>";
						}
						else{
							header("location:admin.php");
						}
					}
				}
			?>
				<form method="post" action="createPost.php" id="blogInput">
					<p>Titel:</p>
					<input type="text" name="title">
					<p>Kategori: </p>
					<select name="category">
						<option value="nyhet">Nyhet</option>
						<option value="saga">Saga</option>
						<option value="design">Design</option>
					</select>
					<p>Ingress:</p>
					<textarea name="description" rows="5" cols="100"></textarea> 
					<p>Brödtext:</p>
					<textarea name="textbody" rows="35" cols="100"></textarea> 
					<input type="submit" name="submit" value="Publicera">
				</form>
			</div>
		</div>
		<div id="foot">
			<div class="alignment">
				<ul>
					<li class="copyTitle">Copyright &copy; Ida Designs</li>
					<li><a href="mailto:joakimdesigns@gmail.com">idadesigns@gmail.com</a></li>
					<li>Allégatan 22</li>
					<li>504 55 Borås</li>
					<li><a class="underlineLinkFoot" href="aboutUs.html">About us</a></li>
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