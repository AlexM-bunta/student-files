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
        array_push($arr_posts, new Post($value['title'], $value['author'], $value['body'], $value['id']));
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

  function getTimeBetween($curr, $prev, $manner){
    $curr = getDateAsArray($curr);
    $prev = getDateAsArray($prev);

    print_r($curr);
  }

  function show_post($post, $userSESSION){

    $viewuser = ($post->getAuthor() !== $userSESSION) ? '&viewuser=' . $post->getAuthor() : '';
    $time = getTimeBetween(date("h:i:s-d:m:y"),$post->getDate(), 'h');

    echo '<div>
      <h3>' . $post->getTitle() . '</h3>
      <p></p>
      <p>by <a href="/views/profile.php?username=' . $userSESSION . $viewuser . '">' . $post->getAuthor() . '</a></p>
      <p>' . $post->getBody() . '</p>
    </div> <br />';

  }
