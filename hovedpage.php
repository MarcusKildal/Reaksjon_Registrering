<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="hovedpage.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>intility</title>

</head>
<body>
    <h1>test</h1>
<form action="kobling.php" method="get">
     Super kult
    <input type="radio" name="knappnavn" value ="Super kult">
     Liker litt
    <input type="radio" name="knappnavn" value ="Liker litt">
     Usikker
    <input type="radio" name="knappnavn" value ="Usikker">
     Liker ikke 
    <input type="radio" name="knappnavn" value ="Liker ikke">
     Hater det 
    <input type="radio" name="knappnavn" value ="Hater det">
    <input type="submit" value="Send">
</form>
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
        echo "<br>";
    }

    // Angi UTF-8 som tegnsett
    $kobling->set_charset("utf8");




// Med linjeskift for 1 tabell
$sql = "SELECT * FROM knapper"; //Skriv din sql kode her
$resultat = $kobling->query($sql);

while($rad = $resultat->fetch_assoc()) {
    $tid = $rad["Tid"]; //Skriv ditt kolonnenavn her
    $navn = $rad["knappnavn"]; //Skriv ditt kolonnenavn her

    echo "  ($navn) har blit tykket (antall) å ble  sist  klokken ($tid) av (navn)  <br>";
}
?>
</body>
</html>