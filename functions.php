<?php
session_start();

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'refit');

// variable declaration
$username = "";
$email    = "";
$errors   = array();


// call the register() function if register_btn is clicked
if (isset($_POST['register_btn'])) {
    register();
}

// REGISTER USER
function register(){
    // call these variables with the global keyword to make them available in function
    global $db, $errors, $username, $email;

    // receive all input values from the form. Call the e() function
    // defined below to escape form values
    $username    =  e(htmlentities($_POST['username']));
    $email       =  e(htmlentities($_POST['email']));
    $password_1  =  e(htmlentities($_POST['password_1']));
    $password_2  =  e(htmlentities($_POST['password_2']));


    // form validation: ensure that the form is correctly filled
    if (empty($username)) {
        array_push($errors, "Gebruikersnaam is benodigd");
    }
    if (empty($email)) {
        array_push($errors, "E-mail is benodigd");
    }
    if (empty($password_1)) {
        array_push($errors, "Wachtwoord is benodigd");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "De wachtwoorden zijn niet gelijk aan elkaar");
    }

    // register user if there are no errors in the form
    if (count($errors) == 0) {
        $password = md5($password_1);//encrypt the password before saving in the database

        if (isset($_POST['user_type'])) {
            $user_type = e($_POST['user_type']);
            $query = "INSERT INTO users (username, email, user_type, password)
					  VALUES('$username', '$email', '$user_type', '$password')";
            mysqli_query($db, $query);
            $_SESSION['success']  = "Nieuwe gebruiker succesvol geregistreerd!!";
            header('location: index.php');
        }else{
            $query = "INSERT INTO users (username, email, user_type, password)
					  VALUES('$username', '$email', 'user', '$password')";
            mysqli_query($db, $query);

            // get id of the created user
            $logged_in_user_id = mysqli_insert_id($db);

            $_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
            $_SESSION['success']  = "U bent nu ingelogd";
            header('location: index.php');
        }
    }
}

// return user array from their id
function getUserById($id){
    global $db;
    $query = "SELECT * FROM users WHERE id=" . $id;
    $result = mysqli_query($db, $query);

    $user = mysqli_fetch_assoc($result);
    return $user;
}

// escape string
function e($val){
    global $db;
    return mysqli_real_escape_string($db, trim($val));
}

function display_error() {
    global $errors;

    if (count($errors) > 0){
        echo '<div class="error">';
        foreach ($errors as $error){
            echo $error .'<br>';
        }
        echo '</div>';
    }
}


function isLoggedIn()
{
    if (isset($_SESSION['user'])) {
        return true;
    }else{
        return false;
    }
}

// log user out if logout button clicked
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    header("location: login.php");
}


// call the login() function if register_btn is clicked
if (isset($_POST['login_btn'])) {
    login();
}

// LOGIN USER
function login(){
    global $db, $username, $errors;

    // grap form values
    $username = e($_POST['username']);
    $password = e($_POST['password']);

    // make sure form is filled properly
    if (empty($username)) {
        array_push($errors, "Gebruikersnaam is niet ingevuld");
    }
    if (empty($password)) {
        array_push($errors, "Wachtwoord is niet ingevuld");
    }

    // attempt login if no errors on form
    if (count($errors) == 0) {
        $password = md5($password);

        $query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
        $results = mysqli_query($db, $query);

        if (mysqli_num_rows($results) == 1) { // user found
            // check if user is admin or user
            $logged_in_user = mysqli_fetch_assoc($results);
            if ($logged_in_user['user_type'] == 'admin') {

                $_SESSION['user'] = $logged_in_user;
                $_SESSION['success']  = "U bent nu ingelogd!";
                header('location: admin/index.php');
            }else{
                $_SESSION['user'] = $logged_in_user;
                $_SESSION['success']  = "U bent nu ingelogd!";

                header('location: index.php');
            }
        }else {
            array_push($errors, "Foute gebruikersnaam/wachtwoord combinatie");
        }
    }
}


// checkt of een user admin is
function isAdmin()
{
    if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
        return true;
    }else{
        return false;
    }
}