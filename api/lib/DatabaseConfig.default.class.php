<?php

/**
 * Configure the connection to the database.
 * SGBD can be 'mysql' or 'pgsql'. Change Database.class.php if you need another driver.
 * 
 * @author rigwild - https://github.com/rigwild
 * @see https://gist.github.com/rigwild/5d4660f3f6f979171496a11e548020d9
 */
class DatabaseConfig {
  static public $Config = [
    'SGBD'     => 'mysql',
    'host'     => 'localhost',
    'port'     => 3306,
    'dbName'   => '',
    'username' => '',
    'password' => ''
  ];
}
?>
