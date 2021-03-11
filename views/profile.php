<?php

  include_once '../includes/header.php';
  include_once '../includes/profile_functions.php';

  $user = ($_GET['viewuser'] !== null) ? $_GET['viewuser'] : $_GET['username'];
  show_user($user);
