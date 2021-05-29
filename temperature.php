<?php
    include_once 'header.php';
    require_once 'includes/connection.inc.php';

    $query = "SELECT * FROM rasten";
    $resultData= mysqli_query($con, $query);
    
?>
<h1>Das ist die Brausteuerung</h1>
<div id=box>
  	<h1>Rasten</h1>
    <table id="meineTabelle" data-role="table" class="ui-responsive"
           data-mode="columntoggle" data-column-btn-text="Spalten" >
      <thead>
        <tr>
          <th>Raste</th>
          <th data-priority="1">Temperatur (Grad Celsius)</th>
          <th data-priority="2">Dauer (Minuten)</th>
          <th data-priority="3">Jodprobe</th>
        </tr>
      </thead>
      <tbody>
    <?php
    while($data = mysqli_fetch_assoc($resultData)){
    ?>
        <tr>
            <td>
                <?php echo $data["rastenName"]; ?>
            </td>
            <td>
                <?php echo $data["rastenSollTemp"]; ?>
            </td>
            <td>
                <?php echo $data["rastenDur"]; ?>
            </td>
            <td>
                <?php echo $data["rastenJod"]; ?>
            </td>          
      </tr>
    <?php
    }
    ?>
      </tbody>
    </table>
 </div>