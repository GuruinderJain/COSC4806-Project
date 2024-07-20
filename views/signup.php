<!DOCTYPE html>
<html>
<head>
    <title>Sign up</title>
</head>
<body>
    <h1>Register</h1>
    <form action="index.php?action=signup" method="post" onsubmit="return validatePasswords()">
        <input type="email" name="email" placeholder="Enter email" required>
        <input type="password" id="password" name="password" placeholder="Enter password" required>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm password" required>
        <button type="submit">Register</button>
    </form>
    <script>
        function validatePasswords() {
            var password = document.getElementById("password").value;
            var confirm_password = document.getElementById("confirm_password").value;
            if (password !== confirm_password) {
                alert("Passwords do not match.");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
