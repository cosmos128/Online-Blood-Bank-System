<?php
// Database connection parameters
$servername = "localhost"; // Change this to your database server
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$database = "online_blood_bank"; // Change this to your database name



// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data after sanitizing
    $fullname = sanitize_input($_POST["fullname"]);
    $mobileNumber = sanitize_input($_POST["mobileNumber"]);
    $address = sanitize_input($_POST["address"]);
    $describe = sanitize_input($_POST["describe"]);

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO donor_requests (fullname, mobile_number, address, describe_request) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fullname, $mobileNumber, $address, $describe);

    // Execute SQL statement
    if ($stmt->execute()) {
        echo "Form submitted successfully.";
    } else {
        echo "Error submitting form.";
    }

    // Close statement
    $stmt->close();
}

// Function to sanitize input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Close connection
$conn->close();
?>
