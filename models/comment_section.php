<?php

  class CommentSection {

    private $post_id;
    private $number_comments;
    private $arr_comments = array();

    public function __construct($post_id, $conn, $create_table = true, $number_comments = 0) {
      $this->post_id = $post_id;
      $this->number_comments = $number_comments;

      // If create_table === true, create table; else, get the table from db
      if ($create_table === true){
        $query = 'CREATE TABLE postcomm' . $this->post_id . '(
            id int NOT NULL AUTO_INCREMENT,
            author VARCHAR(30),
            body text,
            date VARCHAR(20),
            PRIMARY KEY(id)
          )';

          $stmt = $conn->prepare($query);

          if ($stmt->execute() === false){
            printf("Error. Something went wrong");
          }
      }

      else {
        $query = 'SELECT * FROM postcomm' . $this->post_id;

        $stmt = $conn->prepare($query);

        if ($stmt->execute()){
          // Fetch rows
          $row = $stmt->fetchAll();
          // Get total number of comments
          $this->number_comments = $stmt->rowCount();

          foreach($row as $value){
            $comment = new Comment($value['author'], $value['body'], $value['date']);
            array_push($this->arr_comments, $comment);
          }
        }

      }


    }

    public function addComment($comment, $conn) {

      $query = 'INSERT INTO postcomm' . $this->post_id . ' SET
        author=:author,
        body=:body,
        date=:time
        ';

      $stmt = $conn->prepare($query);

      // Associate comment data
      $arr = array(
        'author' => $comment->getAuthor(),
        'body' => $comment->getBody(),
        'date' => $comment->getTime()
      );

      // Clean data
      $arr['body'] = htmlspecialchars(strip_tags($arr['body']));

      // Bind data
      $stmt->bindParam(':author', $arr['author']);
      $stmt->bindParam(':body', $arr['body']);
      $stmt->bindParam(':time', $arr['date']);

      if ($stmt->execute()){

        // Increase total number of comments
        $this->number_comments++;

        // Push into array
        array_push($this->arr_comments, $comment);

        return true;
      }

      printf("Error: %s.\n", $stmt->error);

      return false;

    }

    // Getters
    public function getArrComments() {
      return $this->arr_comments;
    }
    public function getNumberComments(){
      return $this->number_comments;
    }

  }
