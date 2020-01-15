<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<head>
    <title>Registreren</title>
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
</head>
<body>
<div class="header">
    <h2>Register</h2>
</div>
<form name="register" class="inloggen" method="post" action="register.php">
    <?php echo display_error(); ?>
    <div class="input-group">
        <label>Gebruikersnaam:</label>
        <input type="text" name="username" value="<?php echo $username;?>">
    </div>
    <div class="input-group">
        <label>E-Mail</label>
        <input type="email" name="email" value="<?php echo $email; ?>">
    </div>
    <div class="input-group">
        <label>Wachtwoord</label>
        <input type="password" name="password_1">
        <input type="checkbox" name="option" value='0' onchange="changeType()">
    </div>
    <div class="input-group">
        <label>Bevestig wachtwoord</label>
        <input type="password" name="password_2">
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="register_btn">Registeren</button>
    </div>
    <p>
        Already a member? <a href="login.php">Inloggen</a>
    </p>
</form>
</body>
</html>
