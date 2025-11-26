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

	$result = mysqli_query($conn,"SELECT * FROM user WHERE id LIKE '$id'");
	$user = mysqli_fetch_array($result);

	if (!$result)
	{
		die("Error : Data not found...");
	}
		$username = $user['name'];
		$email = $user['email'];
		$password = $user['password'];
	
	if(isset($_POST['save'])){
		$username_changed = $_POST['name'];
		$email_changed = $_POST['email'];
		$password_changed = $_POST['pwd'];
		

		mysqli_query($conn,"UPDATE user SET name = '$username_changed', email = '$email_changed', password = '$password_changed' WHERE id = '$id'") or die(mysql_error());

			echo "<script>alert('Saved!')</script>";

			header('location: userlist.php');
	}
	mysqli_close($conn);
?>

<!DOCTYPE html>
<head>
	<title>Edit User </title>
</head>
<body>
 <div id="sidebar" class="nav-collapse ">
        <ul class="sidebar-menu" id="nav-accordion">


          <li>
            <a class="active" href="userlist.php">
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

<body>

	 <div id="edit" style="font-size:20px ">
			<h1>Update User Info</h1>
			<form method="post">
	 </div>	
	 <br>
	 
	 <div>	
			<tr>
				<td>Username :</td>
				<td><input type="text" name="name" value="<?php echo $username?>"/></td>
			</tr>
			<br>
			<tr>
				<td>Email :</td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td><input type="text" name="email" value="<?php echo $email?>"/></td>
			</tr>
			<br>
			<tr>
				<td>Password :&nbsp;</td>
				<td><input type="text" name="pwd" value="<?php echo $password?>"/></td>
			</tr>
	</div>		
		<br>

		<div id="save">
		  <p class="p-container">
            <button type="submit" style="width:15%" class="btn btn-danger btn-theme1" name="save">Update</button>
          </p>
        </div>
	  </div>
	</form>

</body>
</html>