<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    $_SESSION['msg'] = "You must log in first";
    header("location: /CapstoneProject/user_login.php");
    exit; // Ensure no further code is executed
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user_id']);
    header("location: /CapstoneProject/user_login.php");
    exit; // Ensure no further code is executed
}

$host = 'localhost';
$username = 'root';
$database = 'finalproject';

$conn = new mysqli($host, $username, "", $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_REQUEST['id'];
$user = $_SESSION['user_id'];

$result = mysqli_query($conn, "SELECT * FROM room WHERE id LIKE '$id'");
$room = mysqli_fetch_array($result);

if (!$result) {
    die("Error : Data not found...");
}

$roomname = $room['name'];
$roompicture = $room['picture'];
$roomtype = $room['type'];
$roomprice = $room['price'];
$hotel_id = $room['hotel'];

$resultt = mysqli_query($conn, "SELECT * FROM hotel_and_location WHERE id LIKE '$hotel_id'");
$hotel = mysqli_fetch_array($resultt);

if (!$resultt) {
    die("Error : Data not found...");
}

$hotelid = $hotel['id'];
$hotelname = $hotel['name'];
$hotelpicture = $hotel['picture'];
$hoteldescription = $hotel['description'];
$hotellocation = $hotel['parent_id'];

$resulttt = mysqli_query($conn, "SELECT * FROM user WHERE name LIKE '$user'");
$user = mysqli_fetch_array($resulttt);

if (!$resulttt) {
    die("Error : Data not found...");
}

$userid = $user['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hotel Booking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h1>Hotel Booking</h1>

    <h3><?php echo $hotelname; ?></h3>
    <h4><?php echo $roomtype; ?></h4>
    <h4><?php echo $userid; ?></h4>

    <!-- Personal Details -->
    <h3>Personal Details</h3>

    <form id="personalDetailsForm" method="POST">
        <input type="hidden" id="roomid" name="roomid" value="<?php echo $id ?>">
        <input type="hidden" id="username" name="username" value="<?php echo $userid; ?>">

        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Phone (Malaysia format, e.g., +60 12 345 6789):</label>
        <input type="tel" id="phone" name="phone" max="9999999999" min="6000000000"
               pattern="\+?\d{2}\s?\d{2}\s?\d{3}\s?\d{4}" required>

        <!-- Payment Details -->
        <h3>Payment Details</h3>
        <label for="cardNumber">Card Number (xxxx xxxx xxxx xxxx):</label>
        <input type="number" id="cardNumber" pattern="\d{4} \d{4} \d{4} \d{4}" required>

        <label for="expiryDate">Expiry Date (MM/YY):</label>
        <input type="number" id="expiryDate" placeholder="MM/YY" pattern="\d{2}/\d{2}" required>

        <label for="cvv">CVV (3 or 4 digits):</label>
        <input type="number" id="cvv" pattern="\d{3,4}" required>

        <!-- Date Selection -->
        <h3>Choose Dates</h3>
        <label for="checkInDate">Check-in Date:</label>
        <input type="date" id="checkInDate" name="checkin" min="<?php echo date('Y-m-d'); ?>" required>

        <label for="checkOutDate">Check-out Date:</label>
        <input type="date" id="checkOutDate" name="checkout" min="<?php echo date('Y-m-d'); ?>" required>

        <h3>Price Details</h3>
        <p>Subtotal: RM<span id="subTotal">0.00</span></p>
        <p>Tax (6%): RM<span id="taxAmount">0.00</span></p>

        <!-- Display Total Price -->
        <p>Total Price: RM<span id="totalPrice">0.00</span></p>
        <input type="hidden" name="totalprice" value="" id="hiddenTotalPrice">

        <input type="submit" name="book">
        <a href="room.php?id=<?php echo $hotelid; ?>" class="button">Back</a>
    </form>
</div>

<script>
    // Function to calculate total price including tax
    function calculateTotalPrice() {
        const checkInDate = document.getElementById('checkInDate').value;
        const checkOutDate = document.getElementById('checkOutDate').value;
        const roomPrice = <?php echo $roomprice; ?>;
        const taxRate = 0.06; // 6% tax rate

        if (checkInDate && checkOutDate) {
            const oneDay = 24 * 60 * 60 * 1000; // milliseconds in a day
            const nights = Math.round(Math.abs((new Date(checkOutDate) - new Date(checkInDate)) / oneDay));
            let subtotal = nights * roomPrice;
            let taxAmount = subtotal * taxRate;
            let totalPrice = subtotal + taxAmount;

            document.getElementById('subTotal').innerText = subtotal.toFixed(2);
            document.getElementById('taxAmount').innerText = taxAmount.toFixed(2);
            document.getElementById('totalPrice').innerText = totalPrice.toFixed(2); // Displaying with 2 decimal places for RM
            updateHiddenTotalPrice();
        } else {
            document.getElementById('subTotal').innerText = "0.00";
            document.getElementById('taxAmount').innerText = "0.00";
            document.getElementById('totalPrice').innerText = "0.00";
            updateHiddenTotalPrice();
        }
    }

    function updateHiddenTotalPrice() {
        document.getElementById("hiddenTotalPrice").value = document.getElementById("totalPrice").innerText;
    }

    // Event listeners for check-in and check-out date inputs
    document.getElementById('checkInDate').addEventListener('change', function () {
        document.getElementById('checkOutDate').min = this.value;
        calculateTotalPrice();
    });

    document.getElementById('checkOutDate').addEventListener('change', function () {
        calculateTotalPrice();
    });

    // Initial calculation when the page loads
    calculateTotalPrice();
</script>
</body>
</html>

<?php
if (isset($_POST['book'])) {
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $checkin = $_POST["checkin"];
    $checkout = $_POST["checkout"];
    $totalprice = $_POST["totalprice"];
    $username = $_POST["username"];
    $roomid = $_POST["roomid"];

    // Prepare SQL statement using prepared statement
    $stmt = $conn->prepare("INSERT INTO booking (fullname, email, phone, checkin, checkout, totalprice, roomid, username)
                             VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $fullname, $email, $phone, $checkin, $checkout, $totalprice, $roomid, $username);

    if ($stmt->execute()) {
        echo "New record created successfully";
        exit; // Ensure no further code is executed
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
