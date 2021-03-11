<?php

  include_once '../models/database.php';
  include_once '../models/user.php';

  function get_user($username){
    $database = new Database;
    $conn = $database->connect();

    $query = 'SELECT * FROM users WHERE username=:username';

    $stmt = $conn->prepare($query);

    // Clean data
    $username = htmlspecialchars(strip_tags($username));

    // Bind data
    $stmt->bindParam(":username", $username);

    if ($stmt->execute()){
      $row = $stmt->fetch();
      return new User($row['username'], $row['password'], $row['email'], $row['firstname'], $row['lastname']);
    }

    printf("Error: %s.\n", $stmt->error);

    return null;
  }

  function show_user($username){

    $user = get_user($username);

    echo '<div class="card">
      <h1>' . $user->getUsername() . '</h1>
      <p class="title">' . $user->getFirstName() . " " . $user->getLastName() . '</p>
      <p>' . $user->getEmail() . '</p>
    </div>';

  }
