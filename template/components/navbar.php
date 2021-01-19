<nav>
  <ul>
  <?php
    foreach($routes as $key=>$value){
    ?>
    <li><a href="?p=<?= $key; ?>"><?= $value[0]; ?></a></li>
    <?php
    }
  ?>
  </ul>
</nav>