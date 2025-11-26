<!DOCTYPE html>
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
	<title>User List</title>
</head>

<body>
	<div id="container" >
  <link href="CSS/style.css" rel="stylesheet">
<link href="CSS/addproduct.css" rel="stylesheet">
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
		<font size = 6px>
			<br>
			<h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;User List</h1>
			<br>
 		</font>



<?php
$host = 'localhost'; 
$username = 'root'; 
$database = 'finalproject'; 

// Connect to the database
$conn = new mysqli($host, $username,"", $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

		
	$result = mysqli_query($conn, "SELECT * FROM user");
		if(mysqli_num_rows($result) <= 0)
		{
			echo '<h1> No result found! </h1>';
	
		}

		else 
		{
		echo"<div>";
		echo"<table border=1 class=table-right >";
		echo"<th>UserID</th>";
		echo"<th>Username</th>";
		echo"<th>Email</th>";
		echo"<th>Password</th>";
		echo"<th>Edit Function</th>";
		echo"<th>Delete Function</th>";
		echo "</div>";
		}

		while($user = mysqli_fetch_array($result))
		{
		$id = $user['id'];
		echo"<tr align='center'>";
		echo"<td><font color='black'>".$user['id']."</font></td>";
		echo"<td><font color='black'>".$user['name']."</font></td>";
		echo"<td><font color='black'>".$user['email']."</font></td>";
		echo"<td><font color='black'>".$user['password']."</font></td>";

		echo"<td><a href='admin_edituser.php?id=$id'>Edit</a>";
		echo"<td><a href='admin_deleteuser.php?id=$id'><center>Delete</center></a>";
		echo"</tr>";
		}


	echo "<p>";
      echo "<a href=\"admin_login.php\" style='color:red;'>Admin Log Out</a>";
    echo "</p>";
	

?>

</body>
</html>