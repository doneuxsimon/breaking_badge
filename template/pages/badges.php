<?php

require_once('./components/functions.php');
session_start_once();
if (isAdmin()) {
    echo "All badges : <br>";
    $badges = getBadges();
    while ($badge = $badges->fetch()) {
        echo $badge['name'] . " : " . $badge['description'] . " " . $badge['color'] . "<br>";
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
    <button id="addBadge">Add a badge</button>
    <form action="./components/addBadge.php" method="POST" class="none" id="addBadgeForm">
        <label for="badgeName">Badge name : </label>
        <input type="text" id="badgeName" name="badgeName">
        <label for="badgeDescription">Badge description : </label>
        <input type="text" id="badgeDescription" name="badgeDescription">
        <label for="badgeColor">Badge color : </label>
        <select id="badgeColor" name="badgeColor">
            <option>...</option>
            <option value="blue">Blue</option>
            <option value="orange">Orange</option>
            <option value="gold">Gold</option>
            <option value="red">Red</option>
            <option value="purple">Purple</option>
            <option value="green">Green</option>
            <option value="crimson">Crimson</option>
            <option value="steel">Steel</option>
            <option value="pink">Pink</option>
            <option value="rebecca">Rebecca</option>
            <option value="gainsboro">Gainsboro</option>
        </select>
        <label for="fontawesome">Fontawesome classes : </label>
        <input type="text" id="fontawesome" name="fontawesome">
        <button type="submit">Submit</button>
    </form>
    <?php
    $badges = getBadges();
    ?>
    <button id="editBadge">Edit a badge</button>
    <form action="./components/editBadge.php" method="POST" class="none" id="editBadgeForm">
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
        <label for="badgeColor">Badge color : </label>
        <select id="badgeColor" name="badgeColor">
            <option>...</option>
            <option value="blue">Blue</option>
            <option value="orange">Orange</option>
            <option value="gold">Gold</option>
            <option value="red">Red</option>
            <option value="purple">Purple</option>
            <option value="green">Green</option>
            <option value="crimson">Crimson</option>
            <option value="steel">Steel</option>
            <option value="pink">Pink</option>
            <option value="rebecca">Rebecca</option>
            <option value="gainsboro">Gainsboro</option>
        </select>
        <label for="fontawesome">Fontawesome classes : </label>
        <input type="text" id="fontawesome" name="fontawesome">
        <button type="submit">Submit</button>
    </form>
    <?php
    $badges = getBadges();
    ?>
    <button id="removeBadge">Remove a badge</button>
    <form action="./components/removeBadge.php" method="POST" class="none" id="removeBadgeForm">
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
    <main class="wrapper">
    <?php
      $badges = getBadges();
      while ($badge = $badges->fetch()) {
        ?>
          <article class="badge <?= $badge['color']; ?>">
            <div class="rounded"><?= $badge['fontawesome']; ?></div>
          </article>
        <?php
      }
    ?>

    <!-- <article class="badge orange">
      <div class="rounded"><i class="fab fa-html5"></i></div>
    </article>
    <article class="badge blue">
      <div class="rounded"><i class="fab fa-css3-alt"></i></div>
    </article>
    <article class="badge gold">
      <div class="rounded"><i class="fab fa-js-square"></i></div>
    </article>
    <article class="badge red">
      <div class="rounded"><i class="fab fa-adobe"></i></div>
    </article>
    <article class="badge purple">
      <div class="rounded"><i class="fab fa-php"></i></div>
    </article>
    <article class="badge green">
      <div class="rounded"><i class="fab fa-node"></i></div>
    </article>
    <article class="badge crimson">
      <div class="rounded"><i class="fab fa-npm"></i></div>
    </article>
    <article class="badge steel">
      <div class="rounded"><i class="fab fa-python"></i></div>
    </article>
    <article class="badge pink">
      <div class="rounded"><i class="fab fa-sass"></i></div>
    </article>
    <article class="badge rebecca">
      <div class="rounded"><i class="fab fa-bootstrap"></i></div>
    </article>
    <article class="badge gainsboro">
      <div class="rounded"><i class="fab fa-java"></i></div>
    </article> -->
  </main> 
<?php 
}
?>
<script>
const addBadgeBtn = document.querySelector('#addBadge')
const addBadgeForm = document.querySelector('#addBadgeForm')
addBadgeBtn.addEventListener('click', () => {
  addBadgeForm.classList.toggle("none")
})

const editBadgeBtn = document.querySelector('#editBadge')
const editBadgeForm = document.querySelector('#editBadgeForm')
editBadgeBtn.addEventListener('click', () => {
  editBadgeForm.classList.toggle("none")
})

const removeBadgeBtn = document.querySelector('#removeBadge')
const removeBadgeForm = document.querySelector('#removeBadgeForm')
removeBadgeBtn.addEventListener('click', () => {
  removeBadgeForm.classList.toggle("none")
})
</script>