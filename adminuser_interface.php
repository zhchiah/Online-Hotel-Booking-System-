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
<head>
	<title>Edit User </title>
</head>
<body>
 <div id="sidebar" class="nav-collapse ">
        <ul class="sidebar-menu" id="nav-accordion">
          <li class="mt">
            <a  href="adminlist.php">
              <i class="fa fa-desktop"></i>
              <span>Admin List</span>
              </a>
          </li>
          <li>
            <a class="active" href="userlist.php">
              <i class="fa fa-envelope"></i>
              <span>User List</span>
              </a>
          </li>
          <li>
            <a href="productlist.php">
              <i class="fa fa-envelope"></i>
              <span>View Product</span>
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
<body style="background-color: #1b1b1b">
	 <div id="edit" style="font-size:20px ">
			<h1>Update User Info</h1>
			<form method="post">
	 </div>	
	 <br>
	 <div style="color: white; font-size: 35px " class="form fontstyle">	
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