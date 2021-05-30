<?php
    include_once 'header.php';
    require_once 'includes/connection.inc.php';
    require_once 'includes/functions.inc.php';

    $brewState = getBrewState($con);
    echo "<h1>Brausteuerung - Status: $brewState </h1>";
?>
        

        <div id=box>
            <h2>Neue Raste erstellen</h2>
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
                    elseif ($_GET["error"] == "none"){
                        echo "<p>Raste hinzugefügt</p>";
                    }
                }
            ?>
        
        </div>


        <div id=box>
            <h2>Brauverlauf</h2>
            <table id="meineTabelle" data-role="table" class="ui-responsive"
                data-mode="columntoggle" data-column-btn-text="Spalten" >
            <thead>
                <tr>
                <th>Raste</th>
                <th data-priority="1">Temperatur (Grad Celsius)</th>
                <th data-priority="2">Dauer (Minuten)</th>
                <th data-priority="3">Jodprobe</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $query = "SELECT * FROM rasten";
            $resultData= mysqli_query($con, $query);
            while($data = mysqli_fetch_assoc($resultData)){
            ?>
                <tr>
                    <td>
                        <?php echo $data["rastenName"]; ?>
                    </td>
                    <td>
                        <?php echo $data["rastenSollTemp"]; ?>
                    </td>
                    <td>
                        <?php echo $data["rastenDur"]; ?>
                    </td>
                    <td>
                        <?php echo $data["rastenJod"]; ?>
                    </td>          
            </tr>
            <?php
            }
            ?>
            </tbody>
            </table>
            <br><br>
            <form action="includes/recipie.inc.php" method="get">  
                <input type='hidden' value="yes" name='delete'>              
                <input id="button" type="submit" value="Rasten Löschen">
            </form>

            <?php
                if(isset($_GET["error"])){
                    // In der Seiten URL befindet sich eine Error Message
                    if($_GET["error"] == "dberrordel"){
                        echo "<p>Fehler beim Löschen der Rasten</p>";
                    }
                    elseif ($_GET["error"] == "nodberror"){
                        echo "<p>Rasten gelöscht</p>";
                    }
                }
            ?>
        </div>
        

    </body>
</html>

