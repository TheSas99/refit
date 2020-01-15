<!DOCTYPE html>
    <html>
    <head>
        <title>Verwijderen</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="HandheldFriendly" content="true">
    </head>
<body>
<nav>
    <a href="index.php">Home</a>
    <a href="klanten.php">Klanten</a>
    <a href="afspraken.php">Afspraken</a>
</nav>
<?php
error_reporting(0);

// mysql connect importeren
include "connect.php";

// id ophalen
$id = $_GET['klantid'];

// sql delete een record op id
$sql = "DELETE FROM klanten WHERE klantid=$id";

if (mysqli_query($mysqli, $sql)) {
    echo "Record succesvol verwijderd";
    // terugsturen naar de hoofdpagina
    header('Location: klanten.php');
} else {
    // fouten kan je hier aanzetten.
    echo "Error deleting record: " . mysqli_error($mysqli);
}

mysqli_close($mysqli);

?>
</body>
 </html>
