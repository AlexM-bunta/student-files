<?php
  include_once '../includes/header.php';

  if (empty($_SESSION['pages']['prev']) or $_SESSION['pages']['prev'] === 'No prev page'){
    header("Location: http://localhost:5000/views/login.php");
  }
?>


  <?php
    echo '<h1>WELCOME ' . $_SESSION['username'] . '</h1>';
  ?>

  <div class="CreatePost">
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
        <textarea required placeholder="Type something..." name="body" rows="10" cols="40">
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

      foreach($arr as $post){
        show_post($post, $_SESSION['username']);
      }
    ?>

  </div>

</html>
