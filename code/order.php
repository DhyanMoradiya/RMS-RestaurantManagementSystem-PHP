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

$sqlChanceStatus = "UPDATE ORDERS SET STATUS = 1 WHERE TABLE_NO =" . $_REQUEST['tableNo'] . " AND BILL_NO = " . $_REQUEST['billNo'] . " AND STATUS = 0";

if ($conn->query($sqlChanceStatus)) {
    $sqlOrdersData = "SELECT ORDER_SUBTOTLE FROM ORDERS WHERE TABLE_NO = " . $_REQUEST['tableNo'] . " AND BILL_NO = " . $_REQUEST['billNo'];
    $resultOrdersData = $conn->query($sqlOrdersData);
    $billSubtotle = 0;
    while ($dataOrdersData = $resultOrdersData->fetch_array(MYSQLI_ASSOC)) {
        $billSubtotle += $dataOrdersData['ORDER_SUBTOTLE'];
    }

    $gst = ($billSubtotle * 18) / 100;
    $finalAmount = $billSubtotle + $gst;
    $sqlInsertBillData = "UPDATE BILL SET SUBTOTLE = $billSubtotle, GST = $gst, FINAL_AMOUNT = $finalAmount, BILL_DATE = '" . date('Y-m-d') . "', BILL_TIME = '". date('h:i')."' WHERE BILL_NO =" . $_REQUEST['billNo'];
    if ($conn->query($sqlInsertBillData)) {
        // header("Location : menu.php?tableNo=" . $_REQUEST['tableNo']);
    ?>
    <script>
        window.location = "menu.php?tableNo=<?php echo $_REQUEST['tableNo']?>";
    </script>
    <?php
    }
}
