<?php
require_once('functions.php');
if (!empty($_POST['badgeName']) && !empty($_POST['badgeDescription']) && !empty($_POST['badgeShape'])) {
    $affectedLines = createBadge($_POST['badgeName'], $_POST['badgeDescription'], $_POST['badgeShape']);
    if (!$affectedLines) {
        echo ('Il y a eu une erreur');
    } else {
        header('Location: ../index.php?p=badges');
    }
}