<?php
    include_once 'header.php';
    
?>
    
        <h1>Das ist die Brausteuerung</h1>

        <div id=box>
            <div style="font-size: 20px; margin: 10px;">Neue Raste erstellen</div>
            <form action="includes/rasten.inc.php" method="post">
                <label for="raste">Name der Raste</label>    
                <input id="text" type="text" name="raste" id="raste" placeholder="Name der Raste"><br><br>
                <label for="temp">Temperatur in Grad Celsius</label>
                <input id="text" type="number" name="temperature" id="temp" placeholder="Temperatur"><br><br>
                <label for="dur">Dauer in Minuten</label>
                <input id="text" type="number" name="duration" id="dur" placeholder="Dauer"><br><br>
                <label for="jod">Jodprobe</label>
                <! Der Wert der Variable jodprobe wird überschrieben, wenn die Checkbox aktiviert wird>
                <input type='hidden' value="false" name='jodprobe'>
                <input id="text" type="checkbox" name="jodprobe" id="jod" value="true"><br><br>                
                <input id="button" type="submit" value="Eingabe"><br><br>
            </form>

            <?php
                if(isset($_GET["error"])){
                    // In der Seiten URL befindet sich eine Error Message
                    if($_GET["error"] == "emptyinput"){
                        echo "<p>Alle Felder müssen ausgefüllt sein</p>";
                    }
                    elseif ($_GET["error"] == "invalidraste"){
                        echo "<p>Ungültiger Name für die Raste</p>";
                    }
                    elseif ($_GET["error"] == "invalidtemperature"){
                        echo "<p>Temperatur muss zwischen 0 und 100 Grad liegen</p>";
                    }
                    elseif ($_GET["error"] == "invalidduration"){
                        echo "<p>Dauer muss eine Zahl größer 0 sein</p>";
                    }
                    elseif ($_GET["error"] == "dberror"){
                        echo "<p>Datenbankfehler</p>";
                    }
                    elseif ($_GET["error"] == "stmtfailed"){
                        echo "<p>Datenbankfehler Prepared Statement</p>";
                    }
                }
            ?>
        
        </div>

    </body>
</html>

