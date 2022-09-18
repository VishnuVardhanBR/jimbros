<!DOCTYPE html>
<html lang="en">

<head>
  <?php require 'partials/_header.php' ?>
</head>

<body>
  <?php require 'partials/_nav.php' ?>

  <main class="container">
    <div class="container py-3">
      <div class="p-4 mb-4 bg-light border rounded-3">
        <div class="container-fluid py-5">
          <h1 class="display-4 fw-bold">Get Started!</h1>
          <p class="col-md-8 fs-4">Create an account for free now and gain access to various trackers and tools to help you keep up to date with your gym partners.</p>
          <a class="btn btn-primary btn-lg" href="/signup.php" role="button">Create Account</a>
        </div>
      </div>

      <div class="row align-items-md-stretch">
        <div class="col-md-6">
          <div class="h-100 p-5 text-white bg-dark rounded-3">
            <h2>Share your progress!</h2>
            <p>Create and invite your friends to your personal group on the website or join an existing group to view your friend's gym streak, workouts, and progress. Ping your friend if he is bunking the gym!</p>
            <a class="btn btn-outline-light" href="/logger.php" role="button">Progress</a>
          </div>
        </div>
        <div class="col-md-6">
          <div class="h-100 p-5 bg-light border rounded-3">
            <h2>Log your workouts</h2>
            <p>Log your workouts and more using the logger tool and maintain a streak of going to the jim!<br> Update daily weight, calorie intake, and such.</p>
            <button class="btn btn-outline-secondary" type="button">Logger</button>
          </div>
        </div>
      </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</body>

</html>
