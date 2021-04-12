<?php

  class User {

    private $username;
    private $first_name;
    private $last_name;
    private $password;
    private $email;
    // variable that will be used in later versions
    // private $friends = array();

    public function __construct($username, $password, $email, $first_name, $last_name) {
      $this->username = $username;
      $this->password = $password;
      $this->email = $email;
      $this->first_name = $first_name;
      $this->last_name = $last_name;
    }


    // Short description to check if all credentials are correct -- Test function
    public function shortDesc(){
      return 'Username ' . $this->username . '. I am ' . $this->first_name . ' ' . $this->last_name . '.Email is ' . $this->email . '.Password is ' . $this->password . '.';
    }

    // Function for verifying is the user is in the database only by username and password
    public function checkUserInDB($conn){

      $query = 'SELECT * FROM users WHERE username=:username';

      $stmt = $conn->prepare($query);

      $stmt->bindParam(':username', $this->username);

      if($stmt->execute()){
        // Fetch data from DB
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Extract data
        extract($row);

        // See if username and password match
        if ($this->username === $username && $this->password === $password){

          // Associate email, firstname and lastname with data in the database
          $this->email = $email;
          $this->first_name = $firstname;
          $this->last_name = $lastname;

          return true;
        }

        return false;
      }

      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Function to automatically insert into database
    public function insertIntoDB($conn){

      $query = 'INSERT INTO users SET
        username=:username,
        password=:password,
        firstname=:first_name,
        lastname=:last_name,
        email=:email
        ';

      $stmt = $conn->prepare($query);

      // Clean data
      $this->username = htmlspecialchars(strip_tags($this->username));
      $this->password = htmlspecialchars(strip_tags($this->password));
      $this->first_name = htmlspecialchars(strip_tags($this->first_name));
      $this->last_name = htmlspecialchars(strip_tags($this->last_name));
      $this->email = htmlspecialchars(strip_tags($this->email));

      // Bind data
      $stmt->bindParam(':username', $this->username);
      $stmt->bindParam(':password', $this->password);
      $stmt->bindParam(':first_name', $this->first_name);
      $stmt->bindParam(':last_name', $this->last_name);
      $stmt->bindParam(':email', $this->email);

      if ($stmt->execute()){
        return true;
      }

      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Getters and Setters
    public function getUsername(){
      return $this->username;
    }
    public function getEmail(){
      return $this->email;
    }
    public function getFirstName(){
      return $this->first_name;
    }
    public function getLastName(){
      return $this->last_name;
    }
    public function getPassword(){
      return $this->password;
    }


  }
