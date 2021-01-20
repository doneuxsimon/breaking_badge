<?php
require_once('./components/functions.php');
if (!empty($_POST['mail']) && !empty($_POST['pwd'])) {
    if (login($_POST['mail'], $_POST['pwd']) == "PwdOk") {
        header('Location: index.php');
    } else if (login($_POST['mail'], $_POST['pwd']) == "ChangePwd") {
        ?>
        <form action="../components/newPwd.php" method="POST">
            <p>
                <label for="newPwd"> Choose a new password : </label>
                <input type="password" id="newPwd" name="newPwd">
            </p>
            <p>
                <label for="newPwd2"> Confirm your password : </label>
                <input type="password" id="newPwd2">
            </p>
            <input type="submit" value="Change !">
        </form>
        <?php
    }
    else {
        echo "Wrong email or password!";
    }
} else {
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
<?php } ?>