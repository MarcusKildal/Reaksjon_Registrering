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

    date_default_timezone_set("Europe/Oslo");
    $når_knappen_ble_trykket = date("Y-m-d h:i:s");



    $sql = "INSERT INTO `knapper` (`knappnavn`,`Tid`) VALUES ('$knappnavn', '$når_knappen_ble_trykket')";

    if($kobling->query($sql)) {
        echo "Spørringen $sql ble gjennomført.";
    } else {
        echo "Noe gikk galt med spøfrringen $sql ($kobling->error).";
    }
    header("Location: hovedpage.php");

?>