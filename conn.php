<?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "online_blood_bank";

try {
    // Create a PDO connection
    $pdo = new PDO("mysql:host=$server; dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

?>