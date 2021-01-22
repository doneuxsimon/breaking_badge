<?php
require_once('../components/functions.php');
session_start_once();
if (!empty($_POST['newPwd'])) {
    updatePwd($_SESSION['user_id'], $_POST['newPwd']);
    header('Location: ../index.php');
}