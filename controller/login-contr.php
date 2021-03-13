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
        // Redirect
        header("Location: ../views/home.php?username=" . $user->getUsername());
      }
      else {
        header("Location: ../views/login.php?error=usernotfound");
      }
    }
    else {

      // Print errors
      $errURL = "";
      foreach($errors as $error){
        $errURL = $errURL . '&' . $error;
      }

      // Refresh page with errors
      header("Location: ../views/login.php?error=" . $errURL);
    }

  }
