<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=>, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>

    <div class="grid-container">
    <?php
        
        include 'conn.php';
        include 'session.php';
        $_SESSION['loggedin'] = true;
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    
        include 'header.php';
        include 'sidebar.php'; ?>

        <main class="main-container">
            <div class="group">
                <div class="dasbrd"><p id="displaydash">DASHBOARD</p></div>
                <div id="dateTimeBlock"></div>
                <div class="random"></div>
            </div>
            <?php
            $stmt = $pdo->prepare("SELECT * from donor_list;");
            $stmt->execute();
            $row = $stmt->rowCount();
            ?>
            <div class="dashboard-info1">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h4 class="card-title">Donors available</h>
                        <h6 class="card-subtitle"> <?php echo $row;?></h6>
                        <button class="card-link" onclick = redirect_donors()>More details</button>
        
                    </div>
                </div>
                <?php
                    $stmt = $pdo->prepare("SELECT * from contact_query;");
                    $stmt->execute();
                    $row = $stmt->rowCount();
                ?>
                <div class="card" style="width: 18rem; ">
                    <div class="card-body">
                        <h4 class="card-title">Contact queries</h5>
                        <h6 class="card-subtitle"><?php echo $row;?></h6>
                        <button class="card-link" onclick = redirect_queries()>More details</button>
                    </div>
                </div>
                <?php
                    $stmt = $pdo->prepare("SELECT * from contact_query where query_status=1;");
                    $stmt->execute();
                    $row = $stmt->rowCount();
                ?>
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h4 class="card-title">Pending queries</h5>
                        <h6 class="card-subtitle"><?php echo $row?></h6>
                        <button class="card-link" onclick = redirect_pending()>More details</button>
                    </div>
                </div>
            </div>
            <?php
                    // $stmt = $pdo->prepare("SELECT * from edit_request where query_status=1;");
                    // $stmt->execute();
                    // $row = $stmt->rowCount();
                    $row=0;
                ?>
            <div class="dashboard-info2">
                <div class="card" style="width: 18rem;">
                        <div class="card-body">
                        <h4 class="card-title">Edit Requests</h5>
                        <h6 class="card-subtitle"><?php echo $row;?></h6>
                        <button class="card-link" onclick = redirect_edit()>More details</button>
                    </div>
                </div>
            </div>
            
            <?php } else { ?> <h1>madarchod</h1> <?php } ?>
        </main>
    </div>

    <script>
        
        function showProfileOptions() {
            document.getElementById("profileOptions").style.display = "block";
        }

        function hideProfileOptions() {
            document.getElementById("profileOptions").style.display = "none";
        }

        function toggleProfileOptions() {
            var options = document.getElementById("profileOptions");
            options.style.display = options.style.display === "none" ? "block" : "none";
        }

        function changePassword() {
            if (confirm("Are you sure to change your password ? ")) {
                window.location.href = './change_password.php';
            }
        }

        function logout() {
            <?php 
            $_SESSION['loggedin'] = false;
            session_destroy();
            ?>
            if (confirm("Are you sure to logout ? ")) {
                window.location.href = './login.php';
            }
        
        }

        function updateDateTime() {
            var dateTimeBlock = document.getElementById("dateTimeBlock");
            var currentDate = new Date();

            var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric'};

            dateTimeBlock.textContent = currentDate.toLocaleDateString('en-US', options);
        }
        function redirect_donors() {
            window.location.href = './.php';
        }
        function redirect_queries() {
            window.location.href = './contact.php';
        }
        function redirect_pending() {
            window.location.href = '/test/pending_queries_test/index.php';
        }
        function redirect_edit() {
            window.location.href = '/test/available_donors_test/index.php';
        }

        
        // Update every second
        setInterval(updateDateTime, 1000);

        // Initial update
        updateDateTime();

    </script>


</body>
</html>