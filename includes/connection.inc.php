<?php
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "brau_db";

    if (!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)){
        exit("Error: failed to connect to DB");
    }
