<?php

require_once('./components/functions.php');

session_start_once();

$result = getBadgesByUser(2); // $_SESSION['user_id']
$result2 = getBadges();



if ($_SESSION['account_type'] === 'ADMIN') {
    echo "<h1>HELLO ADMIN</h1>";
    while($badges = $result2->fetch()) {
        echo "<pre>";
        print_r($badges);
        echo "</pre>";
    }
} else {
    echo "<h1>HELLO NORMIE</h1>";
    while($badges = $result->fetch()) {
        echo "<pre>";
        print_r($badges);
        echo "</pre>";
    }
}