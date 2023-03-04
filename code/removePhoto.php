<?php
session_start();
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
$sqlRemove = "UPDATE REGISTER SET PHOTO = 'NOTSET.png'  WHERE PHONE='" . $_SESSION['userPhone'] . "'";
if($conn->query($sqlRemove)){
        // header("Location : dashboard.php");
        ?>
        <script>
            window.location = "dashboard.php";
        </script>
        <?php
}

?>