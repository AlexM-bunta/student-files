<?php

  require_once __DIR__.'/../vendor/autoload.php';
  use app\core\App;

  $app = new App(dirname(__DIR__));


  // Get methods
  $app->router->get('/', 'home');
  $app->router->get('/about', 'about');

  $app->run();
