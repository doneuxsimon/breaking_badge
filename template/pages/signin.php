<?php
    require_once('./components/functions.php');
    if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['mail']) && !empty($_POST['account_type'])) {
        $response = addUsers($_POST['firstname'], $_POST['lastname'], $_POST['mail'], $_POST['account_type']);
        echo $response;
    }
?>
<div class ="signinNeu">
<form method="POST">
    <p class="field">
        <label for="firstname"></label>
        <input type="text" id="firstname" name="firstname" placeholder="First name">
    </p>
    <p class="field">
        <label for="lastname"></label>
        <input type="text" id="lastname" name="lastname" placeholder="Last name">
    </p>
    <p class="field">
        <label for="mail"></label>
        <input type="email" id="mail" name="mail" placeholder="Email">
    </p>
    <p class="field">
        <label for="account"></label>
        <select name="account_type" id="account">
            <option value="NORMIE">NORMIE</option>
            <option value="ADMIN">ADMIN</option>
        </select>
    </p>
    <button class="log" type="submit"> Sign In ! </button>
</form>
</div>