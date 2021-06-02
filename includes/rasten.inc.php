<?php
    require_once 'connection.inc.php';
    require_once 'functions.inc.php';

    if ($_SERVER['REQUEST_METHOD'] == "POST"){

        $brewState = getBrewState($con);
        if($brewState == "Running" || $brewState == "Go"){
            // Brausteuerung läuft - neue Rasten können nicht erstellt werden (sollte nicht auftreten können)
            header("location: ../index.php?error=wrongstate");
            exit;
        }
        
        // Der Eingabe-Button wurde gedrückt
        $nameRaste = $_POST['raste'];
        $temperaturRaste = $_POST['temperature'];
        $durationRaste = $_POST['duration'];
        $jodprobeRaste = $_POST['jodprobe'];
        if ($jodprobeRaste == "true"){
            $jodprobe = true;
        } else{
            $jodprobe = false;
        }
        // Error Handling
        if (emptyInputRasten($nameRaste, $temperaturRaste, $durationRaste) !== false){
            header("location: ../index.php?error=emptyinput");
            exit;
        }

        if (invalidRastenName($nameRaste) !== false){
            header("location: ../index.php?error=invalidraste");
            exit;
        }

        if (invalidTemperatur($temperaturRaste) !== false){
            header("location: ../index.php?error=invalidtemperature");
            exit;
        }

        if (invalidDuration($durationRaste) !== false){
            header("location: ../index.php?error=invalidduration");
            exit;
        }
        // Keine Fehler - Raste kann in DB eingetragen werden
        if (insertRaste($con, $nameRaste, $temperaturRaste, $durationRaste, $jodprobe ) !== true){
            // Raste konnte nicht in DB eingetragen werden
            header("location: ../index.php?error=dberror");
            exit;
        } else{
            header("location: ../index.php?error=none");
            exit;
        }

    } else{
        echo("Kein POST");
    }