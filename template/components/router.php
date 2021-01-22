<?php
  include_once('functions.php');

  // $routes = [];
  // $routes['dashboard'] = 'Dashboard';
  // $routes['badges'] = 'All badges';
  // $routes['students'] = 'All students';
  // $routes['signin'] = "Sign In";
  // $routes['logout'] = "Log out";
  if (isset($_GET['p'])) {
    $requestedPage = $_GET['p'];
  }

  if(!isAuthenticated()){
    // include the login page
    include_once('./pages/login.php');
  } else {
    if (isAdmin()) {
      $routes['dashboard'] = 'Dashboard';
      $routes['badges'] = 'All badges';
      $routes['students'] = 'All students';
      $routes['signin'] = "Add a normie";
      $routes['logout'] = "Log out";
    } else {
      $routes['dashboard'] = 'Dashboard';
      $routes['logout'] = "Log out";
    }
    if (isset($_GET['p'])) {
      $requestedPage = $_GET['p'];
      if(array_key_exists($requestedPage, $routes)){
        include_once('navbar.php');
    
        // include the page
        include_once('./pages/'.$requestedPage.'.php');
        // echo $requestedPage;
      } 
    }
    else {
      include_once('navbar.php');
    }
  }