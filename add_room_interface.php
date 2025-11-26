<?php 
  session_start(); 

  if (!isset($_SESSION['admin_username']  )) {
    $_SESSION['msg'] = "You must log in first";
 header("location:admin_login.php");

  }

  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['admin_username'] );
  header("location:admin_login.php");
  }

?>
<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'finalproject';

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select child hotels (where parent_id is not NULL)
$sql = "SELECT * FROM hotel_and_location WHERE parent_id IS NOT NULL";

$result = $conn->query($sql);

// Initialize an empty array to store the hotel data
$hotels = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $hotels[] = $row;
    }
}

// Close the database connection
$conn->close();
?>




<?php include('add_room.php') ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Room</title>
</head>
<body>
    <h1>Add Room</h1>
    <form method="POST" action="" enctype="multipart/form-data">
        <label for="room_name">Room Name:</label>
        <input type="text" name="room_name" required><br>

        <label for="room_picture">Room Picture:</label>
        <input type="file" name="room_picture" required><br> 


       <label for="hotel_name">Select Hotel:</label>
        <select name="hotel_name">
            <?php
            foreach ($hotels as $hotel) {
                echo '<option value="' . $hotel["id"] . '">' . $hotel["name"] . '</option>';
            }
            ?>

        </select><br>


        <label for="room_type">Room Type:</label>
        <select name="room_type">
            <option value="Single room">Single room</option>
            <option value="Double room">Double room</option>
            <option value="Family room">Family room</option>
        </select><br> 

        <label for="room_price">Room Price:</label>
        <input type="text" name="room_price" required><br> 


        <input type="submit" value="Add Room">
    </form>
</body>
</html>




