<?php

  include_once '../includes/process_forms.php';
  include_once '../models/database.php';
  include_once '../models/post.php';
  include_once '../models/comment_section.php';

  $database = new Database;
  $conn = $database->connect();

  if (isset($_POST['submit-post'])){

    // Get data from form
    $arr = array(
      "title" => $_POST['title'],
      "author" => $_GET['username'],
      "body" => $_POST['body']
    );

    $errors = validate_create_post($arr);
    if(count($errors) === 0){

      // Create post
      $post = new Post($arr['title'], $arr['author'], $arr['body']);

      // Insert into DB
      if ($post->insertIntoDB($conn)){

        // Create comment section and assocciate with the post
        $comment_section = new CommentSection($post->getId(), $conn);
        $post->setCommentSection($comment_section);

        // Redirect
        header("Location: ../views/home.php?postCreated=success");
      }
      else {
        header("Location: ../views/home.php?postCreated=failed");
      }

    }

    else {
      header("Location: ../views/home.php?errors=titleorbody");
    }

  }
