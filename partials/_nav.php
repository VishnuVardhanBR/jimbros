<?php
//error_reporting(0);
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $loggedin = true;
} else {
    $loggedin = false;
}
echo '
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><i class="fa-solid fa-dumbbell" width="30" height="24" class="d-inline-block align-text-top"> Jim Bros </i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-togx`gler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        ';

if ($loggedin) {
    echo '<ul class="navbar-nav me-auto mb-2 mb-lg-0">

            <li class="nav-item">
                    <a class="nav-link" href="/dailylog.php">Logger</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/progress.php">Progress</a>
                </li>

            </ul>
    <a type="button" class="btn btn-dark" href="/logout.php">Logout</a>
    </ul>';
} else {
    echo '<ul class="navbar-nav ms-auto mb-2 mb-lg-0"><li class="nav-item"><a type="button" class="btn btn-secondary me-2" href="/login.php">Login</a>
        </li><li class="nav-item"><a type="button" class="btn btn-primary" href="/signup.php">Signup</a></li></ul>';
}
echo '</div>
    </div>
</nav>';

// <li class="nav-item dropdown">
//                     <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
//                         Groups
//                     </a>
//                     <ul class="dropdown-menu">
//                         <li><a class="dropdown-item" href="/join.php">Join a group</a></li>
//                         <li><a class="dropdown-item" href="/invite.php">Invite a Jim Bro</a></li>
//                         <li>
//                             <hr class="dropdown-divider" />
//                         </li>
//                         <li>
//                             <a class="dropdown-item" href="#">How to?</a>
//                         </li>
//                     </ul>
//                 </li>
