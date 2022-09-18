<?php
//$result = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'partials/_dbconnect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE username='$username'";
    echo $sql;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
        while ($row = mysqli_fetch_row($result)) {
            //echo print_r($row);
            if (password_verify($password, $row['2'])) {
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                $sno = $row['0'];
                $_SESSION['sno'] = $sno;
            } else {
                $showError = true;
            }
        }
    } else {
        $showError = true;
    }
    if ($login) {
        $sql = "SELECT * FROM phychar WHERE uid='$sno'";

        $result = mysqli_query($conn, $sql);
        echo print_r(mysqli_num_rows($result));
        if (mysqli_num_rows(mysqli_query($conn, $sql)) == 0) {
            header("location: phychar.php");
        } else {
            header("location: main.php");
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
    if ($showError == true) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> Incorrect username/ password.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }
    ?>
    <div class="container-fluid">
        <form style="max-width:25%" class="mt-5 mx-auto" action="/login.php" method="POST">
            <div class="mb-3 fs-4">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3 fs-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <br>
            <label class="text-muted fs-6 mt-3"> New here? <a href="/signup.php">Create an account.</a> </label>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</body>

</html>
