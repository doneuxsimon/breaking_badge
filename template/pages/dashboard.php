<?php

require_once('./components/functions.php');

session_start_once();
$badges = getBadges();


echo "<h1>HELLO ".strtoupper($_SESSION['firstname'])." ! </h1>";
while($badge = $badges->fetch()) {
    echo $badge['name'] . " : " . averageBadge($badge['id']) . "%<br>";
}