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
        // echo "<br>";
    }
    // Angi UTF-8 som tegnsett
    $kobling->set_charset("utf8");

    //hvis ikke satt rom blir du på det romme du har satt id 1
    if (isset($_GET["idrom"])){
        $idrom = $_GET["idrom"];
    } else {
        $idrom = 1;
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="Main.css">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>intility</title>
    </head>
    <body>
        <div class = "Legg_Til_Rom">
            <form action="kobling.php"method="get">
                <input type="text" name="navn" placeholder="rom navn" required>
                <input type="text" name="titel" placeholder="titel" required>
                <input type="text" name="sporsmaal" placeholder="spørsmål" required>
                <button type="submit">leg til rom</button>
                <!-- sender deg til bake til det romme du var i etter du trykker på submit knappen-->
                <input type="hidden" name="idrom" value="<?php echo "$idrom";?>">   
            </form>
        </div>
        <div class = "titel">
            <?php 
            //sender ut beskrivelsen hvis det romme du har valgt å være i er det samme som id 
                $sql = "SELECT * FROM rom WHERE idrom = $idrom"; //Skriv din sql kode her
                $resultat = $kobling->query($sql);

                while($rad = $resultat->fetch_assoc()) {
                    $navn = $rad["navn"]; //Skriv ditt kolonnenavn her
                    $titel = $rad["titel"]; //Skriv ditt kolonnenavn her
                    $sporsmaal = $rad["sporsmaal"]; //Skriv ditt kolonnenavn her

                    echo " <h1>$titel</h1> ";
                    echo " <h3>$sporsmaal<h3>";
                    
                }
            ?>
        </div>
        <hr>
        <div class = "for_å_legge_ved_siden_av_form">
            <div class = "interaktivitet">
                <form action=""method="get">
                    <select name= "idrom">
                        <?php
                            // gir deg mulighet til å velge rom
                            $sql = "SELECT * FROM rom"; //Skriv din sql kode her
                            $resultat = $kobling->query($sql);

                            while($rad = $resultat->fetch_assoc()) {
                                $navn = $rad["navn"]; //Skriv ditt kolonnenavn her
                                $idromdatabase = $rad["idrom"];

                                if($idrom == $idromdatabase){
                                    echo "<option value='$idromdatabase' selected> $navn</option>";
                                } else {
                                    echo "<option value='$idromdatabase'> $navn</option>";
                                }
                                
                            }
                        ?>
                        <input type="submit" value="Velg rom">
                    </select>
                </form>

                <form action="kobling.php"method="get">
                    <input type="text" name="brukernavn" placeholder="Username" required>
                    <br>
                    <input type="radio" name="knappnavn" value ="Super kult">
                    Super kult
                    <br>
                    <input type="radio" name="knappnavn" value ="Liker litt">
                    Liker litt
                    <br>
                    <input type="radio" name="knappnavn" value ="Usikker">
                    Usikker
                    <br>
                    <input type="radio" name="knappnavn" value ="Liker ikke">
                    Liker ikke 
                    <br>
                    <input type="radio" name="knappnavn" value ="Hater det">
                    Hater det 
                    <br>
                    <input type="submit" value="Send">
                    <!-- sender deg til bake til det romme du var i -->
                    <input type="hidden" name="idrom" value="<?php echo "$idrom";?>">
                </form>
            </div>
            <div class = "Logg">
                <?php
                // sender ut det du inserta i data basen hvis det romme du har valgt å være i er det samme som id
                    $sql = "SELECT * FROM Reaksjoner JOIN rom ON idrom = rom_idrom WHERE idrom = $idrom"; //Skriv din sql kode her
                    $resultat = $kobling->query($sql);

                    while($rad = $resultat->fetch_assoc()) {
                        $tid = $rad["Tid"]; //Skriv ditt kolonnenavn her
                        $navn = $rad["knappnavn"]; //Skriv ditt kolonnenavn her
                        $brukernavnet = $rad["brukernavn"]; //Skriv ditt kolonnenavn her

                        echo "($navn) ble trykket, klokken ($tid) av ($brukernavnet)  <br>";
                    }
                ?>
            </div>
        </div>
    </body>
</html>