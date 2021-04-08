<?php

  include_once '../includes/header.php';
  include_once '../includes/profile_functions.php';
  include_once '../includes/post_functions.php';

  $user = ($_GET['viewuser'] !== null) ? $_GET['viewuser'] : $_GET['username'];
  show_user($user, $_SESSION['username']);

  if ($_GET['postdeleted'] === 'fail'){
    echo '<p>Could not delete post.</p>';
  }


  echo "<hr /><h2>Posts made by this user</h2>";

  // Show posts of user
  $arr_posts = get_arr_posts();
  foreach($arr_posts as $post) {
      if (!strcmp($post->getAuthor(), $user)){
        show_post($post, $_SESSION['username']);
      }

      if (!strcmp($post->getAuthor(), $_SESSION['username'])){
        echo '
        <form action="../controller/delete-post.php?postid=' . $post->getId() . '" method="post">
          <input type="submit" name="delete-submit" value="Delete post" />
        </form>
        ';
      }
  }
