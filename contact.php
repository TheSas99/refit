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
    <?php include 'navigatie.php';?>
    <div id="contact">
        <h1>Contact</h1>
        <p>Klik op de knop om een e-mail te sturen</p>
        <button><a href="mailto:thesas99games@gmail.com">E-mail mij</a></button>
        <p>Nederland, Rotterdam en omstreken</p>
    </div>
    <br>
    <div id="map">
    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4N5ZTqiuV8APaDn3OIp9pUrNFdjkEgMQ&callback=initMap"
            async defer></script>
    </body>
</html>