<?php
	require("scripts/db.php");
?>
<!DOCTYPE html>
<html lang="nl">
	<head>
		<title>
			Makelaar van Keulen
		</title>
			<link rel="stylesheet" href="css/style.css">
	</head>

	<body>

		<div class="topnav">
		  <a class="menu-Button" href="index_home.php">Home</a>
		  <a class="menu-Button" href="index_reserveringen.php">Reserveringen</a>
			<div class="dropdown">
	    	<button class="menu-Button dropbtn">Serveren
	      	<i class="fa fa-caret-down"></i>
	    	</button>
	    	<div class="dropdown-content">
		      <a href="#">Voor kok</a>
		      <a href="#">Voor barman</a>
		      <a href="#">Voor ober</a>
	    	</div>
			<a class="menu-Button" href="#">Gegevens</a>
  		</div>

		</div>

		<div class="home-text">
			<p>Welkom bij de reserverings- en bestellingenapplicatie van Restaurant Excellent Taste.</p>
			<p>Vul een reservering in, deze kan telefonisch binnenkomen of kan worden ingevoerd als gasten plaats nemen aan een vrije tafel.</p>
			Daarna kan een bestelling worden opgenomen.

	</body>
</html>
