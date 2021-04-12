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

  function show_user($username, $userSESSION){

    $user = get_user($username);

    echo '<div class="card">
      <h1>' . $user->getUsername() . '</h1>
      <p class="title">' . $user->getFirstName() . " " . $user->getLastName() . '</p>
      <p>' . $user->getEmail() . '</p>';
      if ($username !== $userSESSION){
        echo '<button>Message</button>';
      }
      echo '</div>';

  }


  // Function only used for testing purposes
  function show_all_users($userSESSION){

    $database = new Database;
    $conn = $database->connect();

    $query = 'SELECT * FROM users WHERE NOT username=:username';

    $stmt = $conn->prepare($query);

    // Clean data
    $username = htmlspecialchars(strip_tags($userSESSION));

    // Bind data
    $stmt->bindParam(":username", $username);

    if ($stmt->execute()){
      while ($row = $stmt->fetch()){
        echo '<div>
          <h3><a href="./profile.php?username=' . $userSESSION . '&viewuser=' . $row['username'] . '">' . $row['username'] . '</a></h3>
          <p>email: ' . $row['email'] . '</p>
          <p>name: ' . $row['firstname'] . " " . $row['lastname'] . '</p>
        </div>';
      }

      return true;

    }

    printf("Error: %s.\n", $stmt->error);

    return false;

  }
