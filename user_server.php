<?php
session_start();

// Database connection information
$host = 'localhost';
$username = 'root';
$database = 'finalproject';


// Connect to the database
$conn = new mysqli($host, $username, "", $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// USER REGISTRATION
if (isset($_POST['user_register'])) {
    $name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $pass = mysqli_real_escape_string($conn, $_POST['user_password']);
    $email = mysqli_real_escape_string($conn, $_POST['user_email']);

    // Check if the user already exists
    $check_query = "SELECT * FROM user WHERE name='$name' OR email='$email'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) 
    {
        echo "<script> alert('User already exists with this username or email');window.location='user_register.php' </script>";
    } 

    else 
    {
        // Insert the new user into the database
        $insert_query = "INSERT INTO user (name, password, email) VALUES ('$name', '$pass', '$email')";
        if (mysqli_query($conn, $insert_query)) {
            $_SESSION['user_id'] = $name;
            $_SESSION['user_success'] = "";
            header('location: user_login.php'); // Redirect to user dashboard
        } 

        else 
        {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

// USER LOGIN
if (isset($_POST['user_login'])) {
    $name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $pass = mysqli_real_escape_string($conn, $_POST['user_password']);
    $email = mysqli_real_escape_string($conn, $_POST['user_email']);

    $user_query = "SELECT * FROM user WHERE name='$name' AND password='$pass' AND email='$email'";
    $user_results = mysqli_query($conn, $user_query);

    if (mysqli_num_rows($user_results) == 1) 
    {
        $_SESSION['user_id'] = $name;
        $_SESSION['user_success'] = "";
        header('location: front/home.php'); // Redirect to user dashboard
    } 
    else 
    {
        echo "<script> alert('Username, Password, or Email is wrong');window.location='user_login.php' </script>";
    }
}

?>
