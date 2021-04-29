<?php

  namespace app\core\form;
  use app\core\Model;

  class Form {

    public static function begin($method, $action = '') {
      echo sprintf('<form method="%s" action="%s">', $method, $action);
      return new Form();
    }

    public static function end() {
      return '</form>';
    }

    public function field(Model $model, $attribute) {
      return new Field($model, $attribute);
    }

  }
