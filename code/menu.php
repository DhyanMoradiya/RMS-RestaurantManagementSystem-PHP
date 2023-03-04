<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/menu.css">

    <link rel="shortcut icon" href="../source/fevicon.ico" type="image/x-icon">

    <title>Menu</title>
</head>

<body onload="loading()">

    <!---------- PRE LOADER----------->
    <!-- <div id="loader">
    <img src="..\source\Restaurant_Logo.webp" />
  </div> -->




    <!---------- Menu----------->
    <?php
    session_start();


    // STATUS
    // 0 - Pending
    // 1 - Ordered
    // 2 - Cooking 
    // 3 - Ready
    // 4 - Serverd


    // connecting to database
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $dbname  = 'RMS';

    $conn = new mysqli($server, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    date_default_timezone_set("Asia/Kolkata");  //India time (GMT+5:30)

    if (isset($_REQUEST['tableNo'])) {
        $_SESSION['tableNo'] = $_REQUEST['tableNo'];
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


    ?>
    <div class="menu">
        <section class="list">
            <h3 class="heading">JSK Restaurant</h3>
            <?php
            // fetching categorys
            $sqlCategory = "SELECT DISTINCT CATEGORY FROM MENU";
            $result = $conn->query($sqlCategory);
            while ($categoryData = $result->fetch_array(MYSQLI_ASSOC)) {
                $sqlNum = "SELECT * FROM MENU WHERE CATEGORY='" . $categoryData['CATEGORY'] . "'";
                $resultNum = $conn->query($sqlNum);
                $num = mysqli_num_rows($resultNum);
            ?>
                <a href="#<?php echo $categoryData['CATEGORY']; ?>" class="listlink linklistActive" id="list_<?php echo $categoryData['CATEGORY']; ?>" onclick="activeLink('list_<?php echo $categoryData['CATEGORY']; ?>')">
                    <p><?php echo $categoryData['CATEGORY']; ?></p>
                    <p class="number"><?php echo $num; ?></p>
                </a>
                <!-- <div class="listdesign"></div> -->
            <?php
            }
            ?>
            <img src="../source/Restaurant_Logo_Short.webp" alt="" class="logo">
        </section>
        <section class="items">
            <?php
            if (isset($_SESSION['tableNo'])) {
            ?>
                <a href="dashboard.php" class="dashboardLink">Dashboar</a>
            <?php
            
            // Fetching table info 
            $sqlTables = "SELECT * FROM TABLES WHERE TABLE_NO ='" . $_SESSION['tableNo'] . "'";
            $resultTables = $conn->query($sqlTables);
            $dataTables = $resultTables->fetch_array(MYSQLI_ASSOC);
            if ($dataTables['TABLE_STATUS']) {
                $sqlOrders = "SELECT DISTINCT BILL_NO FROM ORDERS ORDER BY BILL_NO ASC";
                $resultOrders = $conn->query($sqlOrders);
                while ($dataOrders = $resultOrders->fetch_array((MYSQLI_ASSOC))) {
                    $billNo = $dataOrders['BILL_NO'];
                }
                $billNo++;

            } else {
                $sqlOrders = "SELECT DISTINCT BILL_NO FROM ORDERS WHERE TABLE_NO = " . $_SESSION['tableNo'] . " ORDER BY BILL_NO ASC";
                $resultOrders = $conn->query($sqlOrders);
                while ($dataOrders = $resultOrders->fetch_array((MYSQLI_ASSOC))) {
                    $billNo = $dataOrders['BILL_NO'];
                }
            }
        }

            // fetching categorys
            $sqlCategory = "SELECT DISTINCT CATEGORY FROM MENU";
            $result = $conn->query($sqlCategory);
            $a = 1;
            while ($categoryData = $result->fetch_array(MYSQLI_ASSOC)) {
            ?>
                <p class="categoryHeading" id="<?php echo $categoryData['CATEGORY']; ?>"><?php echo $categoryData['CATEGORY']; ?></p>

                <div class="menuItem">
                    <?php
                    // faching info as pr category
                    $sqlItem = "SELECT * FROM MENU WHERE CATEGORY='" . $categoryData['CATEGORY'] . "'";
                    $resultItem = $conn->query($sqlItem);
                    while ($itemData = $resultItem->fetch_array(MYSQLI_ASSOC)) {
                    ?>
                        <div class="food">
                            <?php
                            // displaying food image
                            if (!is_dir("../source/menu_image/'" . $itemData['IMAGE'] . "'")) {
                            ?>
                                <img src="<?php echo "../source/menu_image/" . $itemData['IMAGE']; ?>" alt="IMG" class="foodimg">
                            <?php
                            } else {
                            ?>
                                <img src="../source/Restaurant_Logo_Short.webp" alt="" class="foodimg">
                            <?php
                            }
                            ?>
                            <div class="fooddetail">
                                <p class="foodname"><?php echo $itemData['ITEM_NAME']; ?></p>
                                <p class="price"><?php echo $itemData['PRICE']; ?> &#8377;</p>

                                <div class="addOption">
                                    <?php
                                    // setting button for add item
                                    // $_SESSION['position'] = 2;
                                    // session_unset();
                                    if (isset($_SESSION['tableNo'])) {
                                        //Sending data to cart table 
                                        if (isset($_REQUEST['addToCartBtn' . $a])) {
                                            $tableNo = $_SESSION['tableNo'];
                                            $itemName = $itemData['ITEM_NAME'];
                                            $quantity = $_REQUEST['itemQuantity' . $a];
                                            $price = $itemData['PRICE'];
                                            $orderSubtotle = $itemData['PRICE'] * $quantity;

                                            $sqlAddToCart = "INSERT INTO ORDERS (TABLE_NO, BILL_NO, ITEM_NAME, QUANTITY, PRICE, ORDER_SUBTOTLE) VALUES ($tableNo, $billNo, '$itemName', $quantity, $price, $orderSubtotle)";
                                            if ($conn->query($sqlAddToCart)) {
                                                if ($dataTables['TABLE_STATUS']) {
                                                    $sqlTableStatusUpdate = "UPDATE TABLES SET TABLE_STATUS = 0 WHERE TABLE_NO = '" . $_SESSION['tableNo'] . "'";
                                                    $conn->query($sqlTableStatusUpdate);
                                                    $sqlInsertBillNo = "INSERT INTO BILL (BILL_NO, TABLE_NO) VALUES ($billNo ,". $_SESSION['tableNo'].")";
                                                    $conn->query($sqlInsertBillNo);
                                                }
                                            }
                                        }
                                    ?>
                                        <button class="addBtn1" id="addBtn<?php echo $a; ?>" onclick="showElement('add-outer<?php echo $a; ?>')">ADD</button>
                                    <?php
                                    }
                                    ?>
                                </div>

                                <div id="add-outer<?php echo $a; ?>" class="add-outer">
                                    <div class="add-card">
                                        <img src="<?php echo "../source/menu_image/" . $itemData['IMAGE']; ?>" alt="" class="add-card-food-image">
                                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" class="addForm">
                                            <div class="card-food-detail">
                                                <p class="card-food-name"><?php echo $itemData['ITEM_NAME']; ?></p>
                                                <p class="price"><?php echo $itemData['PRICE']; ?> &#8377;</p>
                                            </div>
                                            <div class="quantityBtns">
                                                <div class="addingBtn" onclick="minusIncrese('itemCount<?php echo $a; ?>')">–</div>
                                                <input type="number" name="itemQuantity<?php echo $a; ?>" value=1 id="itemCount<?php echo $a; ?>">
                                                <div class="addingBtn" onclick="addIncrese('itemCount<?php echo $a; ?>')">+</div>
                                            </div>
                                            <div class="submitBtns">
                                                <div class="add-outer-close" onclick="hideElement('add-outer<?php echo $a; ?>')">×</div>
                                                <button type="submit" class="addingBtn addBtn2" name="addToCartBtn<?php echo $a; ?>">ADD TO ORDER</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php
                        $a++;
                    }
                    ?>
                </div>
            <?php
            }
            ?>

            <!--------------------- Cart ------------------->
            <?php
            if (isset($_SESSION['tableNo'])) {
            ?>
                <div id="cart">
                    <div class="cartTop">
                        <p>Order Details</p>
                        <i class='bx bxs-x-circle' onclick="showFullcart()"></i>
                    </div>
                    <div class="cartList">
                        <?php
                        $tableNo = $_SESSION['tableNo'];
                        $sqlGetFromCart = "SELECT * FROM ORDERS WHERE TABLE_NO = $tableNo AND BILL_NO = $billNo";
                        $resultCart = $conn->query($sqlGetFromCart);
                        $lineCount = 0;
                        $cartTotal = 0;
                        while ($cartData = $resultCart->fetch_array(MYSQLI_ASSOC)) {
                            $lineCount++;
                            $sqlMenu = "SELECT * FROM MENU WHERE ITEM_NAME='" . $cartData['ITEM_NAME'] . "'";
                            $resultMenu = $conn->query($sqlMenu);
                            $menuData = $resultMenu->fetch_array(MYSQLI_ASSOC);
                        ?>
                            <div>
                                <p class="cartListName"><?php echo $menuData['ITEM_NAME']; ?></p>
                                <div class="cartListPrice">
                                    <p><?php echo $cartData['QUANTITY'] . " × " . $menuData['PRICE']; ?></p>
                                    <?php
                                    if ($cartData['STATUS'] == 0) {
                                    ?>
                                        <p class="status pending"><?php echo statusToString($cartData['STATUS']); ?></p>
                                    <?php
                                    } else if ($cartData['STATUS'] == 1) {
                                    ?>
                                        <p class="status ordered"><?php echo statusToString($cartData['STATUS']); ?></p>
                                    <?php
                                    } else if ($cartData['STATUS'] == 2) {
                                    ?>
                                        <p class="status cooking"><?php echo statusToString($cartData['STATUS']); ?></p>
                                    <?php
                                    } else if ($cartData['STATUS'] == 3) {
                                    ?>
                                        <p class="status ready"><?php echo statusToString($cartData['STATUS']); ?></p>
                                    <?php
                                    } else if ($cartData['STATUS'] == 4) {
                                    ?>
                                        <p class="status served"><?php echo statusToString($cartData['STATUS']); ?></p>
                                    <?php
                                    }
                                    ?>
                                    <a href="removeFromCart.php?orderNo=<?php echo $cartData['ORDER_NO']; ?>&tableNo=<?php echo $cartData['TABLE_NO']; ?>&itemName=<?php echo $cartData['ITEM_NAME']; ?>&quantity=<?php echo $cartData['QUANTITY']; ?>&bilNo=<?php echo $billNo;?>">
                                        <?php
                                        if ($cartData['STATUS'] < 1) {
                                        ?>
                                            <i class='bx bx-trash'></i>
                                        <?php
                                        }
                                        ?>
                                    </a>
                                </div>
                            </div>
                        <?php
                            $cartSubtotle = $cartData['QUANTITY'] * $menuData['PRICE'];
                            $cartTotal += $cartSubtotle;
                        }
                        ?>
                    </div>
                </div>

                <div id="cartLine">
                    <div>
                        <i class='bx bx-chevron-up-circle' id="cartIcon" onclick="showFullcart()"></i>
                        <p class="orderText">Orders (<?php echo $lineCount; ?>)</p>
                    </div>
                    <div>
                        <p class="amountText">Total: <b><?php echo $cartTotal; ?> &#8377;</b></p>
                        <a href="order.php?tableNo=<?php echo $tableNo; ?>&billNo=<?php echo $billNo; ?>" class="continueBtn">Order</a>
                    </div>
                </div>
            <?php
            }
            ?>
        </section>
    </div>


    <!----------- footer section --------------->
    <!-- <footer id="footer">
    <div class="footer-text">
      <p>© JSK Restaurant. All Rights Reserved</p>
      <div id="footer-links">
        <a href="#home" class="footer-link">Home</a>
        <div class="footer-design"></div>
        <a href="#aboutUs" class="footer-link">About</a>
        <div class="footer-design"></div>
        <a href="#contectUs" class="footer-link">Contect</a>
        <div class="footer-design"></div>
        <a href="login.html" class="footer-link">Login</a>
      </div>
    </div>
    <div id="footer-social-media">
      <a href="https://www.facebook.com">
        <img src="..\source\social media png\facebook.png" alt="facebook">
      </a>
      <a href="https://www.whatsapp.com">
        <img src="..\source\social media png\whatsapp.png" alt="linkedin">
      </a>
      <a href="https://www.instagram.com">
        <img src="..\source\social media png\instagram.png" alt="instagram">
      </a>
      <a href="https://www.twitter.com">
        <img src="..\source\social media png\twitter.png" alt="twitter">
      </a>
    </div>
  </footer> -->



    <!-- ------------------- SCRIPT-------------------- -->
    <script>
        /************** PRE LOADER ***********/
        function loading() {
            var myVar = setTimeout(showPage, 1600);
        }

        function showPage() {
            document.getElementById("loader").style.display = "none";
        }

        /************** LILNK ACTIVATION ***********/
        function activeLink(id) {
            var listLinks = document.getElementsByClassName("listlink");
            for (var i = 0; i < listLinks.length; i++) {
                listLinks[i].className = listLinks[i].className.replace(" listlinkActive", "");
            }
            document.getElementById(id).className += " listlinkActive";
        }

        function addIncrese(itemCountId) {
            document.getElementById(itemCountId).value = Number(document.getElementById(itemCountId).value) + 1;
        }

        function minusIncrese(itemCountId) {
            if (document.getElementById(itemCountId).value > 1) {
                document.getElementById(itemCountId).value = Number(document.getElementById(itemCountId).value) - 1;
            }
        }

        function showFullcart() {
            var icon = document.getElementById("cartIcon");
            var cart = document.getElementById("cart");
            var cartLine = document.getElementById("cartLine");
            // var clearBtn = document.getElementById("clearBtn");
            var pos = 0;
            var posO = 0;
            let id = null;
            let id2 = null;

            if (icon.classList.contains("bx-chevron-up-circle")) {
                icon.className = icon.className.replace(" bx-chevron-up-circle", " bx-chevron-down-circle");
                cart.style.display = "flex";
                // clearBtn.style.display = "block";
                // cart.style["bottom"] = "55px";
                cartLine.style.backgroundColor = "rgb(226, 226, 226)";
                cartLine.style["boxShadow"] = "none";
                pos = -345;
                clearInterval(id);
                id = setInterval(fadeIn, 0.01);
            } else {
                icon.className = icon.className.replace(" bx-chevron-down-circle", " bx-chevron-up-circle");
                // cart.style.display = "none";
                // clearBtn.style.display = "none";
                // cart.style["bottom"] = "calc(-23rem + 55px)";
                cartLine.style.backgroundColor = "#fff";
                cartLine.style["boxShadow"] = "0px -2px 20px rgba(53, 53, 53, 0.1)";
                posO = 55;
                clearInterval(id2);
                id2 = setInterval(fadeOut, 5);
            }

            function fadeIn() {
                if (pos != 55) {
                    pos += 16;
                    cart.style.bottom = pos + "px";
                } else {
                    clearInterval(id);
                }
            }

            function fadeOut() {
                if (posO != -345) {
                    posO -= 16;
                    cart.style.bottom = posO + "px";
                } else {
                    clearInterval(id2);
                }
            }
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
    </script>
</body>

</html>