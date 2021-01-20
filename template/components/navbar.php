<nav>
  <ul>
  <?php
    foreach($routes as $key=>$value) {
    ?>
      <li><a href="?p=<?= $key; ?>"><?= $value; ?></a></li>
    <?php
    }
  ?>
  </ul>
</nav>