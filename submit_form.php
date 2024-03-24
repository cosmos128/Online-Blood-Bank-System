<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establishing a database connection
    $servername = "localhost"; // Change this to your database server name
    $username = "root"; // Change this to your database username
    $password = ""; // Change this to your database password
    $dbname = "online_blood_bank"; // Change this to your database name

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Checking the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieving form data
    $fullName = $_POST["fullName"];
    $mobileNumber = $_POST["mobileNumber"];
    $age = $_POST["age"];
    $address = $_POST["address"];
    $bloodType = $_POST["bloodType"];
    $gender = $_POST["gender"];

    // Inserting data into the database table
    $sql = "INSERT INTO blood_requests (fullName, mobileNumber, age, address, bloodType, gender)
    VALUES ('$fullName', '$mobileNumber', '$age', '$address', '$bloodType', '$gender')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to donor.php with the blood group parameter
        header("Location: donor.php?blood_group=$bloodType");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    header("Location: index.html");
    exit;
}
?>
