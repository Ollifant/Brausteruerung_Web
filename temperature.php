<?php
    include_once 'header.php';
    require_once 'includes/connection.inc.php';
    require_once 'includes/functions.inc.php';

    $query = "SELECT * FROM rasten";
    $resultData= mysqli_query($con, $query);
    
?>
<h1>Das ist die Brausteuerung</h1>

<div id=box>
  <h2>Jodprobe durchführen</h2>
  <form action="includes/jodprobe.inc.php" method="get">
      <p>Ergebnis auswählen:</p>
      <input type="radio" id="positiv" name="jod" value="positiv">
      <label for="positiv">Positiv</label><br>
      <input type="radio" id="wait" name="jod" value="wait" checked="checked">
      <label for="wait">Wait</label><br>
      <input type="radio" id="negativ" name="jod" value="negativ">
      <label for="negativ">Negativ</label><br>
      <br>    
      <input id="button" type="submit" value="Eingabe"><br><br>
  </form>
</div>

<div id=box>
  <h2>Braustatus setzen</h2>
  
  <?php
      $brewState = getBrewState($con);
      echo "<h3>Aktueller Status: $brewState </h3>";
    
    ?>
  <form action="includes/state.inc.php" method="get">
      <p>Status auswählen:</p>
      <input type="radio" id="off" name="state" value="Off">
      <label for="off">Off</label><br>
      <input type="radio" id="select" name="state" value="Select">
      <label for="select">Select</label><br>
      <input type="radio" id="wait" name="state" value="Wait" checked="checked">
      <label for="wait">Wait</label><br>
      <input type="radio" id="go" name="state" value="Go">
      <label for="go">Go</label><br>
      <input type="radio" id="running" name="state" value="Running">
      <label for="running">Running</label><br>
      <input type="radio" id="done" name="state" value="Done">
      <label for="done">Done</label><br>
      <br>    
      <input id="button" type="submit" value="Eingabe"><br><br>
  </form>

  <?php
    if(isset($_GET["error"])){
        // In der Seiten URL befindet sich eine Error Message
        if($_GET["error"] == "stateerror"){
            echo "<p>Fehler beim Aktualisieren des Braustatus</p>";
        }
        elseif ($_GET["error"] == "nostateerror"){
            echo "<p>Braustatus aktualisiert</p>";
        }
    }
    ?>
</div>
