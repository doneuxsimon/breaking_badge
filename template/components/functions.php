<?php
  include_once('db.php');


  // Similar to "include_once" but for sessions
  // Calls "session_start()" unless it has already been called on the page
  function session_start_once(){
    if(session_status() == PHP_SESSION_NONE){
      return session_start();
    }
  }

  function isAuthenticated(){
    session_start_once();
    return !empty($_SESSION['user_id']);
  }

  function isAdmin(){
    session_start_once();
    return isAuthenticated() && $_SESSION['account_type'] == 'ADMIN';
  }

  function login($email, $password){
    session_start_once();

    $cursor = createCursor();
    $query = $cursor->prepare('SELECT id, firstname, pwd, account_type from users WHERE mail=?');
    $query->execute([$email]);
    $results = $query->fetch();
    
    if(password_verify($password, $results['pwd'])){
      if ($password === "breaking") {
        $_SESSION['user_id'] = $results['id'];
        $_SESSION['firstname'] = $results['firstname'];
        $_SESSION['account_type'] = $results['account_type'];
        $_SESSION['email'] = $email;
        return "ChangePwd";
      } else {
        $_SESSION['user_id'] = $results['id'];
        $_SESSION['firstname'] = $results['firstname'];
        $_SESSION['account_type'] = $results['account_type'];
        $_SESSION['email'] = $email;

        return "PwdOk";
      }
    }
    return "LoginNotOk";
  }

  function logout(){
    session_start_once();
    session_destroy();
  }

  function getUsers(){
    $db = createCursor();
    $users = $db->query('SELECT firstname, lastname, mail FROM users');

    return $users;
  }

  function getStudents() {
    $db = createCursor();
    $students = $db->query('SELECT id,firstname, lastname, mail FROM users WHERE account_type = "NORMIE"');

    return $students;
  }

  function getStudentById($userId) {
    $db = createCursor();
    $student = $db->prepare('SELECT id,firstname, lastname, mail FROM users WHERE account_type = "NORMIE" AND id = ?');
    $student->execute([ $userId ]);
    $result = $student->fetch();

    return $result;
  }

  function addUsers($firstname, $lastname, $mail, $account, $pwd = "breaking") {
    $pwd = password_hash($pwd, PASSWORD_DEFAULT);
    $db = createCursor();
    $req = $db->prepare("SELECT EXISTS(SELECT mail FROM users WHERE  mail = ?)");
    $req->execute([
      $mail
      ]);
    $result = $req->fetchColumn();
    $req->closeCursor();
    if (!$result) {
      $req = $db->prepare('INSERT INTO users(firstname, lastname, mail, pwd, account_type) VALUES(?, ?, ?, ?, ?)');
      $req->execute([
        $firstname,
        $lastname,
        $mail,
        $pwd,
        $account
      ]);
    }
  }

  function updatePwd($userId, $pwd) {
    $db = createCursor();
    $req = $db->prepare('UPDATE users SET pwd = ? WHERE id = ?');
    $req->execute([
      password_hash($pwd, PASSWORD_DEFAULT),
      $userId
    ]);
  }

  function getBadges(){
    $db = createCursor();
    $badges = $db->query('SELECT id, name, description, color, fontawesome FROM badges GROUP BY id');

    return $badges;
  }

  function getBadgeById($badgeId) {
    $db = createCursor();
    $req = $db->prepare('SELECT id, name, description, color, fontawesome FROM badges WHERE id = ?');
    $req->execute([ $badgeId ]);
    $badge = $req->fetch();

    return $badge;
  }

  function getBadgesByName() { // Why ?
    $db = createCursor();
    $badges = $db->query('SELECT name, description, color, fontawesome FROM badges GROUP BY id');

    return $badges;
  }

  function getBadgesByUser($userId) {
    $db = createCursor();
    $badgesUser = $db->prepare('SELECT b.id AS badgeId, b.name AS badge, b.description AS description, b.color AS color, b.fontawesome AS fontawesome,
    users.firstname AS firstname, users.lastname AS lastname, l.level AS level FROM badges AS b
    INNER JOIN users_has_badges
    ON b.id = users_has_badges.fk_badges_id
      INNER JOIN users
      ON users.id = users_has_badges.fk_users_id
        INNER JOIN levels AS l
        ON l.id = users_has_badges.fk_levels_id
    WHERE users.id = ? AND users.account_type = "NORMIE"');
    $badgesUser->execute([ $userId ]);

    return $badgesUser;
  }

  function createBadge($name, $description, $color, $fontawesome){
    $db = createCursor();
    try {
      $req = $db->prepare('INSERT INTO badges(name, description, color, fontawesome) VALUES(?, ?, ?, ?)');
      $affectedLines = $req->execute([
        $name,
        $description,
        $color,
        $fontawesome
      ]);
      return $affectedLines;
    } catch (Exception $e) {
      echo "This badge already exists !";
    }

  }

  function editBadge($badge_id, $description, $color, $fontawesome){
    $db = createCursor();
    $req = $db->prepare('UPDATE badges SET description = ?, color = ?, fontawesome = ? WHERE id = ?');
    $affectedLines = $req->execute([
      $description,
      $color,
      $fontawesome,
      $badge_id
    ]);

    return $affectedLines;
  }

  function removeBadge($badge_id){
    $db = createCursor();
    $affectedLines = $req = $db->prepare('DELETE FROM badges WHERE id = ?');
    $req->execute([
      $badge_id
    ]);

    return $affectedLines;

  }

  function grantBadgeToUser($badge_id, $user_id, $levelId){
    $db = createCursor();
    $req = $db->prepare('INSERT INTO users_has_badges(fk_badges_id, fk_users_id, fk_levels_id) VALUES(?, ?, ?)');
    $affectedLines = $req->execute([
      $badge_id,
      $user_id,
      $levelId
    ]);

    return $affectedLines;
  }

  function removeBadgeFromUser($badge_id, $user_id){
    $db = createCursor();
    $req = $db->prepare('DELETE FROM users_has_badges WHERE fk_users_id = ?  AND fk_badges_id = ?');
    $affectedLines = $req->execute([
      $user_id,
      $badge_id
    ]);

    return $affectedLines;
  }

  function getLevels() {
    $db = createCursor();
    $levels = $req = $db->query('SELECT id, level FROM levels');

    return $levels;
  }

  function averageBadge($badgeId) {
    $db = createCursor();
    $req = $db->prepare('SELECT COUNT(fk_badges_id) AS count FROM users_has_badges WHERE fk_badges_id = ?');
    $req->execute([ $badgeId ]);
    $data = $req->fetch();
    $countBadge = $data['count'];
    $req->closeCursor();

    $req = $db->query('SELECT COUNT(id) AS user FROM users WHERE account_type = "NORMIE"');
    $data = $req->fetch();
    $countUsers = $data['user'];
    $average = ($countBadge / $countUsers) * 100;

    return $average;
}

function averageLevelByBadge($badgeId, $levelId) {
  $db = createCursor();
  $req = $db->prepare('SELECT COUNT(fk_badges_id) AS count FROM users_has_badges WHERE fk_badges_id = ?');
  $req->execute([ $badgeId ]);
  $data = $req->fetch();
  $countBadge = $data['count'];
  $req->closeCursor();
  
  $req = $db->prepare('SELECT COUNT(fk_levels_id) AS count, b.name AS badge FROM users_has_badges
  INNER JOIN badges AS b ON b.id = users_has_badges.fk_badges_id WHERE b.id = ? AND fk_levels_id = ?');
  $req->execute([ $badgeId, $levelId ]);
  $result = $req->fetch();
  $countLevel = $result['count'];

  $statLevel = ($countLevel / $countBadge) * 100;
  return $statLevel;
}

function generateBarres($x, $x1, $x2, $x3, $x4) {

  return '<div class="barreContainer" style="height: ' . $x . '%;">
  <div class="barre4" style="height: ' . $x4 . '%; width: 50px;"></div>
  <div class="barre3" style="height: ' . $x3 . '%; width: 50px;"></div>
  <div class="barre2" style="height: ' . $x2 . '%; width: 50px;"></div>
  <div class="barre1" style="height: ' . $x1 . '%; width: 50px;"></div>
</div>';
}
?>