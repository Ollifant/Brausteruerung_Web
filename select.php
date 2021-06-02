<?php
    include_once 'header.php';
    require_once 'includes/connection.inc.php';
    require_once 'includes/functions.inc.php';

    $brewState = getBrewState($con);
    if($brewState !== "Select"){
        // Falscher Status
        header("location: index.php");
        exit;
    }

    $mode = getMode($con);
    if($mode !== 'Wait'){
        // Warten auf Brausteuerung
        header("location: wait.php");
        exit;
    }

?>

<meta http-equiv="refresh" content="10">

<h1>Auswahl des Modus</h1>

<div id=box>
  <h2>Modus setzen</h2>

  <?php
      echo "<h3>Aktueller Modus: $mode </h3>";  
    ?>

  <form action="includes/mode.inc.php" method="get">
      <p>Status auswählen:</p>
      <input type="radio" id="manual" name="mode" value="Manual">
      <label for="mode">Manuell</label><br>
      <input type="radio" id="automatic" name="mode" value="Automatic" checked="checked">
      <label for="automatic">Automatisch</label><br>
      <br>    
      <input id="button" type="submit" value="Eingabe"><br><br>
  </form>

  <?php
    if(isset($_GET["error"])){
        // In der Seiten URL befindet sich eine Error Message
        if($_GET["error"] == "modeerror"){
            echo "<p>Fehler beim Aktualisieren des Modus</p>";
        }
        elseif ($_GET["error"] == "nomodeerror"){
            echo "<p>Modus aktualisiert</p>";
        }
    }
    ?>
</div>
