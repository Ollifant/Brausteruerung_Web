<?php
    require_once 'connection.inc.php';
    require_once 'functions.inc.php';

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        
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
            header("location: ../index.php?eror=emptyinput");
            exit;
        }

        if (invalidTemperatur($temperaturRaste) !== false){
            header("location: ../index.php?eror=invalidtemperature");
            exit;
        }

        if (invalidDuration($durationRaste) !== false){
            header("location: ../index.php?eror=invalidduration");
            exit;
        }
        // Keine Fehler - Raste kann in DB eingetragen werden
        if (insertRaste($con, $nameRaste, $temperaturRaste, $durationRaste, $jodprobe ) !== true){
            // Raste konnte nicht in DB eingetragen werden
            header("location: ../index.php?eror=dberror");
            exit;
        } else{
            header("location: ../temperature.php");
            exit;
        }

    } else{
        echo("Kein POST");
    }