<?php

  class Post {

    private $title;
    private $author;
    private $body;
    private $id;
    private $time;
    private $comment_section;

    public function __construct($title, $author, $body, $id = null){
      $this->title = $title;
      $this->author = $author;
      $this->body = $body;
      $this->id = $id;
    }

    public function deleteFromDB($conn){
      $queryDROP = "DROP TABLE postcomm" . $this->id;
      $queryDELETEPOST = "DELETE FROM posts WHERE id=" . $this->id;

      $stmtDROP = $conn->prepare($queryDROP);
      $stmtDELETEPOST = $conn->prepare($queryDELETEPOST);

      if ($stmtDROP->execute() && $stmtDELETEPOST->execute()){
        return true;
      }

      printf("Error!\nDROP:%s.\nDELETEPOST:%s", $stmtDROP->error, $stmtDELETEPOST->error);
      return false;
    }

    public function insertIntoDB($conn){

      $this->time = date("h:i:s-d:m:y");
      $query = 'INSERT INTO posts SET
        title=:title,
        author=:author,
        body=:body,
        date=:time_created
        ';

      $stmt = $conn->prepare($query);

      // Clean data
      $this->title = htmlspecialchars(strip_tags($this->title));
      $this->author = htmlspecialchars(strip_tags($this->author));
      $this->body = htmlspecialchars(strip_tags($this->body));

      // Bind data
      $stmt->bindParam(':title', $this->title);
      $stmt->bindParam(':author', $this->author);
      $stmt->bindParam(':body', $this->body);
      $stmt->bindParam(':time_created', $this->time);

      if ($stmt->execute()){
        $this->id = $conn->lastInsertId();
        return true;
      }

      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Getters
    public function getTitle(){
      return $this->title;
    }
    public function getAuthor(){
      return $this->author;
    }
    public function getBody(){
      return $this->body;
    }
    public function getDate(){
      return $this->time;
    }
    public function getId(){
      return $this->id;
    }
    public function getCommentSection(){
      return $this->comment_section;
    }

    // Setters
    public function setDate($date){
      $this->time = $date;
    }
    public function setCommentSection($comment_section){
      $this->comment_section = $comment_section;
    }

  }
