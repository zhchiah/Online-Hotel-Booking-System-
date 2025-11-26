<?php
session_start();

// Database connection information
$host = 'localhost'; 
$username = 'root'; 
$database = 'finalproject'; 

// Connect to the database
$conn = new mysqli($host, $username,"", $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// LOGIN ADMIN
if (isset($_POST['admin_login'])) 
{
  
    $id = mysqli_real_escape_string($conn, $_POST['admin_id']);
    $pass = mysqli_real_escape_string($conn, $_POST['admin_password']);

    $admin_query = "SELECT * FROM admin WHERE id='$id' AND password='$pass'";
    $admin_results = mysqli_query($conn, $admin_query);

    

    if (mysqli_num_rows($admin_results) == 1)
     {
      $_SESSION['admin_username'] = $id;
      $_SESSION['admin_success'] = "";
      header('location: userlist.php');
    }

    else 
    {
      echo "<script> alert('Username or Password is wrong');window.location='admin_login.php' </script>";
    }
  
}

?>