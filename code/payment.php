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

$sqlCloseBill = "UPDATE Bill SET Bill_STATUS = 1, CASHIER = '" . $_REQUEST['position'] . "', BILL_DATE = '" . date('Y-m-d') . "', BILL_TIME = '" . date('h:i') . "' WHERE TABLE_NO =" . $_REQUEST['tableNo'] . " AND BILL_NO = " . $_REQUEST['billNo'] . " AND BILL_STATUS = 0";

if ($conn->query($sqlCloseBill)) {
    $sqlFreeTable = "UPDATE TABLES SET TABLE_STATUS=1  WHERE TABLE_NO =" . $_REQUEST['tableNo'];
    if ($conn->query($sqlFreeTable)) {
        // header("Location : dashboard.php");
?>
        <script>
            window.location = "dashboard.php";
        </script>
<?php
    }
}
