<?php
// delete_donor.php

include 'conn.php'; 

if(isset($_GET['id'])) {
    $d_id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM donor_details WHERE donor_id = :donor_id");
    $stmt->execute(['donor_id' => $d_id]);
}

// Redirect back to the main page or any other desired page
header("Location: donors.php");
exit();
?>
