<?php

  namespace app\core;

  class App {

    public Router $router;
    public Request $request;
    public Response $response;
    public Controller $controller;

    public static App $app;
    public static string $ROOT_DIR;

    public function __construct($rootPath) {
      self::$ROOT_DIR = $rootPath;
      self::$app      = $this;

      $this->controller = new Controller();
      $this->request    = new Request();
      $this->response   = new Response();
      $this->router     = new Router($this->request, $this->response);
    }

    // Core function
    public function run() {
      echo $this->router->resolve();
    }

  }
