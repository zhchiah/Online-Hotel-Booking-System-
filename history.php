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
        .button-container-kl {
            background-size: cover;
            background-repeat: no-repeat;
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
        background-color: #f8f9fa;
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
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand px-3 mb-0 h1" href="home.php">Travelry</a>
            <div class="dropdown">
                <button class="dropbtn"><?php echo $_SESSION['user_id'] ?></button>
                    <div class="dropdown-content">
                        <a href="#">Booking History</a>
                        <a href="home.php?logout='1'">LOGOUT</a>
                    </div>
            </div>
        </nav>
    </header>
    

    <main>
        <div class="main-container">
        <div class="main-row">
            <?php
       
        // Database connection information
        $host = 'localhost';
        $username = 'root';
        $database = 'finalproject';

           $conn = new mysqli($host, $username, "", $database);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if (isset($_GET['order_id'])) {
                $order_id = $_GET['order_id'];
                $sql = "SELECT * FROM booking WHERE username = $order_id ORDER BY id DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                    $room_id = $row["roomid"];

                    $sql2 = "SELECT * FROM room WHERE id = $room_id";
                    $result2 = $conn->query($sql2);
                    if ($result2->num_rows > 0) {
                        // Output data of each row
                        while ($row2 = $result2->fetch_assoc()) {

                    echo "<div class='col-md-8 mb-4 mr-10'>";
                    echo "<div class='card'>";
                    echo "<div class='row gx-5'>";
                    echo "<div class='col-md-6'>";
                    echo "<a> <img src='images/" . $row2['picture'] . "' class='card-img-top' style='height:300px;width:350px;' alt='Hotel Image'> </a>";
                    echo "</div>"; // Close col-md-6
                    echo "<div class='col-md-6'>";
                    echo "<div class='card-body'>";
                    echo "<h3 class='card-title'>" . $row2["name"] . "</h5>";
                    echo "<h5 class='card-title'>" . $row["fullname"] . "</h5>";
                    echo "<p class='card-text'>Email: " . $row["email"] . "</p>";
                    echo "<p class='card-text'>Phone NO: " . $row["phone"] . "</p>";
                    echo "<p class='card-text'>Check-in: " . $row["checkin"] . "</p>";
                    echo "<p class='card-text'>Check-out: " . $row["checkout"] . "</p>";
                    echo "<p class='card-text'>RM " . $row["totalprice"] . "</p>";
                    echo "</div>"; // Close card-body
                    echo "</div>"; // Close col-md-6
                    echo "</div>"; // Close row g-0
                    echo "</div>"; // Close card
                    echo "</div>"; // Close col-md-4
                        // Other details to display
                    }
                }
            }
                } else {
                    echo "No booking history found with ID: $order_id";
                }
            } else {
                echo "No booking history provided";
            }

            $conn->close();
            ?>
        </div>
        </div>

    </main>

    <footer>
        <div class="footer-container">
            <a>@Capstone Project_CHIAH ZI HONG</a>
        </div>
    </footer>
    
    <!-- Include Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>


