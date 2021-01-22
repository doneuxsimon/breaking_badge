<?php
require_once('../components/functions.php');
$allBadges = getBadges();
$levels = getLevels();
    if (!empty($_GET['id']) && $_GET['id'] > 0) {
        $users = getStudentById($_GET['id']);
        ?>
            <form action="../components/grantABadge.php?id=<?= $_GET['id']; ?>" method="POST">
                <p><?= $users['firstname']; ?> : </p>
                <label for="badge">Badge : </label>
                <select name="badge" id="badge">
                    <?php
                    while ($badge = $allBadges->fetch()) {
                        ?>
                        <option value="<?= $badge['id']; ?>"><?= $badge['name']; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <label for="level">
                <select name="level" id="level">
                    <?php
                    while ($level = $levels->fetch()) {
                        ?>
                        <option value="<?= $level['id']; ?>"><?= $level['level']; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <input type="submit" value="Grant the badge">
            </form>
        <?php
    }