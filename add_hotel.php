<?php
$host = 'localhost';
$username = 'root';
$database = 'finalproject';

$conn = new mysqli($host, $username, "", $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hotelName = $_POST['hotel_name'];
    $hotelLocation = $_POST['hotel_location'];
    $hoteldescription = $_POST['hotel_description'];



    //Insert image
    $image = $_FILES['hotel_picture']['name'];
    $target_dir = "upload/";
    $target = "images/".basename($image);


    if (move_uploaded_file($_FILES['hotel_picture']['name'], $target_dir.$image)) 
    {
        $msg = "Image uploaded successfully";
    }

    else
    {
        $msg = "Failed to upload image";
    }



    $sql = "INSERT INTO hotel_and_location (name, parent_id , picture ,  description) VALUES (?, ?, ?,?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssss", $hotelName, $hotelLocation, $image, $hoteldescription);
        if ($stmt->execute()) {
            echo "Hotel added successfully.";
        } else {
            echo "Error adding hotel: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} 


$conn->close();
?>

