<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" media="screen and (max-width:1017px)" href="../css/mainTab.css">
    <link rel="shortcut icon" href="../source/fevicon.ico" type="image/x-icon">

    <title>JSK Resturant</title>
</head>

<body onload="loading()">
    <?php
    session_start();
    ?>

    <!---------- PRE LOADER----------->
    <!-- <div id="loader">
      <img src="..\source\Restaurant_Logo.webp" />
    </div> -->

    <?php

    // echo '<script>showMsg("helllo......., green");</script>';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    // Checking session 
    if (!isset($_SESSION['userPhone'])) {
    ?>
        <script>
            window.location = "login.php";
        </script>
    <?php
        exit(1);
    }

    // functions
    function positionToString($position)
    {
        switch ($position) {
            case 0:
                $positionText = "Developer";
                break;

            case 1:
                $positionText = "Admin";
                break;

            case 2:
                $positionText = "Waiter";
                break;

            case 3:
                $positionText = "Cook";
                break;

            default:
                $positionText = "";
                break;
        }
        return $positionText;
    }

    function stringToPosition($positionString)
    {
        switch ($positionString) {
            case "Admin":
                $positionNo = 1;
                break;

            case "Waiter":
                $positionNo = 2;
                break;

            case "Cook":
                $positionNo = 3;
                break;

            default:
                $positionNo = 0;
                break;
        }
        return $positionNo;
    }

    function billStatusToString($statusNo)
    {
        switch ($statusNo) {
            case 0:
                $status = "Pending...";
                break;

            case 1:
                $status = "Completed";
                break;

            default:
                $status = "";
                break;
        }

        return $status;
    }
    function statusToString($statusNo)
    {
        switch ($statusNo) {
            case 0:
                $status = "Pending ";
                break;

            case 1:
                $status = "Ordered";
                break;

            case 2:
                $status = "Cooking";
                break;

            case 3:
                $status = "Ready";
                break;

            case 4:
                $status = "Serverd";
                break;

            default:
                $status = "";
                break;
        }

        return $status;
    }

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
    // $_SESSION['userPhone'] = 9714877117;
    $sql = "SELECT * FROM REGISTER WHERE PHONE='" . $_SESSION['userPhone'] . "'";
    $result = $conn->query($sql);
    $data = $result->fetch_array(MYSQLI_ASSOC);
    $position = $data['POSITION'];
    $_SESSION['position'] = $data['POSITION'];
    $fname = $data['FNAME'];
    $lname = $data['LNAME'];
    $positionText = positionToString($position);


    //update info
    $fnameError = "";
    $lnameError = "";
    $emailError = "";
    $phoneError = "";
    $profileFormInfo = "";
    if (isset($_REQUEST['updateProfileBtn'])) {
        if (empty($_REQUEST['fname'])) {
            $fnameError = "*First name could not be empty";
        } else if (empty($_REQUEST['lname'])) {
            $lnameError = "*last name could not be empty";
        } else if (empty($_REQUEST['phone'])) {
            $phoneError = "*Phone could not be empty";
        } else if (empty($_REQUEST['email'])) {
            $emailError = "*Email could not be empty";
        } else {
            $fn = $_REQUEST['fname'];
            $ln = $_REQUEST['lname'];
            $ph = $_REQUEST['phone'];
            $em = $_REQUEST['email'];
            $sqlUpdate = "UPDATE REGISTER SET FNAME = '$fn', LNAME = '$ln', PHONE = $ph, EMAIL = '$em' WHERE PHONE='" . $_SESSION['userPhone'] . "'";
            if ($conn->query($sqlUpdate)) {
                $data['FNAME'] = $_REQUEST['fname'];
                $data['LNAME'] = $_REQUEST['lname'];
                $data['PHONE'] = $_REQUEST['phone'];
                $data['EMAIL'] = $_REQUEST['email'];
            }

            $profileFormInfo = "Profile update Success Fully...";


            $file_Name = $_FILES['photo']['name'];
            if ($file_Name != "") {
                // creating image file path
                $fileTmpName = $_FILES['photo']['tmp_name'];

                $path = "../source/profile_photos/" . $file_Name;
                $sqlUpdate = "UPDATE REGISTER SET PHOTO = '$file_Name' WHERE PHONE='" . $_SESSION['userPhone'] . "'";

                if ($conn->query($sqlUpdate)) {
                    move_uploaded_file($fileTmpName, $path);
                    $data['PHOTO'] = $file_Name;
                    $profileFormInfo = "Profile update Success Fully...";
                }
            }
        }
    }


    // change password / incomplete
    if (isset($_REQUEST["changeBtn"])) {
        $profileFormInfo = "entered";
        $cpass = $_REQUEST['cpass'];
        if (strcmp($cpass, $data['PASSWORD'])) {
            if (strcmp($_REQUEST['newpass'], $_REQUEST['repass'])) {
                $newpass = $_REQUEST['newpass'];
                $sqlChnagePass = "UPDATE REGISTER SET PASSWORD = '$newpass' WHERE PHONE='" . $_SESSION['userPhone'] . "'";
                if ($conn->query($sqlChnagePass)) {
                    $profileFormInfo = "chnaged";
                }
            } else {
                $profileFormInfo = "pass ans repass not matching";
            }
        } else {
            $profileFormInfo = "cpass is not matching";
            // $profileFormInfo = var_dump($data['PASSWORD']);
            // $profileFormInfo = var_dump($cpass);
        }
    }
    ?>

    <div class="sidebar">
        <div class="logo-details">
            <div class="logo_name">JSK Restaurant</div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list">
            <li>
                <a href="#" class="sidebarLink sidebarLinkActive" id="text_dashboard" onclick="activeTab(event, 'dashboard', 'link_dashboard', 'text_dashboard')">
                    <i class='bx bx-grid-alt sidebarLink' id="link_dashboard"></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <?php
            if ($position == 2 || $position == 0) {
                //Waiter orders 
            ?>
                <li>
                    <a href="#" class="sidebarLink" id="text_order" onclick="activeTab(event, 'order', 'link_order', 'text_order')">
                        <i class='bx bx-dish sidebarLink' id="link_order"></i>
                        <span class="links_name">Take Order</span>
                    </a>
                    <span class="tooltip">Take Order</span>
                </li>
            <?php
            }
            // Coock orders
            if ($position == 3 || $position == 0) {
            ?>
                <li>
                    <a href="#" class="sidebarLink" id="text_orders" onclick="activeTab(event,'orders', 'link_orders', 'text_orders')">
                        <i class='bx bx-dish sidebarLink' id="link_orders"></i>
                        <span class="links_name">Orders</span>
                    </a>
                    <span class="tooltip">Orders</span>
                </li>
            <?php
            }
            if ($position == 1 || $position == 2 || $position == 0) {
            ?>
                <li>
                    <a href="#" class="sidebarLink" id="text_orderlist" onclick="activeTab(event,'orderlist', 'link_orderlist', 'text_orderlist')">
                        <i class='bx bx-paste sidebarLink' id="link_orderlist"></i>
                        <span class="links_name">Order list</span>
                    </a>
                    <span class="tooltip">Order list</span>
                </li>
            <?php
            }
            if ($position == 1 || $position == 0) {
            ?>
                <li>
                    <a href="#" class="sidebarLink" id="text_updatemenu" onclick="activeTab(event,'updatemenu', 'link_updatemenu', 'text_updatemenu')">
                        <i class='bx bx-food-menu sidebarLink' id="link_updatemenu"></i>
                        <span class="links_name">Update menu</span>
                    </a>
                    <span class="tooltip">Update menu</span>
                </li>
            <?php
            }
            if ($position == 1 || $position == 0) {
            ?>
                <li>
                    <a href="#" class="sidebarLink" id="text_bill" onclick="activeTab(event, 'bill', 'link_bill', 'text_bill')">
                        <i class='bx bx-notepad sidebarLink' id="link_bill"></i>
                        <span class="links_name">Bill</span>
                    </a>
                    <span class="tooltip">Bill</span>
                </li>
            <?php
            }
            if ($position == 1 || $position == 0) {
            ?>
                <li>
                    <a href="#" class="sidebarLink" id="text_staff" onclick="activeTab(event, 'staff', 'link_staff', 'text_staff')">
                        <i class='bx bx-user sidebarLink' id="link_staff"></i>
                        <span class="links_name">Staff</span>
                    </a>
                    <span class="tooltip">Staff</span>
                </li>
            <?php
            }
            ?>
            <li>
                <a href="#" class="sidebarLink" id="text_setting" onclick="activeTab(event , 'setting', 'link_setting', 'text_setting')">
                    <i class='bx bx-cog sidebarLink' id="link_setting"></i>
                    <span class="links_name">Setting</span>
                </a>
                <span class="tooltip">Setting</span>
            </li>
            <li class="profile">
                <div class="profile-details">
                    <img src="<?php echo "../source/profile_photos/" . $data['PHOTO']; ?>" alt="">
                    <div class="name_job">
                        <div class="name"><?php echo $fname . " " . $lname; ?></div>
                        <div class="job"><?php echo $positionText; ?></div>
                    </div>
                    <a href="logout.php"><i class='bx bx-log-out' id="log_out"></i></a>
                </div>
            </li>
        </ul>
    </div>

    <section class="home-section">

        <div id="dashboard" class="tab">
            <div class="heading">
                <h1>Dashboard</h1>
                <h6></h6>
            </div>

            <?php
            if ($position == 1 || $position == 0) {
            ?>
                <div class="finance-info">
                    <div class="finance-info-card" id="today">
                        <div class="finance-detail">
                            <p class="finace-detail-title">TODAY SALES</p>
                            <?php
                            $amount = 0;
                            $sqlBillFinance = "SELECT FINAL_AMOUNT FROM BILL WHERE BILL_DATE = CURRENT_DATE AND BILL_STATUS = 1";
                            $resultFinance = $conn->query($sqlBillFinance);
                            while ($dataFinance = $resultFinance->fetch_assoc()) {
                                $amount += $dataFinance['FINAL_AMOUNT'];
                            }
                            ?>
                            <p class="finace-detail-figure"><?php echo $amount; ?> &#8377;</p>
                        </div>
                        <i class='bx bx-clipboard finance-icon'></i>
                    </div>
                    <div class="finance-info-card" id="yesterday">
                        <div class="finance-detail">
                            <p class="finace-detail-title">YESTERDAY SALES</p>
                            <?php
                            $amount = 0;
                            $sqlBillFinance = "SELECT FINAL_AMOUNT FROM BILL WHERE BILL_DATE = CURRENT_DATE - INTERVAL 1 DAY AND BILL_STATUS = 1";
                            $resultFinance = $conn->query($sqlBillFinance);
                            while ($dataFinance = $resultFinance->fetch_assoc()) {
                                $amount += $dataFinance['FINAL_AMOUNT'];
                            }
                            ?>
                            <p class="finace-detail-figure"><?php echo $amount; ?> &#8377;</p>
                        </div>
                        <i class='bx bx-clipboard finance-icon'></i>
                    </div>
                    <div class="finance-info-card" id="last7day">
                        <div class="finance-detail">
                            <p class="finace-detail-title">LAST 7 DAY SALES</p>
                            <?php
                            $amount = 0;
                            $sqlBillFinance = "SELECT FINAL_AMOUNT FROM BILL WHERE BILL_DATE > CURRENT_DATE - INTERVAL 7 DAY AND BILL_STATUS = 1";
                            $resultFinance = $conn->query($sqlBillFinance);
                            while ($dataFinance = $resultFinance->fetch_assoc()) {
                                $amount += $dataFinance['FINAL_AMOUNT'];
                            }
                            ?>
                            <p class="finace-detail-figure"><?php echo $amount; ?> &#8377;</p>
                        </div>
                        <i class='bx bx-clipboard finance-icon'></i>
                    </div>
                    <div class="finance-info-card" id="alltime">
                        <div class="finance-detail">
                            <p class="finace-detail-title">ALL TIME SALES</p>
                            <?php
                            $amount = 0;
                            $sqlBillFinance = "SELECT FINAL_AMOUNT FROM BILL WHERE BILL_STATUS = 1";
                            $resultFinance = $conn->query($sqlBillFinance);
                            while ($dataFinance = $resultFinance->fetch_assoc()) {
                                $amount += $dataFinance['FINAL_AMOUNT'];
                            }
                            ?>
                            <p class="finace-detail-figure"><?php echo $amount; ?> &#8377;</p>
                        </div>
                        <i class='bx bx-clipboard finance-icon'></i>
                    </div>
                </div>
            <?php
            }
            ?>

            <div class="dashboard-table-map-outer">
                <p class="dashboard-table-map-heading">Live Table Status</p>
                <div class="dashboard-table-map">
                    <?php
                    $sqlTables = "SELECT * FROM TABLES";
                    $resultTables = $conn->query($sqlTables);
                    while ($dataTables = $resultTables->fetch_array(MYSQLI_ASSOC)) {
                        if ($dataTables['TABLE_STATUS']) {
                    ?>
                            <div class="dashboard-table-box dashboard-free">
                                <p class="dashboard-tabe-no">Table <?php echo $dataTables['TABLE_NO']; ?></p>

                                <p class="dashboard-table-status"><?php echo $dataTables['CAPACITY']; ?> Person</p>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="dashboard-table-box dashboard-occupied">
                                <p class="dashboard-tabe-no">Table <?php echo $dataTables['TABLE_NO']; ?></p>
                                <p class="dashboard-table-status">Occupied</p>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        </div>

        <!--Captain waiterx waiter -->
        <div id="order" class="tab">
            <div class="heading">
                <h1>Take Order</h1>
                <h6>Take customer orders</h6>
            </div>
            <div class="table-map-outer">
                <?php
                $sqlTables = "SELECT * FROM TABLES";
                $resultTables = $conn->query($sqlTables);
                while ($dataTables = $resultTables->fetch_array(MYSQLI_ASSOC)) {
                ?>
                    <a href="menu.php?tableNo=<?php echo $dataTables['TABLE_NO']; ?>" class="table-box <?php if (!$dataTables['TABLE_STATUS']) {
                                                                                                            echo "occupy";
                                                                                                        } ?>"><?php echo $dataTables['TABLE_NO']; ?></a>
                <?php
                }
                ?>
            </div>
        </div>

        <!--For cook -->
        <div id="orders" class="tab">
            <div class="heading">
                <h1>Orders</h1>
                <h6>Update and proceed</h6>
            </div>
            <?php

            $sqlOrder = "SELECT * FROM ORDERS WHERE STATUS >= 1 AND STATUS <= 3 ORDER BY STATUS DESC";
            $resultOrder = $conn->query($sqlOrder);
            ?>
            <div class="outer outer-orders">
                <table class="staffTable " cellspacing="0">
                    <thead>
                        <tr>
                            <th>Order No</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        while ($dataOrder = $resultOrder->fetch_array(MYSQLI_ASSOC)) {

                        ?>
                            <tr>
                                <td><?php echo $dataOrder['ORDER_NO']; ?></td>
                                <td><?php echo $dataOrder['ITEM_NAME']; ?></td>
                                <td><?php echo $dataOrder['QUANTITY']; ?></td>
                                <?php
                                if ($dataOrder['STATUS'] == 1) {
                                ?>
                                    <td>
                                        <p class="status ordered"><?php echo statusToString($dataOrder['STATUS']); ?></p>
                                    </td>
                                <?php
                                } else if ($dataOrder['STATUS'] == 2) {
                                ?>
                                    <td>
                                        <p class="status cooking"><?php echo statusToString($dataOrder['STATUS']); ?></p>
                                    </td>
                                <?php
                                } else if ($dataOrder['STATUS'] == 3) {
                                ?>
                                    <td>
                                        <p class="status ready"><?php echo statusToString($dataOrder['STATUS']); ?></p>
                                    </td>
                                <?php
                                }
                                ?>
                                <td>
                                    <?php
                                    if ($dataOrder['STATUS'] == 1) {
                                    ?>
                                        <a href="cook.php?orderNo=<?php echo $dataOrder['ORDER_NO']; ?>&tableNo=<?php echo $dataOrder['TABLE_NO']; ?>&itmeName=<?php echo $dataOrder['ITEM_NAME']; ?>&quantity=<?php echo $dataOrder['QUANTITY']; ?>" class="cookBtn">Cook</a>
                                    <?php
                                    } else if ($dataOrder['STATUS'] == 2) {
                                    ?>
                                        <a href="ready.php?orderNo=<?php echo $dataOrder['ORDER_NO']; ?>&tableNo=<?php echo $dataOrder['TABLE_NO']; ?>&itmeName=<?php echo $dataOrder['ITEM_NAME']; ?>&quantity=<?php echo $dataOrder['QUANTITY']; ?>" class="cookBtn readyBtn">Ready</a>
                                    <?php
                                    }
                                    ?>
                                </td>

                            <?php
                            $i++;
                        }
                            ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- For waiter -->
        <div id="orderlist" class="tab">
            <div class="heading">
                <h1>Order List</h1>
                <h6>Update and proceed</h6>
            </div>
            <?php

            $sqlOrder = "SELECT * FROM ORDERS WHERE STATUS >= 2 AND STATUS <= 4 ORDER BY STATUS ASC";
            $resultOrder = $conn->query($sqlOrder);
            ?>
            <div class="outer outer-orders">
                <table class="staffTable " cellspacing="0">
                    <thead>
                        <tr>
                            <th>Order No</th>
                            <th>Table No</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        while ($dataOrder = $resultOrder->fetch_array(MYSQLI_ASSOC)) {

                        ?>
                            <tr>
                                <td><?php echo $dataOrder['ORDER_NO']; ?></td>
                                <td><?php echo $dataOrder['TABLE_NO']; ?></td>
                                <td><?php echo $dataOrder['ITEM_NAME']; ?></td>
                                <td><?php echo $dataOrder['QUANTITY']; ?></td>
                                <?php
                                if ($dataOrder['STATUS'] == 4) {
                                ?>
                                    <td>
                                        <p class="status served"><?php echo statusToString($dataOrder['STATUS']); ?></p>
                                    </td>
                                <?php
                                } else if ($dataOrder['STATUS'] == 2) {
                                ?>
                                    <td>
                                        <p class="status cooking"><?php echo statusToString($dataOrder['STATUS']); ?></p>
                                    </td>
                                <?php
                                } else if ($dataOrder['STATUS'] == 3) {
                                ?>
                                    <td>
                                        <p class="status ready"><?php echo statusToString($dataOrder['STATUS']); ?></p>
                                    </td>
                                <?php
                                }
                                ?>
                                <td>
                                    <?php
                                    if ($dataOrder['STATUS'] == 3) {
                                    ?>
                                        <a href="serve.php?orderNo=<?php echo $dataOrder['ORDER_NO']; ?>&tableNo=<?php echo $dataOrder['TABLE_NO']; ?>&itmeName=<?php echo $dataOrder['ITEM_NAME']; ?>&quantity=<?php echo $dataOrder['QUANTITY']; ?>" class="cookBtn">Served</a>
                                    <?php
                                    }
                                    ?>
                                </td>

                            <?php
                            $i++;
                        }
                            ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="updatemenu" class="tab">
            <div class="heading">
                <h1>Update Menu</h1>
                <h6>Add/Remove items from menu</h6>
            </div>
            <?php

            if (isset($_REQUEST['addItemBtn'])) {
                if (!isset($_REQUEST['item_name'])) {
                    $nameError = "Enter item name first.";
                } else if (!isset($_REQUEST['price'])) {
                    $priceError = "Enter price first.";
                } else if (!isset($_REQUEST['category'])) {
                    $imageError = "Select category first.";
                } else {
                    $item_name = $_REQUEST['item_name'];
                    $price = $_REQUEST['price'];
                    $file_Name = $_FILES['image']['name'];
                    $category = $_REQUEST['category'];
                    $description = "";
                    if (isset($_REQUEST['description'])) {
                        $description = $_REQUEST['description'];
                    }


                    if ($file_Name != "") {
                        // creating image file path
                        $fileTmpName = $_FILES['image']['tmp_name'];
                        $path = "../source/menu_image/" . $file_Name;

                        $sql = "INSERT INTO MENU VALUES('$item_name', '$file_Name', $price, '$category', '$description')";
                        if ($conn->query($sql)) {
                            move_uploaded_file($fileTmpName, $path);
                            $info = "Upload successful...";
                        } else {
                            $info = "VALUE INSERT FAIL!!!";
                        }
                    } else {
                        $imageError = "Select image first";
                    }
                }
            }

            $sqlMenu = "SELECT * FROM MENU ORDER BY CATEGORY ASC";
            $resultMenu = $conn->query($sqlMenu);
            ?>
            <div class="outer outer-menu">
                <table class="staffTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Item Iamge</th>
                            <th>Item Name</th>
                            <th>Price</th>
                            <th>category</th>
                            <th>Description</th>
                            <th></th>
                            <!-- <th></th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        while ($dataMenu = $resultMenu->fetch_array(MYSQLI_ASSOC)) {

                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><img class="menu-item-photo" src="<?php echo "../source/menu_image/" . $dataMenu['IMAGE']; ?>"></td>
                                <td><?php echo $dataMenu['ITEM_NAME']; ?></td>
                                <td><?php echo $dataMenu['PRICE']; ?></td>
                                <td><?php echo $dataMenu['CATEGORY']; ?></td>
                                <?php
                                if (strcmp($dataMenu['DESCRIPTION'], "")) {
                                ?>
                                    <td><?php echo $dataMenu['DESCRIPTION']; ?></td>
                                <?php
                                } else {
                                ?>
                                    <td class="no-description">Empty</td>
                                <?php
                                }
                                ?>
                                <td><a onclick="showElement('editItemFormOuter<?php echo $i; ?>')" class="editBtn"><i class='bx bx-pencil'></i></a></td>
                                <td><a href="removeMenuItem.php?itemName=<?php echo $dataMenu['ITEM_NAME']; ?>&price=<?php echo $dataMenu['PRICE']; ?>&category=<?php echo $dataMenu['CATEGORY']; ?>" class="removeBtn"><i class='bx bx-trash removeBtn'></i></a></td>
                            </tr>

                            <div id="editItemFormOuter<?php echo $i; ?>" class="editItemFormOuter">
                                <form method="post" class="editItemForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                                    <i class='bx bx-x-circle' onclick="hideElement('editItemFormOuter<?php echo $i; ?>')"></i>
                                    <h2>Edit Item</h2>
                                    <img class="menu-item-photo" src="<?php echo "../source/menu_image/" . $dataMenu['IMAGE']; ?>">
                                    <div>
                                        <label for="itemName">Item Name</label>
                                        <input type="text" name="item_name<?php echo $i; ?>" value="<?php echo $dataMenu['ITEM_NAME']; ?>" id="itemName">
                                    </div>
                                    <div>
                                        <label for="itemPrice">Price</label>
                                        <input type="number" name="price<?php echo $i; ?>" value="<?php echo $dataMenu['PRICE']; ?>" id="itemPrice">
                                    </div>
                                    <div>
                                        <label for="itemImage">Iamge</label>
                                        <input type="file" name="image<?php echo $i; ?>" id="itemIamge" />
                                    </div>
                                    <div>
                                        <label for="ItemCategory">Category</label>
                                        <select value="<//?php echo $dataMenu['CATEGORY']; ?>" name="category<?php echo $i; ?>" id="ItemCategory">
                                            <option value="">Select a category:</option>
                                            <option value="Farsan">Farsan</option>
                                            <option value="Panjabi">Panjabi</option>
                                            <option value="South Indian">South Indian</option>
                                            <option value="Gujarati">Gujarati</option>
                                            <option value="Chainese">Chainese</option>
                                            <option value="Fast Food">Fast Food</option>
                                            <option value="Drinks">Drinks</option>
                                        </select>
                                    </div>
                                    <button class="editItemBtn" type="submit" name="EditMenuBtn<?php echo $i; ?>">Update</button>
                            </div>
                            </form>

                        <?php
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="addStaff addMenu">
                <button id="addStaffBtn" onclick="showElement('addItemFormOuter')">Add Item</button>
            </div>

            <div id="addItemFormOuter">
                <form method="post" id="addItemForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                    <i class='bx bx-x-circle' onclick="hideElement('addItemFormOuter')"></i>
                    <h2>Add Item</h2>
                    <div>
                        <input type="text" name="item_name" placeholder="Item name">
                    </div>
                    <div><input type="number" name="price" placeholder="price">
                    </div>
                    <div>
                        <input type="file" name="image" />
                    </div>
                    <div>
                        <select name="category">
                            <option value="">Select a category:</option>
                            <option value="Farsan">Farsan</option>
                            <option value="Panjabi">Panjabi</option>
                            <option value="South Indian">South Indian</option>
                            <option value="Gujarati">Gujarati</option>
                            <option value="Chainese">Chainese</option>
                            <option value="Fast Food">Fast Food</option>
                            <option value="Drinks">Drinks</option>
                        </select>
                    </div>
                    <button id="addItemBtn" type="submit" name="addItemBtn">Add</button>
                </form>
            </div>
        </div>

        <div id="staff" class="tab">

            <?php
            // sending mail
            if (isset($_REQUEST['sendMail'])) {
                $email = $_REQUEST['email'];
                $addPosition = $_REQUEST['position'];

                // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                //     echo "<script> showMsg('Enter correct infometion', 'red'); </script>";
                // } else {
                require 'Exception.php';
                require 'PHPMailer.php';
                require 'SMTP.php';


                $mail = new PHPMailer(true);
                $msg = "Hello, \r\n We are happy to hireing you as $addPosition in our restaurant. Please Sign up using given link to work with us \r\n\r\n http://127.0.0.1/RMS/code/signup.php?position=$addPosition; \r\n\r\n For support mrkingmoradiya@gmail.com";
                try {
                    $mail->isSMTP();
                    $mail->Host = gethostbyname('smtp.gmail.com');
                    $mail->SMTPAuth = true;
                    $mail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    );
                    $mail->Username = 'mrkingmoradiya@gmail.com';
                    $mail->Password = 'jaikwqpmnbnncvep';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;

                    $mail->setFrom('mrkingmoradiya@gamil.com', 'JSK Restaurant');
                    $mail->addAddress($email);
                    $mail->addReplyTo('no-reply@gmail.com', 'No-replay');

                    $mail->isHTML(true);
                    $mail->Subject = 'Job opportunity';
                    $mail->Body = nl2br($msg);
                    $mail->send();
            ?><script type="text/javascript">
                        showMsg('Email sent successfully...', 'green');
                    </script>
                <?php
                } catch (Exception $e) {
                ?>
                    <script type="text/javascript">
                        showMsg('Somting is wrong', 'red');
                    </script>
            <?php
                }
            }
            // } 
            ?>

            <div class="heading">
                <h1>Staff</h1>
            </div>
            <?php
            // Fetching staff infomation from database
            $sqlStaff = "SELECT * FROM REGISTER ORDER BY POSITION ASC";
            $resultStaff = $conn->query($sqlStaff);
            ?>
            <div class="outer">
                <table class="staffTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Contect</th>
                            <th>Email</th>
                            <th>Position</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        while ($dataStaff = $resultStaff->fetch_array(MYSQLI_ASSOC)) {

                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><img class="profile_photo" src="<?php echo "../source/profile_photos/" . $dataStaff['PHOTO']; ?>"></td>
                                <td><?php echo $dataStaff['FNAME'] . " " . $dataStaff['LNAME']; ?></td>
                                <td><?php echo $dataStaff['PHONE']; ?></td>
                                <td><?php echo $dataStaff['EMAIL']; ?></td>
                                <td><?php echo positionToString($dataStaff['POSITION']); ?></td>
                                <td><a href="removeUser.php?fname=<?php echo $dataStaff['FNAME'] ?>&lname=<?php echo $dataStaff['LNAME'] ?>&phone=<?php echo $dataStaff['PHONE']; ?>&email=<?php echo $dataStaff['EMAIL']; ?>"><i class='bx bx-trash removeBtn'></i></a></td>
                            </tr>
                        <?php
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="addStaff">
                <button id="addStaffBtn" onclick="showElement('addStaffFormOuter')">Add staff</button>
            </div>

            <!-- <div id="staffInfoBlockOuter">
                <div class="staffInfoBlock"></div>
            </div>    -->

            <div id="addStaffFormOuter">
                <form method="post" id="addStaffForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                    <i class='bx bx-x-circle' onclick="hideElement('addStaffFormOuter')"></i>
                    <h2>Staff Request</h2>
                    <div>
                        <input type="email" placeholder="Email" name="email" required>
                    </div>
                    <div>
                        <select name="position" required>
                            <option value="">Select a position:</option>
                            <option value="Admin">Admin</option>
                            <option value="Waiter">Waiter</option>
                            <option value="Cook">Cook</option>
                        </select>
                    </div>
                    <input id="sendBtn" type="submit" value="Send" name="sendMail">
                </form>
            </div>
        </div>

        <div id="bill" class="tab">
            <div class="heading">
                <h1>Bill</h1>
                <h6>Restaurant Bills</h6>
            </div>
            <?php
            // Fetching staff infomation from database
            $sqlBill = "SELECT * FROM BILL ORDER BY BILL_STATUS ASC";
            $resultBill = $conn->query($sqlBill);
            ?>
            <div class="outer">
                <table class="staffTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Bill No</th>
                            <th>Table No</th>
                            <th>Bill Date</th>
                            <th>Bill Time</th>
                            <th>Cashier</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($dataBill = $resultBill->fetch_array(MYSQLI_ASSOC)) {

                        ?>
                            <tr>
                                <td><?php echo $dataBill['BILL_NO']; ?></td>
                                <td><?php echo $dataBill['TABLE_NO']; ?></td>
                                <td><?php echo $dataBill['BILL_DATE']; ?></td>
                                <td><?php echo $dataBill['BILL_TIME']; ?></td>
                                <td><?php echo $dataBill['CASHIER']; ?></td>
                                <?php
                                if ($dataBill['BILL_STATUS']) {
                                ?>
                                    <td>
                                        <p class="bill-status bill-status-completed"><?php echo billStatusToString($dataBill['BILL_STATUS']); ?></p>
                                    </td>
                                    <td>
                                        <p class="generateBill" id="viewBill<?php echo $dataBill['BILL_NO']; ?>" onclick="showElement('bill-outer<?php echo $dataBill['BILL_NO']; ?>')">View Bill</p>
                                    </td>
                                <?php
                                } else {
                                ?>
                                    <td>
                                        <p class="bill-status bill-status-pending"><?php echo billStatusToString($dataBill['BILL_STATUS']); ?></p>
                                    </td>
                                    <td>
                                        <p class="generateBill" id="viewBill<?php echo $dataBill['BILL_NO']; ?>" onclick="showElement('bill-outer<?php echo $dataBill['BILL_NO']; ?>')">Generate Bill</p>
                                    </td>
                                <?php
                                }
                                ?>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <?php
                $sqlBill = "SELECT * FROM BILL ORDER BY BILL_STATUS ASC";
                $resultBill = $conn->query($sqlBill);
                while ($dataBill = $resultBill->fetch_array(MYSQLI_ASSOC)) {
                ?>
                    <div class="bill-outer" id="bill-outer<?php echo $dataBill['BILL_NO']; ?>">
                        <div class="bill">
                            <div class="bill-detail">
                                <p>Bill No : <?php echo $dataBill['BILL_NO']; ?></p>
                                <i class='bx bx-x-circle' onclick="hideElement('bill-outer<?php echo $dataBill['BILL_NO']; ?>')"></i>
                            </div>
                            <?php
                            $sqlOrdersData = "SELECT * FROM ORDERS WHERE BILL_NO = " . $dataBill['BILL_NO'];
                            $resultOrdersData = $conn->query($sqlOrdersData);
                            ?>
                            <table class="bill-table">
                                <tr>
                                    <th>No</th>
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Amount</th>
                                </tr>
                                <?php
                                $i = 1;
                                while ($dataOrdersData = $resultOrdersData->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $dataOrdersData['ITEM_NAME']; ?></td>
                                        <td><?php echo $dataOrdersData['QUANTITY']; ?></td>
                                        <td><?php echo $dataOrdersData['PRICE']; ?> &#8377;</td>
                                        <td><?php echo $dataOrdersData['ORDER_SUBTOTLE']; ?> &#8377;</td>
                                    </tr>
                                <?php
                                }
                                ?>
                                <tr>
                                    <th class="bill-table-heading" colspan="4">Totle</th>
                                    <td><?php echo $dataBill['SUBTOTLE'] ?> &#8377;</td>
                                </tr>
                                <tr>
                                    <th class="bill-table-heading" colspan="4">GST(18%)</th>
                                    <td><?php echo $dataBill['GST'] ?> &#8377;</td>
                                </tr>
                                <tr>
                                    <th class="bill-table-heading" colspan="4">Payable Amount</th>
                                    <td><?php echo $dataBill['FINAL_AMOUNT'] ?> &#8377;</td>
                                </tr>
                            </table>
                            <div class="bill-btn">
                                <?php
                                if (!$dataBill['BILL_STATUS']) {
                                ?>
                                    <a href="payment.php?billNo=<?php echo $dataBill['BILL_NO']; ?>&tableNo=<?php echo $dataBill['TABLE_NO']; ?>&position=<?php echo $data['FNAME'] . " " . $data['LNAME']; ?>" class="paymentBtn">Payment Done</a>
                                <?php
                                }
                                ?>
                                <p class="closeBtn" onclick="hideElement('bill-outer<?php echo $dataBill['BILL_NO']; ?>')">close</p>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>

        <div id="setting" class="tab">
            <div class="heading">
                <h1>Setting</h1>
                <h6>View/Update Proflile</h6>
            </div>

            <div class="edit-profile">
                <div class="profile-photo">
                    <img src="<?php echo "../source/profile_photos/" . $data['PHOTO']; ?>" alt="">
                    <div class="profile-photo-btn">
                        <button id="changePhotoBtn" onclick="selectFile()">Change Photo</button>
                        <a href="removePhoto.php" id="removePhotoBtn">
                            <div><i class='bx bx-trash removeBtn'></i> Remove</div>
                        </a>
                    </div>
                </div>
                <p class="profile-recmmend">select squre photo maximum 256×256px recommended</p>
                <form id="profile-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" method="post">
                    <div>
                        <label for="fname" pattern="[A-Z, a-z]*">First Name</label>
                        <input type="text" name="fname" id="fname" value="<?php echo $data["FNAME"]; ?>">
                        <p class="error"><?php echo $fnameError; ?></p>
                    </div>
                    <div>
                        <label for="lname" pattern="[A-Z, a-z]*">Last Name</label>
                        <input type="text" name="lname" id="lname" value="<?php echo $data["LNAME"]; ?>">
                        <p class="error"><?php echo $lnameError; ?></p>
                    </div>
                    <div>
                        <label for="phone" pattern="[[0-9]{10}]*">Phone</label>
                        <input type="tel" name="phone" id="phone" value="<?php echo $data["PHONE"]; ?>">
                        <p class="error"><?php echo $phoneError; ?></p>
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?php echo $data["EMAIL"]; ?>">
                        <p class="error"><?php echo $emailError; ?></p>
                    </div>
                    <input type="file" id="fileSelector" name="photo">
                    <div class="profile-update-btn">
                        <button type="submit" name="updateProfileBtn" id="updateBtn">Update</button>
                        <div id="changePassBtn" onclick="showElement('changePassOuter')">Change Password</div>
                    </div>
                </form>
                <div class="profile-success">
                    <p><?php echo $profileFormInfo; ?></p>
                </div>
            </div>

            <div id="changePassOuter">
                <form method="get" id="ChangePassForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                    <i class='bx bx-x-circle' onclick="hideElement('changePassOuter')"></i>
                    <h2>Change Passsword</h2>
                    <div>
                        <input type="password" placeholder="Current password" name="cpass" required>
                    </div>
                    <div>
                        <input type="password" placeholder="New password" name="newpass" required>
                    </div>
                    <div>
                        <input type="password" placeholder="Re-enter password" name="repass" id="repass" required>
                    </div>
                    <input id="ChangeBtn" type="submit" value="Change" name="changeBtn">
                </form>
            </div>
        </div>

        <div id="msg">
            <div id="msgLineOuter">
                <div id="proccessBar"></div>
                <p id="msgLine"></p>
            </div>
        </div>
    </section>



    <!-- ------------------- SCRIPT-------------------- -->
    <script type="text/javascript">
        /************** PRE LOADER ***********/

        function loading() {
            var myVar = setTimeout(showPage, 3200);
        }

        function showPage() {
            document.getElementById("loader").style.display = "none";
        }

        let sidebar = document.querySelector(".sidebar");
        let closeBtn = document.querySelector("#btn");
        let searchBtn = document.querySelector(".bx-search");

        closeBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
            menuBtnChange(); //calling the function(optional)
        });


        // following are the code to change sidebar button(optional)
        function menuBtnChange() {
            if (sidebar.classList.contains("open")) {
                closeBtn.classList.replace("bx-menu", "bx-menu-alt-right"); //replacing the iocns class
            } else {
                closeBtn.classList.replace("bx-menu-alt-right", "bx-menu"); //replacing the iocns class
            }
        }

        //accessing tab
        function activeTab(event, tabName, id, id2) {
            var tab = document.getElementsByClassName("tab");
            for (var i = 0; i < tab.length; i++) {
                tab[i].style.display = "none";
            }

            var link = document.getElementsByClassName("sidebarLink")
            for (var i = 0; i < link.length; i++) {
                link[i].className = link[i].className.replace(" sidebarLinkActive", "");
            }
            document.getElementById(tabName).style.display = "block";
            document.getElementById(id).className += " sidebarLinkActive";
            document.getElementById(id2).className += " sidebarLinkActive";
        }

        function showElement(elementId) {
            var element = document.getElementById(elementId);
            fade(element);

            function fade(element) {
                var op = 0.1; // initial opacity
                var timer = setInterval(function() {
                    if (op > 1) {
                        clearInterval(timer);
                    }
                    element.style.display = 'flex';
                    element.style.opacity = op;
                    element.style.filter = 'alpha(opacity=' + op * 100 + ")";
                    op += op * 0.2;
                }, 2);
            }
        }

        function hideElement(elementId) {
            var element = document.getElementById(elementId);
            fade(element);

            function fade(element) {
                var op = 1; // initial opacity
                var timer = setInterval(function() {
                    if (op <= 0.1) {
                        clearInterval(timer);
                        element.style.display = 'none';
                    }
                    element.style.opacity = op;
                    element.style.filter = 'alpha(opacity=' + op * 100 + ")";
                    op -= op * 0.1;
                }, 5);
            }
        }

        function showMsg(msg, color) {
            var msgLineOuter = document.getElementById("msgLineOuter");
            var msgLine = document.getElementById("msgLine");
            msgLine.innerText = msg;
            proccessBar(color);

        }

        function proccessBar(color) {
            var bar = document.getElementById("proccessBar");
            bar.style.backgroundColor = color
            proccess(bar);

            function proccess(element) {
                var width = 1; // initial opacity
                var timer = setInterval(function() {
                    if (width >= 100) {
                        clearInterval(timer);
                        msgLineOuter.style.display = "none";
                    } else {
                        msgLineOuter.style.display = "block";
                        width++;
                        element.style.width = width + '%';
                    }
                }, 60);
            }
        }

        function selectFile() {
            document.getElementById("fileSelector").click();
        }
    </script>
</body>

</html>