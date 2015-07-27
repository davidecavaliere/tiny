<?php

/**
 * This is the "base controller class". All other "real" controllers extend this class.
 */
class Controller
{
    /**
     * @var null Model
     */
    public $model = null;

    /**
     * @var null Title
     */
     public $title = null;

    /**
    * @var Parser The Parser
    */

    /**
     * Whenever a controller is created, open a database connection too. The idea behind is to have ONE connection
     * that can be used by multiple models (there are frameworks that open one connection per model).
     */
    function __construct()
    {
      require APP . 'model' . DIRECTORY_SEPARATOR . 'model.php';
      require LIBS . 'parser.php';
      $this->parser = new Parser();
    }
}
