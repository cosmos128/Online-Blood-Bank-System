<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online_blood_bank";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobileNumber = mysqli_real_escape_string($conn, $_POST['mobileNumber']);
    $address = mysqli_real_escape_string($conn, $_POST['Address']);
    $bloodType = mysqli_real_escape_string($conn, $_POST['Blood-type']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);

    // SQL query to insert data into the database
    $sql = "INSERT INTO donor_details (donor_first_name, donor_last_name, donor_gender, donor_email, donor_mobile_number, donor_address, donor_blood_type, donor_age)
            VALUES ('$firstName', '$lastName', '$gender', '$email', '$mobileNumber', '$address', '$bloodType', '$age')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
