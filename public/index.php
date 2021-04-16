<?php

  require_once __DIR__.'/../vendor/autoload.php';
  use app\core\App;
  use app\controllers\SiteController;

  $app = new App(dirname(__DIR__));


  // Get methods
  $app->router->get('/', [SiteController::class, 'home']);
  $app->router->get('/about', [SiteController::class, 'about']);

  $app->run();
