<?php

  class Route {

    private static $routes = array();
    private static $pathNotFound = null;
    private static $methodNotAllowed = null;

    public static function add($expression, $function, $method = 'get') {
      array_push(self::$routes, array(
        'expression' => $expression,
        'function' => $function,
        'method' => $method
      ));
    }

    public static function pathNotFound($function) {
      self::$pathNotFound = $function;
    }

    public static function methodNotAllowed($function) {
      self::$methodNotAllowed = $function;
    }

  }
