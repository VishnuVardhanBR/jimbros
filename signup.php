<?php
$result = false;
$showError = false;
$alreadyExistsError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  require 'partials/_dbconnect.php';
  $username = $_POST['username'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];
  //print_r($_POST);
  $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
  if (mysqli_num_rows(mysqli_query($conn, $sql)) >= 1) {
    $alreadyExistsError = true;
  } else {
    if (($password == $cpassword)) {
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      $sql = "INSERT INTO `users` (`username`, `password`, `date`) VALUES ('$username', '$hashedPassword', CURRENT_TIMESTAMP);";
      $result = mysqli_query($conn, $sql);
    } else {
      $showError = true;
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <?php require 'partials/_header.php' ?>
</head>

<body>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand mx-auto" href="index.php"><i class="fa-solid fa-dumbbell" width="30" height="24" class="d-inline-block align-text-top">
          Jim Bros
        </i></a>
    </div>
  </nav>
  <?php
  if ($alreadyExistsError) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> User already exists.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  } else if ($result) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> You can now login.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    header('refresh:2; url=/index.php');
  } else if ($showError == true) {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Error!</strong> Passwords do not match.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
  ?>
  <div class="container-fluid">
    <form style="max-width:25%" class="mt-5 mx-auto" action="/signup.php" method="POST">
      <div class="mb-3 fs-4">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label fs-4">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
        <div id="passwordHelpBlock fs-6" class="form-text">
          Your password must be 5-20 characters long, contain letters and numbers, and must not contain spaces, special characters.
        </div>
      </div>
      <div class="mb-3 fs-4">
        <label for="cpassword" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="cpassword" name="cpassword" required>
      </div>
      <button type="submit" class="btn btn-primary">Sign Up</button>
      <br>
      <label class="text-muted fs-6 mt-3"> Already have an account? <a href="/login.php">Sign in.</a> </label>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</body>

</html>
