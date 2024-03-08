<?php

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "blood_donation";
    
    $name = test_input($_POST["Name"]);
    $email = test_input($_POST["email"]);
    $message = test_input($_POST['message']);

    if (empty($name)) {
        die("Error: Name is required");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo("error");
        die("Error: Invalid email format");

    }

    try {
        // Create a PDO connection
        $pdo = new PDO("mysql:host=$server; dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare and execute the SQL query
        $stmt = $pdo->prepare("INSERT INTO contact_query (query_Name, query_Email, query_Message) VALUES (:name, :email, :message)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);
        $stmt->execute();

        echo "Data inserted successfully!";
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }

    $conn -> close();
}

?>
