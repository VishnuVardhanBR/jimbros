<?php
//print_r($_POST);
require 'partials/_dbconnect.php';
$mgroup = $_POST['mgroup'];
session_start();
$sno = $_SESSION['sno'];
$td = date("Y-m-d");
$result = mysqli_query($conn, "SELECT * FROM workoutlog WHERE uid='$sno' ORDER BY id DESC LIMIT 1;");
while ($row = mysqli_fetch_row($result)) {
    $oldwid = $row['0'];
}
$result = mysqli_query($conn, "DELETE FROM excercise WHERE wid = '$oldwid';");
$sql = "INSERT INTO `workoutlog` (`uid`, `mgroup`) VALUES ('$sno', '$mgroup');";
$result = mysqli_multi_query($conn, $sql);
$result = mysqli_query($conn, "SELECT * FROM workoutlog WHERE uid='$sno' ORDER BY id DESC LIMIT 1;");
while ($row = mysqli_fetch_row($result)) {
    $wid = $row['0'];
}
foreach ($_POST['e_variation'] as $key => $value) {
    $e_sets = $_POST['e_sets'][$key];
    $e_reps = $_POST['e_reps'][$key];
    $sql = "INSERT INTO `excercise` (`uid`,`wid`, `excercise`, `sets`, `reps`) VALUES ('$sno', '$wid', '$value', '$e_sets', '$e_reps');";
    $result = mysqli_query($conn, $sql);
    echo ($result);
    //VALUES (:uid, :wid, :excercise, :sets, :reps);
    //$stmt = $conn->prepare($sql);
    // $stmt->execute([
    //     'uid' => $sno,
    //     'wid' => $wid,
    //     'excercise' => $value,
    //     'sets' => $_POST['e_sets'][$key],
    //     'reps' => $_POST['e_reps'][$key]
    // ]);
}
echo 'Items inserted!';
