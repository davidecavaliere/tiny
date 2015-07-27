<?php

class Model
{
    /**
     * @var null Database Connection
     */
    public $db = null;

    private $dbType = 'mysql';
    private $dbHost = 'localhost';
    private $dbName = 'pages';
    private $dbUser = 'admin';
    private $dbPass = 'pass';

    /**
     * @param object $db A PDO database connection
     */
    function __construct()
    {
      $this->openDatabaseConnection();
    }

    /**
     * Open the database connection with the credentials from application/config/config.php
     */
    private function openDatabaseConnection()
    {
        // set the (optional) options of the PDO connection. in this case, we set the fetch mode to
        // "objects", which means all results will be objects, like this: $result->user_name !
        // For example, fetch mode FETCH_ASSOC would return results like this: $result["user_name] !
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

        // generate a database connection, using the PDO connector
        try {
          $this->db = new PDO($this->dbType .
            ':host=' . $this->dbHost .
            ';dbname=' . $this->dbName .
            ';charset=utf8',
            $this->dbUser, $this->dbPass, $options);
        } catch (PDOException $e) {
          die('Database connection could not be established.');
        }
    }

    public function findPageByTitle($title) {
      $title = urldecode($title);

      $sql = "SELECT * FROM page WHERE title = :title";
      $query = $this->db->prepare($sql);

      $params = array(':title' => $title);
      $query->execute($params);

      $page = $query->fetch();

      return $page;
    }

}
