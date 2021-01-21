<?php

require_once('./components/functions.php');

session_start_once();
$average = averageBadges();


echo "<h1>HELLO ".strtoupper($_SESSION['firstname'])." ! </h1>";
var_dump($average);