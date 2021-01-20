<?php

require_once('./components/functions.php');
$badges = getBadges();
while ($badge = $badges->fetch()) {
    echo "<pre>";
    print_r($badge);
    echo "</pre>";
}