<?php
    include_once 'header.php';
    require_once 'includes/connection.inc.php';
    require_once 'includes/functions.inc.php';

    $brewState = getBrewState($con);
    if($brewState !== "Select"){
        // Seite verlassen (Status kann sich über DB geändert haben)
        header("location: index.php");
        exit;
    }

    $mode = getMode($con);
    if($mode == "Wait"){
        // Entscheiden, wie die Rasten eingegeben werden sollen
        header("location: select.php");
        exit;
    }

?>

<meta http-equiv="refresh" content="10">

<h1>Auf Brausteuerung warten</h1>

<div id=box>
  <h2>Brausteuerung simmulieren</h2>

  <?php
      echo "<h3>Aktueller Modus: $mode </h3>";  
    ?>

<form action="includes/state.inc.php" method="get">
      <p>Status auswählen:</p>
      <input type="radio" id="wait" name="state" value="Wait" checked="checked">
      <label for="wait">Wait</label><br>
      <input type="radio" id="running" name="state" value="Running">
      <label for="running">Running</label><br>
      <br>    
      <input id="button" type="submit" value="Eingabe"><br><br>
  </form>

</div>
