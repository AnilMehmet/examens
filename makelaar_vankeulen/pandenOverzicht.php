<?php
	require("scripts/db.php");
	if (isset($_GET['straatnaam']) && isset($_GET['huisnummer']) && isset($_GET['postcode'])) DeleteRow(ConnectDB(),'pand',array('straatnaam'=>$_GET['straatnaam'],'huisnummer'=>$_GET['huisnummer']));
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
		<!-- Pand maken query -->
		<?php
		if (isset($_POST['pandSubmit'])) {
			if(isset($_GET['method'])&&$_GET['method']=='maken') {
			$straatnaam = $_POST['straatnaam'];
			$huisnummer = $_POST['huisnummer'];
			$postcode = $_POST['postcode'];
			$gemeente = $_POST['gemeente'];
			$vierkantemeters = $_POST['vierkantemeters'];
			$Nkamers = $_POST['Nkamers'];
			$Nbadkamers = $_POST['Nbadkamers'];
			$waarde_euros = $_POST['waarde_euros'];
			$eigenaar_email = $_POST['eigenaar_email'];
			$status= $_POST['status'];

			$sql = "INSERT INTO pand (`straatnaam`,`huisnummer`,`postcode`,`gemeente`,`vierkantemeters`,`Nkamers`,`Nbadkamers`,`waarde_euros`,`eigenaar_email`,`status`)
			VALUES ('$straatnaam','$huisnummer','$postcode','$gemeente','$vierkantemeters','$Nkamers','$Nbadkamers','$waarde_euros','$eigenaar_email','$status')";

			$pdo = ConnectDB();
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

			echo "Pand gemaakt!";
		}
		if(isset($_GET['method'])&&$_GET['method']=='updaten') {
			$straatnaam = $_GET['straatnaam'];
			$huisnummer = $_GET['huisnummer'];
			$postcode = $_POST['postcode'];
			$gemeente = $_POST['gemeente'];
			$vierkantemeters = $_POST['vierkantemeters'];
			$Nkamers = $_POST['Nkamers'];
			$Nbadkamers = $_POST['Nbadkamers'];
			$waarde_euros = $_POST['waarde_euros'];
			$eigenaar_email = $_POST['eigenaar_email'];
			$status= $_POST['status'];

			$sql = "UPDATE pand SET straatnaam=?, huisnummer=?, postcode=?, gemeente=?, vierkantemeters=?, Nkamers=?, Nbadkamers=?, waarde_euros=?, eigenaar_email=?, status=? WHERE straatnaam='$straatnaam' AND huisnummer='$huisnummer'";

			$pdo = ConnectDB();

			$stmt = $pdo->prepare($sql);

			$stmt->execute([$straatnaam, $huisnummer, $postcode, $gemeente, $vierkantemeters, $Nkamers, $Nbadkamers, $waarde_euros, $eigenaar_email, $status]);

			echo "Pand aangepast!";

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
		<p><input class="crudButtons2"type="submit" value="Terug naar Keuzenmenu" /></p>
		</form>

	<!-- Pand Maken -->
	<div class="pand-overlayMaken <?php if(isset($_GET['method'])&&$_GET['method']=='maken') echo 'active' ?>">
		<div class="pandMakenPopup <?php if(isset($_GET['method'])&&$_GET['method']=='maken') echo 'active' ?>">
			<form method="post">
				Straat naam:<br>
				<input class="straatnaam" type="text" name="straatnaam" required> <p>

				Huisnummer<br>
				<input class="huisnummer" type="text" name="huisnummer" required> <p>

				Postcode:<br>
				<input type="text" name="postcode" required> <p>

				Gemeente:<br>
				<input type="text" name="gemeente" required> <p>

				Aantal Vierkantemeters:<br>
				<input type="text" name="vierkantemeters" required> <p>

				Aantal kamers:<br>
				<input type="text" name="Nkamers" required> <p>

				Aantal badkamers:<br>
				<input type="text" name="Nbadkamers" required> <p>

				Waarde in euro's:<br>
				<input type="text" name="waarde_euros" required> <p>

				Eigenaar email:<br>
					<select name="eigenaar_email" >

							<?php
							$sql = "SELECT `email` FROM `klant`";

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

				Status<br>
				<input type="text" name="status" required> <p>

				<input class="crudButtons2" type="submit" value="Pand maken" name="pandSubmit"> <p>
			</form>
			<button class="close crudButtons2">Sluiten</button>
		</div>
	</div>

		<!-- Pand maken button -->
		<button onclick="location.href='?method=maken'" class="openPopupMaken crudButtons2">Pand Maken</button><br>

		<!-- Pand Updaten -->
		<?php if (isset($_GET['straatnaam']) && isset($_GET['huisnummer'])) $selectedPand = SelectRow(ConnectDB(), 'pand', array('straatnaam'=>$_GET['straatnaam'],'huisnummer'=>$_GET['huisnummer']));	?>

		<div class="pand-overlayUpdaten <?php if(isset($_GET['method'])&&$_GET['method']=='updaten') echo 'active' ?>">
			<div class="pandUpdatenPopup <?php if(isset($_GET['method'])&&$_GET['method']=='updaten') echo 'active' ?>">
				<form method="post">
					Straat naam:<br>
					<input class="straatnaam" type="text" name="straatnaam" value='<?php if(isset($selectedPand)) echo $selectedPand[0]['straatnaam']; ?>' disabled> <p>

					Huisnummer<br>
					<input class="huisnummer" type="text" name="huisnummer" value='<?php if(isset($selectedPand)) echo $selectedPand[0]['huisnummer']; ?>'disabled> <p>

					Postcode:<br>
					<input type="text" name="postcode" value='<?php if(isset($selectedPand)) echo $selectedPand[0]['postcode']; ?>'required> <p>

					Gemeente:<br>
					<input type="text" name="gemeente" value='<?php if(isset($selectedPand)) echo $selectedPand[0]['gemeente']; ?>'required> <p>

					Aantal Vierkantemeters:<br>
					<input type="text" name="vierkantemeters" value='<?php if(isset($selectedPand)) echo $selectedPand[0]['vierkantemeters']; ?>'required> <p>

					Aantal kamers:<br>
					<input type="text" name="Nkamers" value='<?php if(isset($selectedPand)) echo $selectedPand[0]['Nkamers']; ?>'required> <p>

					Aantal badkamers:<br>
					<input type="text" name="Nbadkamers" value='<?php if(isset($selectedPand)) echo $selectedPand[0]['Nbadkamers']; ?>'required> <p>

					Waarde in euro's:<br>
					<input type="text" name="waarde_euros" value='<?php if(isset($selectedPand)) echo $selectedPand[0]['waarde_euros']; ?>'required> <p>

					Status<br>
					<input type="text" name="status" value='<?php if(isset($selectedPand)) echo $selectedPand[0]['status']; ?>'required> <p>

					Eigenaar email:<br>
						<select name="eigenaar_email" >

								<?php
								$sql = "SELECT `email` FROM `klant`";

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

					<input class="pand-klantUpdaten crudButtons2" type="submit" value="Pand Updaten" name="pandSubmit"> <p>
				</form>
				<button class="close crudButtons2">Sluiten</button>
			</div>
		</div>

<!-- Pand overzicht -->

		<div class="pand-overlayOverzicht <?php if(isset($_GET['method'])&&$_GET['method']=='updaten') echo 'active' ?> <?php if(isset($_GET['method'])&&$_GET['method']=='maken') echo 'active' ?>">
			<p><b>Makelaar van Keulen</b></p>
				<?php
				$sql = "SELECT * FROM `pand`";

				$pdo = ConnectDB();
				$stmt = $pdo->prepare($sql);
				$stmt->execute();

				$databaseResult = $stmt->fetchAll(PDO::FETCH_ASSOC);

				foreach ($databaseResult as $key => $value) {
					echo "<br><b>Pand:</b></br>";
					foreach ($value as $key2 => $value2) {

						echo $key2 . ": ";
						echo $value2;
						echo "<br>";
					};
					$redirectUrlAanpassen = "'?method=updaten&straatnaam=".$value['straatnaam']."&huisnummer=".$value['huisnummer']."'";
					$redirectUrlDelete = "'?straatnaam=".$value['straatnaam']."&huisnummer=".$value['huisnummer']."&postcode=".$value['postcode']."'";
					echo '<button onclick="location.href='.$redirectUrlAanpassen .'" class="openPopupUpdaten crudButtons">Pand Aanpassen</button><p>';
					echo '<button onclick="location.href='.$redirectUrlDelete	.'" class="crudButtons">Pand Verwijderen</button><br>';
					echo "<p>";
				}
				?>
		</div>



		<!-- Popup Maken -->
		<script>
		$(".openPopupMaken").on("click", function(){
		$(".pand-overlayMaken, .pandMakenPopup, .pand-overlayOverzicht").addClass("active");
		});

		$(".close, .popup").on("click", function(){
		$(".pand-overlayMaken, .pandMakenPopup, .pand-overlayOverzicht	").removeClass("active");
		window.location.href = 'pandenOverzicht.php?';
		});
		</script>

		<!-- Popup Updaten -->
		<script>
		$(".openPopupUpdaten").on("click", function(){
		$(".pand-overlayUpdaten, .pandUpdatenPopup, .pand-overlayOverzicht").addClass("active");
		});

		$(".close, .popup").on("click", function(){
		$(".pand-overlayUpdaten, .pandUpdatenPopup, .pand-overlayOverzicht	").removeClass("active");
		window.location.href = 'pandenOverzicht.php?';
		});
		</script>

	</body>
</html>
