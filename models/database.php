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
        }
        catch(PDOException $e) {
          echo 'Connection error: ' . $e->getMessage();
        }

        return $this->conn;
    }

    // Execute any query
    public function execute_query($query) {
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
