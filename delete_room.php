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

		$id = $_REQUEST['id'];

		mysqli_query($conn,"DELETE FROM room WHERE id = '$id'")or die (mysql_error());

		header('location: admin_hotellist.php');

?>