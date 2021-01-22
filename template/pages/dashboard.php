<?php

require_once('./components/functions.php');

session_start_once();
$badges = getBadges()->fetchAll(PDO::FETCH_ASSOC);
$levels = getLevels()->fetchAll(PDO::FETCH_ASSOC);
$badgesByUser = getBadgesByUser($_SESSION['user_id']);


echo "<h1>HELLO ".strtoupper($_SESSION['firstname'])." ! </h1>";

if (!isAdmin()) {
    while ($badge = $badgesByUser->fetch()) {
        ?>
        <article class="badge <?= $badge['color']; ?>">
            <div class="rounded"><?= $badge['fontawesome']; ?></div>
        </article>
        <?php
    }
}
foreach($badges as $badge) {
// foreach($levels as $level) {
    $percent = generateBarres(averageBadge($badge['id']), averageLevelByBadge($badge['id'], 1), averageLevelByBadge($badge['id'], 2), averageLevelByBadge($badge['id'], 3), averageLevelByBadge($badge['id'], 4));
    // echo $badge['name'] . ", " . $level['level'] . " : " . averageLevelByBadge($badge['id'], $level['id']) . "%<br>";
    echo $percent;
// }
}