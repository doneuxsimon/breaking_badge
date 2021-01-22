<?php
require_once('functions.php');
if (!empty($_POST['badgeName']) && !empty($_POST['badgeDescription']) && !empty($_POST['badgeColor']) && !empty($_POST['fontawesome'])) {
    $affectedLines = createBadge($_POST['badgeName'], $_POST['badgeDescription'], $_POST['badgeColor'], $_POST['fontawesome']);
    if ($affectedLines) {
        header('Location: ../index.php?p=badges');
    }
}