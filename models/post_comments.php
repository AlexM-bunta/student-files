<?php

  class PostComments {

    private $post_id;
    private $number_comments;

    public function __construct($post_id, $number_comments = 0, $db) {
      $this->post_id = $post_id;
      $this->number_comments = $number_comments;

      // Create table
      $query = 'CREATE TABLE postcomm' . $this->post_id . '(
          id int NOT NULL AUTO_INCREMENT,
          author VARCHAR(30),
          body text,
          date VARCHAR(20),
          PRIMARY KEY(id)
        )';

      if ($db->executeQuery($query) === false){
        printf("Error. Something went wrong.");
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
        $this->number_comments++;
        return true;
      }

      printf("Error: %s.\n", $stmt->error);

      return false;

    }

  }
