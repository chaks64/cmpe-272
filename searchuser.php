<?php
$conn = mysqli_connect('localhost','root', '', 'test272');
if(!$conn){
  echo 'Error ' . mysqli_connect_errno();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <style>
        select {
            text-align: center;
            appearance: none;
            outline: 0;
            background: grey;
            background-image: none;
            width: 100%;
            height: 100%;
            color: black;
            cursor: pointer;
            border:1px solid black;
            border-radius:3px;
        }
        .select {
            position: relative;
            display: block;
            width: 15em;
            height: 3em;
            line-height: 3;
            overflow: hidden;
            border-radius: .25em;
            padding-bottom:10px;
                
        }
</style>
</head>
<body>
    <center>
    <h1>Search User from anyone of the dropdown</h1>
    <form class="example" action="welcome.php" method="post">
        <div class="input-group" style="width: 50%; text-align: centerx; margin-top: 20px;">
            <input type="text" name="search" class="form-control" placeholder="Search user by first name">
            <div class="input-group-append">
            <button type="submit" class="btn btn-secondary" type="button">
                <i class="fa fa-search"></i>
            </button>
            </div>
        </div>
        <div class="select" style=" margin-top: 20px;">
            <select name="type" id="type">
                <option value="">Select Option</option>
                <option value="1">First Name</option>
                <option value="2">Last Name</option>
                <option value="3">Email</option>
                <option value="4">Home Number</option>
                <option value="5">Phone Number</option>
            </select>
        </div>
    </form>

    
    </center>

    
</body>
</html>