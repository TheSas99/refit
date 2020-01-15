<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "refit");


// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Escape user inputs for security
$voornaam = mysqli_real_escape_string($link, $_REQUEST['voornaam']);
$tussenvoegsel = mysqli_real_escape_string($link, $REQUEST['tussenvoegsel']);
$achternaam = mysqli_real_escape_string($link, $_REQUEST['achternaam']);
$massagesoort = mysqli_real_escape_string($link, $_REQUEST['massagesoort']);

// Attempt insert query execution
$sql = "INSERT INTO klanten (voornaam, tussenvoegsel, achternaam, massagesoort) VALUES ('$voornaam', '$tussenvoegsel',  '$achternaam', '$massagesoort')";
if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
    // terugsturen naar de klantenpagina
    header('Location: klanten.php');
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);
?>