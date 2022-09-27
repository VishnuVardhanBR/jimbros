<div class="container my-5 pb-5">
    <div class="row mb-3">
        <div class="col-6">
            <div class="col">
                <h1 class="display-1 fw-bold">Today, <h1 class="display-4 fw-soft"><?php echo $td2 ?></h1>
                </h1>
            </div>
            <h2 class="fw-light"> you have </h2>

            <div class="col d-flex align-items-start mt-5">
                <div class="icon flex-shrink-0 me-3">
                    <i class="fa-solid fa-fire fa-2x"></i>
                </div>
                <div>
                    <h1>Burnt <?php echo $dres['calorieburn']; ?> Calories</h1>
                </div>
            </div>
            <div class="col d-flex align-items-start mt-5">
                <div class="icon flex-shrink-0 me-3">
                    <i class="fa-solid fa-stopwatch-20 fa-2x"></i>
                </div>
                <div>
                    <h1>Worked out for <?php echo $dres['workouttime']; ?> Minutes</h1>
                </div>
            </div>

            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            <div class="col d-flex align-items-start mt-5">
                                <div class="icon flex-shrink-0 me-3">
                                    <i class="fa-solid fa-hand-fist fa-2x"></i>
                                </div>
                                <div>
                                    <h1>Focused on <?php echo $wdres['mgroup']; ?></h1>
                                </div>
                            </div>
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="list-group">
                                <div class="container">

                                    <?php
                                    foreach ($edayresult as $data) {
                                        echo ('<div class="list-group-item">
                        <div class="row">
                        <div class="col-6">
                      <h5 class="mb-1">' . $data['excercise'] . '</h5></div>
                      <div class="col-3">
                      <p class="mb-1">Sets</p>
                      <span class="badge bg-black rounded-pill">' . $data['sets'] . '</span></div>
                      <div class="col-3">
                      <p class="mb-1">Reps</p>
                      <span class="badge bg-black rounded-pill">' . $data['reps'] . '</span></div>
                    </div>
                  </div>');
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="b-example-divider my-5"></div>
