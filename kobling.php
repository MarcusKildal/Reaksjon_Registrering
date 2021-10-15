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


    $sql = "INSERT INTO `knapper` (`knappnavn`) VALUES ('$knappnavn')";

    if($kobling->query($sql)) {
        echo "Spørringen $sql ble gjennomført.";
    } else {
        echo "Noe gikk galt med spøfrringen $sql ($kobling->error).";
    }


    header("Location: rom.php");

?>