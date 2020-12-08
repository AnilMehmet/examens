<?php
	require("scripts/db.php");
	if (isset($_GET['email']) && isset($_GET['telefoonnummer'])) DeleteRow(ConnectDB(),'klant',array('email'=>$_GET['email'],'telefoonnummer'=>$_GET['telefoonnummer']));
?>
<!DOCTYPE html>
<html lang="nl">
	<head>
		<title>
			Makelaar van Keulen
		</title>
			<link rel="stylesheet" href="css/style.css">

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
				<script>
	            $(document).ready(function(){
	                $("#popup").hide();
									$(".pandMakenPopup").hide();
	            });
	            function showpopup(id){
	                $("#popup").show();

									success: function(data) {
										$(".test").html(data);
									},
									error: function(jqXHR, expection) {
										alert(jqXHR.responseText);
									},

									dataType: 'json'
								});
	            }
			</script>
	</head>

	<body>
		<!-- Klant maken query -->
		<?php
		if (isset($_POST['klantSubmit'])) {
			if(isset($_GET['method'])&&$_GET['method']=='maken') {
			$email = $_POST['email'];
			$naam = $_POST['naam'];
			$straatnaam = $_POST['straatnaam'];
			$huisnummer = $_POST['huisnummer'];
			$postcode = $_POST['postcode'];
			$telefoonnummer = $_POST['telefoonnummer'];

			$sql = "INSERT INTO klant (`email`,`naam`,`straatnaam`,`huisnummer`,`postcode`,`telefoonnummer`)
			VALUES ('$email','$naam','$straatnaam','$huisnummer','$postcode','$telefoonnummer')";

			$pdo = ConnectDB();
			$stmt = $pdo->prepare($sql);
			$stmt->execute();

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

			echo "Klant gemaakt!";
		}
		if(isset($_GET['method'])&&$_GET['method']=='updaten') {
			$email = $_GET['email'];
			$naam = $_POST['naam'];
			$straatnaam = $_POST['straatnaam'];
			$huisnummer = $_POST['huisnummer'];
			$postcode = $_POST['postcode'];
			$telefoonnummer = $_POST['telefoonnummer'];

			$sql = "UPDATE klant SET email=?, naam=?, straatnaam=?, huisnummer=?, postcode=?, telefoonnummer=? WHERE email='$email'";

			$pdo = ConnectDB();

			$stmt = $pdo->prepare($sql);

			$stmt->execute([$email, $naam, $straatnaam, $huisnummer, $postcode, $telefoonnummer]);

			echo "Klant aangepast!";

				}
		}
		?>

		<!-- Leeg maken error -->
		<script>
    	if (window.history.replaceState) {
        	window.history.replaceState( null, null, window.location.href );
    	}
		</script>

		<!-- Terug naar keuzenmenu -->
		<form action="keuzen_menu.php">
		<p><input class="crudButtons2" type="submit" value="Terug naar Keuzenmenu" /></p>
		</form>

	<!-- Klant Maken -->
	<div class="klant-overlayMaken <?php if(isset($_GET['method'])&&$_GET['method']=='maken') echo 'active' ?>">
		<div class="klantMakenPopup <?php if(isset($_GET['method'])&&$_GET['method']=='maken') echo 'active' ?>">
			<form method="post">
				Email:<br>
				<input class="email" type="text" name="email" required> <p>

				Naam:<br>
				<input class="naam" type="text" name="naam" required> <p>

				Straatnaam:<br>
				<input type="text" name="straatnaam" required> <p>

				Huisnummer:<br>
				<input type="text" name="huisnummer" required> <p>

				Postcode:<br>
				<input type="text" name="postcode" required> <p>

				Telefoonnummer:<br>
				<input type="text" name="telefoonnummer" required> <p>

				<input class="crudButtons2" type="submit" value="Klant maken" name="klantSubmit"> <p>
			</form>
			<button class="close crudButtons2">Sluiten</button>
		</div>
	</div>

	<!-- Klant maken button -->
	<button onclick="location.href='?method=maken'" class="openPopupMaken crudButtons2">Klant Maken</button><br>

	<!-- Klant Updaten -->
	<?php if (isset($_GET['email'])) $selectedPand = SelectRow(ConnectDB(), 'klant', array('email'=>$_GET['email']));	?>

	<div class="klant-overlayUpdaten <?php if(isset($_GET['method'])&&$_GET['method']=='updaten') echo 'active' ?>">
		<div class="klantUpdatenPopup <?php if(isset($_GET['method'])&&$_GET['method']=='updaten') echo 'active' ?>">
			<form method="post">
				Email:<br>
				<input class="email" type="text" name="email" value='<?php if(isset($selectedPand)) echo $selectedPand[0]['email']; ?>'disabled> <p>

				Naam:<br>
				<input class="naam" type="text" name="naam" value='<?php if(isset($selectedPand)) echo $selectedPand[0]['naam']; ?>'required> <p>

				Straatnaam:<br>
				<input type="text" name="straatnaam" value='<?php if(isset($selectedPand)) echo $selectedPand[0]['straatnaam']; ?>'required> <p>

				Huisnummer:<br>
				<input type="text" name="huisnummer" value='<?php if(isset($selectedPand)) echo $selectedPand[0]['huisnummer']; ?>'required> <p>

				Postcode:<br>
				<input type="text" name="postcode" value='<?php if(isset($selectedPand)) echo $selectedPand[0]['postcode']; ?>'required> <p>

				Telefoonnummer:<br>
				<input type="text" name="telefoonnummer" value='<?php if(isset($selectedPand)) echo $selectedPand[0]['telefoonnummer']; ?>'required> <p>

				<input class="pand-klantUpdaten crudButtons2" type="submit" value="Klant Updaten" name="klantSubmit"> <p>
			</form>
			<button class="close crudButtons2">Sluiten</button>
		</div>
	</div>

		<!-- Klant overzicht -->

		<div class="klant-overlayOverzicht <?php if(isset($_GET['method'])&&$_GET['method']=='updaten') echo 'active' ?> <?php if(isset($_GET['method'])&&$_GET['method']=='maken') echo 'active' ?>">
			<p><b>Makelaar van Keulen</b></p>
				<?php
				$sql = "SELECT * FROM `klant`";

				$pdo = ConnectDB();
				$stmt = $pdo->prepare($sql);
				$stmt->execute();

				$databaseResult = $stmt->fetchAll(PDO::FETCH_ASSOC);

				foreach ($databaseResult as $key => $value) {
					echo "<br><b>Klant:</b></br>";
					foreach ($value as $key2 => $value2) {

						echo $key2 . ": ";
						echo $value2;
						echo "<br>";
					};
					$redirectUrlAanpassen = "'?method=updaten&email=".$value['email']."'";
					$redirectUrlDelete = "'?email=".$value['email']."&telefoonnummer=".$value['telefoonnummer']."'";
					echo '<button onclick="location.href='.$redirectUrlAanpassen .'" class="openPopupUpdaten crudButtons">Klant Aanpassen</button><p>';
					echo '<button onclick="location.href='.$redirectUrlDelete.'" class="crudButtons">Pand Verwijderen</button><br>';
					echo "<p>";
				}

				?>
		</div>

		<!-- Popup Maken -->
		<script>
		$(".openPopupMaken").on("click", function(){
		$(".klant-overlayMaken, .klantMakenPopup, .klant-overlayOverzicht").addClass("active");
		});

		$(".close, .popup").on("click", function(){
		$(".klant-overlayMaken, .klantMakenPopup, .klant-overlayOverzicht	").removeClass("active");
		window.location.href = 'klantenOverzicht.php?';
		});
		</script>

		<!-- Popup Updaten -->
		<script>
		$(".openPopupUpdaten").on("click", function(){
		$(".klant-overlayUpdaten, .klantUpdatenPopup, .klant-overlayOverzicht").addClass("active");
		});

		$(".close, .popup").on("click", function(){
		$(".klant-overlayUpdaten, .klantUpdatenPopup, .klant-overlayOverzicht	").removeClass("active");
		window.location.href = 'klantenOverzicht.php?';
		});
		</script>

	</body>
</html>
