<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/style.css">
  <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Texturina:wght@500&display=swap" rel="stylesheet">
   <title>Sign In !</title>
</head>
<body>
    <h1>It seems like you're not a member of my BeeKaud yet...</h1>
    <h2>Please, fill the blanks below to claim your access :</h2>
    <form action="" method="get" class="signInForm">
    <input type="text">First name
    <input type="text">Last name
    <input type="email">Your email
    <input type="password">Password
    <input type="password">Confirm your password
    <input type="button" value=""> Submit
    </form>
</body>
</html>