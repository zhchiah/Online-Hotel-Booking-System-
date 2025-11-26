<?php include('admin_server.php') ?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
</head>
<body>
    <h1>Admin Login Page </h1>
    <form method="POST" action="">

        <label for="admin_id">Admin ID:</label>
        <input type="text" name="admin_id" required><br><br>

        <label for="admin_password">Password:</label>
        <input type="password" name="admin_password" required><br><br>

        <button type="submit" name="admin_login">Login</button>
    </form>
    
</body>
</html>