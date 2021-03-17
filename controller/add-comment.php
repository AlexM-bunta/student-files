<?php

  include_once '../models/comment.php';
  include_once '../models/comment_section.php';
  include_once '../models/database.php';
  include_once '../models/post.php';
  include_once '../includes/post_functions.php';

  if (isset($_POST['submit-comment'])){
    $database = new Database;
    $conn = $database->connect();

    // Get comment details
    $comment = new Comment($_GET['author'], $_POST['comment'], date("h:i:s-d:m:y"));

    // Get the post
    $arr_posts = get_arr_posts();

    foreach($arr_posts as $post){
      if ($post->getId() === $_GET['postid']){

        // Add comment
        if ($post->getCommentSection()->addComment($comment, $conn)){
          header("Location: ../views/view_post.php?id=" . $post->getId());
        }
        else {
          header("Location: ../views/view_post.php?id=" . $post->getId() . "&commenterr=failure");
        }

        break;
      }
    }

    // If postid was not found
    if ($post->getId() === null) {
      die("Error. No such post found.");
    }
  }
