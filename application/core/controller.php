<?php
require_once APP . 'controllers/error.php';
require_once APP . 'model' . DIRECTORY_SEPARATOR . 'model.php';
require_once LIBS . 'parser.php';

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
     * @var null The Parser
     */
    public $parser = null;

    /**
     * @var null start time
     */
    public $startTime = null;

    /**
     * @var null end time
     */
    public $endTime = null;

    /**
     * Whenever a controller is created, open a database connection too. The idea behind is to have ONE connection
     * that can be used by multiple models (there are frameworks that open one connection per model).
     */
    function __construct()
    {
      $this->parser = new Parser();
      $this->startTime = microtime(true) * 1000;
    }
}
