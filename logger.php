<?php
$result = false;
require 'partials/_unauth.php';
$sno = $_SESSION['sno'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  require 'partials/_dbconnect.php';
  if ($_POST['weight'] != "") {
    $weight = $_POST['weight'];
  } else {
    $sql = "SELECT * FROM phychar WHERE uid='$sno'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result);
    $weight = $row['2'];
  }
  $sql = "SELECT * FROM phychar WHERE uid='$sno'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_row($result);
  $height = $row['3'];
  $bmi = ($weight / ($height * $height));
  $workouttime = $_POST['workouttime'];
  $caloriein = $_POST['caloriein'];
  $calorieburn = $_POST['calorieburn'];
  $sql = "INSERT INTO `dailylog` (`uid`,`weight`, `workouttime`, `caloriein`, `calorieburn`, `bmi`) VALUES ('$sno', '$weight', '$workouttime', '$caloriein', '$calorieburn', '$bmi');";
  $result = mysqli_query($conn, $sql);
  //echo $sql;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  //session_start();
  require 'partials/_header.php' ?>
</head>

<body>
  <?php require 'partials/_nav.php';
  if ($result) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Data inserted.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    header('refresh:2; url=/main.php');
  }
  ?>

  <div class="col-md-6 mx-auto pt-5">
    <h1 class="text-center">
      Today's updates.
      <small class="text-muted">Log your progress</small>
    </h1>
  </div>
  <div class="col-md-3 mx-auto">
    <form class="row g-3" action="/dailylog.php" method="POST">
      <div class="col-md-10">
        <label for="weight" class="form-label" min="1" max="200">Weight (in kg)</label>
        <input type="text" class="form-control" id="weight" placeholder="" name="weight">
      </div>
      <div class="col-md-10">
        <label for="workouttime" class="form-label" min="1">Workout time (in minutes)*</label>
        <input type="text" class="form-control" id="workouttime" name="workouttime" required>
      </div>
      <div class="col-md-5">
        <label for="caloriein" class="form-label" min="1">Calories intake*</label>
        <input type="text" class="form-control" id="caloriein" name="caloriein" required>
      </div>
      <div class="col-md-5">
        <label for="calorieburn" class="form-label" min="1">Calories burnt*</label>
        <input type="text" class="form-control" id="calorieburn" name="calorieburn" required>
      </div>
      <div class="col-12">
        <button class="btn btn-primary" type="submit">Log</button>
      </div>


    </form>
  </div>
</body>
