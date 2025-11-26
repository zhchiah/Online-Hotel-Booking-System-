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
<html>
    <head>
        <title>View Product</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
<body>
<?php if (isset($_SESSION['admin_success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['admin_success']; 
          	unset($_SESSION['admin_success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

	<div id="container" >
  <link href="CSS/style.css" rel="stylesheet">
<link href="CSS/addproduct.css" rel="stylesheet">
      <div id="sidebar" class="nav-collapse ">
        <ul class="sidebar-menu" id="nav-accordion">

          <li>
            <a href="userlist.php">
              <i class="fa fa-envelope"></i>
              <span>User List</span>
              </a>
          </li>

          <li>
            <a href="admin_hotellist.php">
              <i class="fa fa-envelope"></i>
              <span>View Hotel</span>
            </a>
          </li>

          <li>
            <a href="admin_login.php">
              <i class="fa fa-dashboard"></i>
              <span>Log Out</span>
              </a>
          </li>
  
        
        </ul>
      </div>
</div>
		<font size = 6px>
			<br>
			<h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hotel List</h1>
			<br>
 		</font>

<?php
	echo "<button><a  href='add_hotel_interface.php'>Add Hotel</a></button>";

	// Database connection information
	$host = 'localhost';
	$username = 'root';
	$database = 'finalproject';


	// Connect to the database
	$conn = new mysqli($host, $username, "", $database);
	$result = mysqli_query($conn, "SELECT * FROM hotel_and_location WHERE parent_id IS NOT NULL");

		echo "<div class='row'>";
  while($hotel = mysqli_fetch_array($result)){
	  $id = $hotel['id'];

	echo "<div class='col-3' style='margin-left:300px'>";

		echo "<div>";
	  echo "<a id='img_div' name='img'>";

		echo "<img style='height:300px;width:350px;' src='images/".$hotel['picture']."'  >";
	  echo "</div></a>";

	  echo "<div id='name'>";

		echo "<h2 >".$hotel['name']."</h2>";

	  echo "<div>";

		echo "<p >Description: ".$hotel['description']."</p>";
	
		echo"<a href='edit_hotel_interface.php?id=$id' style='font-size:20px;color:#3bdbff'>Edit";

	  echo"<a href='admin_deletehotel.php?id=$id'> &nbsp; <span class='glyphicon glyphicon-trash'></span></a>";
	  echo "</div><br></div></div>";  
	  
  }
?>
	
</body>
</html>