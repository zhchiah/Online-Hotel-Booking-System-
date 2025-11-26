<?php
$host = 'localhost';
$username = 'root';
$database = 'finalproject';

$conn = new mysqli($host, $username, "", $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

	$id = $_REQUEST['id'];
	
	$result = mysqli_query($conn,"SELECT * FROM room WHERE id LIKE '$id'");
	$room = mysqli_fetch_array($result);

	if (!$result)
	{
		die("Error : Data not found...");
	}
		$roomname = $room['name'];
		$roompicture = $room['picture'];
		$roomtype = $room['type'];
		$roomprice = $room['price'];
	

	//edit room
	if (isset($_POST['upload'])) {
  	// Get image name
  	$picture_changed = $_FILES['room_picture']['name'];
	$target_dir = "upload/";

  	
  	// Get text
	$roomname_changed = mysqli_real_escape_string($conn, $_POST['room_name']);
	$roomtype_changed = mysqli_real_escape_string($conn, $_POST['room_type']);
	$roomprice_changed = mysqli_real_escape_string($conn, $_POST['room_price']);

  	// image file directory
  	$target = "images/".basename($picture_changed);

  	mysqli_query($conn,"UPDATE room SET name = '$roomname_changed', picture ='$picture_changed ' , type= '$roomtype_changed', price = '$roomprice_changed ' WHERE id = '$id'") or die(mysql_error());
	
	echo "<script>alert('Saved')</script>";

	header('location: admin_hotellist.php');


  	if (move_uploaded_file($_FILES['picture']['name'], $target_dir.$picture_changed)) {
  		$msg = "Picture uploaded successfully";
  	}
  	else{
  		$msg = "Failed to upload image";
  	}
  }


?>







