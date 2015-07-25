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
      $pageBasePath = PAGE . $page;
      if (file_exists($pageBasePath. '.html')) {

        // page can be served
        $this->model = file_get_contents($pageBasePath . '.html');


      } else if (file_exists($pageBasePath . '.txt')) {
        $pageContent = file_get_contents($pageBasePath . '.txt');
        require LIBS . 'parser.php';
        $parser = new Parser();
        $this->model = $parser->parse($pageContent);
      } else {
        // search for page in database
        require APP . 'model' . DIRECTORY_SEPARATOR . 'model.php';
        $model = new Model();
      }

      // load views
      require APP . 'views/index.php';
      require APP . 'views/_templates/footer.php';

    }
}
