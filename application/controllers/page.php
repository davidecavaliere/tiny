<?php

/**
 * Class Page
 *
 */
class Page extends Controller
{
  /**
   * PAGE: serve
   * This method handles the page serving
   */
    public function serve($page) {
      $this->title = ucfirst($page);

      $pageBasePath = PAGE . $page;

      if (file_exists($pageBasePath. '.html')) {

        // page can be served
        $this->model = file_get_contents($pageBasePath . '.html');


      } else if (file_exists($pageBasePath . '.txt')) {
        $pageContent = file_get_contents($pageBasePath . '.txt');
        $this->model = $this->parser->parse($pageContent);
      } else {
        // search for page in database
        $model = new Model();
      }

      // load views
      require APP . 'views/_templates/header.php';
      require APP . 'views/index.php';
      require APP . 'views/_templates/footer.php';

    }
}
