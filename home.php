<!DOCTYPE html>

<?php 
  session_start(); 

  if (!isset($_SESSION['user_id']  )) {
    $_SESSION['msg'] = "You must log in first";
  header("location: /CapstoneProject/user_login.php");

  }

  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user_id'] );
  header("location: /CapstoneProject/user_login.php");
  }

?>

<html>
<head>
    <title>Hotel Booking</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <style>
        .main-container {
            background-image: url('images/2237792.jpg');
            background-size: cover;
            padding: 250px;
            background-repeat: no-repeat;
            position: relative;
        }

        .overlay {
            background-color: rgba(0, 0, 0, 0.15); /* Background color with opacity */
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .text-container {
            position: relative;
            text-align: center;
            z-index: 1;
            color: #fff; /* Text color */
            text-decoration:none
        }

         .secondtext-container {
            position: relative;
            text-align: left;
            z-index: 1;
            color: #000; /* Text color */
            margin : 20px 0px 0px 20px ;
            text-decoration:none
        }


        .location-button {
            margin: 10px;
        }

        .button-container-kl {
            background-image: url('images/kl.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            text-align: center;
            margin-top: 30px;
            background-color: rgba(0, 0, 0, 0.1); /* Background color with opacity */
            border-radius: 10px;
            padding:50px;
        }

        .button-container-ipoh {
            background-image: url('images/ipoh.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            text-align: center;
            margin-top: 30px;
            background-color: rgba(0, 0, 0, 0.1); /* Background color with opacity */
            border-radius: 10px;
            padding:50px;
        }

        .button-container-penang {
            background-image: url('images/penang.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            text-align: center;
            margin-top: 30px;
            background-color: rgba(0, 0, 0, 0.1); /* Background color with opacity */
            border-radius: 10px;
            padding:50px;
        }

        .footer-container {
            background-repeat: no-repeat;
            margin-top: 30px;
            text-align: center;
            background-color: rgba(0, 0, 0, 0.1); /* Background color with opacity */
            padding:50px;
            width: 100%;
            height: 100%;
        }
/* Dropbox */
        .dropbtn {
        background-color: #ffffff;
        color: black;
        font-size: 18px;
        padding: 0px 12px;
        border: none;
        radius:5px;
        cursor: pointer;
        }

        .dropdown {
        position: relative;
        display: inline-block;
        }

        .dropdown-content {
        display: none;
        position: absolute;
        right: 0;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        }

        .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1;}
.dropdown:hover .dropdown-content {display: block;}
.dropdown:hover .dropbtn {background-color: #E3E3E3; border-radius: 25px;}

    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand px-3 mb-0 h1" href="home.php" style="font-style: italic;"><img src="images/logo.png"/></a>
            <div class="dropdown">
                <button class="dropbtn"><?php echo $_SESSION['user_id'] ?></button>
                    <div class="dropdown-content">
                    <?php
                    $host = 'localhost';
                    $username = 'root';
                    $database = 'finalproject';

                    $user = $_SESSION['user_id'];
                    
                    $conn = new mysqli($host, $username, "", $database);
                    
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $result = mysqli_query($conn,"SELECT * FROM user WHERE name LIKE '$user'");
                    $user = mysqli_fetch_array($result);
   
                    if (!$result)
                    {
                    die("Error : Data not found...");
                    }
                    // $userid = $user['id'];

                    echo "<a href='history.php?order_id=". $user['id'] ."'>Booking History</a>";

                    $conn->close();
                    ?>
                        <a href="home.php?logout='1'">LOGOUT</a>
                    </div>
            </div>
        </nav>
    </header>

    <!-- Main container for the content and background image -->
    <div class="main-container">
        <div class="overlay"></div>
        <div class="text-container">
            <p class="animated fadeInUp" style="font-size:40px">WELCOME TO</p>
            <h1 class="animated fadeInUp" style="font-size:80px">Travelry</h1>
            <p class="animated fadeInUp" style="font-size:50px">Plan your journey with us !</p>
        </div>
    </div>

    <!-- Container for the three buttons -->
    
    <div class="secondtext-container">
        <p class="animated fadeInLeft" style="font-size:40px;font-style: italic;">Explore popular destinations around</p>

    </div>

    <div class="container button-container-kl">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <a class="text-container h1" href="hotel.php?hotel_id=1" >Kuala Lumpur</a>
            </div>
        </div>
    </div>

    <div class="container button-container-ipoh">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <a class="text-container h1" href="hotel.php?hotel_id=2">Ipoh</a>
            </div>
        </div>
    </div>

    <div class="container button-container-penang">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <a class="text-container h1" href="hotel.php?hotel_id=3" >Penang</a>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-container">
            <a>@Capstone Project_CHIAH ZI HONG</a>
        </div>
    </footer>
    
    <!-- Include Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
