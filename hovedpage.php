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


if (isset($_GET["idrom"])){
    $idrom = $_GET["idrom"];
} else {
    $idrom = 1;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="main.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>intility</title>

</head>
<body>
    <div>
        <form action="kobling.php"method="get">
            <input type="text" name="navn" placeholder="rom navn" required>
            <input type="text" name="titel" placeholder="titel" required>
            <input type="text" name="sporsmaal" placeholder="spørsmål" required>
            <button type="submit">leg til rom</button>
            <input type="hidden" name="idrom" value="<?php echo "$idrom";?>">   
        </form>
    </div>
    <?php 


    $sql = "SELECT * FROM rom WHERE idrom = $idrom"; //Skriv din sql kode her
    $resultat = $kobling->query($sql);

    while($rad = $resultat->fetch_assoc()) {
        $navn = $rad["navn"]; //Skriv ditt kolonnenavn her
        $titel = $rad["titel"]; //Skriv ditt kolonnenavn her
        $sporsmaal = $rad["sporsmaal"]; //Skriv ditt kolonnenavn her

        echo " <h1>$titel</h1>";
        echo " <p>$sporsmaal<p>";
        
    }
    ?>
    <form action=""method="get">
        <select name= "idrom">
        <?php
            // Med linjeskift for 1 tabell    
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
        <input type="hidden" name="idrom" value="<?php echo "$idrom";?>">

    </form>


    <?php
    // Med linjeskift for 1 tabell 
    //JOIN rom ON WHERE idrom = 13"
    $sql = "SELECT * FROM Reaksjoner JOIN rom ON idrom = rom_idrom WHERE idrom = $idrom"; //Skriv din sql kode her
    $resultat = $kobling->query($sql);

    while($rad = $resultat->fetch_assoc()) {
        $tid = $rad["Tid"]; //Skriv ditt kolonnenavn her
        $navn = $rad["knappnavn"]; //Skriv ditt kolonnenavn her
        $brukernavnet = $rad["brukernavn"]; //Skriv ditt kolonnenavn her

        echo "($navn) ble trykket, klokken ($tid) av ($brukernavnet)  <br>";
    }
    ?>
</body>
</html>