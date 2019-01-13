<?php

require_once 'DatabaseConfig.class.php';

/**
 * Easily communicate with your database.
 * 
 * Usage : 
 * $dbLink = new Database();
 * 
 * $req1 = $dbLink->select('SELECT * FROM users');
 * $req2 = $dbLink->select('SELECT * FROM users WHERE username = :username', ['username' => 'rigwild']);
 * $req3 = $dbLink->execute('INSERT INTO users VALUES (:username), ['username' => 'rigwild']);
 * 
 * The link with the database is established only once to save performance.
 * 
 * MySQL and PostgreSQL are supported.
 * 
 * @author rigwild - https://github.com/rigwild
 * @see https://gist.github.com/rigwild/5d4660f3f6f979171496a11e548020d9
 */
class Database {
  private $dbConfig = null;
  private $connection = null;

  public function __construct() {
    $this->dbConfig = DatabaseConfig::$Config;
  }

  /**
   * Connect to the database and backup the PDO object for next use.
   * Public so you can get the PDO object if you need it.
   * 
   * @return PDO pdo connection object
   */
  public function connect() {
    if ($this->connection !== null)
      return $this->connection;
    $dbInfos = $this->dbConfig['SGBD']
      .':host='.$this->dbConfig['host']
      .';port='.$this->dbConfig['port']
      .';dbname='.$this->dbConfig['dbName'];

    if ($this->dbConfig['SGBD'] === 'mysql') $dbInfos .= ';charset=utf8mb4';
    elseif ($this->dbConfig['SGBD'] === 'pgsql') $dbInfos .= ';options=\'-c client_encoding=utf8\'';

    $username = $this->dbConfig['username'];
    $password = $this->dbConfig['password'];

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
    return $stmt->execute($parametersArray);
  }
}

?>