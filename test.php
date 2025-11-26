<?php
	// Database connection information
	$host = 'localhost';
	$username = 'root';
	$database = 'finalproject';

$id=16;
	// Connect to the database
	$conn = new mysqli($host, $username, "", $database);
	$result = mysqli_query($conn, "SELECT * FROM room WHERE hotel = $id");

		echo "<div class='row'>";
  while($room = mysqli_fetch_array($result)){
	  $id = $room['id'];

	echo "<div class='col-3' style='margin-left:300px'>";
	echo "<div>";
	echo "<a id='img_div' name='img'>";
	echo "<img style='height:300px;width:350px;' src='images/".$room['picture']."'  >";
	echo "</div></a>";
	echo "<div id='name'>";
	echo "<h2 >".$room['name']."</h2>";
	echo "<div>";
	echo "<p >Description: ".$room['description']."</p>";
	echo"<a href='edit_hotel_interface.php?id=$id' style='font-size:20px;color:#3bdbff'>Edit";
	echo"<a href='admin_deletehotel.php?id=$id'> &nbsp; <span class='glyphicon glyphicon-trash'></span></a>";
	echo "</div><br></div></div>";  
	  
  }
?>