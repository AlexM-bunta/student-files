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

    </div>

  </body>

</html>
