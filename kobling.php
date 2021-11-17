<?php
    $tjener = "localhost";
    $brukernavn = "root";
    $passord = "root";
    $database = "intilitypros"; //Endre på denne til din database

    // Opprette en kobling
    $kobling = new mysqli($tjener, $brukernavn, $passord, $database);

    // Sjekk om koblingen virker
    if($kobling->connect_error) {
        die("Noe gikk galt: " . $kobling->connect_error);
    } else {
        echo "Koblingen virker.<br>";
    }
    // Angi UTF-8 som tegnsett
    $kobling->set_charset("utf8");



    
    $knappnavn = $_GET["knappnavn"];
    $rom = $_GET["idrom"];
    $brukernavnet = $_GET["brukernavn"];
    date_default_timezone_set("Europe/Oslo");
    $når_knappen_ble_trykket = date("Y-m-d h:i:s");


    if(isset($brukernavnet)){
        $sql = "INSERT INTO `Reaksjoner` (`knappnavn`,`Tid`,`brukernavn`, `rom_idrom`) VALUES ('$knappnavn', '$når_knappen_ble_trykket', '$brukernavnet', '$rom')";

        if($kobling->query($sql)) {
            echo "Spørringen $sql ble gjennomført.";
        } else {
            echo "Noe gikk galt med spøfrringen $sql ($kobling->error).";
        }
        
    }


    
    $navn = $_GET["navn"];
    $titel = $_GET["titel"];
    $sporsmaal = $_GET["sporsmaal"];


    if(isset($navn)){
        $sql = "INSERT INTO `rom` (`navn`,`titel`,`sporsmaal`) VALUES ('$navn', '$titel', '$sporsmaal')";

        if($kobling->query($sql)) {
            echo "Spørringen $sql ble gjennomført.";
        } else {
            echo "Noe gikk galt med spøfrringen $sql ($kobling->error).";
        }
    
    }

    header("Location: hovedpage.php?idrom=$rom");
?>