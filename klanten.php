<?php
/*
include('functions.php');
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}
*/
?>
<?php

?>
<!DOCTYPE html>
<html>
<head>
    <title>Re-Fit</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="script/script.js"></script>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
</head>
<body>
<?php include 'navigatie.php';?>
<div id="toevoegen">
    <h1>Toevoegen</h1>
    <form action="verzonden.php" method="post">
        <p>
            <label for="voornaam">Voornaam:</label>
            <input type="text" name="voornaam" id="voornaam" required>
        </p>
        <p>
            <label for="tussenvoegsel">Tussenvoegsel:</label>
            <input type="text" name="tussenvoegsel" id="tussenvoegsel" >
        </p>
        <p>
            <label for="achternaam">Achternaam:</label>
            <input type="text" name="achternaam" id="achternaam" required>
        </p>
        <p>
            <label for="massagesoort">Massagesoort:</label>
            <input type="text" name="massagesoort" id="massagesoort" required>
        </p>
        <input type="submit" value="Submit">
    </form>
</div>
<div id="klanten">
    <h1>Klanten</h1>
    <?php
    // mysql connect importeren
        include "connect.php";

        $query = "SELECT * FROM klanten ";


        echo '<table border="0" cellspacing="2" cellpadding="2"> 
            <tr> 
                <td> klantid </td> 
                <td> voornaam </td> 
                <td> tussenvoegsel </td> 
                <td> achternaam </td>  
                <td> massageinfo</td>  
            </tr>';

        if ($result = $mysqli->query($query)) {
            while ($row = $result->fetch_assoc()) {
                $id = $row["klantid"];
                $voornaam = $row["voornaam"];
                $tussenvoegsel = $row["tussenvoegsel"];
                $achternaam = $row["achternaam"];
                $massage = $row["massagesoort"];

            echo '<tr> 
                    <td>'.$id.'</td> 
                    <td>'.$voornaam.'</td> 
                    <td>'.$tussenvoegsel.'</td> 
                    <td>'.$achternaam.'</td>  
                    <td><b>'.$massage.'</b></td>';
                    echo "<td><a href=update.php?klantid=$id>UPDATE</a></td>";
                    echo "<td><a href=delete.php?klantid=$id>DELETE</a></td>";
                  echo '</tr>';
        }
        $result->free();
    }
?>
</div>
</body>
</html>