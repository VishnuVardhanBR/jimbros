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
    $sql = "INSERT INTO dailylog (uid,weight, workouttime, caloriein, calorieburn, bmi) VALUES ('$sno', '$weight', '$workouttime', '$caloriein', '$calorieburn', '$bmi');";
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
    <script src="js/jquery-3.6.1.min.js"></script>
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
    <div id="show_alert"></div>
    <div class="col-md-6 mx-auto pt-5">
        <h1 class="text-center">
            Today's updates.
            <small class="text-muted">Log your progress</small>
        </h1>
    </div>
    <div class="container-sm">
        <div class="row mb-3">
            <div class="col-md-6 mt-5">
                <h1 class="text-start my-4">
                    Basic Stats.
                </h1>
                <form class="row g-3" action="/dailylog.php" method="POST">
                    <div class="col-md-12">
                        <label for="weight" class="form-label" min="1" max="200">Weight (in kg)</label>
                        <input type="text" class="form-control" id="weight" placeholder="" name="weight">
                    </div>
                    <div class="col-md-12">
                        <label for="workouttime" class="form-label" min="1">Workout time (in minutes)</label>
                        <input type="text" class="form-control" id="workouttime" name="workouttime" required>
                    </div>
                    <div class="col-md-6">
                        <!-- <label for="caloriein" class="form-label" min="1">Calories intake</label> -->
                        <input type="text" class="form-control" id="caloriein" name="caloriein" placeholder="Calories Intake" required>
                    </div>
                    <div class="col-md-6">
                        <!-- <label for="calorieburn" class="form-label" min="1">Calories burnt</label> -->
                        <input type="text" class="form-control" id="calorieburn" name="calorieburn" placeholder="Calories Burnt" required>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Log</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6 mt-5">

                <h1 class="text-end my-4">
                    Strength Training.
                </h1>
                <form class="row g-3 mx-auto text-end" action="#" method="POST" id="add_form">
                    <div class="col-md-12 mt-3">
                        <label for="mgroup">Select Muscle Group</label>
                        <select class="form-select mt-2 text-end" id="mgroup" name="mgroup">
                            <option value="Chest">Chest</option>
                            <option value="Back">Back</option>
                            <option value="Shoulders">Shoulders</option>
                            <option value="Arms">Arms</option>
                            <option value="Legs">Legs</option>
                            <option value="Fullbody / Cardio">Fullbody / Cardio</option>
                        </select>
                    </div>
                    <!-- <div class="col-md-12">
                        <label for="workouttime" class="form-label" min="1">Variations</label>
                        <input type="text" class="form-control" id="workouttime" name="workouttime" required>
                    </div>
                    <div class="col-md-6">
                        <label for="caloriein" class="form-label" min="1">Sets</label>
                        <input type="text" class="form-control" id="caloriein" name="caloriein" required>
                    </div>
                    <div class="col-md-6">
                        <label for="calorieburn" class="form-label" min="1">Reps</label>
                        <input type="text" class="form-control" id="calorieburn" name="calorieburn" required>
                    </div> -->

                    <div class="col-md-12" id="show_item">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="e_variation" class="form-label">Add exercises</label>
                                <input type="text" name="e_variation[]" id="e_variation" class="form-control" placeholder="Exercise Variation" required>
                            </div>
                            <div class="col-md-5 mb-3">
                                <input type="number" name="e_sets[]" class="form-control" placeholder="Sets" required>
                            </div>
                            <div class="col-md-5 mb-3">
                                <input type="number" name="e_reps[]" class="form-control" placeholder="Reps" required>
                            </div>
                            <div class="col-md-2 mb-3">
                                <button class="btn btn-success add_item_btn">
                                    +
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-primary" id="add_btn" type="submit">Log</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript">
    $(document).ready(function() {
        $(".add_item_btn").click(function(e) {
            e.preventDefault();
            $("#show_item").prepend(`<div class="row append_item">
                            <div class="col-md-12 mb-3">
                                <label for="e_variation" class="form-label">Add exercises</label>
                                <input type="text" name="e_variation[]" id="e_variation" class="form-control" placeholder="Exercise Variation" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <input type="number" name="e_sets[]" class="form-control" placeholder="Sets" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <input type="number" name="e_reps[]" class="form-control" placeholder="Reps" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <button class="btn btn-danger remove_item_btn">
                                    Remove
                                </button>
                            </div>
                        </div>`);
        });
        $(document).on('click', '.remove_item_btn', function(e) {
            e.preventDefault();
            let row_item = $(this).parent().parent();
            $(row_item).remove();
        });
        $("#add_form").submit(function(e) {
            e.preventDefault();
            $("#add_btn").val('Adding...');
            $.ajax({
                url: 'exer_upl.php',
                method: 'post',
                data: $(this).serialize(),
                success: function(response) {
                    $("#add_btn").val('Add');
                    $("#add_form")[0].reset();
                    $(".append_item").remove();
                    $("#show_alert").html(`<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Data inserted.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>`);
                }
            });
        });
    });
</script>
