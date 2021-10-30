<!DOCTYPE html>
<html>
  
<head>
    <title>Insert Page page</title>
</head>
  
<body>
    <center>
        <?php
        $conn = mysqli_connect("localhost", "root", "", "test272");
        if($conn === false){
            die("ERROR: Could not connect. " 
                . mysqli_connect_error());
        }
          
        // Taking all 5 values from the form data(input)
        $fname =  $_REQUEST['fname'];
        $lname = $_REQUEST['lname'];
        $email = $_REQUEST['email'];
        $address =  $_REQUEST['address'];
        $home = $_REQUEST['home'];
        $phone = $_REQUEST['phone'];
          
        // Performing insert query execution
        // here our table name is college
        $sql = "INSERT INTO usertable  VALUES ('$fname','$lname','$email','$address','$home','$phone')";
          
        if(mysqli_query($conn, $sql)){
            echo "<h3>data stored in a database successfully." 
                . " Please browse your localhost php my admin" 
                . " to view the updated data</h3>"; 
  
            echo nl2br("\n$fname\n $lname\n "
                . "$address\n $home\n $phone");
        } else{
            echo "ERROR: Hush! Sorry $sql. " 
                . mysqli_error($conn);
        }
          
        // Close connection
        mysqli_close($conn);
        ?>
    </center>
</body>
  
</html>