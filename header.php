<?php
  @include "database/db.php";
  session_start();

  if(!isset($_SESSION['user_name'])){
    header('location:login.php');
}

?>

<header class="header">
    <div class="flex">

        <nav class="navbar">
            <a><?= $_SESSION['user_name'] ?></a>
        </nav>

        <div id="menu-btn" class="fas fa-bars"></div>
    </div>
</header>