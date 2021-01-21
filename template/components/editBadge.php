<?php
require_once('functions.php');
if (isset($_POST['badge'])) {
    $badge = getBadgeById($_POST['badge']);
    if(empty($_POST['badgeDescription'])) {
        if (empty($_POST['badgeShape'])) {
            header('Location: ../index.php?p=badges');
        } else {
            $affectedLines = editBadge($_POST['badge'], $badge['description'], $_POST['badgeShape']);
            if ($affectedLines) {
                header('Location: ../index.php?p=badges');
            }
        }
    } else {
        if (empty($_POST['badgeShape'])) {
            $affectedLines = editBadge($_POST['badge'], $_POST['badgeDescription'], $badge['shape']);
            if ($affectedLines) {
                header('Location: ../index.php?p=badges');
            }
        } else {
            $affectedLines = editBadge($_POST['badge'], $_POST['badgeDescription'], $_POST['badgeShape']);
            if ($affectedLines) {
                header('Location: ../index.php?p=badges');
            }
        }
    }
}