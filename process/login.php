<?php
include_once '../include/db_connect.php';
include_once '../include/functions.php';

sec_session_start(); // Our custom secure way of starting a PHP session.

if (isset($_POST['username'], $_POST['p'])) {
    $username = $_POST["username"];
    $password = $_POST['p']; // Hashed password
    switch (login($username, $password, $mysqli)) {
        case "login":
            header('Location: ../calendar.php?message=login');
            break;
        case "wrong_password":
        case "no_user":
            header('Location: ../index.php?error=1');
            break;
        default:
            header('Location: ../index.php?error=2');
    }
} else {
    // The correct POST variables were not sent to this page.
    echo 'Invalid Request';
}
?>
