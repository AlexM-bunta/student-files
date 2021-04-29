<h1>Log In</h1>

<?php

  use app\core\form\Form;

  $form = Form::begin('post');

  echo $form->field($model, 'email');
  echo $form->field($model, 'password');

  echo '<button type="submit" class="btn btn-primary">Submit</button>';

  Form::end();

?>

<!-- <form method="post" action="">
  <div class="form-group">
    <label>Email</label>
    <input type="email" name="email" class="form-control">
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" name="email" class="form-control">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form> -->
