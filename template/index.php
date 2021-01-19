<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/style.css">
  <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Texturina:wght@500&display=swap" rel="stylesheet">
  <title>Breaking Badge</title>
</head>
<body>
  <h1>Welcome to BeeKaud</h1>
  <?php include_once('components/router.php'); ?>
  <form action="" method="get">
    <input type="text">Username
    <input type="email" name="" id="">
    <input type="hidden" name="">Password
    <p>You don't have an account yet ?</p>
    <a href="./signin.php">Sign in here !</a>
    </form>
</body>
</html>