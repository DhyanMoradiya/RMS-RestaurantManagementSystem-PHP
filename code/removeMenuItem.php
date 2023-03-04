<?php
// connecting to database
$server = 'localhost';
$username = 'root';
$password = '';
$dbname  = 'RMS';

$conn = new mysqli($server, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetching user's position
$sqlRemove = "DELETE FROM MENU WHERE ITEM_NAME='" . $_REQUEST['itemName'] . "'" . " AND PRICE=" . $_REQUEST['price'] . " AND CATEGORY='" . $_REQUEST['category'] . "'";

if ($conn->query($sqlRemove)) {
    // header("Location : dashboard.php");
    ?>
    <script>
        window.location = "dashboard.php";
    </script>
    <?php
}
