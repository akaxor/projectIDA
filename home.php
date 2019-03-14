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
								//Login/ut knappar
								include_once("logInOutBtn.php");
							?>
						</li>
					</ul>
				</div>
			</div>		
		</div>
		<div id="body">
			<div class="alignment">
			<ul id="frontSortMenu">
				<li><a href="home.php?category=allt">Allt</a></li>
				<li><a href="home.php?category=nyhet">Nyheter</a></li>
				<li><a href="home.php?category=saga">Sagor</a></li>
				<li><a href="home.php?category=design">Design</a></li>
			</ul>
			
			<?php
			//hämtar filer
			include_once("dbConn.php");
			
			//kollar om det finns rätt $_GET för sortering, if not visar vanliga "fulla" framsidan
			if ($_GET['category'] == "nyhet" || $_GET['category'] == "design" || $_GET['category'] == "saga"){
				$category = $_GET['category'];
				
				//Sorterad SQL sträng
				$sql = "SELECT * FROM post WHERE category ='$category' ORDER BY pId DESC";
			}	
			else{
				//basic SQL sträng
				$sql = "SELECT * FROM post ORDER BY pId DESC";
			}
				$result = mysqli_query($dbConn, $sql);

				if (mysqli_num_rows($result) > 0) {
				     // skriver ut varje artikel med html taggar för snyggar visning, variablar används för att hämta data
				     while($row = mysqli_fetch_assoc($result)) {
						 $pageContent = <<<EOD
<div id="article">
<div id='articlePageHead'>
	<h1 class='articleTitle'>{$row["title"]}</h1>
	<div>
	<p class='dateTimePublished'>Published: {$row["datePublish"]}</p>
	<p class='authorSign'>Author: {$row["author"]}</p>
	</div>
	<p class='summaryArticlePage'>{$row['description']}</p>
	</div>
	<p>{$row["textBody"]}</p>
	<div class="underlineArticle"></div>
	</div>
EOD;
						//skriv ut pageContent
				         echo $pageContent;
				     }
				} else {
					//Om nått går fel
				     echo "Nått gick fel, RIP";
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