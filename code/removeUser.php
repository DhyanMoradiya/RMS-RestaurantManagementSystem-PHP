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
$sqlRemove = "DELETE FROM REGISTER WHERE FNAME='" . $_REQUEST['fname'] . "'" . " AND LNAME='" . $_REQUEST['lname'] . "'" . " AND PHONE=" . $_REQUEST['phone']. " AND EMAIL='" . $_REQUEST['email']. "'";


if ($conn->query($sqlRemove)) {
    // header("Location : dashboard.php");
    ?>
    <script>
        window.location = "dashboard.php";
    </script>
    <?php
}
