<?php

    function emptyInputRasten($nameRaste, $temperaturRaste, $durationRaste){
        
        if(empty($nameRaste) || empty($temperaturRaste) || empty($durationRaste)){
            
            // Mindestens ein Feld ist leer
            $result = true;
        } else{
            // Kein Fehler
            $result = false;
        }
        return $result;
    }

    function invalidTemperatur($temperaturRaste) {

        if(!is_numeric($temperaturRaste)){
            // Keine Zahl eingegeben
            $result = true;
        } else{
            if (($temperaturRaste <= 0) ||($temperaturRaste > 100)){
                // Falscher Temperaturberich
                $result = true;
            } else{
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
            } else{
                // Kein Fehler
                $result = false;
            }
        }
        return $result;
    }

    function insertRaste($con, $nameRaste, $temperaturRaste, $durationRaste, $jodprobe ){
        $query = "insert into rasten (rastenName, rastenSollTemp, rastenDur, rastenJod) values ('$nameRaste', '$temperaturRaste', '$durationRaste', '$jodprobe')";
        mysqli_query($con, $query);

        $result = true;
        return $result;
    }