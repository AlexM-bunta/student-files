<?php

  namespace app\core;

  abstract class Model {

    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';

    public array $errors = [];

    abstract public function rules() : array;

    public function loadData($data) {
      foreach ($data as $key => $value) {
        if (property_exists($this, $key)) {
          $this->{$key} = $value;
        }
      }
    }

    public function validate() {
      foreach ($this->rules() as $attribute => $rules) {
        $value = $this->{$attribute};

        foreach ($rules as $rule){
          $ruleName = $rule;
          if (!is_string($ruleName)){
            $ruleName = $rule[0];
          }

          if ($ruleName === self::RULE_REQUIRED && !$value){
            $this->addError($attribute, self::RULE_REQUIRED);
          }
          if ($ruleName === self::RULE_EMAIL && filter_var($value, FILTER_VALIDATE_EMAIL)){
            $this->addError($attribute, self::RULE_EMAIL);
          }
          if ($ruleName === self::RULE_REQUIRED && strlen($value) < $rule['min']){
            $this->addError($attribute, self::RULE_MIN, $rule);
          }
          if ($ruleName === self::RULE_REQUIRED && strlen($value) > $rule['max']){
            $this->addError($attribute, self::RULE_MAX, $rule);
          }
          if ($ruleName === self::RULE_REQUIRED && $value !== $this->{$rule['match']}){
            $this->addError($attribute, self::RULE_MATCH);
          }
        }
      }
      return empty($this->errors);
    }

    public function addError(string $attribute, string $rule, $params = []) {
      $message = $this->errorMessage()[$rule] ?? '';
      foreach ($params as $key => $value) {
        $message = str_replace("{{$key}}", $value, $message);
      }
      $this->errors[$attribute][] = $message;
    }

    public function errorMessages() {
      return [
        self::RULE_REQUIRED => 'This field is required',
        self::RULE_EMAIL => 'Enter a valid email address',
        self::RULE_MIN => 'This field cannot be have less than {min} characters',
        self::RULE_MAX => 'This field cannot be have more than {max} characters',
        self::RULE_MATCH => 'This field and {match} must match'
      ];
    }

    public function hasError($attribute) {
      return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute) {
      return $this->errors[$attribute][0] ?? false;
    }

  }
