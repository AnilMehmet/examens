<?php
require("scripts/db.php");

$id = $_GET['id']; // get id through query string

$qry = mysqli_query($db,"select * from reservering where ID='$id'"); // select query

$data = mysqli_fetch_array($qry); // fetch data

if(isset($_POST['update'])) // when click on Update button
{
    $Tafel = $_POST['Tafel'];
    $Datum = $_POST['Datum'];
    $Tijd = $_POST['Tijd'];
    $Klant_ID = $_POST['Klant_ID'];
    $Aantal = $_POST['Aantal'];
    $Aantal_k = $_POST['Aantal_k'];
    $Allergieen = $_POST['Allergieen'];
    $Opmerking = $_POST['Opmerking'];

    $edit = mysqli_query($db,"update reservering set Tafel='$Tafel', Datum='$Datum', Tijd='$Tijd', Klant_ID='$Klant_ID', Aantal='$Aantal', Aantal_k='$Aantal_k', Allergieen='$Allergieen', Opmerking='$Opmerking' where id='$id'");

    if($edit)
    {
        mysqli_close($db); // Close connection
        header("location:bediening_ober.php"); // redirects to all records page
        exit;
    }
}
?>



<form method="POST">
  <input type="text" name="code" value="<?php echo $data['code'] ?>" placeholder="Enter code" Required>
  <input type="text" name="naam" value="<?php echo $data['naam'] ?>" placeholder="enter naam" Required>
  <input type="submit" name="update" value="Update">
</form>

<div class="reservering-Maken">
    <form method="post">
      Tafel:<br>
      <input type="text" name="Tafel" value="<?php echo $data['Tafel'] ?>" Required>

      Datum:<br>
      <input type="text" name="Datum" value="<?php echo $data['Datum'] ?>" Required>

      Tijd:<br>
      <input type="time" name="Tijd" value="<?php echo $data['Tijd'] ?>" Required>

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
      <input type="text" name="Aantal" value="<?php echo $data['Aantal'] ?>" Required>

      Aantal kinderen:<br>
      <input type="text" name="Aantal_k" value="<?php echo $data['Aantal_k'] ?>" Required>

      Allergieen:<br>
      <input type="text" name="Allergieen" value="<?php echo $data['Allergieen'] ?>" Required>

      Opmerking:<br>
      <input type="text" name="Opmerking" value="<?php echo $data['Opmerking'] ?>" Required>

      <input class="crud-Button" type="submit" value="Reservering maken" name="reserveringSubmit">
    </form>
    <a class="crud-Button" href="index_reserveringen.php">Annuleren</a>
</div>
