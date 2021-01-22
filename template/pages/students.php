<?php

require_once('./components/functions.php');
$users = getStudents();
while ($user = $users->fetch()) {
    echo "<pre>";
    print_r($user);
    echo "</pre>";
}
?>