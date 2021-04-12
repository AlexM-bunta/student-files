<?php
  include_once '../includes/header.php';

  if (!isset($_SESSION['username'])){
    header("Location: ./login.php");
  }

  // If there is not prev page, redirect
  // if (empty($_SESSION['pages']['prev']) or $_SESSION['pages']['prev'] === 'No prev page'){
  //   header("Location: ./login.php");
  // }
?>


  <?php
    echo '<h1>WELCOME ' . $_SESSION['username'] . '</h1>';
  ?>

  <div class="create-post">
    <h2>Create post</h2>
    <?php
      echo '<form method="post" action="../controller/create-post.php?username=' . $_SESSION['username'] . '">';
    ?>

      <div>
        <label for="title">Title</label>
        <input required type="text" name="title" placeholder="Title..."/>
      </div>

      <br />

      <div>
        <label for="body">Body</label>
        <textarea required name="body" rows="10" cols="40">
        </textarea>
      </div>

      <br />

      <input type="submit" name="submit-post" value="Submit" />

      <?php
        if ($_GET['postCreated'] === 'failed'){
          echo '<p>Post creation has failed for some reason</p>.';
        }
      ?>

    </form>
  </div>

  <div class="CreatePost">

    <?php
      include_once '../includes/post_functions.php';
      $arr = get_arr_posts();

      // To show from the first to the latest
      // foreach($arr as $post){
      //   show_post($post, $_SESSION['username']);
      // }

      // To show from the latest to the first
      for($i = count($arr) - 1; $i >= 0; $i--){
        show_post($arr[$i], $_SESSION['username']);
      }
    ?>

  </div>

</html>
