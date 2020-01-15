<?php
require_once 'includes/database.php';

// A date begin of the week. Start of the week is on Sunday.
$date = '2020-01-05';
$enddate = '2020-01-12';
$query = "SELECT * 
          FROM planning_system.reservations 
          WHERE date >= '$date' AND date <= '$enddate'
          ORDER BY start_time ASC";
$result = mysqli_query($db, $query)
or die('Error '.mysqli_error($db).' with query '.$query);

$reservations = [];
while($row = mysqli_fetch_assoc($result))
{
    $reservations[] = $row;
}



setlocale(LC_ALL, 'nl_NL');

if(isset($_POST['submit'])) {
    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $time = mysqli_real_escape_string($db, $_POST['time']);
    $date = mysqli_escape_string($db, $_POST['date']);
    $endTime = date('H:i', strtotime($time . ' 1hour'));

    //Require the form validation handling
    require_once "includes/form-validation.php";

    if (empty($errors)) {
        //Save the record to the database
        $query = "INSERT INTO planning_system.reservations
                  (description, date, start_time, end_time)
                  VALUES ('$name', '$date', '$time', '$endTime')";
        $result = mysqli_query($db, $query);

        if ($result) {
            //Set success message & empty all variables for new form
            $name = '';
            $date = '';
            $genre = '';
            $year = '';
            $tracks = '';
            $success = true;

            // Or redirect to index.php
        } else {
            $errors[] = 'Something went wrong in your database query: ' . mysqli_error($db);
        }

        //Close connection
        mysqli_close($db);
    }
    header('Location: index_advanced.php');
}
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/style_advanced.css"/>
</head>
<body>
<div class="row">

    <?php for($i = 0 ; $i < 6 ; $i++) {?>

        <div class="column">
            <b><?= strftime('%A', strtotime($date ." + $i days")) ?></b>
            <div><?= date('j F', strtotime($date ." + $i days")) ?></div>

            <?php foreach($reservations as $reservation) { ?>

                <?php if(date('N', strtotime($reservation['date'])) == $i) {?>
                    <?php include 'templates/template_event.php' ?>
                <?php } ?>

            <?php } ?>

        </div>

    <?php } ?>
</div>

<div class="row">
    <div class="column">
        <h2>Nieuw event</h2>
        <form action="" method="post">
            <div class="data-field">
                <label for="name">Omschrijving</label>
                <input id="name" type="text" name="name" value="<?= (isset($name) ? $name : ''); ?>"/>
                <span class="errors"><?= isset($errors['name']) ? $errors['name'] : '' ?></span>
            </div>
            <div class="data-field">
                <label for="date">Datum</label>
                <input type="date" name="date" id="date"/>
                <span class="errors"><?= isset($errors['date']) ? $errors['date'] : '' ?></span>
            </div>
            <div class="data-field">
                <label for="time">Tijd</label>
                <select name="time" id="time">
                    <option value="">Select a date first</option>
                </select>
                <span class="errors"><?= isset($errors['time']) ? $errors['time'] : '' ?></span>
            </div>
            <div class="data-submit">
                <input type="submit" name="submit" value="Save"/>
            </div>
        </form>
    </div>
</div>

<script src="js/main.js"></script>
</body>
</html>
