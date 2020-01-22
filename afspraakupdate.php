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
<?php include 'includes/navigatie.php';?>
<h1>Updaten</h1>
<?php
// mysql connect importeren
include "connect.php";

error_reporting(0);

$id = $_GET['id'];

$sql = "SELECT * FROM reservations WHERE id =$id";

// variabele $mysqli is het object uit de connect.php
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
// output data van elke kolom
while($row = $result->fetch_assoc())
{
?>
<form method='post'><table width='400' border='0' cellspacing='1' cellpadding='2'>
        <tr><td width=100>Datum</td><td><input name='date' type='text' id='date' value='<?php echo $row['date']; ?>'></td></tr>
        <tr><td width=100>Starttijd</td><td><input name='start_time' type='text' id='start_time' value='<?php echo $row['start_time']; ?>'></td></tr>
        <tr><td width=100>Eindtijd</td><td><input name='end_time' type='text' id='end_time' value='<?php echo $row['end_time']; ?>'></td></tr>
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
if (isset($_REQUEST['date']))
{
// waarden ophalen
    $date = $_POST['date'];
    $time = $_POST['start_time'];

// strip_tags (veiliger, geen code invoer)
    $date = strip_tags($date);
    $time = strip_tags($time);

// real_escape_string maakt het nog veiliger, Preventie voor een SQL injectie.
    $date = $mysqli->real_escape_string($date);
    $time = $mysqli->real_escape_string($time);

// query opstellen
    $sql2 = "UPDATE reservations SET date = '$date', start_time = '$time' WHERE id = '$id'";

// query uitvoeren
    if (mysqli_query($mysqli, $sql2)) {
        echo "Succesvol bijgewerkt";
        // terugsturen naar de hoofdpagina
        header('Location: afspraken.php');
    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }
}

// verbinding sluiten
$mysqli->close();
?>
<?php include 'includes/footer.php';?>
