<?php
namespace ConnectionManager;

class Connection extends \PDO{

  private static $conn;
  private $data;

  public function __construct(){
    $this->data = getConfig()['database'];
  }

  public function connect(){
    if($this->data['driver'] == 'postgresql'){
      $query = "pgsql:host=".$this->data['host'].";port=".$this->data['puerto'].";dbname=".$this->data['nombre'].";user=".$this->data['usuario'].";password=".$this->data['pass'];
      $pdo = new \PDO($query);
      $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
    return $pdo;
  }

  public static function get() {
      if (null === static::$conn) {
          static::$conn = new static();
      }
      return static::$conn;
  }

}

?>
