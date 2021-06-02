<?php
    include_once 'header.php';
    require_once 'includes/connection.inc.php';
    require_once 'includes/functions.inc.php';

    $brewState = getBrewstate($con);
    if ($brewState == "Done"){
        // Brauvorgang abgeschlossen
        header("location: ende.php");
        exit;
    }
    if($brewState == "Select"){
        // Auswahl nötig
        header("location: select.php");
        exit;
    }
    
    // Messwerte aus DB lesen (absteigende Sortierung)
    $query = "SELECT * FROM messwerte ORDER BY MessID DESC";
    $resultData= mysqli_query($con, $query);
    // Letzten Datensatz lesen
    $data = mysqli_fetch_assoc($resultData);

    if($data == false){
        $rastenName = "Aktuell keine Messwerte";
        $istTemp = 0;
        $sollTemp = 0;
        $restTime = "00:00";
    } 
    else{
        $rastenName = $data["Raste"];
        $istTemp = $data["IstTemp"];
        $sollTemp = $data["SollTemp"];
        $restTime = $data["RestTime"];
    }

    $brewState = getBrewState($con);
    echo "<h1>Braustatus: $brewState </h1>";
?>

<div id=box>
    <h2><?php echo $rastenName; ?></h2>
    <?php echo "Ist-Temp : ", $istTemp, " °C <br><br>" ?>
    <?php echo "Soll-Temp: ", $sollTemp, " °C <br><br>" ?>
    <?php echo "Rest-Zeit: ", $restTime, "<br><br>" ?>
    <?php
        if(jodprobe($con) == true){
            ?>
            <h2>Jodprobe durchführen</h2>
            <form action="includes/jodprobe.inc.php" method="get">
                <p>Ergebnis auswählen:</p>
                <input type="radio" id="positiv" name="jod" value="positiv">
                <label for="positiv">Positiv</label><br>
                <input type="radio" id="negativ" name="jod" value="negativ" checked="checked">
                <label for="negativ">Negativ</label><br>
                <br>    
                <input id="button" type="submit" value="Eingabe"><br><br>
            </form>
        <?php
        }
        else{
            echo '<meta http-equiv="refresh" content="5">';
        }
        ?>
</div>

<div id=box>
    <h2>Geplanter Brauverlauf</h2>
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
    $query = "SELECT * FROM rasten";
    $resultData= mysqli_query($con, $query);
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
    <br><br>
</div>