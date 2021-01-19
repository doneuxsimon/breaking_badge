<?php
    require_once('./components/functions.php');
    if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['mail']) && !empty($_POST['pwd'])) {
        $response = addUsers($_POST['firstname'], $_POST['lastname'], $_POST['mail'], $_POST['pwd']);
        echo $response;
    }
?>

<form method="POST">
    <p>
        <label for="firstname"> Firstname : </label>
        <input type="text" id="firstname" name="firstname">
    </p>
    <p>
        <label for="lastname"> Lastname : </label>
        <input type="text" id="lastname" name="lastname">
    </p>
    <p>
        <label for="mail"> Email : </label>
        <input type="email" id="mail" name="mail">
    </p>
    <p>
        <label for="account">Account type :</label>
        <select name="account_type" id="account">
            <option value="NORMIE">NORMIE</option>
            <option value="ADMIN">ADMIN</option>
        </select>
    </p>
    <p>
        <label for="pwd"> Password : </label>
        <input type="password" id="pwd" name="pwd">
    </p>
    <p>
        <label for="pw2"> Password : </label>
        <input type="password" id="pw2" name="pw2">
    </p>
    <input type="submit" value="Sign in !">
</form>