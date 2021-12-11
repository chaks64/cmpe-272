<?php require "connect.php" ?>

<script>

    console.log("herer");
</script>
<?php
$conn = new mysqli($servername, $username, $password, $dbname);

// if (isset($_POST['rate'])) {
    // Getting the value of button
    // in $btnValue variable
    $rating = $_POST['rate'];
    $review = $_POST['review'];
    $name = $_POST['prod_name'];
    $sql = "INSERT INTO rating(rating, user_id, product_name, siteID, review) VALUES  ('$rating', '2', '$name', '2', '$review', '$cphone','$passwd')";
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

    // echo "<script>console.log('" . json_encode($rating) . "');</script>";


    // $data = array(
    // 	':user_name'		=>	$_POST["user_name"],
    // 	':user_rating'		=>	$_POST["rating_data"],
    // 	':user_review'		=>	$_POST["user_review"],
    // 	':datetime'			=>	time()
    // );

    // $query = "
    // INSERT INTO review_table 
    // (user_name, user_rating, user_review, datetime) 
    // VALUES (:user_name, :user_rating, :user_review, :datetime)
    // ";

    // $statement = $connect->prepare($query);

    // $statement->execute($data);

    // echo "Your Review & Rating Successfully Submitted";

// }

?>