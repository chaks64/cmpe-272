<?php
$conn = mysqli_connect("localhost", "root", "", "test272");
if($conn === false){
    die("ERROR: Could not connect. " 
        . mysqli_connect_error());
}
$search = $_REQUEST['search'];
$type = $_REQUEST['type'];
if($type == 1){
$query = "SELECT * from usertable where fname like '%$search%'";
} elseif($type == 2){
  $query = "SELECT * from usertable where lname like '%$search%'";
}elseif($type == 3){  
  $query = "SELECT * from usertable where email like '%$search%'";
}elseif($type == 4){
  $query = "SELECT * from usertable where phone like '%$search%'";
}elseif($type == 5) {
  $query = "SELECT * from usertable where mobile like '%$search%'";
} 
$result = mysqli_query($conn,$query);
$users = mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);


if(!$result){
  echo "No Data found";
}
else{
  foreach($users as $user){
?>
  <link href="https://fonts.googleapis.com/css?family=Montserrat|Ubuntu" rel="stylesheet">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="css/styles.css">

<script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <div class="row">
          <div class="feature-box col-lg-2">
          <i class="fas fa-building fa-4x pb-3"></i>
          <h3 class="feature-title cont-last">
          <?php
            echo htmlspecialchars($user['fname']);
            //echo htmlspecialchars($type);

                ?></h3>
          </div>

          <div class="feature-box col-lg-2">
          <i class="fas fa-building fa-4x pb-3"></i>
          <h3 class="feature-title cont-last">
          <?php
            echo htmlspecialchars($user['lname']);
            //echo htmlspecialchars($type);

                ?></h3>
          </div>

          <div class="feature-box col-lg-2">
          <i class="fas fa-envelope-open fa-4x pb-3"></i>
          <h3 class="feature-title cont-last">
          <?php
            echo htmlspecialchars($user['email']);
                ?></h3>
        </div>

        <div class="feature-box col-lg-2">
        <i class="bcon fas fa-phone fa-4x pb-3"></i>
          <h3 class="feature-title cont-last">
          <?php
            echo htmlspecialchars($user['address']);

                ?></h3>
        </div>

        <div class="feature-box col-lg-2">
        <i class="fab fa-whatsapp fa-4x pb-3"></i>
          <h3 class="feature-title cont-last">
          <?php
            echo htmlspecialchars($user['phone']);

                ?></h3>
        </div>

        <div class="feature-box col-lg-2">
        <i class="bcon fas fa-phone fa-4x pb-3"></i>
          <h3 class="feature-title cont-last">
          <?php
            echo htmlspecialchars($user['mobile']);

                ?></h3>
        </div>

      </div>
<?php
}}
?>