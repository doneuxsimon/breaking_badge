<?php

require_once('./components/functions.php');
session_start_once();
if (isAdmin()) {
    echo "All badges : <br>";
    $badges = getBadges();
    while ($badge = $badges->fetch()) {
        echo $badge['name'] . " : " . $badge['description'] . " " . $badge['shape'] . "<br>";
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
        ?>
        <button><a href="pages/grant.php?id=<?= $_POST['userId']; ?>">Grant a badge</a></button>
        <?php
        while($badge = $badgesForUser->fetch()) {
            echo $badge['firstname'] . " " . $badge['lastname'] . " has the badge " . $badge['badge'] . " and the level " . $badge['level'] . "<button><a href='./components/removeBadgeFromUser.php?id=".$_POST['userId']."&badgeId=".$badge['badgeId']."'>Remove the badge</a></button><br>";
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
        <button type="submit">Submit</button>
    </form>
    <?php
    $badges = getBadges();
    ?>
    <button>Edit a badge</button>
    <form action="./components/editBadge.php" method="POST">
        <label for="badgeName">Badge name : </label>
        <select name="badge" id="badgeName">
        <?php
        while ($badge = $badges->fetch()) {
            ?>
            <option value="<?= $badge['id']; ?>"><?= $badge['name']; ?></option>
            <?php
        }
        ?>
        </select>
        <label for="badgeDescription">Badge description : </label>
        <input type="text" id="badgeDescription" name="badgeDescription">
        <label for="badgeShape">Badge shape : </label>
        <input type="text" id="badgeShape" name="badgeShape">
        <button type="submit">Submit</button>
    </form>
    <?php
    $badges = getBadges();
    ?>
    <button>Remove a badge</button>
    <form action="./components/removeBadge.php" method="POST">
        <label for="badgeName">Badge name : </label>
        <select name="badge" id="badgeName">
        <?php
        while ($badge = $badges->fetch()) {
            ?>
            <option value="<?= $badge['id']; ?>"><?= $badge['name']; ?></option>
            <?php
        }
        ?>
        </select>
        <button type="submit">Submit</button>
    </form>
    <?php
}