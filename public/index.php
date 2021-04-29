<?php

  require_once __DIR__.'/../vendor/autoload.php';
  use app\core\App;
  use app\controllers\SiteController;

  $app = new App(dirname(__DIR__));

  // Get methods
  $app->router->get('/', [SiteController::class, 'home']);
  $app->router->get('/about', [SiteController::class, 'about']);
  $app->router->get('/login', [SiteController::class, 'login']);
  $app->router->get('/register', [SiteController::class, 'register']);

  // Post methods
  $app->router->post('/login', [SiteController::class, 'login']);
  $app->router->post('/register', [SiteController::class, 'register']);

  $app->run();
