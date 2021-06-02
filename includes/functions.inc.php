<?php

    function emptyInputRasten($nameRaste, $temperaturRaste, $durationRaste){
        
        if(empty($nameRaste) || empty($temperaturRaste) || empty($durationRaste)){
            
            // Mindestens ein Feld ist leer
            $result = true;
        } 
        else{
            // Kein Fehler
            $result = false;
        }
        return $result;
    }

    function invalidRastenName($nameRaste){
        // Name der Raste darf nur auf Buchstaben und Ziffern bestehen
        // Regulären Ausdruck prüfen
        if(!preg_match("/^[a-zßäüöA-ZÄÖÜ0-9]*$/", $nameRaste)){
            // Falsches Zeichen gefunden
            $result = true;
        } 
        else{
            // Name korrekt
            $result = false;
        }
        return $result;
    }

    function invalidTemperatur($temperaturRaste) {

        if(!is_numeric($temperaturRaste)){
            // Keine Zahl eingegeben
            $result = true;
        } 
        else{
            if (($temperaturRaste <= 0) ||($temperaturRaste > 100)){
                // Falscher Temperaturberich
                $result = true;
            } 
            else{
                // Kein Fehler
                $result = false;
            }
        }
        return $result;
    }

    function invalidDuration($durationRaste) {

        if(!is_numeric($durationRaste)){
            // Keine Zahl eingegeben
            $result = true;
        } else{
            if ($durationRaste <= 0){
                // Keine negativen Werte für die Dauer
                $result = true;
            } 
            else{
                // Kein Fehler
                $result = false;
            }
        }
        return $result;
    }

    function insertRaste($con, $nameRaste, $temperaturRaste, $durationRaste, $jodprobe ){
        // Prepared Statement verwenden
        $sql = "INSERT INTO rasten (rastenName, rastenSollTemp, rastenDur, rastenJod) values (?, ?, ?,?);";
        $stmt = mysqli_stmt_init($con);
        
        // Prüfen, ob das Prepared Statement funktioniert
        if(!mysqli_stmt_prepare($stmt, $sql)){
            // SQL Statement ist fehlerhaft
            header("location: ../index.php?error=stmtfailed");
            exit;
        }

        // Prepared Statement it ok, nun die Parameter hinzufügen
        mysqli_stmt_bind_param($stmt, "ssss", $nameRaste, $temperaturRaste, $durationRaste, $jodprobe);
        // Prepared Statement ausführen
        $result = mysqli_stmt_execute($stmt);
        // Prepared Statement schließen
        mysqli_stmt_close($stmt);

        return $result;
    }

    function deletetRasten($con){
        $query = "DELETE FROM rasten";
        $result = mysqli_query($con, $query);   

        return $result;
    }

    function jodprobe($con){
        // Status der Jodprobe aus DB lesen
        $query = "SELECT state FROM Status WHERE StateName = 'Jodprobe'";
        $resultData= mysqli_query($con, $query);
        // Datensatz lesen
        $data = mysqli_fetch_assoc($resultData);

        if($data["state"] == "Wait"){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    function updateJodprobe($con, $input){
        // Status der Jodprobe setzen
        $query = "UPDATE Status SET State = '$input' WHERE StateName = 'Jodprobe'";
        $result = mysqli_query($con, $query);   

        return $result;
    }

    function getBrewstate($con){
        // Status des Brewstate aus DB lesen
        $query = "SELECT state FROM Status WHERE StateName = 'Brewstate'";
        $resultData= mysqli_query($con, $query);
        // Datensatz lesen
        $data = mysqli_fetch_assoc($resultData);

        return $data["state"];
    }

    function setBrewState($con, $state){
        // Braustatus setzen
        $query = "UPDATE Status SET State = '$state' WHERE StateName = 'BrewState'";
        $result = mysqli_query($con, $query);   

        return $result;

    }

    function getMode($con){
        // Status des Modus aus DB lesen
        $query = "SELECT state FROM Status WHERE StateName = 'Modus'";
        $resultData= mysqli_query($con, $query);
        // Datensatz lesen
        $data = mysqli_fetch_assoc($resultData);

        return $data["state"];
    }

    function setMode($con, $state){
        // Braustatus setzen
        $query = "UPDATE Status SET State = '$state' WHERE StateName = 'Modus'";
        $result = mysqli_query($con, $query);   

        return $result;

    }