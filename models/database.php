<?php

  class Database {

    private $conn;
    private $host = 'localhost:3306';
    private $db = 'student_files';
    private $username = 'root';
    private $password = '';

    // Establishing connection with the database
    public function connect() {
        $this->conn = null;

        try{
          $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db, $this->username, $this->password);
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          // Create tables
          $this->create_table("../sql/tables/create_users.sql");
          $this->create_table("../sql/tables/create_posts.sql");
        }
        catch(PDOException $e) {
          echo 'Connection error: ' . $e->getMessage();
        }

        return $this->conn;
    }

    private function create_table($filepath){
      $query = file_get_contents($filepath);

      $stmt = $this->conn->prepare($query);

      if ($stmt->execute()){
        return true;
      }

      printf("Error when creating table " . $filepath . ". \n%s.\n", $stmt->error());

      return false;
    }

    // Execute any query
    public function executeQuery($query) {
      $stmt = $this->conn->prepare($query);

      return $stmt->execute();
    }

    public function __destruct(){
      $this->conn = null;
    }


    // Getters
    public function getConn(){
      return $this->conn;
    }

  }
