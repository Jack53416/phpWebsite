<?php
include_once "templates.php";

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
			<link rel='stylesheet' href='style.css' />
			</head>";
		$pageHeader = PageHeader::getHtml($this->title);
		$pageFooter = "<div class = 'footer'> <div id = 'footer-content'>{$this->footerContent}</div></div>";
		$pageEnd = "</body>
      <script src='main.js'></script>
      </html>";
		echo $htmlHead.$pageHeader.$this->pageContent.$pageFooter.$pageEnd;
	}
}


$dp = new Display;
$dp->addContent(ErrorDialog::getHtml("Dupa"));
$dp->run();
?>
