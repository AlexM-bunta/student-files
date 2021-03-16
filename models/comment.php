<?php

  class Comment {

    private $author;
    private $body;
    private $time;

    public function __construct($author, $body, $time) {
      $this->author = $author;
      $this->body = $body;
      $this->time = $time;
    }

    // Getters
    public function getAuthor() {
      return $this->author;
    }
    public function getBody() {
      return $this->body;
    }
    public function getTime() {
      return $this->time;
    }


  }
