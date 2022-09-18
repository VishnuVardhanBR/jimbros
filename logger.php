<?php require 'partials/_unauth.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  session_start();
  if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header('location: login.php');
    exit;
  }
  require 'partials/_header.php' ?>
</head>

<body>
  <?php require 'partials/_nav.php' ?>

</body>
