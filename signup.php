<?php ob_start(); ?>
<?php require "connect.php" ?>

<?php
$fnameErr = $lnameErr = $emailIdErr = $hphoneErr = $cphoneErr = $unameErr = $passwdErr = $unameExistsErr = $msg = "";
$fname = $lname = $emailId = $hphone = $cphone = $passwd = $confirmpasswdErr = "";
$dbrow = "";
$submiterr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["firstname"])) {
        $fnameErr = "required.";
    } else {
        $fname = clean($_POST["firstname"]);
    }

    if (empty($_POST["lastname"])) {
        $lnameErr = "required.";
    } else {
        $lname = clean($_POST["lastname"]);
    }

    if (empty($_POST["email"])) {
        $emailIdErr = "required.";
    } else {
        $emailId = clean($_POST["email"]);
    }

    if (empty($_POST["hphone"])) {
        $hphoneErr = "required.";
    } else {
        $hphone = clean($_POST["hphone"]);
    }

    if (empty($_POST["cell"])) {
        $cphoneErr = "required.";
    } else {
        $cphone = clean($_POST["cell"]);
    }

    if (empty($_POST["password"])) {
        $passwdErr = "required.";
    } else {
        $passwd = clean($_POST["password"]);
    }
    if (empty($_POST["confirm_password"])) {
        $confirmpasswdErr = "required.";
    } else {
        $confirmpasswd = clean($_POST["confirm_password"]);
    }
    if ($passwd != $confirmpasswd) {
        //echo "not matching";
        //echo "passwords did not macth!"
        $confirmpasswdErr = "passwords do not match.";
        $submiterr = "passwords do not match";
        // return;
    }

    if ($emailId != '' && $passwd != '') {
        // $passwd = password_hash($passwd, PASSWORD_DEFAULT);               
        $conn = new mysqli($servername, $username, $password, $dbname);
        $msg = "Connected successfully";
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $user = "SELECT * from usertable WHERE email='$emailId';";
        $userQuery = $conn->query($user);
        if ($userQuery->num_rows > 0) {
            //user exists
            $submiterr = "Username already exists!";
        }
        if ($submiterr == "") {
            //echo  $guid;
            $sql = "INSERT INTO usertable(fname, lname, email, address, hphone, cphone, password) VALUES  ('$fname', '$lname', '$emailId', '$address', '$hphone', '$cphone','$passwd')";

            if ($conn->query($sql) === TRUE) {
                $sqluser = "SELECT * FROM usertable where email='$emailId' and password='$passwd'";
                $sqluserres = $conn->query($sqluser);
                if ($sqluserres->num_rows > 0) {
                    //$data=$sqlproductsres->fetch_assoc();  
                    // $emailId=$sqluserres->fetch_assoc();
                    // $emailId=$emailId["id"];
                    //echo "New record created successfully";
                    header("location: login.php");
                    exit();
                }
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        $conn->close();
    }
}
function clean($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <title>Bootstrap Simple Login Form with Blue Background</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        body {
            color: #fff;
            background: #3598dc;
            font-family: 'Roboto', sans-serif;
        }

        .form-control {
            height: 41px;
            background: #f2f2f2;
            box-shadow: none !important;
            border: none;
        }

        .form-control:focus {
            background: #e2e2e2;
        }

        .form-control,
        .btn {
            border-radius: 3px;
        }

        .signup-form {
            width: 400px;
            margin: 30px auto;
        }

        .signup-form form {
            color: #999;
            border-radius: 3px;
            margin-bottom: 15px;
            background: #fff;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }

        .signup-form h2 {
            color: #333;
            font-weight: bold;
            margin-top: 0;
        }

        .signup-form hr {
            margin: 0 -30px 20px;
        }

        .signup-form .form-group {
            margin-bottom: 20px;
        }

        .signup-form input[type="checkbox"] {
            margin-top: 3px;
        }

        .signup-form .row div:first-child {
            padding-right: 10px;
        }

        .signup-form .row div:last-child {
            padding-left: 10px;
        }

        .signup-form .btn {
            font-size: 16px;
            font-weight: bold;
            background: #3598dc;
            border: none;
            min-width: 140px;
        }

        .signup-form .btn:hover,
        .signup-form .btn:focus {
            background: #2389cd !important;
            outline: none;
        }

        .signup-form a {
            color: #fff;
            text-decoration: underline;
        }

        .signup-form a:hover {
            text-decoration: none;
        }

        .signup-form form a {
            color: #3598dc;
            text-decoration: none;
        }

        .signup-form form a:hover {
            text-decoration: underline;
        }

        .signup-form .hint-text {
            padding-bottom: 15px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="signup-form">
        <form action="signup.php" method="post">
            <h2>Sign Up</h2>
            <p>Please fill in this form to create an account!</p>
            <hr>
            <div class="form-group">
                <div class="row">
                    <div class="col"><input type="text" class="form-control" name="firstname" placeholder="First Name" required="required"></div>
                    <div class="col"><input type="text" class="form-control" name="lastname" placeholder="Last Name" required="required"></div>
                </div>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required="required">
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control  input-lg" id="hphone" name="hphone" placeholder="Home Phone" required>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="cell" name="cell" placeholder="Cell Phone" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg">Sign Up</button>
            </div>
        </form>

        <?php
        if ($submiterr == "") {
            echo '<button type="submit" class="btn btn-success btn-lg btn-block signup-btn">Sign Up</button>';
        } else {
            if ($submiterr == "passwords do not match") {
                echo '<label style="color:red;">' . $submiterr . '</label>';
                echo '<button type="submit" class="btn btn-success btn-lg btn-block signup-btn">Sign Up</button>';
            }
        }
        ?>
        <div class="hint-text">Already have an account? <a href="login.php">Login here</a></div>
    </div>
</body>

</html>