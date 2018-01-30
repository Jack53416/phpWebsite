<?php namespace firebird;

class QueryResult{
  public $status;
  public $message;
  public $data;

  public function __construct($status, $message, $data) {
        $this->status = $status;
        $this->message = $message;
        $this->data = $data;
    }
}

class Database{
  private $path = 'localhost:db259';
  private $user = 'SYSDBA';
  private $password = 'masterkey';

  public function queryInsert($table, $columns, $values){
    $db = ibase_connect($this->path, $this->user, $this->password);
    $sqlQuery = "INSERT INTO {$table} ($columns) VALUES ($values)";
    $result = ibase_query($db, $sqlQuery);
    $status = $result == true;
    return new QueryResult($status, ibase_errmsg(), []);
  }
  public function queryDelete($table, $condition){
    $db = ibase_connect($this->path, $this->user, $this->password);
    $sqlQuery = "DELETE FROM {$table} WHERE {$condition}";
    $result = ibase_query($db, $sqlQuery);
    $status = $result == true;
    return new QueryResult($status, ibase_errmsg(), []);
  }

  public function querySelect($table, $columns, $whereString){
    $db = ibase_connect($this->path, $this->user, $this->password);
    $sqlQuery = "SELECT {$columns} FROM {$table}";
    if(!empty($whereString)){
      $sqlQuery = $sqlQuery." WHERE {$whereString}";
    }
    $cursor = ibase_query($db, $sqlQuery);
    $data = [];

    if(!$cursor){
      return new QueryResult(false, ibase_errmsg(), $data);
    }

    while($row=ibase_fetch_object($cursor))
		{
		  $data[] = $row;
		}
		return new QueryResult(true, ibase_errmsg(), $data);
  }
}

namespace firebird\schema;

class Users{
   const id = "ID";
   const email = "EMAIL";
   const name = "NAME";
   const surname = "SURNAME";
   const password = "PASSWORD";
}
class Students{
   const id = "ID";
   const name = "NAME";
   const surname = "SURNAME";
   const faculty = "FACULTY";
   const birthDate = "BIRTH";
   const index = "STUDENT_NO";
   const dateAdded = "DATE_ADDED";

   public static function getColumnsForInsert(){
     return Students::name.','.Students::surname.','.Students::faculty.','.Students::birthDate.','.Students::index;
   }
}
 ?>
