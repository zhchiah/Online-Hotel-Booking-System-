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
    <title>Hotel Details</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Other CSS files -->

</head>
<style>
            .footer-container {
            background-repeat: no-repeat;
            margin-top: 30px;
            text-align: center;
            background-color: rgba(0, 0, 0, 0.1); /* Background color with opacity */
            padding:50px;
            width: 100%;
            height: 100%;
        }

            

        .main-row{


            text-align: center;
            margin-top: 30px;
            border-radius: 10px;
            padding:50px;

        }

    </style>


<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand px-3 mb-0 h1" href="#">Travelry</a>
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


            // Assuming hotel ID is passed via a query parameter (e.g., ?hotel_id=123)
            if (isset($_GET['hotel_id'])) {
                $hotel_id = $_GET['hotel_id'];
                $sql = "SELECT * FROM hotel_and_location WHERE parent_id = $hotel_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                    echo "<div class='col-md-8 mb-4 mr-10'>";
                    echo "<div class='card'>";
                    echo "<div class='row gx-5'>";
                    echo "<div class='col-md-6'>";
                    echo "<a href='room.php?id=".$row['id']."'> <img src='images/" . $row['picture'] . "' class='card-img-top'    style='height:300px;width:350px;' alt='Hotel Image'> </a>";

                    echo "</div>"; // Close col-md-6
                    echo "<div class='col-md-6'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>" . $row["name"] . "</h5>";
                    echo "<p class='card-text'>" . $row["description"] . "</p>";
                    echo "</div>"; // Close card-body
                    echo "</div>"; // Close col-md-6
                    echo "</div>"; // Close row g-0
                    echo "</div>"; // Close card
                    echo "</div>"; // Close col-md-4
                        // Other details to display
                    }
                } else {
                    echo "No hotel found with ID: $hotel_id";
                }
            } else {
                echo "No hotel ID provided";
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
    <!-- Other JS files -->

</body>
</html>
