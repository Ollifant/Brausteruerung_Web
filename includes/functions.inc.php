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
        if(!preg_match("/^[a-zA-Z0-9]*$/", $nameRaste)){
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
            header("location: ../index.php?stmtfailed");
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