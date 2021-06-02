<?php
    require_once 'connection.inc.php';
    require_once 'functions.inc.php';

    if ($_SERVER['REQUEST_METHOD'] == "GET"){
        
        // Der Eingabe-Button wurde gedrückt
        
        $state = $_GET['state'];

        if($state == "Select"){
            // Bei Select muss der Modus auf Wait gesetzt werden
            if (setMode($con, "Wait") !== true){
                header("location: ../temperature.php?error=stateerror");
                exit;
            }
        }
        // Neuen Status setzen
        if (setBrewState($con, $state) == true){
            header("location: ../temperature.php?error=nostateerror");
            exit;
        }
        else{
            header("location: ../temperature.php?error=stateerror");
            exit;
        }

    }
    else{
        echo("Kein GET");
    }