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

	<div class="menu_text">
	<b>Makelaar van Keulen</b>
	</div>

		<!-- Buttons -->
	<div class="menu">
		<form action="pandenOverzicht.php">
    <input class="pandButton" type="submit" value="Panden" />
		</form>

			<p>

		<form action="klantenOverzicht.php">
    <input class="klantButton" type="submit" value="Klanten" />
		</form>
	</div>

	</body>
</html>
