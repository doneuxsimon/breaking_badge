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
    return isAuthenticated && $_SESSION['account_type'] == 'ADMIN';
  }

  function login($email, $password){
    session_start_once();

    $cursor = createCursor();
    $query = $cursor->prepare('SELECT id, pwd, account_type from users WHERE mail=?');
    $query->execute([$email]);
    $results = $query->fetch();
    
    if(password_verify($password, $results['pwd'])){
      $_SESSION['user_id'] = $results['id'];
      $_SESSION['account_type'] = $results['account_type'];
      $_SESSION['email'] = $email;

      return true;
    }
    return false;
  }

  function logout(){
    session_start_once();
    session_destroy();
  }

  function getBadges(){
    $db = createCursor();
    $badges = $db->query('SELECT name, description, shape FROM badges');

    return $badges;
  }

  function getBadgesByUser($userId) {
    $db = createCursor();
    $badgesUser = $db->prepare('SELECT b.name AS badge, b.description AS description, b.shape AS shape,
    users.firstname, users.lastname
    FROM badges AS b
    INNER JOIN users_has_badges
    ON b.id = users_has_badges.fk_badges_id
      INNER JOIN users
      ON users.id = users_has_badges.fk_users_id
    WHERE users.id = ?');
    $badgesUser->execute([ $userId ]);

    return $badgesUser;
  }

  function getUsers(){
    $db = createCursor();
    $users = $db->query('SELECT firstname, lastname, mail FROM users');

    return $users;
  }

  function getStudents() {
    $db = createCursor();
    $students = $db->query('SELECT firstname, lastname, mail FROM users WHERE account_type = "NORMIE"');

    return $students;
  }

  function addUsers($firstname, $lastname, $mail, $account, $pwd) {
    $pwd = password_hash($pwd, PASSWORD_DEFAULT);
    $db = createCursor();
    try {
      $req = $db->prepare('INSERT INTO users(firstname, lastname, mail, pwd, account_type) VALUES(?, ?, ?, ?, ?)');
      $req->execute([
        $firstname,
        $lastname,
        $mail,
        $account,
        $pwd
      ]);
    } catch (Exception $e) {
      echo "This email adress is already used !";
    } 
}

  function createBadge($name, $description, $shape){
    $db = createCursor();
    $req = $db->prepare('INSERT INTO badges(name, description, shape) VALUES(?, ?, ?, ?)');
    $affectedLines = $req->execute([
      $name,
      $description,
      $shape
    ]);

    return $affectedLines;
  }

  function editBadge($badge_id, $name, $description, $shape){
    $db = createCursor();
    $req = $db->prepare('UPDATE badges SET name = ?, description = ?, shape = ? WHERE id = ?');
    $affectedLines = $req->execute([
      $name,
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

  function grantBadgeToUser($badge_id, $user_id){
    $db = createCursor();
    $req = $db->prepare('INSERT INTO users_has_badges(fk_badges_id, fk_users_id) VALUES(?, ?)');
    $affectedLines = $req->execute([
      $badge_id,
      $user_id
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
?>