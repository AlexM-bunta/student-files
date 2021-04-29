<?php

  namespace app\models;
  use app\core\Model;

  class LoginModel extends Model {

    public string $email = '';
    public string $password = '';

    public function login() {
      echo 'Login user';
    }

    public function rules() : array {
      return [
        'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
        'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' >= 8], [self::RULE_MAX, 'max' <= 24]],
      ];
    }

  }
