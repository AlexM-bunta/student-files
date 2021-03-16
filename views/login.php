<?php
  include_once '../includes/header.php';
?>

    <div>

      <form action="../controller/login-contr.php" method="post">

        <div>
          <label for="username">Username</label>
          <input type="text" name="username" />
        </div>
        <br />
        <div>
          <label for="password">Password</label>
          <input type="password" name="password" />
        </div>
        <br />
        <input type="submit" name="submit" value="Submit" />

      </form>

      <?php
        if (isset($_GET['error'])){
          $display_error = '';

          switch($_GET['error']){

            case 'usernotfound':
              $display_error = "Username was not found in the database.\n";
              break;

            case 'fieldnotvalid':
              $display_error = "A field is too large to be processed.\n";
              break;
          }
        }

        echo "<p>".$display_error."</p>";
      ?>

    </div>

  </body>

</html>
