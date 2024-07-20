<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="index.php?action=login" method="post">
        <input type="email" name="email" placeholder="Enter email" required>
        <input type="password" name="password" placeholder="Enter password" required>
        <button type="submit">Login</button>
    </form>
     <p>Don't have an account? <a href="index.php?action=signup">Register here</a></p>
</body>
</html>
