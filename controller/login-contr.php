<?php

  include_once '../includes/process_forms.php';
  include_once '../models/database.php';
  include_once '../models/user.php';

  $database = new Database();
  $conn = $database->connect();

  if (isset($_POST['submit'])){

    // Get data from form
    $arr = array(
      "username" => $_POST['username'],
      "password" => $_POST['password']
    );

    // Process form
    $errors = validating_login($arr);
    if (count($errors) === 0){

      // Create user then check if it is in db
      $user = new User($arr['username'], $arr['password'], '', '', '');

      if ($user->checkUserInDB($conn)){

        // Session start -> set the username session variable
        session_start();
        $_SESSION['username'] = $user->getUsername();

        // Create cookie
        //setcookie($user->getUsername());

        // Redirect
        header("Location: ../views/home.php");
      }
      else {
        header("Location: ../views/login.php?error=usernotfound");
      }
    }
    else {

      // Refresh page with errors
      header("Location: ../views/login.php?error=fieldnotvalid");
    }

  }
