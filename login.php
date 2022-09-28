<?php
//$result = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'partials/_dbconnect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE username='$username'";
    //echo $sql;
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript">
        window.onload = function() {
            OpenBootstrapPopup();
        };

        function OpenBootstrapPopup() {
            $("#myModal").modal('show');
        }
    </script>
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
    <div id="myModal" class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Attention!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    This is just a project and not an actual product. Please do not enter any sensitive information in any of the fields. Do not enter a password that you have used on other sites.
                </div>
            </div>
        </div>
    </div>
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


</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>

</html>
