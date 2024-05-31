<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="./header.css">
    <link rel="stylesheet" href="./sidebar.css">
    <link rel="stylesheet" href="./table_display.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</head>
<body>

    <div class="grid-container">
    <?php
        include 'conn.php';
        include 'session.php';
        // $_SESSION['loggedin'] = true;
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

            include 'header.php';
            include 'sidebar.php';
    ?>
            

            <main class="main-container">

            <div class="group">
                <div><p id="displayinfo">CONTACT QUERIES</p></div>
                <div class="random"></div>
            </div>

            <table style="width: 98%;">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date/Time</th>
                    <th>Query_Status</th>
                </tr>

                <?php

                    $stmt = $pdo->prepare("SELECT * from contact_query;");
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $row = $stmt->rowCount();
                    $result = $stmt->fetchAll();

                    if ($result){
                        foreach($result as $row){
                ?>
                        <tr>
                        <td><?php echo $row['query_Name']?></td>
                        <td><?php echo $row['query_Email'] ?></td>
                        <td><?php echo $row['query_Message'] ?></td>
                        <td><?php echo $row['query_date'] ?></td>
                        <?php if ($row['query_status'] == 0) { ?>
                                <td>READ</td>
                        <?php } else { ?>
                                <td><a href="index.php?id=<?php echo $row['query_id'];?>" onclick="clickme()"><b id="demo">PENDING</b></a><br>
                        </td>
                        <?php } ?>
                        </tr>
              <?php }

        }
        ?>
            </table>
            <script>
                function clickme(){
                    if(confirm("Do you really Want to Read ?"))
                    {
                        document.getElementById("demo").innerHTML = "Read";
                        <?php
                        $que_id = $_GET['id'];
                        $stmt = $pdo->prepare("UPDATE contact_query set query_status= 0 where  query_id={$que_id};");
                        $stmt->execute();
                        ?>
                    }
                }
            </script>

        </div>
        </main>
<?php  } else { 
        ?> <h1>madarchod </h1> <?php } ?>
</body>
</html>

