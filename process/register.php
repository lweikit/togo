<?php
include_once '../include/db_connect.php';
include_once '../include/functions.php';
include_once '../include/global_variables.php';

sec_session_start();

$error_msg = "";

if (isset($_POST['username'], $_POST['p'], $_POST['type'])) {
    // Sanitize and validate the data passed in
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);

    if (strlen($password) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
        $error_msg .= '<p class="error">Invalid password configuration.</p>';
    }
    // Password validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
    $prep_stmt = "SELECT id FROM users WHERE username = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
    if ($stmt) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows == 1) {
            // A user with this username already exists
            $error_msg .= '<p class="error">A user with this username address already exists.</p>';
        }
    } else {
        $error_msg .= '<p class="error">Database error</p>';
    }
    if (empty($error_msg)) {
        // Create a random salt
        $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
        // Create salted password
        $password = hash('sha512', $password . $random_salt);
        // Insert the new user into the database
        if ($insert_stmt = $mysqli->prepare("INSERT INTO users (username, password, salt, type) VALUES (?, ?, ?, ?)")) {
            $insert_stmt->bind_param('ssss', $username, $password, $random_salt, $type);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../register.php?err=Registration failure: INSERT');
            }
        }
        header('Location: ../calendar.php?message=register');
    }
}
?>
