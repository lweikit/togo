<?php
include_once 'global_variables.php';
// Create connection
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}
?>
