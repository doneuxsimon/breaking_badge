<?php
require_once('functions.php');
if (isset($_POST['badge'])) {
    $affectedLines = removeBadge($_POST['badge']);
    if ($affectedLines) {
        header('Location: ../index.php?p=badges');
    }
}