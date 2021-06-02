<?php
    require_once 'connection.inc.php';
    require_once 'functions.inc.php';

    if ($_SERVER['REQUEST_METHOD'] == "GET"){
        
        // Der Eingabe-Button wurde gedrückt
        
        $deleteRaste = $_GET['delete'];
        
        if($deleteRaste === "yes"){
            // Rasten löschen ausgewählt
            $brewState = getBrewState($con);
            if($brewState == "Running" || $brewState == "Go"){
                // Brausteuerung läuft - Rasten können nicht gelöscht werden (sollte nicht auftreten können)
                header("location: ../index.php?error=nodelete");
                exit;
            }
            if (deletetRasten($con) !== true){
                // Rasten konnte nicht aus DB gelöscht werden
                header("location: ../index.php?error=dberrordel");
                exit;
            } else{
                header("location: ../index.php?error=nodberror");
                exit;
            }
        }

        $startBrewing = $_GET['startBrew'];
        
        if($startBrewing === "yes"){
            // Brauvorgang starten ausgewählt
            if(getBrewstate($con) !== 'Wait'){
                // Brauanlage nicht bereit
                header("location: ../index.php?error=wrongstate");
                exit;
            }
            else{
                // Brauvorgang starten
                if (setBrewState($con, 'Go') !== true){
                    // Fehler beim Schreiben in DB
                    header("location: ../index.php?error=dberrorbrew");
                    exit;
                }
                else{
                    // Brauvorgang gestartet
                    header("location: ../monitor.php");
                    exit;
                }
            }
        }
        
    }
    else{
        echo("Kein GET");
    }