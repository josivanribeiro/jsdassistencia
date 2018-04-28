<?php
/**
 * ContentVO value object class.
 * 
 * @author josivanSilva(Developer);
 *
 */
class ContentVO {
	
	private $CONTENT_ID;
	private $USER_ID;
	private $COMPONENT_ID;
	private $URL;	
	private $TITLE;
	private $CONTENT;
	private $CREATION_DT;
	private $LAST_UPDATE_DT;
	private $STATUS;
				
	public function __construct () {}
	
	public function getCONTENT_ID () {
		return $this->CONTENT_ID;		
	}
	public function setCONTENT_ID ($CONTENT_ID) {
		$this->CONTENT_ID = $CONTENT_ID;
    }
	public function getUSER_ID () {
		return $this->USER_ID;
	}
	public function setUSER_ID ($USER_ID) {
		$this->USER_ID = $USER_ID;
    }
	public function getCOMPONENT_ID () {
		return $this->COMPONENT_ID;
	}
	public function setCOMPONENT_ID ($COMPONENT_ID) {
		$this->COMPONENT_ID = $COMPONENT_ID;
    }
	public function getURL () {
		return $this->URL;
	}
	public function setURL ($URL) {
		$this->URL = $URL;
    }
	public function getTITLE () {
		return $this->TITLE;
	}
	public function setTITLE ($TITLE) {
		$this->TITLE = $TITLE;
    }
	public function getCONTENT () {
		return $this->CONTENT;
	}
	public function setCONTENT ($CONTENT) {
		$this->CONTENT = $CONTENT;
    }
	public function getCREATION_DT () {
		return $this->CREATION_DT;
	}
	public function setCREATION_DT ($CREATION_DT) {
		$this->CREATION_DT = $CREATION_DT;
    }
	public function getLAST_UPDATE_DT () {
		return $this->LAST_UPDATE_DT;
	}
	public function setLAST_UPDATE_DT ($LAST_UPDATE_DT) {
		$this->LAST_UPDATE_DT = $LAST_UPDATE_DT;
    }
	public function getSTATUS () {
		return $this->STATUS;
	}
	public function setSTATUS ($STATUS) {
		$this->STATUS = $STATUS;
    }		
}
?>