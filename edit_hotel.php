<?php
$host = 'localhost';
$username = 'root';
$database = 'finalproject';

$conn = new mysqli($host, $username, "", $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

	$id = $_REQUEST['id'];
	
	$result = mysqli_query($conn,"SELECT * FROM hotel_and_location WHERE id LIKE '$id'");
	$hotel = mysqli_fetch_array($result);

	if (!$result)
	{
		die("Error : Data not found...");
	}
		$hotelname = $hotel['name'];
		$hotelpicture = $hotel['picture'];
		$hoteldescription = $hotel['description'];
		$hotellocation = $hotel['parent_id'];
	

	//edit hotel
	if (isset($_POST['upload'])) {
  	// Get image name
  	$picture_changed = $_FILES['hotel_picture']['name'];
	$target_dir = "upload/";

  	// Get text
	$hotelname_changed = mysqli_real_escape_string($conn, $_POST['hotel_name']);
	$description_changed = mysqli_real_escape_string($conn, $_POST['hotel_description']);
	$location_changed = mysqli_real_escape_string($conn, $_POST['hotel_location']);

  	// image file directory
  	$target = "images/".basename($picture_changed);

  	mysqli_query($conn,"UPDATE hotel_and_location SET name = '$hotelname_changed', parent_id='$location_changed ' , picture = '$picture_changed', description = '$description_changed' WHERE id = '$id'") or die(mysql_error());
	
	echo "<script>alert('Saved')</script>";

	header('location: admin_hotellist.php');


  	if (move_uploaded_file($_FILES['picture']['name'], $target_dir.$picture_changed)) {
  		$msg = "Picture uploaded successfully";
  	}
  	else{
  		$msg = "Failed to upload image";
  	}
  }

	// $room_result = mysqli_query($conn,"SELECT * FROM room WHERE hotel LIKE '$id'");
	// $room = mysqli_fetch_array($room_result);

	// if (!$room_result)
	// {
	// 	die("Error : Data not found...");
	// }
	// 	$roomname = $room['name'];
	// 	$roompicture = $room['picture'];
	// 	$roomdprice = $room['price'];
	// 	$roomtype = $room['type'];

?>







