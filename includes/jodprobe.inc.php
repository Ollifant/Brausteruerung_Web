<?php
    require_once 'connection.inc.php';
    require_once 'functions.inc.php';

    if ($_SERVER['REQUEST_METHOD'] == "GET"){
        
        // Der Eingabe-Button wurde gedrückt
        
        $jodprobe = $_GET['jod'];

        if($jodprobe == "positiv"){
            updateJodprobe($con, "Positiv");
            header("location: ../monitor.php");
            exit;
        }

        if($jodprobe == "negativ"){
            updateJodprobe($con, "Negativ");
            header("location: ../monitor.php");
            exit;
        }
        // Nur für Testzwecke
        if($jodprobe == "wait"){
            updateJodprobe($con, "Wait");
            header("location: ../monitor.php");
            exit;
        }
    }
    else{
        echo("Kein GET");
    }