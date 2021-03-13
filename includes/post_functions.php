<?php

  include_once '../models/database.php';
  include_once '../models/post.php';

  function get_arr_posts(){

    $database = new Database;
    $conn = $database->connect();

    $query = 'SELECT * FROM posts';

    $stmt = $conn->prepare($query);

    $arr_posts = array();

    if ($stmt->execute()){
      $row = $stmt->fetchAll();

      foreach($row as $value){
        $post = new Post($value['title'], $value['author'], $value['body'], $value['id']);
        $post->setDate($value['date']);
        array_push($arr_posts, $post);
      }
    }

    return $arr_posts;
  }

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

  function getTimeBetween($curr, $prev){
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

  function show_post($post, $userSESSION){

    $viewuser = ($post->getAuthor() !== $userSESSION) ? '&viewuser=' . $post->getAuthor() : '';
    $time = getTimeBetween(date("h:i:s-d:m:y"),$post->getDate());

    echo '<div>
      <h3>' . $post->getTitle() . '</h3>
      <p></p>
      <p>by <a href="/views/profile.php?username=' . $userSESSION . $viewuser . '">' . $post->getAuthor() . '</a></p>
      <p>'.$time.'</p>
      <p>' . $post->getBody() . '</p>
    </div> <br />';

  }
