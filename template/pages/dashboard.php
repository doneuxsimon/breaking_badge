<?php

require_once('./components/functions.php');

session_start_once();

$result = getBadgesByUser(2); // $_SESSION['user_id']
$result2 = getBadges();
$allBadges = getBadgesByName();



if (isAdmin()) {
    echo "<h1>HELLO ".strtoupper($_SESSION['firstname'])." ! </h1>";
    $students = getStudents();
    ?> 
    <form action="" method="POST">
    <select> <?php
    while ($normie = $students->fetch()) {
        ?>
        <option value="<?= $normie["id"]; ?>"><?= $normie["firstname"]; ?></option>
        <?php
    }
    ?>
    </select>
    <input type="submit" value="Go">
    </form>
    <?php
    while($badges = $allBadges->fetch()) {
        echo $badges['name'] . " : " . $badges['description']."<br>";
    }
} else {
    echo "<h1>HELLO ".strtoupper($_SESSION['firstname'])." ! </h1>";
    while($badges = $result->fetch()) {
        echo "<pre>";
        print_r($badges);
        echo "</pre>";
    }
}