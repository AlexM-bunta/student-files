<?php

  namespace app\core;

  class Request {

    // Get path of route
    public function getPath() {
      $path = $_SERVER['REQUEST_URI'] ?? '/';
      $position = strpos($path, '?');
      if ($position === false) {
        return $path;
      }
      return substr($path, 0, $position);
    }

    // Get method of route
    public function getMethod() {
      return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet() {
      return $this->getMethod() === 'get';
    }

    public function isPost() {
      return $this->getMethod() === 'post';
    }

  }
