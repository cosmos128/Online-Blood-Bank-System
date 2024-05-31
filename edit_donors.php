<?php
include 'conn.php';

$message = '';

if(isset($_GET['id'])) {
    $donor_id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM donor_details WHERE donor_id = :donor_id");
    $stmt->execute(['donor_id' => $donor_id]);
    $donor = $stmt->fetch(PDO::FETCH_ASSOC);

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve updated information from the form
        $updated_first_name = $_POST['donor_first_name'];
        $updated_last_name = $_POST['donor_last_name'];
        $updated_email = $_POST['donor_email'];
        $updated_address = $_POST['donor_address'];
        $updated_mobile = $_POST['donor_mobile_number'];
        $updated_blood_type = $_POST['donor_blood_type'];
        $updated_age = $_POST['donor_age'];
        $updated_gender = $_POST['donor_gender'];

        // Check for changes
        $changes = [];
        if ($updated_first_name !== $donor['donor_first_name']) {
            $changes[] = "First Name: {$donor['donor_first_name']} → $updated_first_name";
        }
        if ($updated_last_name !== $donor['donor_last_name']) {
            $changes[] = "Last Name: {$donor['donor_last_name']} → $updated_last_name";
        }
        if ($updated_email !== $donor['donor_email']) {
            $changes[] = "Email: {$donor['donor_email']} → $updated_email";
        }
        if ($updated_address !== $donor['donor_address']) {
            $changes[] = "Address: {$donor['donor_address']} → $updated_address";
        }
        if ($updated_mobile !== $donor['donor_mobile_number']) {
            $changes[] = "Mobile: {$donor['donor_mobile_number']} → $updated_mobile";
        }
        if ($updated_blood_type !== $donor['donor_blood_type']) {
            $changes[] = "Blood Group: {$donor['donor_blood_type']} → $updated_blood_type";
        }
        if ($updated_age !== $donor['donor_age']) {
            $changes[] = "Age: {$donor['donor_age']} → $updated_age";
        }
        if ($updated_gender !== $donor['donor_gender']) {
            $changes[] = "Gender: {$donor['donor_gender']} → $updated_gender";
        }

        // Update donor details if changes exist
        if (!empty($changes)) {
            // Update donor details in the database
            $stmt = $pdo->prepare("UPDATE donor_details SET donor_first_name = :first_name, donor_last_name = :last_name, donor_email = :email, donor_address = :address, donor_mobile_number = :mobile, donor_blood_type = :blood_type, donor_age = :age, donor_gender = :gender WHERE donor_id = :donor_id");

            // Bind parameters
            $stmt->bindParam(':first_name', $updated_first_name);
            $stmt->bindParam(':last_name', $updated_last_name);
            $stmt->bindParam(':email', $updated_email);
            $stmt->bindParam(':address', $updated_address);
            $stmt->bindParam(':mobile', $updated_mobile);
            $stmt->bindParam(':blood_type', $updated_blood_type);
            $stmt->bindParam(':age', $updated_age);
            $stmt->bindParam(':gender', $updated_gender);
            $stmt->bindParam(':donor_id', $donor_id);

            // Execute the query
            if ($stmt->execute()) {
                // Set success message
                $message = 'Changes made:<br>' . implode('<br>', $changes);
            } else {
                // Set error message
                $message = 'Error updating donor details.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Donor</title>
    <link rel="stylesheet" href="edit_donors.css">
    <script src="edit_donors.js"></script>
    <style>
        #edit-form {
            display: <?php echo (!empty($message)) ? 'none' : 'block'; ?>;
        }
    </style>
</head>
<nav>
    <h1>
        NAV Code
    </h1>
</nav>
<body>
    <h1>Edit Donor</h1>
    <?php if (!empty($message)) : ?>
        <div id="success-message">
            <p><?php echo $message; ?></p>
            <button id="ok-button">OK</button>
        </div>
    <?php endif; ?>

    <form id="edit-form" method="post">
        <label for="donor_first_name">First Name:</label>
        <input type="text" id="donor_first_name" name="donor_first_name" value="<?php echo $donor['donor_first_name']; ?>"><br>
        <label for="donor_last_name">Last Name:</label>
        <input type="text" id="donor_last_name" name="donor_last_name" value="<?php echo $donor['donor_last_name']; ?>"><br>
        <label for="donor_email">Email:</label>
        <input type="email" id="donor_email" name="donor_email" value="<?php echo $donor['donor_email']; ?>"><br>
        <label for="donor_address">Address:</label>
        <input type="text" id="donor_address" name="donor_address" value="<?php echo $donor['donor_address']; ?>"><br>
        <label for="donor_mobile_number">Mobile:</label>
        <input type="tel" id="donor_mobile_number" name="donor_mobile_number" value="<?php echo $donor['donor_mobile_number']; ?>"><br>
        <label for="donor_blood_type">Blood Group:</label>
        <input type="text" id="donor_blood_type" name="donor_blood_type" value="<?php echo $donor['donor_blood_type']; ?>"><br>
        <label for="donor_age">Age:</label>
        <input type="number" id="donor_age" name="donor_age" value="<?php echo $donor['donor_age']; ?>"><br>
        <label for="donor_gender">Gender:</label>
        <input type="text" id="donor_gender" name="donor_gender" value="<?php echo $donor['donor_gender']; ?>"><br>
        <button type="submit">Update</button>
    </form>

    <script>
        // Add event listener to the OK button to redirect to donors.php
        document.getElementById("ok-button").addEventListener("click", function() {
            window.location.href = "donors.php";
        });
    </script>
</body>
</html>
