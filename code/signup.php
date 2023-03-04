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

    <title>SIGNUP</title>

</head>

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

if (isset($_REQUEST['position'])) {
    $_SESSION['position'] = $_REQUEST['position'];
    echo $_REQUEST['position'];
}

if (isset($_REQUEST['signup'])) {
    // echo "hello";
    if (empty($_REQUEST['fname'])) {
        echo '<script> window.alert("Please enter your First name.");</script>';
        echo '<script>fname.focus();</script>';
    } else if (empty($_REQUEST['lname'])) {
        echo '<script> window.alert("Please enter your Last name."); </script>';
        echo '<script>lname.focus();</script>';
    } else if (empty($_REQUEST['phone'])) {
        echo '<script> window . alert("Please enter your contact number."); </script>';
        echo '<script>phone.focus();</script>';
    } else if (empty($_REQUEST['email'])) {
        echo '<script> window . alert("Please enter a valid E-mail ID."); </script> ';
        echo '<script>email.focus();</script>';
    } else if (empty($_REQUEST['pass'])) {
        echo '<script> window . alert("Please enter your password"); </script>';
        echo '<script>pass.focus();</script>';
    } else if (empty($_REQUEST['copass'])) {
        echo '<script> window . alert("Please enter your confirmpassword"); </script>';
        echo '<script>copass.focus();</script>';
    } else if (strcmp($_REQUEST['pass'], $_REQUEST['copass'])) {
        echo '<script> window . alert("Password doesn\'t match to confirm password, Try again."); </script>';
    } else {
        // authority
        // 0 - developer
        // 1 - admin
        // 2 - waiter
        // 3 - cook

        $fname =  $_REQUEST['fname'];
        $lname = $_REQUEST['lname'];
        $phone = $_REQUEST['phone'];
        $email = $_REQUEST['email'];
        $pass = $_REQUEST['pass'];
        $positon = $_SESSION['position'];

        $sql = 'SELECT PHONE FROM REGISTER';
        $result = $conn->query($sql);
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            if ($row['PHONE'] == $phone) {
                $info = "Phone Number already exist";
                exit(1);
            }
        }

        $stmt = $conn->prepare('INSERT INTO REGISTER (FNAME, LNAME, PHONE, EMAIL, PASSWORD,  POSITION) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('ssssss', $fname, $lname, $phone, $email, $pass, $positon);
        if ($stmt->execute()) {
?>
            <script>
                window.location = "login.php";
            </script>
<?php
        }
    }
}

$conn->close();
?>

<body>
    <div id="layout">
        <div class="signup-box">
            <h1>Sign Up</h1>
            <form name="RegForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                <div class="side">
                    <div class="form-floating mb-3">
                        <input type="text" pattern="[A-Z, a-z]*" class="form-control shadow-none" id="firstname" name="fname" placeholder="First Name" required>
                        <label for="firstname">First Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" pattern="[A-Z, a-z]*" class="form-control shadow-none" id="lastname" name="lname" placeholder="Last Name" required>
                        <label for="lastname">Last Name</label>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="tel" pattern="[[0-9]{10}]*" maxlength="10" class="form-control shadow-none" id="number" name="phone" placeholder="Mobile Number" required>
                    <label for="number">Mobile Number</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control shadow-none" id="email" name="email" placeholder="Email ID" required>
                    <label for="email">Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control shadow-none" id="password" name="pass" placeholder="Password" required>
                    <label for="password">Password</label>
                </div>
                <div class="form-floating mb-2">
                    <input type="password" class="form-control shadow-none" id="confirm_pass" name="copass" placeholder="Confirm Password" required>
                    <label for="confirm_pass">Confirm Password</label>
                </div>
                <p class="error"><?php echo $info; ?></p>
                <input type="submit" value="Sign Up" name="signup">

            </form>
            <p>By clicking the Sign Up Button, you are agree to our
                <a href="#">Terms and Condition</a> and <a href="#">Privacy Policy</a>
            </p>
            <p>Already have an Account? <a href="login.html">Login</a></p>
        </div>
    </div>

    <script>
        var fname = document.forms["RegForm"]["fname"];
        var lname = document.forms["RegForm"]["lname"];
        var pass = document.forms["RegForm"]["password"];
        var copass = document.forms["RegForm"]["confirmpassword"];
        var phone = document.forms["RegForm"]["phone"];
        var email = document.forms["RegForm"]["email"];
    </script>
</body>

</html>