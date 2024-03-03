<?php

<<<<<<< HEAD
$SERVER = "localhost";
$USERNAME = "root";
$PASSWORD = "";
$DB_NAME = "blood_donation";

$conn = mysqli_connect($SERVER,$USERNAME,$PASSWORD,$DB_NAME);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
=======
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
>>>>>>> aa3d490245c322eafceb0cb2f306d6f2a58d3b6c

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

<<<<<<< HEAD
    // If everything is valid, you can proceed with further processing or store the data
    // For example, you might want to send an email, save to a database, etc.
    $sql = "INSERT INTO contact_query (Name,Email,Message) VALUES('$name','$email','$message')";

    if ($conn->query($sql)) {
        echo "Record added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
=======
>>>>>>> aa3d490245c322eafceb0cb2f306d6f2a58d3b6c
    }

    try {
        // Create a PDO connection
        $pdo = new PDO("mysql:host=$server; dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare and execute the SQL query
        $stmt = $pdo->prepare("INSERT INTO contact_query (Name, Email, Message) VALUES (:name, :email, :message)");
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
