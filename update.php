 <!DOCTYPE html>
    <html>
    <head>
        <title>Refit | Wijzigen</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="HandheldFriendly" content="true">
    </head>
<body>
<?php include 'navigatie.php';?>
<h1>Updaten</h1>
<?php
// mysql connect importeren
include "connect.php";

error_reporting(0);

$id = $_GET['klantid'];

$sql = "SELECT * FROM klanten WHERE klantid =$id";

// variabele $mysqli is het object uit de connect.php
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // output data van elke kolom
    while($row = $result->fetch_assoc())
    {
        ?>
        <form method='post'><table width='400' border='0' cellspacing='1' cellpadding='2'>
                <tr><td width=100>Voornaam</td><td><input name='voornaam' type='text' id='voornaam' value='<?php echo $row['voornaam']; ?>'></td></tr>
                <tr><td width=100>Tussenvoegsel</td><td><input name='tussenvoegsel' type='text' id='tussenvoegsel' value='<?php echo $row['tussenvoegsel']; ?>'></td></tr>
                <tr><td width='100'>Achternaam</td><td><input name='achternaam' type='text' id='achternaam' value='<?php echo $row['achternaam'];  ?>'></td></tr><tr>
                <tr><td width='100'>Massagesoort</td><td>
                        <textarea rows="4" cols="30" name='massagesoort'>
                            <?php echo $row['massagesoort'];?>
                        </textarea></td>
                </tr></table>
            </br>
            <input type="submit" value="Updaten"></td>
        </form>
        <?php
    }
} else {
    echo "0 resultaten";
}

// update uitvoeren
if (isset($_REQUEST['voornaam']))
{
// waarden ophalen
    $voornaam = $_POST['voornaam'];
    $tussenvoegsel = $_POST['tussenvoegsel'];
    $achternaam = $_POST['achternaam'];
    $massage = $_POST['massagesoort'];

// strip_tags (veiliger, geen code invoer)
    $voornaam = strip_tags($voornaam);
    $tussenvoegsel = strip_tags($tussenvoegsel);
    $achternaam = strip_tags($achternaam);
    $massage = strip_tags($massage);

// real_escape_string maakt het nog veiliger, Preventie voor een SQL injectie.
    $voornaam = $mysqli->real_escape_string($voornaam);
    $tussenvoegsel = $mysqli->real_escape_string($tussenvoegsel);
    $achternaam = $mysqli->real_escape_string($achternaam);
    $massage = $mysqli->real_escape_string($massage);

// query opstellen
    $sql2 = "UPDATE klanten SET voornaam = '$voornaam', tussenvoegsel = '$tussenvoegsel', achternaam = '$achternaam', massagesoort = '$massage' WHERE klantid = '$id'";

// query uitvoeren
    if (mysqli_query($mysqli, $sql2)) {
        echo "Succesvol bijgewerkt";
        // terugsturen naar de hoofdpagina
        header('Location: klanten.php');
    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }
}

// verbinding sluiten
$mysqli->close();
?>