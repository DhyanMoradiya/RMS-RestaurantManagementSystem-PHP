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

// Update status
    $sqlChanceStatus = "UPDATE ORDERS SET STATUS = 2 WHERE TABLE_NO =" . $_REQUEST['tableNo']. " AND ORDER_NO=" . $_REQUEST['orderNo']." AND QUANTITY='". $_REQUEST['quantity'] . "'" ." AND STATUS = 1";

if ($conn->query($sqlChanceStatus)) {
    // header("Location : dashboard.php");
    ?>
    <script>
        window.location = "dashboard.php";
    </script>
    <?php
}
?>
