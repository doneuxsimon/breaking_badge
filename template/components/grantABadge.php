<?php
require_once('functions.php');
if (!empty($_GET['id']) && $_GET['id'] > 0 && !empty($_POST['badge']) && !empty($_POST['level'])) {
    grantBadgeToUser($_POST['badge'], $_GET['id'], $_POST['level']);
    header('Location: ../index.php?p=badges');
} else {
    echo "ERREUR";
    // header('Location: ../index.php?p=badges');
}