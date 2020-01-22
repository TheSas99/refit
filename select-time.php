<?php
require_once "includes/database.php";

// Maak een array met tijden van 09:00 - 17:00 met stappen van 30 minuten.
$times = [];
$time = strtotime('10:00');
$timeToAdd = 30;

// loop (while of for loop)
while ($time <= strtotime('19:30'))
{

    // time toevoegen aan times array
    $times[] = date('H:i',$time);
    // time + een 30 min
    $time += 60 * $timeToAdd;
}


if(isset($_POST['submit'])) {
    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $klantid = mysqli_real_escape_string($db, $_POST['klantid']);
    $time = mysqli_real_escape_string($db, $_POST['time']);
    $date = mysqli_escape_string($db, $_POST['date']);
    $endTime = date('H:i', strtotime($time . ' 1hour'));
    //Require the form validation handling
    require_once "includes/form-validation.php";

    if (empty($errors)) {
        //Save the record to the database
        $query = "INSERT INTO refit.reservations
                  (klantid, date, start_time, end_time)
                  VALUES ('$klantid', '$date', '$time', '$endTime')";
        $result = mysqli_query($db, $query)
        or die('Error: '.mysqli_error($db). 'QUERY: '.$query);

        if ($result) {
            header('Location: afspraken.php');
        } else {
            $errors[] = 'Iets ging verkeerd bij de database query: ' . mysqli_error($db);
        }
    }
}

if(isset($_GET['date']) && !empty($_GET['date'])) {
    $date = mysqli_escape_string($db, $_GET['date']);

    // Haal de reserveringen uit de database voor specifieke datum
    $query = "SELECT * FROM reservations WHERE date = '$date'";

    $result = mysqli_query($db, $query);
    if($result) {
        $reservations = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $reservations[] = $row;
        }
    }

    // Doorloop alle reserveringen en filter alle tijden die gelijk zijn
    // aan de tijd van een reservering t/m een uur later.
    // Zet alle overgebleven tijden in de array $availableTimes.
    $availableTimes = [];
    // doorloop alle tijden
    foreach ($times as $time)
    {
        $time = strtotime($time);
        $occurs = false;
        // controleer de tijd tegen de reserveringen
        foreach ($reservations as $reservation)
        {
            $startTime = strtotime($reservation['start_time']);
            $endTime = strtotime($reservation['end_time']);
            // Als de tijd van begin- t/m eindtijd van reservering, voeg de niet toe
            if ($time >= $startTime && $time < $endTime)
            {
                $occurs = true;
            }
        }
        if(!$occurs) {
            $availableTimes[] = date('H:i', $time);
        }
    }


} else {
    header('Location: afspraken.php');
}


// Get all artist names for dropdown
require_once 'includes/klantdata.php';
?>
<!doctype html>
<html lang="en">
<head>
    <title>Nieuwe reservering - tijd</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
<?php include 'includes/navigatie.php';?>
<div id="toevoegen">
    <h1>Afspraak aanmaken</h1>

    <form action="" method="post">
        <div>
            <p>Reservering voor <?= date('d-m-Y', strtotime($date)) ?></p>
        </div>
        <!--<div class="data-field">
            <label for="klantid">Klantid:</label>
            <input id="name" type="number" name="klantid" value="// (isset($name) ? $name : ''); ?>"/>
            <span class="errors"><// isset($errors['klantid']) ? $errors['klantid'] : '' ?></span>
        </div>-->
        <div class="data-field">
            <label for="voornaam">Klantnaam: </label>
            <select name="klantid" id="voornaam">
                <?php foreach ($artists as $artist) { ?>
                    <option value="<?= $artist['klantid'] ?>"><?= $artist['voornaam'] ?></option>

                <?php } ?>
            </select>
            <span class="errors"><?= isset($errors['klantid']) ? $errors['klantid'] : '' ?></span>
        </div>
        <div class="data-field">
            <label for="time">Tijd</label>
            <select name="time" id="time">
                <?php foreach ($availableTimes as $time) { ?>
                    <option value="<?= $time ?>"><?= $time ?></option>
                <?php } ?>
            </select>
            <span class="errors"><?= isset($errors['time']) ? $errors['time'] : '' ?></span>
        </div>
        <input type="hidden" name="date" value="<?= $date ?>"/>
        <div class="data-submit">
            <input type="submit" name="submit" value="Save"/>
        </div>
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
            </tr>';

    if ($result = $mysqli->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $id = $row["klantid"];
            $voornaam = $row["voornaam"];
            $tussenvoegsel = $row["tussenvoegsel"];
            $achternaam = $row["achternaam"];
            $massage = $row["massagesoort"];

            echo '<tr> 
                    <td><b>'.$id.'</b></td> 
                    <td>'.$voornaam.'</td> 
                    <td>'.$tussenvoegsel.'</td> 
                    <td>'.$achternaam.'</td>';
        }
        $result->free();
    }
    ?>
</div>
<?php include 'includes/footer.php';?>
</body>
</html>