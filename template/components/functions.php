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
    $badges = $db->query('SELECT id, name, description, shape FROM badges GROUP BY id');

    return $badges;
  }

  function getBadgeById($badgeId) {
    $db = createCursor();
    $req = $db->prepare('SELECT id, name, description, shape FROM badges WHERE id = ?');
    $req->execute([ $badgeId ]);
    $badge = $req->fetch();

    return $badge;
  }

  function getBadgesByName() { // Why ?
    $db = createCursor();
    $badges = $db->query('SELECT name, description, shape FROM badges GROUP BY id');

    return $badges;
  }

  function getBadgesByUser($userId) {
    $db = createCursor();
    $badgesUser = $db->prepare('SELECT b.id AS badgeId, b.name AS badge, b.description AS description, b.shape AS shape,
    users.firstname AS firstname, users.lastname AS lastname, l.level AS level
    FROM badges AS b
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

  function createBadge($name, $description, $shape){
    $db = createCursor();
    try {
      $req = $db->prepare('INSERT INTO badges(name, description, shape) VALUES(?, ?, ?)');
      $affectedLines = $req->execute([
        $name,
        $description,
        $shape
      ]);
      return $affectedLines;
    } catch (Exception $e) {
      echo "This badge already exists !";
    }

  }

  function editBadge($badge_id, $description, $shape){
    $db = createCursor();
    $req = $db->prepare('UPDATE badges SET description = ?, shape = ? WHERE id = ?');
    $affectedLines = $req->execute([
      $description,
      $shape,
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

  function averageBadges() {
    $db = createCursor();
    $req = $db->query('SELECT SUM(fk_users_id) FROM users_has_badges GROUP BY fk_badges_id');
    $average = $req->fetch();
    return $average;
  }
?>