<?php
require_once('./components/functions.php');
$users = getStudents();
while ($user = $users->fetch()) {
    echo $user['firstname'] . " " . $user['lastname'] . " : " . $user['mail'] . "<br>";
}
?>