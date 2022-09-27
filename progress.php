<?php
require 'partials/_unauth.php';
require 'partials/_dbconnect.php';
$daylogged = false;
$anylogged = false;
$td = date("Y-m-d");
$td2 = date("jS \of F Y");
$sno = $_SESSION['sno'];
//to grab data from daily log (left side form)
$sql = "SELECT * FROM `dailylog` WHERE uid = $sno and date LIKE '$td%'";
$dayresult = mysqli_query($conn, $sql);
if (mysqli_num_rows($dayresult) >= 1) {
  $daylogged = true;
  while ($row = mysqli_fetch_row($dayresult)) {
    $dres = array("did" => $row[0], "uid" => $row[1], "weight" => $row[2], "workouttime" => $row[3], "caloriein" => $row[4], "calorieburn" => $row[5], "bmi" => $row[6], "date" => $row[7]);
  }
}
$result = mysqli_query($conn, "SELECT * FROM dailylog WHERE uid='$sno' ORDER BY uid LIMIT 1;");
while ($row = mysqli_fetch_row($result)) {
  $startdate = $row['7'];
}
$sql = "SELECT COUNT(*) FROM dailylog WHERE uid = $sno";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  $anylogged = true;
}
//to grab data from workoutlog (right side form), only mgroup
$sql = "SELECT * FROM `workoutlog` WHERE uid = $sno and date LIKE '$td%'";
$wdayresult = mysqli_query($conn, $sql);
if (mysqli_num_rows($wdayresult) >= 1) {
  while ($row = mysqli_fetch_row($wdayresult)) {
    $wdres = array("id" => $row[0], "uid" => $row[1], "mgroup" => $row[2], "date" => $row[3]);
  }
}
//to further grab data from excercises linked to workoutlog (right side form)
$wid = $wdres['id'];
$sql = "SELECT * FROM `excercise` WHERE wid = '$wid'";
$edayresult = mysqli_query($conn, $sql);
if (mysqli_num_rows($edayresult) >= 1) {
  foreach ($edayresult as $data) {
    $excercise[] = $data['excercise'];
    $sets[] = $data['sets'];
    $reps[] = $data['reps'];
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php require 'partials/_header.php' ?>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
  <link href="/css/custom.css" rel="stylesheet">
</head>

<body>
  <?php require 'partials/_nav.php' ?>
  <?php if ($daylogged) {
    require 'partials/_progresstoday.php';
  }
  if ($anylogged) {
    require 'partials/_progresstotal.php';
  } ?>
  <div class="container my-5 py-5">
    <?php
    $result = mysqli_query($conn, "SELECT * FROM phychar WHERE uid='$sno' ORDER BY uid DESC LIMIT 1;");
    while ($row = mysqli_fetch_row($result)) {
      $height = $row['3'];
    }
    $result = mysqli_query($conn, "SELECT * FROM dailylog WHERE uid='$sno' ORDER BY did DESC LIMIT 1;");
    while ($row = mysqli_fetch_row($result)) {
      $weight = $row['2'];
      $bmi = $row['6'];
    }
    ?>
    <div class="row mb-3">
      <div class="col-6">
        <div class="col">
          <h1 class="display-1 fw-bold">Current Build
          </h1>
        </div>

        <div class="col d-flex align-items-start mt-5">
          <div class="icon flex-shrink-0 me-3">
            <i class="fa-solid fa-ruler-vertical fa-2x"></i>
          </div>
          <div>
            <h1>Height • <?php echo $height; ?> cm</h1>
          </div>
        </div>
        <div class="col d-flex align-items-start mt-5">
          <div class="icon flex-shrink-0 me-3">
            <i class="fa-solid fa-weight-scale fa-2x"></i>
          </div>
          <div>
            <h1>Weight • <?php echo $weight; ?> kg</h1>
          </div>
        </div>
        <div class="col d-flex align-items-start mt-5">
          <div class="icon flex-shrink-0 me-3">
            <i class="fa-solid fa-person fa-2x"></i>
          </div>
          <div>
            <h1>Body Mass Index • <?php echo $bmi; ?> </h1>
          </div>
          <a href="https://www.cdc.gov/healthyweight/assessing/index.html#:~:text=If%20your%20BMI%20is%2018.5,falls%20within%20the%20obese%20range." target="_blank" class="icon flex-shrink-0 me-3" style="text-decoration: none;">
            <i class="fa-regular fa-circle-question"></i>
          </a>
        </div>
      </div>
    </div>
  </div>


  <!-- <div class="b-example-divider mt-5"></div>
  <div class="container mt-5 pt-5">
    <div class="row">
      <div class="col">
        <div style="width: 1000px">
          <canvas id="myChart"></canvas>
        </div>
      </div>
    </div>
  </div> -->



  <script>
    Chart.register(ChartDataLabels);
    const labels = <?php echo json_encode($names) ?>;
    const data = {
      labels: labels,
      datasets: [{
        label: 'My First dataset',
        backgroundColor: 'rgb(0, 0, 0)',
        borderColor: 'rgb(0, 0, 0)',
        borderRadius: 75,
        data: <?php echo json_encode($numbers) ?>,
      }]
    };

    const config = {
      type: 'bar',
      data: data,
      options: {
        plugins: {
          legend: {
            display: false,
          },
          datalabels: {
            anchor: 'end',
            align: 'top',
            formatter: Math.round,
            color: '#000000',
            font: {
              weight: 'bold',
              size: 24,
            }
          }
        },
        scales: {
          x: {
            display: true,
            grid: {
              display: false
            },
            grace: '5%'
          },
          y: {
            display: false,
            grace: '5%'
          }
        }
      },
    };
  </script>
  <script>
    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );
  </script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>


</body>

</html>
