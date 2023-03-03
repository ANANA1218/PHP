<?php
require_once '_inc/function.php';
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/"><img src="/img/logo.png"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/games.php">Games</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/contact.php">Contact</a>
      </li>
      <?php if (getSessionData('user')): ?>
        <li class="nav-item">
          <a class="nav-link" href="/logout.php">Logout</a>
        </li>
      <?php else: ?>
        <li class="nav-item">
          <a class="nav-link" href="/login.php">Login</a>
        </li>
      <?php endif; ?>
      <?php if (isset($_SESSION['user'])) : ?>
        <li class="nav-item">
      <a class="nav-link" href="admin/index.php">Espace d'administration</a>
      </li>
      <?php endif; ?>

    </ul>
  </div>
</nav>
