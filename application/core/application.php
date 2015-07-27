<?php

class Application
{
    /** @var array URL parameters */
    private $url_params = array();

    /**
     * "Start" the application:
     * Analyze the URL elements and calls the according controller/method or the fallback
     */
    public function __construct() {
        $this->parseURL();
        $this->handlePage();
    }

    private function handlePage() {
      $page = $this->url_params['page'];

      require APP . 'controllers/page.php';

      $pageCtrl = new Page();

      $pageCtrl->serve($page);
    }

    /**
     *  Handle Errors
     */
    private function handleError($message) {
      require APP . 'controllers/error.php';
      $page = new Error();
      $page->index($message);
    }

    /**
     * Get and split the URL
     */
    private function parseURL() {
      $requestedURI = $_SERVER['REQUEST_URI'];

      $url = explode('/', $_SERVER['REQUEST_URI']);

      if (empty($url[1])) $this->handleError('Missing params');

      $rawParams = explode('&', explode('?', $url[1])[1]);
      $params = array();

      foreach ($rawParams as $key => $value) {
        if (!empty($value)) {
          $param = explode('=', $value);
          $params[$param[0]] = $param[1];
        }
      }

      if (!array_key_exists('page', $params)) $this->handleError('Missing param: page');

      $this->url_params = $params;
    }
}
