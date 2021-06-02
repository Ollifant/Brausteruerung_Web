<?php
    require_once 'connection.inc.php';
    require_once 'functions.inc.php';

    if ($_SERVER['REQUEST_METHOD'] == "GET"){
        
        // Der Eingabe-Button wurde gedrückt
        $mode = $_GET['mode'];
        // Neuen Modus setzen
        if (setMode($con, $mode) == true){
            header("location: ../wait.php");
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