<?php

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

    // Server-side validation
    $name = test_input($_POST["Name"]);
    $email = test_input($_POST["email"]);
    $message = test_input($_POST['message']);


    // Check if name is not empty
    if (empty($name)) {
        die("Error: Name is required");
    }

    // Check if the email address is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Error: Invalid email format");
     }

    // If everything is valid, you can proceed with further processing or store the data
    // For example, you might want to send an email, save to a database, etc.
    $sql = "INSERT INTO contact_query (Name,Email,Message) VALUES('$name','$email','$message')";

    if ($conn->query($sql)) {
        echo "Record added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
