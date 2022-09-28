<div class="container my-5 py-5">
    <?php

    $sql = "SELECT COUNT(*) FROM dailylog WHERE uid = $sno";
    $result = mysqli_query($conn, $sql);
    $totaldays = mysqli_fetch_row($result)[0];

    $sql = "SELECT SUM(caloriein) FROM dailylog WHERE uid = $sno";
    $result = mysqli_query($conn, $sql);
    $totalcaloriein = mysqli_fetch_row($result)[0];

    $sql = "SELECT SUM(calorieburn) FROM dailylog WHERE uid = $sno";
    $result = mysqli_query($conn, $sql);
    $totalcalorieburnt = mysqli_fetch_row($result)[0];

    $sql = "SELECT SUM(workouttime) FROM dailylog WHERE uid = $sno";
    $result = mysqli_query($conn, $sql);
    $totalminutes = mysqli_fetch_row($result)[0];

    ?>
    <div class="row mb-3">
        <div class="col">
            <div class="col">
                <h1 class="display-1 fw-bold">All time stats <h1 class="display-4 fw-soft"><?php echo date("M d, Y", strtotime($startdate)) . " - " . date("M d, Y")  ?></h1>
                </h1>
            </div>
            <h2 class="fw-light"> you have </h2>
            <div class="col d-flex flex-row-reverse align-items-start mt-5">
                <div class="icon flex-shrink-0 ms-3">
                    <i class="fa-solid fa-dumbbell fa-2x"></i>
                </div>
                <div>
                    <h1>Hit the gym for <?php echo $totaldays ?> Days</h1>
                </div>
            </div>
            <div class="col d-flex flex-row-reverse align-items-start mt-5">
                <div class="icon flex-shrink-0 ms-3">
                    <i class="fa-solid fa-utensils fa-2x"></i>
                </div>
                <div>
                    <h1>Consumed <?php echo $totalcaloriein ?> Calories</h1>
                </div>
            </div>
            <div class="col d-flex flex-row-reverse align-items-start mt-5">
                <div class="icon flex-shrink-0 ms-3">
                    <i class="fa-solid fa-fire fa-2x"></i>
                </div>
                <div>
                    <h1>Burnt <?php echo $totalcalorieburnt ?> Calories</h1>
                </div>
            </div>
            <div class="col d-flex flex-row-reverse align-items-start mt-5">
                <div class="icon flex-shrink-0 ms-3">
                    <i class="fa-solid fa-gauge-high fa-2x"></i>
                </div>
                <div>
                    <h1>Worked out for <?php echo $totalminutes ?> minutes</h1>
                </div>
            </div>
            <div class="col d-flex flex-row-reverse align-items-start mt-5">
                <?php
                $sql = "select mgroup, count(*) from workoutlog where uid = '$sno' group by mgroup";
                $result = mysqli_query($conn, $sql);
                $mgroup = array("Chest" => 0, "Back" => 0, "Shoulders" => 0, "Arms" => 0, "Legs" => 0, "Fullbody / Cardio" => 0);
                foreach ($result as $data) {
                    $key = $data['mgroup'];
                    $mgroup[$key] = (int)$data['count(*)'];
                }
                $names = array_keys($mgroup);
                //$n = count($mgroup);
                foreach ($mgroup as $key => $n) {
                    $numbers[] = $n;
                }
                ?>
            </div>
        </div>
    </div>
</div>
<div class="b-example-divider my-5"></div>
