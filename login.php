<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<head>
    <title>Inloggen</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="script/script.js"></script>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
</head>
<body>
<div class="header">
    <h2>Login</h2>
</div>
<form class="inloggen" method="post" action="login.php">

    <?php echo display_error(); ?>

    <div class="input-group">
        <label>Gebruikersnaam:</label>
        <input type="text" name="username" >
    </div>
    <div class="input-group">
        <label>Wachtwoord:</label>
        <input type="password" name="password">
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="login_btn">Login</button>
    </div>
    <p>
        Not yet a member? <a href="register.php">Registreren</a>
    </p>
</form>
</body>
</html>