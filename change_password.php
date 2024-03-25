<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="./login.css">
</head>

<body>

    <div class="maincontainer">
        <div class="leftcontainer">
            <!-- <img src="./raktadaan-logo.png"> -->
        </div>
        <div class="rightcontainer">
            <div class="logo">
                <!-- <img src="./backgn.png"> -->
            </div>
            <div class="form">
                <h1>Change Password</h1>

                <form id="myForm" action="">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" placeholder="Enter your username">
                        <span class="error" id="usernameError"></span>
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" placeholder="Enter your Password">
                        <span class="error" id="passwordError"></span>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirm Password:</label>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                        <span class="error" id="passwordError"></span>
                    </div>

                    <div class="submit">
                        <button type="submit" id="submitButton">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("myForm").addEventListener("submit", function (event) {
            event.preventDefault(); // Prevents the default form submission behavior

            // Call your validation function here
            validateForm();
        });
        function validateForm() {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            var usernameError = document.getElementById("usernameError");
            var passwordError = document.getElementById("passwordError");
            var isValid = true;

            // Reset error messages
            usernameError.innerHTML = "";
            passwordError.innerHTML = "";

            // Regular expressions for validation
            var usernameRegex = /^[a-zA-Z0-9_-]{3,16}$/; // Alphanumeric, underscores, and hyphens allowed, 3-16 characters
            var passwordRegex = /^.{6,}$/; // Minimum 6 characters

            // Validation for username
            if (!usernameRegex.test(username)) {
                usernameError.innerHTML = "Username must be alphanumeric and 3-16 characters long";
                isValid = false;
            }

            // Validation for password
            if (!passwordRegex.test(password)) {
                passwordError.innerHTML = "Password must be at least 6 characters long";
                isValid = false;
            }

            return isValid;
        }
    </script>

</body>

</html>