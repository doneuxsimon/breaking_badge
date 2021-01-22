<?php
require_once('functions.php');
if (!empty($_GET['id']) && $_GET['id'] > 0 && !empty($_GET['badgeId']) && $_GET['badgeId'] > 0) {
    removeBadgeFromUser($_GET['badgeId'], $_GET['id']);
    header('Location: ../index.php?p=badges');
}