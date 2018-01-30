<?php

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
  
  public function queryDelete($table, $condition){
    $db = ibase_connect($this->path, $this->user, $this->password);
    $sqlQuery = "DELETE FROM {$table} WHERE {$condition}";
    $result = ibase_query($db, $sqlQuery);
    $status = $result == true;
    return new QueryResult($status, ibase_errmsg(), []);
  }
  
  public function querySelect($table, $columns, $whereString){
    $db = ibase_connect($this->path, $this->user, $this->password);
    $sqlQuery = "SELECT {$columns} FROM {$table} WHERE {$whereString}";
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

class Display{
	public $title = "Students";
	public $footerContent = "Database project 2018";
	public $pageContent;
	
	function addContent($newContent){
		$this->pageContent = $this->pageContent.$newContent;
	}
	
	function run(){
	  $htmlHead = "<!DOCTYPE html><html><head>
			<title>{$this->title}</title>
			</head>";
		$pageHeader = "<div class='header'><h2 class='title'>{$this->title}</h2></div>";
		$pageFooter = "<div class = 'footer'> <div id = 'footer-content'>{$this->footerContent}</div></div>";
		$pageEnd = '</body></html>';
		echo $htmlHead.$pageHeader.$this->pageContent.$pageFooter.$pageEnd;
	}
	
}

$dp = new Display;
$dp->run();

ob_start(); //Start output buffer
echo "abc123";
$output = ob_get_contents(); //Grab output
ob_end_clean(); //Discard output buffer
echo $output;

$p = new QueryResult(false, "Dupa", []);
$data = 'message';
echo $p->{$data};

?>