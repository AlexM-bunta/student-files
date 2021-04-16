<?php

  namespace app\core;

  class View {

    // Rendering a file into a layout
    public function renderView($view, $params = []) {
      $layoutContent = $this->layoutContent();
      $viewContent = $this->renderOnlyView($view, $params);
      return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function renderContent($viewContent) {
      $layoutContent = $this->layoutContent();
      return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    // Get layout 
    protected function layoutContent() {
      $layout = App::$app->controller->layout;
      ob_start();
      include_once App::$ROOT_DIR."/views/layouts/$layout.php";
      return ob_get_clean();
    }

    protected function renderOnlyView($view, $params) {
      foreach($params as $key => $value) {
        $$key = $value;
      }

      ob_start();
      include_once App::$ROOT_DIR."/views/$view.php";
      return ob_get_clean();
    }


  }
