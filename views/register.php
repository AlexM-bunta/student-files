<h1>Register</h1>

<?php

  use app\core\form\Form;

  $form = Form::begin('post');

  echo $form->field($model, 'firstname');
  echo $form->field($model, 'lastname');
  echo $form->field($model, 'email');
  echo $form->field($model, 'password');
  echo $form->field($model, 'passwordConfirm');

  echo '<button type="submit" class="btn btn-primary">Submit</button>';

  Form::end()
?>

<!-- <form method="post" action="">
  <div class="row">
    <div class="col">
      <div class="form-group">
        <label>First name</label>
        <input type="text" name="firstname" value="<?php //echo $model->firstname ?>"
              class="form-control<?php //echo $model->hasError('firstname') ? ' is-invalid' : '' ?>">
        <div class="invalid-feedback">
          <?php //echo $model->getFirstError('firstname') ?>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <label>Last name</label>
        <input type="text" name="lastname" class="form-control">
      </div>
    </div>
  </div>

  <div class="form-group">
    <label>Email</label>
    <input type="email" name="email" class="form-control">
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" name="password" class="form-control">
  </div>
  <div class="form-group">
    <label>Confirm password</label>
    <input type="password" name="passwordConfirm" class="form-control">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form> -->
