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

            <a href="monitor.php">Monitor</a><br><br>
        
        </div>

    </body>
</html>

