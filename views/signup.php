<?php
  include_once '../includes/header.php';
?>

    <div>

      <form action="../controller/signup-contr.php" method="post">

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

        <div>
          <label for="repass">Re-enter password</label>
          <input type="password" name="repassword" />
        </div>

        <br />

        <div>
          <label for="email">Email</label>
          <input type="email" name="email" />
        </div>

        <br />

        <div>
          <label for="fname">First name</label>
          <input type="text" name="fname" />
        </div>

        <br />

        <div>
          <label for="lname">Last name</label>
          <input type="text" name="lname" />
        </div>

        <br />

        <input type="submit" name="submit" value="Submit" />

      </form>

    </div>

  </body>

</html>
