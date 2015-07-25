<?php

class Application
{
    /** @var array URL parameters */
    private $url_params = array();

    /**
     * "Start" the application:
     * Analyze the URL elements and calls the according controller/method or the fallback
     */
    public function __construct()
    {
        $this->parseURL();

        $this->handlePage();


        // // check for controller: no controller given ? then load start-page
        // if (!$this->url_controller) {
        //
        //     require APP . 'controllers/home.php';
        //     $page = new Home();
        //     $page->index();
        //
        // } elseif (file_exists(APP . 'controllers/' . $this->url_controller . '.php')) {
        //     // here we did check for controller: does such a controller exist ?
        //
        //     // if so, then load this file and create this controller
        //     // example: if controller would be "car", then this line would translate into: $this->car = new car();
        //     require APP . 'controllers/' . $this->url_controller . '.php';
        //     $this->url_controller = new $this->url_controller();
        //
        //     // check for method: does such a method exist in the controller ?
        //     if (method_exists($this->url_controller, $this->url_action)) {
        //
        //         if(!empty($this->url_params)) {
        //             // Call the method and pass arguments to it
        //             call_user_func_array(array($this->url_controller, $this->url_action), $this->url_params);
        //         } else {
        //             // If no parameters are given, just call the method without parameters, like $this->home->method();
        //             $this->url_controller->{$this->url_action}();
        //         }
        //
        //     } else {
        //         if(strlen($this->url_action) == 0) {
        //             // no action defined: call the default index() method of a selected controller
        //             $this->url_controller->index();
        //         }
        //         else {
        //             // defined action not existent: show the error page
        //             require APP . 'controllers/error.php';
        //             $page = new Error();
        //             $page->index();
        //         }
        //     }
        // } else {
        //     require APP . 'controllers/error.php';
        //     $page = new Error();
        //     $page->index();
        // }
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
