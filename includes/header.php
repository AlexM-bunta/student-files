<?php
  session_start();
  $_SESSION['username'] = $_GET['username'];

  // Checking the last page accessed to prevent XSS
  if (!empty($_SESSION['pages']['prev']) or $_SESSION['pages']['prev'] !== 'No prev page'){
    $_SESSION['pages']['prev'] = $_SESSION['pages']['current'];
  }
  else {
    $_SESSION['pages']['prev'] = 'No prev page';
  }

  $_SESSION['pages']['current'] = $_SERVER['REQUEST_URI'];
?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
  </head>

  <body>

    <div class="navbar">

      <ul>
        <?php
          if (isset($_SESSION['username'])){
            echo '<li><a href="../views/home.php?username=' . $_SESSION['username'] . '">Home</a></li>';
            echo '<li><a href="../views/profile.php?username=' . $_SESSION['username'] . '">Profile</a></li>';
            echo '<li><a href="../controller/logout-contr.php">Log out</a></li>';
            echo '<li><a href="#about">About</a></li>';
          }
          else {
            echo '<li><a href="../views/login.php">Log in</a></li>';
            echo '<li><a href="../views/signup.php">Sign up</a></li>';
          }
        ?>

      </ul>

    </div>

    <br />
