<?php ob_start(); ?>
<?php require "connect.php" ?>
<?php
// Create a connection 
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn) {
  // echo "ready \n"; 
} else {
  die("Error" . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $id = $_GET['id'];
  $sql = "select * from products where p_id={$id}";

  $result = mysqli_query($conn, $sql);
  if (!mysqli_num_rows($result) > 0) {
  } else {
    if (isset($_COOKIE["user_activity"])) {
      // echo "im in if";
      $cookie_data = stripslashes($_COOKIE['user_activity']);

      $cookie_data = json_decode($cookie_data, true);
    } else {
      $cookie_data = array();
    }

    $arrLength = count($cookie_data);

    while ($row = mysqli_fetch_assoc($result)) {
      $id = $row["p_id"];
      $name = $row["p_name"];
      $price = $row["price"];
      $details = $row["details"];
      // $desc = $row["description"];
      // $img = $row["img"];
    }
    $cookie_data[$arrLength] = $id;
    // echo "cookie data is ";
    // print_r($cookie_data);
    $cookie_data = json_encode($cookie_data);
    // setcookie("welcome", "welcomee", time()+2*24*60*60, '/');
    setcookie("user_activity", $cookie_data, time() + 2 * 24 * 60 * 60, '/');
  }

  mysqli_close($conn);
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  echo 'here for insert';

  $rating = $_POST['rate'];
  $review = $_POST['review'];
  $name = $_POST['prod_name'];
  $sql = "INSERT INTO rating(rating, user_id, product_name, siteID, review) VALUES  ('$rating', '3', '$name', '3', '$review')";
  if ($conn->query($sql) === TRUE) {
    //$data=$sqlproductsres->fetch_assoc();  
    // $emailId=$sqluserres->fetch_assoc();
    // $emailId=$emailId["id"];
    //echo "New record created successfully";
    header("location: index.php");
    exit();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://fonts.googleapis.com/css?family=Montserrat|Ubuntu" rel="stylesheet">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="css/styles.css">

  <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <style>
    .rate {
      float: left;
      height: 60px;
      padding: 0 10px;
    }

    .rate:not(:checked)>input {
      position: absolute;
      top: -9999px;
    }

    .rate:not(:checked)>label {
      float: right;
      width: 1em;
      overflow: hidden;
      white-space: nowrap;
      cursor: pointer;
      font-size: 30px;
      color: #ccc;
    }

    .rate:not(:checked)>label:before {
      content: '★ ';
    }

    .rate>input:checked~label {
      color: #ffc700;
    }

    .rate:not(:checked)>label:hover,
    .rate:not(:checked)>label:hover~label {
      color: #deb217;
    }

    .rate>input:checked+label:hover,
    .rate>input:checked+label:hover~label,
    .rate>input:checked~label:hover,
    .rate>input:checked~label:hover~label,
    .rate>label:hover~input:checked~label {
      color: #c59b08;
    }
  </style>
</head>

<body>
  <section class="colored-section" id="title">
    <div class="container-fluid">
      <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="index.php">tindog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="products.php">Products</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </section>

  <section class="white-section" id="pricing">

    <h2 class="section-heading">Product Details</h2>

    <div class="col">

      <div class="pricing-column col-lg-4 col-md-6">
        <div class="card">
          <div class="card-header">
            <h3><?php echo $name ?></h3>
          </div>
          <div class="card-body">
            <h2 class="price-text"><?php echo $name ?></h2>
            <p><?php echo $name ?></p>
            <a href="product1.php"><button class="btn btn-lg btn-block btn-dark" type="button">Select Service</button></a>
          </div>
        </div>
      </div>

      <form action="details.php" method="post">
        <div class="pricing-column col-lg-4 col-md-6">
          <div class="card" style="border:none;">
            <div class="rate">
              <input type="radio" id="star5" name="rate" value="5" />
              <label for="star5" title="text">5 stars</label>
              <input type="radio" id="star4" name="rate" value="4" />
              <label for="star4" title="text">4 stars</label>
              <input type="radio" id="star3" name="rate" value="3" />
              <label for="star3" title="text">3 stars</label>
              <input type="radio" id="star2" name="rate" value="2" />
              <label for="star2" title="text">2 stars</label>
              <input type="radio" id="star1" name="rate" value="1" />
              <label for="star1" title="text">1 star</label>
            </div>
            <input type="hidden" name="prod_name" id="prod_name" value="<?php echo $name ?>" />
          </div>
          <div class="card" style="border:none;">
            <div style="text-align:left;">
              <h4>Leave us a feedback</h4>
            </div>
            <textarea name="review" id="review" style="width:100%;height:80px;border-color:lightgrey;"></textarea>
            <p>
              <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
            </p>
          </div>
        </div>
      </form>

    </div>

  </section>

</body>

</html>