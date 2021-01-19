<?php
require_once('./components/functions.php');
if (!empty($_POST['mail']) && !empty($_POST['pwd'])) {
    if (login($_POST['mail'], $_POST['pwd'])) {
        header('Location: index.php');
    } else {
        echo "Wrong email or password!";
    }
}
?>

<form action="" method="POST">
    <p>
        <label for="mail"> Email : </label>
        <input type="email" id="mail" name="mail">
    </p>
    <p>
        <label for="pwd"> Password : </label>
        <input type="password" id="pwd" name="pwd">
    </p>
    <input type="submit" value="Log in">
</form>