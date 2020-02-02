<!doctype html>
<html lang="en">
<head>
    <title>Afspraak aanmaken</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
    <main id="container">
        <?php include 'includes/navigatie.php';?>
        <div id="toevoegen">
            <h1>Afspraak aanmaken</h1>
            <form action="select-time.php" method="get">
                <div class="data-field">
                    <label for="date">Selecteer een datum</label>
                    <input id="date" type="date" name="date" value="<?= date('Y-m-d') ?>"/>
                </div>
                <div class="data-submit">
                    <input type="submit" name="submit" value="Kies een tijd"/>
                </div>
        </div>
        <div id="afspraken">
            <h1>Afspraken</h1>
            <?php
            // mysql connect importeren
            include "connect.php";

            $query = "SELECT *
    FROM reservations
    INNER JOIN klanten
    ON reservations.klantid = klanten.klantid
    ORDER BY date DESC; ";


            echo '<table border="0" cellspacing="2" cellpadding="2"> 
                <tr> 
                    <td> voornaam </td> 
                    <td> achternaam </td> 
                    <td> datum </td>  
                    <td> starttijd </td>
                    <td> eindtijd </td>
                </tr>';

            if ($result = $mysqli->query($query)) {
                while ($row = $result->fetch_assoc()) {
                    $id = $row["id"];
                    $klantid = $row["klantid"];
                    $voornaam = $row["voornaam"];
                    $tussenvoegsel = $row["tussenvoegsel"];
                    $achternaam = $row["achternaam"];
                    $datum = $row["date"];
                    $starttijd = $row["start_time"];
                    $endtijd = $row["end_time"];

                    echo "<tr>
                        <td> $voornaam </td>
                        <td> $achternaam </td>  
                        <td><b> $datum </b></td>
                        <td><b> $starttijd </b></td>
                        <td><b> $endtijd </b></td>
                        <td><a href=afspraakupdate.php?id=$id>UPDATE</a></td>  
                        <td><a href=afspraakdelete.php?id=$id>DELETE</a></td>  
                      </tr>";
                }
                $result->free();
            }
            ?>
        </div>
        </form>
        <?php include 'includes/footer.php';?>
    </main>
</body>
</html>
