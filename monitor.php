<?php
    include_once 'header.php';
    require_once 'includes/connection.inc.php';
    
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
?>

<meta http-equiv="refresh" content="5"> 
<h1>Braustatus</h1>
<div id=box2>
    <h2><?php echo $rastenName; ?></h2>
    <?php echo "Ist-Temp : ", $istTemp, "<br>" ?>
    <?php echo "Soll-Temp: ", $sollTemp, "<br>" ?>
    <?php echo "Rest-Zeit: ", $restTime, "<br>" ?>

</div>