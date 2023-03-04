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

    $sqlRemove = "DELETE FROM ORDERS WHERE TABLE_NO=" . $_REQUEST['tableNo'] . " AND ORDER_NO=" . $_REQUEST['orderNo'] . " AND ITEM_NAME='" . $_REQUEST['itemName'] . "'" . " AND QUANTITY=" . $_REQUEST['quantity'] ." AND STATUS<1";
if ($conn->query($sqlRemove)) {
    // header("Location : menu.php?tableNo=" . $_REQUEST['tableNo']);
        
        ?>
        <script>
            window.location = "menu.php?tableNo=<?php echo $_REQUEST['tableNo']?>";
        </script>
        <?php
    }

