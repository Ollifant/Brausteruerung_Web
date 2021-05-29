<?php
    require_once 'connection.inc.php';
    require_once 'functions.inc.php';

    if ($_SERVER['REQUEST_METHOD'] == "GET"){
        
        // Der Eingabe-Button wurde gedrückt
        
        $deleteRaste = $_GET['delete'];

        if($deleteRaste === "yes"){
            echo("Lösche alle Rasten");
            if (deletetRasten($con) !== true){
                // Rasten konnte nicht aus DB gelöscht werden
                header("location: ../index.php?error=dberrordel");
                exit;
            } else{
                header("location: ../index.php?error=nodberror");
                exit;
            }
        }
        
    }
    else{
        echo("Kein GET");
    }