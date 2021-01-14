<?php
	require("scripts/db.php");
	error_reporting(0);
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
			<p>Dit zijn de reserveringen van vandaag. Om een reservering toe te voegen klikt u op de knop "Reservering aanmaken".</p>

			<button onclick="location.href='index_reserveringmaken.php'" class="crud-Button">Reservering aanmaken</button><br>

				<br><b>Reserveringen van vandaag:</b></br>
					<?php
					$sql = "SELECT * FROM `reservering`";

					$pdo = ConnectDB();
					$stmt = $pdo->prepare($sql);
					$stmt->execute();

					$databaseResult = $stmt->fetchAll(PDO::FETCH_ASSOC);

					foreach ($databaseResult as $key => $value) {
						echo "<br><b>Reservering:</b></br>";
						foreach ($value as $key2 => $value2) {

							echo $key2 . ": ";
							echo $value2;
							echo "<br>";
						};

						$redirectUrlDelete = "'?id=".$value['ID']."'";
						$redirectUrlEdit = "'index_reserveringedit.php?id=".$value['ID']."'";
						echo '<button onclick="location.href='.$redirectUrlDelete	.'" class="menu-Button">Reservering verwijderen</button><br>';
						echo '<button onclick="location.href='.$redirectUrlEdit.'" class="menu-Button">Reservering aanpassen</button><br>';

						if (isset($_GET['id'])) {
							$id = $_GET['id'];
							$sql = "DELETE FROM reservering WHERE ID=$id";

							$pdo = ConnectDB();
							$stmt = $pdo->prepare($sql);
							$stmt->execute();

							$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
						}
					}
					?>
	</body>
</html>
