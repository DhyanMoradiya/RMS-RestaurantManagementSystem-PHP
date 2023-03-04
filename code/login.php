<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="shortcut icon" href="../source/fevicon.ico" type="image/x-icon">

    <title>LOGIN</title>

</head>

<body>

    <div id="layout">
        <div class="signup-box signin-box">
            <h1>Sign In</h1>
            <form name="RegForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                <div class="form-floating mb-3">
                    <input type="tel" class="form-control shadow-none" id="phone" placeholder="Phone" name="phone">
                    <label for="phone">Mobile Number</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control shadow-none" id="password" placeholder="Password" name="pass">
                    <label for="password">Password</label>
                </div>
                <input type="submit" value="Sign In" name="signin" onclick="Registrationform()">
            </form>
        </div>
    </div>

    <?php
    session_start();
    $info = "";

    // connecting to database
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $dbname  = 'RMS';

    $conn = new mysqli($server, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_REQUEST['signin'])) {
        if (empty($_REQUEST['phone'])) {
    ?>
            <script>
                window.alert("Please enter your contact number.");
                phone.focus();
            </script>
        <?php
        } else if (empty($_REQUEST['pass'])) {
        ?>
            <script>
                window.alert("Please enter your password");
                pass.focus();
            </script>
            <?php
        } else {
            // authority
            // 0 - developer
            // 1 - admin
            // 2 - waiter
            // 3 - cook

            $phone = $_REQUEST['phone'];
            $pass = $_REQUEST['pass'];

            $sql = "SELECT * FROM REGISTER WHERE PHONE=$phone AND PASSWORD='$pass'";
            $result = $conn->query($sql);
            $rowCount = mysqli_num_rows($result);

            if ($rowCount == 1) {
                $_SESSION['userPhone'] = $phone;
                // header("Location : dashboard.php");
            ?>
                <script>
                    window.location = "dashboard.php";
                </script>
    <?php
            } else {
                $info = "Invalid User Credentials !";
            }
        }
    }
    $conn->close();
    ?>



    <script>
        var password = document.forms["RegForm"]["password"];
        var email = document.forms["RegForm"]["email"];
    </script>
</body>

</html>