<?php
require_once('functions.php');
if (isset($_POST['badge'])) {
    $badge = getBadgeById($_POST['badge']);
    if(empty($_POST['badgeDescription'])) {
        if (empty($_POST['badgeColor'])) {
            if (empty($_POST['fontawesome'])) {
                header('Location: ../index.php?p=badges');
            } else {
                $affectedLines = editBadge($_POST['badge'], $badge['description'], $badge['badgeColor'], $_POST['fontawesome']);
                if ($affectedLines) {
                    header('Location: ../index.php?p=badges');
                }
            }
        } else {
            if (empty($_POST['fontawesome'])) {
                $affectedLines = editBadge($_POST['badge'], $badge['description'], $_POST['badgeColor'], $badge['fontawesome']);
                if ($affectedLines) {
                    header('Location: ../index.php?p=badges');
                }
            } else {
                $affectedLines = editBadge($_POST['badge'], $badge['description'], $_POST['badgeColor'], $_POST['fontawesome']);
                if ($affectedLines) {
                    header('Location: ../index.php?p=badges');
                }
            }
        }
    } else {
        if (empty($_POST['badgeColor'])) {
            if (empty($_POST['fontawesome'])) {
                $affectedLines = editBadge($_POST['badge'], $_POST['badgeDescription'], $badge['color'], $badge['fontawesome']);
                if ($affectedLines) {
                    header('Location: ../index.php?p=badges');
                }
            } else {
                $affectedLines = editBadge($_POST['badge'], $_POST['badgeDescription'], $badge['color'], $_POST['fontawesome']);
                if ($affectedLines) {
                    header('Location: ../index.php?p=badges');
                }
            }
        } else {
            if (empty($_POST['fontawesome'])) {
                $affectedLines = editBadge($_POST['badge'], $_POST['badgeDescription'], $_POST['badgeColor'], $badge['fontawesome']);
                if ($affectedLines) {
                    header('Location: ../index.php?p=badges');
                }
            } else {
                $affectedLines = editBadge($_POST['badge'], $_POST['badgeDescription'], $_POST['badgeColor'], $_POST['fontawesome']);
                if ($affectedLines) {
                    header('Location: ../index.php?p=badges');
                }
            }
        }
    }
}