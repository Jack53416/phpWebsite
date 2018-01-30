<?php
class Display{
	public $title = "Students";
	public $footerContent = "Database project 2018";
	public $pageContent = "";
	public $pageToolbar = "";
	public $sideMenu = "";

	function addContent($newContent){
		$this->pageContent = $this->pageContent.$newContent;
	}

	function addToolbar($newContent){
		$this->pageToolbar = $this->pageToolbar.$newContent;
	}

	function addSideMenu($newContent){
		$this->sideMenu = $this->sideMenu.$newContent;
	}

	function run($sessionFlag){
	  $htmlHead = "<!DOCTYPE html><html><head>
			<meta charset='UTF-8'>
			<title>{$this->title}</title>
			<link rel='stylesheet' href='style.css' />
      <script src='main.js'></script>
			</head>";
		$pageHeader = PageHeader::getHtml($this->title, $sessionFlag);
		$pageFooter = "<div class = 'footer'> <div id = 'footer-content'>{$this->footerContent}</div></div>";
		$pageEnd = "</body>
      </html>";
		echo $htmlHead.$pageHeader.$this->pageToolbar.
		"<div class = 'flexContainer content'>
			<div class = 'mainContent'>".
		$this->pageContent.
			"</div>".
		"<div class = 'sideMenu'>".
		$this->sideMenu.
			"</div>".
		"</div>"
		.$pageFooter.$pageEnd;
	}
}
 ?>
