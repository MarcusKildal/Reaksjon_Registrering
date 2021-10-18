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
    <h1>trykk på en av knappene som sier noe om din tanker om det bildet</h1>
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

</body>
</html>