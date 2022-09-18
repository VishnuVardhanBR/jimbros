<?php
$result = false;
require 'partials/_unauth.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'partials/_dbconnect.php';
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $gender = substr($gender, 0, 1);
    $daysperweek = $_POST['daysperweek'];

    $sno = $_SESSION['sno'];
    $sql = "INSERT INTO `phychar` (`uid`,`weight`, `height`, `age`, `gender`, `daysperweek`) VALUES ('$sno','$weight', '$height', '$age', '$gender', '$daysperweek');";
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

    <div class="col-md-3 mx-auto pt-5">
        <h1>
            New here?
            <small class="text-muted">Give us your basic details</small>
        </h1>
    </div>
    <div class="col-md-3 mx-auto mt-5">
        <form class="row g-3" action="/phychar.php" method="POST">
            <div class="col-md-6">
                <label for="weight" class="form-label" min="1" max="200">Weight (in kg)</label>
                <input type="text" class="form-control" id="weight" name="weight" required>
            </div>
            <div class="col-md-6">
                <label for="height" class="form-label" min="1">Height (in cm)</label>
                <input type="text" class="form-control" id="height" name="height" required>
            </div>
            <div class="col-md-4">
                <label for="age" class="form-label" min="1">Age</label>
                <input type="text" class="form-control" id="age" name="age" required>
            </div>
            <div class=" col-md-8">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-select" id="gender" name="gender" required>
                    <option selected disabled value="">Choose...</option>
                    <option>Male</option>
                    <option>Female</option>
                    <option>Other?</option>
                </select>
            </div>
            <label for="daysperweek" class="form-label">How many days a week do you go to the jim?</label>
            <div class="col-md-12">
                <input type="range" class="form-range" min="0" max="7" step="1" id="sliderRange" name="daysperweek" oninput="this.form.typeRange.value=this.value">
                <input type="number" class="form-control" id="typeRange" value="4" min="0" max="7" name="daysperweek" oninput="this.form.sliderRange.value=this.value"></input>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Submit form</button>
            </div>


        </form>
    </div>
</body>
