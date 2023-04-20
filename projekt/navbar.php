<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/projekt/">Kezdőlap</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/projekt/dashboard/">Dashboard</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <?php if(isset($_SESSION['login_user'])) { ?>
        <li><a href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/projekt/admin/logout.php"><span class="glyphicon glyphicon-log-out"></span> Kijelentkezés</a></li>
      <?php } ?>
    </ul>
  </div>
</nav>
