<!DOCTYPE html>
<html>
    <head>
	    <title>Re-Fit</title>
	    <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="script/script.js"></script>
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
        <meta name="viewport" content="initial-scale=1.0">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="HandheldFriendly" content="true">
    </head>
    <body>
    <main id="container">
        <?php include 'includes/navigatie.php';?>
        <div id="contact">
            <h1>Contact</h1>
            <p>Klik op de knop om een e-mail te sturen</p>
            <button><a href="mailto:thesas99games@gmail.com">E-mail mij</a></button>
            <br>
        </div>
        <br>
        <div id="map"></div>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4N5ZTqiuV8APaDn3OIp9pUrNFdjkEgMQ&callback=initMap"
                async defer></script>
        <?php
        $apiKey = "ffdcf51d4fec2016f348a4c593555adb";
        $cityId = "2747890";
        $googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=en&units=metric&APPID=" . $apiKey;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);

        curl_close($ch);
        $data = json_decode($response);
        $currentTime = time();
        ?>
        <div class="report-container">
            <h2><?php echo $data->name; ?> Weer status </h2>
            <div class="time">
                <div><?php echo date("l g:i a", $currentTime); ?></div>
                <div><?php echo date("jS F, Y",$currentTime); ?></div>
                <div><?php echo ucwords($data->weather[0]->description); ?></div>
            </div>
            <div class="weather-forecast">
                <img
                    src="http://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png"
                    class="weather-icon" /> <br><?php echo $data->main->temp_max; ?>°C Maximaal<span
                    class="min-temperature"><br><?php echo $data->main->temp_min; ?>°C Minimaal</span>
            </div>
            <div class="time">
                <div>Vochtigheid: <?php echo $data->main->humidity; ?> %</div>
                <div>Wind: <?php echo $data->wind->speed; ?> km/h</div>
            </div>
        </div>
    </main>
    </body>

</html>