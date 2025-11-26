<?php include('user_server.php') ?>
<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
</head>
<body>
    <h1>User Login</h1>
    <form method="POST" action="">
        <label for="user_name">User Name:</label>
        <input type="text" name="user_name" required><br><br>

        <label for="user_password">Password:</label>
        <input type="password" name="user_password" required><br><br>

        <label for="user_email">Email:</label>
        <input type="email" name="user_email" required><br><br>

        <button type="submit" name="user_login">Login</button>

        <p>Don't have an account? <a href="user_register.php">Register</a></p>
    </form>
</body>
</html>