<?php

  include_once '../includes/process_forms.php';
  include_once '../models/database.php';
  include_once '../models/user.php';


  // Create connection
  $database = new Database;
  $conn = $database->connect();

  // If sign up
  if (isset($_POST['submit'])){

    // Get data from form
    $arr = array(
      "username" => $_POST['username'],
      "password" => $_POST['password'],
      "repassword" => $_POST['repassword'],
      "email" => $_POST['email'],
      "first_name" => $_POST['fname'],
      "last_name" => $_POST['lname']
    );

    // Process form
    $errors = validating_signup($arr);
    if (count($errors) === 0){

      // Create user then insert into db
      $user = new User($arr['username'], $arr['password'], $arr['email'], $arr['first_name'], $arr['last_name']);
      if($user->insertIntoDB($conn)){
        // User was inserted successfuly. Redirect to login
        header("Location: ../views/login.php");
      }
    }
    else {
      // Print errors
      foreach($errors as $error){
        echo "<h1>" . $error . "</h1>";
      }
    }

  }
