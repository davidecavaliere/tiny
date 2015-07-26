<?php

class Model
{
    /**
     * @var null Database Connection
     */
    public $db = null;

    /**
     * @var null Model
     */
    public $model = null;

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
        // @see http://www.php.net/manual/en/pdostatement.fetch.php
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

        // generate a database connection, using the PDO connector
        // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
        try {
          $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
          die('Database connection could not be established.');
        }
    }

    public function findPageByTitle($title) {
      $sql = 'SELECT * FROM page WHERE title = :title LIMIT 1';
      $query = $this->db->prepare($sql);

      $params = array(':title' => $title);

      $query->execute($params);

      return $query->fetch();
    }

}
