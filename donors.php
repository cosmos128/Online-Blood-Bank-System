<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donors Admin Panel</title>
    <link rel="stylesheet" href="./header.css">
    <link rel="stylesheet" href="./sidebar.css">
    <link rel="stylesheet" href="./table_display.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="grid-container">
        <?php include 'conn.php'; ?>
        <?php include 'session.php';
            $_SESSION['loggedin'] = true;
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { ?>
                <?php include 'header.php';?>
                <?php include 'sidebar.php'; ?>
                <main class="main-container">
                <div class="group">
                <div><p id="displayinfo">AVAILABLE DONORS</p></div>
                <div class="random"></div>
                </div>
                    <table style="width: 98%;">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Mobile</th>
                            <th>Blood group</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th colspan='2'>Action</th>
                        </tr>
                <?php $stmt = $pdo->prepare("SELECT * from donor_details;");
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $row = $stmt->rowCount();
                    $result = $stmt->fetchAll();
                if ($result){
                    foreach($result as $row){ ?>
                        <tr>
                        <td><?php echo $row['donor_first_name'].' '.$row['donor_last_name']?></td>
                        <td><?php echo $row['donor_email'] ?></td>
                        <td><?php echo $row['donor_address'] ?></td>
                        <td><?php echo $row['donor_mobile_number'] ?></td>
                        <td><?php echo $row['donor_blood_type'] ?></td>
                        <td><?php echo $row['donor_age'] ?></td>
                        <td><?php echo $row['donor_gender'] ?></td>
                        <td><a href="#" onclick="clickme(<?php echo $row['donor_id']; ?>)"><b>DELETE</b></a><br></td>
                        <td><a href="./edit_donors.php?id=<?php echo $row['donor_id'];?>"> <b id="demo">EDIT</b></a><br></td>
            <?php }
                }
            } else { 
            ?> <h1>madarchod </h1> <?php } ?>
            </table>
        </main>
    </div>
    <script>
        function clickme(donor_id) {
            if(confirm("Do you want to remove donor?")) {
                window.location.href = "./delete_donor.php?id=" + donor_id;
            }
        }
    </script>
</body>
</html>