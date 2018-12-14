<?php

/**
 * Usage : 
 * $dbLink = new Database();
 * 
 * $req1 = $dbLink->execute('SELECT * FROM users');
 * $req2 = $dbLink->execute('SELECT * FROM users WHERE username = :username', ['username' => 'rigwild']);
 * 
 * The link with the database is established once on each reload.
 * 
 * @author rigwild - https://github.com/rigwild
 * @see https://gist.github.com/rigwild/5d4660f3f6f979171496a11e548020d9
 */

require_once 'DatabaseConfig.class.php';

class Database {
  private $dbCredentials = null;
  private $connection = null;

  public function __construct() {
    $this->dbCredentials = Config::$DatabaseCredentials;
  }

  private function connect() {
    if ($this->connection !== null)
      return $this->connection;
    $dbInfos = $this->dbCredentials['SGBD']
      .':host='.$this->dbCredentials['host']
      .';port='.$this->dbCredentials['port']
      .';dbname='.$this->dbCredentials['dbName']
      .';charset=utf8';
    $username = $this->dbCredentials['username'];
    $password = $this->dbCredentials['password'];
    $conn = new PDO($dbInfos, $username, $password);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $this->connection = $conn;
    return $conn;
  }

  /**
   * Execute a select query
   * @param query the SQL query to execute
   * @param parametersArray an array of parameters
   * 
   * @return boolean the result of the query
   */
  public function select($query, $parametersArray = []) {
    $conn = $this->connect();
    $stmt = $conn->prepare($query);
    if ($stmt->execute($parametersArray))
      return $stmt->fetchAll();
    return null;
  }

  /**
   * Execute a query that doesn't return any tuples
   * @param query the SQL query to execute
   * @param parametersArray an array of parameters
   * 
   * @return boolean the query worked
   */
  public function execute($query, $parametersArray = []) {
    $conn = $this->connect();
    $stmt = $conn->prepare($query);
    return ($stmt->execute($parametersArray));
  }
}
?>
