<?php

require_once('./components/functions.php');
session_start_once();
if (isAdmin()) {
    $badges = getBadges();
    while ($badge = $badges->fetch()) {
        echo $badge['name'] . " : " . $badge['description'] . "<br>";
    }
    $users = getStudents();
    ?>
    <p>
        <form method="POST">
            <select name="userId">
            <?php
                while ($normie = $users->fetch()) {
                    ?>
                        <option value="<?= $normie["id"]; ?>"><?= $normie["firstname"]; ?></option>
                    <?php
                }
            ?>
            </select>
            <input type="submit" value="OK">
        </form>
    </p>
    <?php
    if (!empty($_POST['userId'])) {
        $badgesForUser = getBadgesByUser($_POST['userId']);
        while($badge = $badgesForUser->fetch()) {
            echo $badge['firstname'] . " " . $badge['lastname'] . " has the badge " . $badge['badge'] . " and the level " . $badge['level'] . "<br>";
        }
    }
    ?>
    <button>Add a badge</button>
    <form action="./components/addBadge.php" method="POST">
        <label for="badgeName">Badge name : </label>
        <input type="text" id="badgeName" name="badgeName">
        <label for="badgeDescription">Badge description : </label>
        <input type="text" id="badgeDescription" name="badgeDescription">
        <label for="badgeShape">Badge shape : </label>
        <input type="text" id="badgeShape" name="badgeShape">
        <button type="submit">Add the badge</button>
    </form>
    <?php
    
}