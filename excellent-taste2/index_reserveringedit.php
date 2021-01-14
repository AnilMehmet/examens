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

		<div class="reservering-text">
			<p>Reservering aanpassen:</p>
		</div>

		<div class="reservering-Maken">
				<form method="post">
					Tafel:<br>
					<input type="text" name="Tafel" value="<?php if(isset($value)) echo $value[0]['tafel']	 ?>"> <p>

					Datum:<br>
					<input type="date" name="Datum" required> <p>

					Tijd:<br>
					<input type="time" name="Tijd" required> <p>

						Klant ID:<br>
						<select name="Klant_ID" >

								<?php
								$sql = "SELECT `ID` FROM `klanten`";

								$pdo = ConnectDB();
								$stmt = $pdo->prepare($sql);
								$stmt->execute();

								$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

								foreach ($result as $key => $value) {
									foreach ($value as $key2 => $value2) {
										echo "<option>".$value2."</option>";
									};
								}
								?>
							</option>
						</select> <p>

					Aantal:<br>
					<input type="text" name="Aantal" required> <p>

					Aantal kinderen:<br>
					<input type="text" name="Aantal_k"> <p>

					Allergieen:<br>
					<input type="text" name="Allergieen"> <p>

					Opmerking:<br>
					<input type="text" name="Opmerking"> <p>

					<input class="crud-Button" type="submit" value="Reservering maken" name="reserveringSubmit">
				</form>
				<a class="crud-Button" href="index_reserveringen.php">Annuleren</a>
		</div>

		<?php
		if (isset($_POST['reserveringSubmit'])) {
			$Tafel = $_POST['Tafel'];
			$Datum = $_POST['Datum'];
			$Tijd = $_POST['Tijd'];
			$Klant_ID = $_POST['Klant_ID'];
			$Aantal = $_POST['Aantal'];
			$Aantal_k = $_POST['Aantal_k'];
			$Allergieen = $_POST['Allergieen'];
			$Opmerking = $_POST['Opmerking'];

			$sql = "UPDATE reservering (`Tafel`,`Datum`,`Tijd`,`Klant_ID`,`Aantal`,`Aantal_k`,`Allergieen`,`Opmerking`)
			VALUES ('$Tafel','$Datum','$Tijd','$Klant_ID','$Aantal','$Aantal_k','$Allergieen','$Opmerking')";

			$pdo = ConnectDB();
			$stmt = $pdo->prepare($sql);
			$stmt->execute();

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

			echo "Reservering aangepast!";
		}
		?>


	</body>
</html>
