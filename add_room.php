<?php
$host = 'localhost';
$username = 'root';
$database = 'finalproject';

$conn = new mysqli($host, $username, "", $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roomName = $_POST['room_name'];
    $roomprice = $_POST['room_price'];
    $roomtype = $_POST['room_type'];
    $hotelName = $_POST['hotel_name'];


    //Insert image
    $image = $_FILES['room_picture']['name'];
    $target_dir = "upload/";
    $target = "images/".basename($image);


    if (move_uploaded_file($_FILES['room_picture']['name'], $target_dir.$image)) 
    {
        $msg = "Image uploaded successfully";
    }

    else
    {
        $msg = "Failed to upload image";
    }


    $sql = "INSERT INTO room (name,  picture , price , type  , hotel) VALUES (?, ?, ?,? , ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssdss", $roomName, $image, $roomprice, $roomtype , $hotelName);
        if ($stmt->execute()) {
            echo "Hotel added successfully.";
            header('location: admin_hotellist.php');
        } else {
            echo "Error adding hotel: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    echo "Invalid file type. Allowed file types: PNG, JPEG, JPG.";
}


$conn->close();
?>

