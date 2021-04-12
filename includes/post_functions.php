<?php

  include_once '../models/database.php';
  include_once '../models/post.php';
  include_once '../models/comment_section.php';
  include_once '../models/comment.php';

  //---------------------------------------------------------------------------------------DATE FUNCTIONS

  function getDateAsArray($time){
    $time = explode('-', $time);
    $hms = explode(':', $time[0]);
    $dmy = explode(':', $time[1]);
    $arr = array(
      'h' => (int)$hms[0],
      'i' => (int)$hms[1],
      's' => (int)$hms[2],
      'd' => (int)$dmy[0],
      'm' => (int)$dmy[1],
      'y' => (int)$dmy[2]
    );

    return $arr;
  }

  function getTimeBetween($prev, $curr){
    $curr = getDateAsArray($curr);
    $prev = getDateAsArray($prev);

    // print_r($curr);
    // print_r($prev);

    if ($curr['y'] > $prev['y']){
      return $curr['y'] - $prev['y'] . " year" . (($curr['y'] - $prev['y'] > 1) ? "s" : "") . " ago";
    }
    else if ($curr['m'] > $prev['m']){
      return $curr['m'] - $prev['m'] . " month" . (($curr['m'] - $prev['m'] > 1) ? "s" : "") . " ago";
    }
    else if ($curr['d'] > $prev['d']){
      return $curr['d'] - $prev['d'] . " day" . (($curr['d'] - $prev['d'] > 1) ? "s" : "") . " ago";
    }
    else if ($curr['h'] > $prev['h']){
      return $curr['h'] - $prev['h'] . " hour" . (($curr['h'] - $prev['h'] > 1) ? "s" : "") . " ago";
    }
    else if ($curr['i'] > $prev['i']){
      return $curr['i'] - $prev['i'] . " minute" . (($curr['i'] - $prev['i'] > 1) ? "s" : "") . " ago";
    }
    else if ($curr['s'] > $prev['s']){
      return $curr['s'] - $prev['s'] . " second" . (($curr['s'] - $prev['s'] > 1) ? "s" : "") . " ago";
    }

  }

  //---------------------------------------------------------------------------------------POST FUNCTIONS

  function show_post($post, $userSESSION){

    $viewuser = ($post->getAuthor() !== $userSESSION) ? '&viewuser=' . $post->getAuthor() : '';
    $time = getTimeBetween($post->getDate(), date("h:i:s-d:m:y"));

    echo '<div class="post-render">
      <h3><a href="./view_post.php?id=' . $post->getId() . '">' . $post->getTitle() . '</a></h3>
      <p>by <a href="./profile.php?username=' . $userSESSION . $viewuser . '">' . $post->getAuthor() . '</a></p>
      <p>'.$time.'</p>
      <p>' . $post->getBody() . '</p>
    </div> <br />';

  }

  function get_arr_posts(){

    $database = new Database;
    $conn = $database->connect();

    $query = 'SELECT * FROM posts';

    $stmt = $conn->prepare($query);

    $arr_posts = array();

    if ($stmt->execute()){
      $row = $stmt->fetchAll();

      foreach($row as $value){
        $comment_section = new CommentSection($value['id'], $conn, false);

        $post = new Post($value['title'], $value['author'], $value['body'], $value['id']);
        $post->setDate($value['date']);
        $post->setCommentSection($comment_section);

        array_push($arr_posts, $post);
      }
    }

    return $arr_posts;
  }

  //---------------------------------------------------------------------------------------COMMENT SECTION FUNCTIONS

  function html_add_comment($id, $author){
    echo '
      <form method="post" action="../controller/add-comment.php?postid=' . $id . '&author=' . $author . '">
      <div>
        <label for="comment">Comment</label>
        <textarea required name="comment" rows="2" cols="40">
        </textarea>
      </div>
      <input type="submit" name="submit-comment" value="Submit" />
      </form>
    ';
  }

  function show_comment($comment) {
    echo '
      <div>
        <h5>' . $comment->getAuthor() . ' commented ' . getTimeBetween($comment->getTime(), date("h:i:s-d:m:y")) . '</h5>
        <p>'. $comment->getBody() . '</p>
      </div>
      <br />
    ';
  }

  function show_comment_section($post, $userSESSION) {
    $comment_section = $post->getCommentSection();
    $arr_comment = $comment_section->getArrComments();

    html_add_comment($post->getId(), $userSESSION);

    // To show from the latest to the first
    for($i = $comment_section->getNumberComments() - 1; $i >= 0; $i--){
      show_comment($arr_comment[$i]);
    }

    // To show from the first entered to last
    // foreach($comment_section->getArrComments() as $comment) {
    //   show_comment($comment);
    // }
  }
