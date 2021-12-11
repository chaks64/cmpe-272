<?php ob_start(); ?>
<?php require "connect.php" ?>
<?php
    $unameErr = $passwdErr = $msg = "";
    $uname = $passwd = "";
    $error = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $uname = $_POST["email"];
        $passwd = $_POST["password"];
        if (empty($uname)) {
          $unameErr = "Email is required";
        } 
        // else {
        //   $uname = clean($_POST["email"]);
        // }

        if (empty($passwd)) {
          $passwdErr = "Password is required";
        } 
        // else {
        //   $passwd = clean($_POST["password"]);
        // }

        if($uname != '' && $passwd != '') {	
          
          // Create connection
          $conn = new mysqli($servername, $username, $password, $dbname);
          //$msg2= "Connected successfully -- index --". $_SESSION["uname"]; 
          // Check connection
          if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
          }
          //echo $uname;
          //echo $passwd;
          $sql = "SELECT email,fname, password FROM usertable WHERE email = '$uname'";
          $result = $conn->query($sql);
          echo 'here after login';
          $ur=$result->fetch_assoc();     
          if ($result->num_rows > 0 && $ur["email"]==$uname && $passwd == $ur["password"] )  {
                $msg = "found";   
                echo $msg;                   
                    // //date_default_timezone_set('Asia/Kolkata');
                    // //$date = date('d-m-y h:i:s');
                    // //echo "whats";
                    // $userid=$ur["id"];
                    // //echo $userid;
                    // $guid=createGUID();
                    // //echo $guid;
                    // $sqlusstatus="SELECT * FROM marketplace.userstatus where userid=$userid;";
                    // $sqluserstatusres=$conn->query($sqlusstatus);  
                    // // print_r($res);     
                    //   //$conn->close();
                    // //print($msg);
                    // date_default_timezone_set('Asia/Kolkata');
                    // $date = date('d-m-y h:i:s');
                    // if($sqluserstatusres->num_rows>0)
                    // {
                    //   $sqlustatus="UPDATE marketplace.userstatus set status='active',logintime='$date',sessionid='$guid' where userid=$userid;";                          
                    // }
                    // else{
                    //   $sqlustatus = "INSERT INTO marketplace.userstatus VALUES  ($userid,'$uname','$date','$date','active','$guid')";
                      
                    // }
                    // //echo "wats this";
                    // $sres=$conn->query($sqlustatus);
                    // print_r($sres);                         
                    // $_SESSION["uname"] = $uname;
                    // $_SESSION["uid"] = $ur["id"];
                    // $msg= "Welcome ". $_SESSION["uname"]."! "; 
                    echo 'here after login';
                    if ($msg == "found") {
                        session_start();
                        $_SESSION["uname"] = $uname;
                       if(!isset( $_SESSION["uname"])){
                            header("location: login.php");
                       }
                       else{
                        header("location: index.html");
                       }
                        //session_unset() on logout
                      
                      exit();      
                    }
                    //$error="";
                   // //echo $_SESSION["uname"];
                  
                      
          }else{
            $error="Invalid credentials!";
          } 
          $conn->close();
        }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market Place</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #17a2b8 !important;
            height: 100vh;
        }

        #login .container #login-row #login-column #login-box {
            margin-top: 120px;
            max-width: 600px;
            height: 320px;
            border: 1px solid #9C9C9C;
            background-color: #EAEAEA;
        }

        #login .container #login-row #login-column #login-box #login-form {
            padding: 20px;
        }

        #login .container #login-row #login-column #login-box #login-form #register-link {
            margin-top: -85px;
        }
    </style>

</head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<body>
    <div id="login">
        <h3 class="text-center text-white pt-5">Login form</h3>
        <p style="color: red;"><?php echo $error; ?></p>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form action="login.php" id="login-form" class="form" method="post">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Email:</label><br>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="signup.php" class="text-info">Register here</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>