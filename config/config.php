<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblio";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo "Oops! We couldn't connect to the database. Please try again later.";
    echo "Connection failed: " . $conn->connect_error;
    exit();
}
// else{
//     echo "Connected to the database successfully.";
// }
?>