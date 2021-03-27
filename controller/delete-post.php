<?php

  include_once '../includes/post_functions.php';
  include_once '../models/database.php';
  include_once '../models/post.php';
  include_once '../models/comment_section.php';

  session_start();

  $arr_posts = get_arr_posts();

  foreach($arr_posts as $post) {
    // Find post in DB
    if ($post->getId() === $_GET['postid']){

      // Check if the person deleting is the same as the one logged in
        if ($_SESSION['username'] === $post->getAuthor()){
          if (isset($_POST['delete-submit'])){

            $database = new Database;
            $conn = $database->connect();

            if ($post->deleteFromDB($conn)){
              header("Location: ../views/profile.php?username=" . $_SESSION['username'] . "&postdeleted=success");
            }
            else {
              header("Location: ../views/profile.php?username=" . $_SESSION['username'] . "&postdeleted=fail");
            }
          }
        }
      // Else delete session through logout
        else {
          header("Location: ./logout-contr.php");
        }

      // Found the post, stop execution
      break;
    }
  }
