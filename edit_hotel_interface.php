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

// SQL query to select data where parent_id is NULL
$sql = "SELECT * FROM hotel_and_location WHERE parent_id IS NULL";

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

<?php include('edit_hotel.php') ?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Hotel</title>
</head>
<body>
    <h1>Edit Hotel</h1>
    <form method="POST" action="" enctype="multipart/form-data">
        <label for="hotel_name">Hotel Name:</label>
        <input type="text" name="hotel_name" value="<?php echo$hotelname ?>"required><br>

        <label for="hotel_picture">Hotel Picture:</label>
        <input type="file" name="hotel_picture"  required><br> 


       <label for="hotel_locationa">Select Location:</label>
        <select name="hotel_location">
            <?php
            foreach ($hotels as $hotel) {
                echo '<option value="' . $hotel["id"] . '">' . $hotel["name"] . '</option>';
            }
            ?>
        </select><br>

        <label for="hotel_description">Hotel Description:</label>
        <input type="text" name="hotel_description"value="<?php echo$hoteldescription ?>" required><br>


<!--         <label for="room_type">Room Type:</label>
        <select name="room_type">
            <option value="Single room">Single room</option>
            <option value="Double room">Double room</option>
            <option value="Family room">Family room</option>
        </select><br> -->

        <input type="submit"name="upload" value="Edit Hotel">
    </form>
    <button><a href="add_room_interface.php">Add Room</a></button>

    <table border='1'>
    <tr>
    <th>Room Name</th> 
    <th>Room Picture</th>
    <th>Room price</th> 
    <th>Room type</th>
    <th>Edit</th> 
    <th>Delete</th>
    </tr>
<?php
	// Database connection information
	$host = 'localhost';
	$username = 'root';
	$database = 'finalproject';

    $id = $_REQUEST['id'];
	// Connect to the database
	$conn = new mysqli($host, $username, "", $database);
	$result = mysqli_query($conn, "SELECT * FROM room WHERE hotel = $id");

	echo "<tr>";
    while($room = mysqli_fetch_array($result)){
	    $id = $room['id'];
        echo "<td><a>".$room['name']."</a></td>";
        echo "<td><img style='height:100px;width:150px;' src='images/".$room['picture']."'  ></td>";
        echo "<td><a>".$room['price']."</a></td>";
        echo "<td><a>".$room['type']."</a></td>" ;
        echo "<td><a href='edit_room_interface.php?id=$id'>Edit</a></td>";
        echo "<td><a href='delete_room.php?id=$id'>Delete</a></td>" ;
        echo "</tr>";
	  
  }

    
?>
</table>
</body>
</html>

