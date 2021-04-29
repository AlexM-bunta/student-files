<?php

  namespace app\controllers;
  use app\core\Controller;

  class SiteController extends Controller {

    public function home() {
      return $this->render('home');
    }

    public function about() {
      return $this->render('about');
    }

    public function login() {
      return $this->render('login');
    }

    public function register() {
      return $this->render('register');
    }

  }
