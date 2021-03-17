<?php

  include_once '../includes/header.php';
  include_once '../includes/post_functions.php';

  $arr_posts = get_arr_posts();
  $post_to_show = null;

  foreach($arr_posts as $post){
    if ($post->getId() === $_GET['id']){
      $post_to_show = $post;
      break;
    }
  }

  show_post($post_to_show, $_SESSION['username']);

  show_comment_section($post_to_show, $_SESSION['username']);
