<?php

  namespace app\core;

  class Router {

    public Request $request;
    public Response $response;
    public View $view;

    private array $routes = [];

    public function __construct($request, $response) {
      $this->request = $request;
      $this->response = $response;
      $this->view = new View();
    }

    // Create and configure the route
    public function resolve() {
      $path = $this->request->getPath();
      $method = $this->request->getMethod();
      $callback = $this->routes[$method][$path] ?? false;

      if ($callback === false) {
        $this->response->setStatusCode(404);
        return 'Not found.';
        exit;
      }

      if (is_string($callback)) {
        return $this->view->renderView($callback);
      }

      if (is_array($callback)) {
        App::$app->controller = new $callback[0]();
        $callback[0] = App::$app->controller;
      }

      return call_user_func($callback, $this->request);
    }

    // Create GET and POST HTTP methods
    public function get($path, $callback) {
      $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback) {
      $this->routes['post'][$path] = $callback;
    }


  }
