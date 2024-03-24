<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <h2 class="nav">Nav code</h2>
    </nav>
    <h3 class="small-title">Blood Donors list according to their Blood Groups</h3>
    <div class="container">
        <?php
        // Your PHP code to fetch donor information here

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

        // Check if blood group is requested
        if(isset($_GET['blood_group'])) {
            // Retrieve blood group from the request
            $bloodGroup = $_GET['blood_group'];

            // Query to select donors with the requested blood group from the donor_details table
            $sql = "SELECT * FROM donor_details WHERE donor_blood_type = '$bloodGroup'";
            
            // Execute the query
            $result = $conn->query($sql);

            // Check if there are any results
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    // Start donor information container with dynamic background color
                    echo '<div class="donor-info">';
                    
                    // Display donor name
                    echo '<div class="donor-name">' . $row["donor_first_name"] . ' ' . $row["donor_last_name"] . '</div>';
                    
                    // Start donor details container
                    echo '<div class="donor-details">';
                    
                    // Display mobile number
                    echo '<div class="donor-detail">Mobile Number: ' . $row["donor_mobile_number"] . '</div>';
                    
                    // Display age
                    echo '<div class="donor-detail">Age: ' . $row["donor_age"] . '</div>';
                    
                    // Display address
                    echo '<div class="donor-detail">Address: ' . $row["donor_address"] . '</div>';
                    
                    // Display blood type
                    echo '<div class="donor-detail">Blood Type: ' . $row["donor_blood_type"] . '</div>';
                    
                    // Display gender
                    echo '<div class="donor-detail">Gender: ' . $row["donor_gender"] . '</div>';
                    
                    // End donor details container
                    echo '</div>';
                    
                    // End donor information container
                    echo '</div>';
                }
            } else {
                // No donors found message
                echo '<div class="no-donors">No donors found for blood group: ' . $bloodGroup . '</div>';
            }
        } else {
            echo "Blood group not specified.";
        }

        $conn->close();
        ?>
    </div>

</body>
</html>
