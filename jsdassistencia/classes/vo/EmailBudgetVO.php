<?php
/**
 * EmailBudgetVO value object class.
 * 
 * @author josivanSilva (Developer);
 *
 */
class EmailBudgetVO {
	
	private $NAME;
	private $EMAIL;
	private $PHONE;
	private $ATTACHMENT_FILEPATH;
	private $ATTACHMENT_NAME;
	private $SERVICE;
	private $MESSAGE;
		
	public function __construct () {}
	
	public function getNAME () {
		return $this->NAME;		
	}
	public function setNAME ($NAME) {
		$this->NAME = $NAME;
    }
	public function getEMAIL () {
		return $this->EMAIL;		
	}
	public function setEMAIL ($EMAIL) {
		$this->EMAIL = $EMAIL;
    }
	public function getPHONE () {
		return $this->PHONE;
	}
	public function setPHONE ($PHONE) {
		$this->PHONE = $PHONE;
    }
	public function getATTACHMENT_FILEPATH () {
		return $this->ATTACHMENT_FILEPATH;
	}
	public function setATTACHMENT_FILEPATH ($ATTACHMENT_FILEPATH) {
		$this->ATTACHMENT_FILEPATH = $ATTACHMENT_FILEPATH;
    }
	public function getATTACHMENT_FILENAME () {
		return $this->ATTACHMENT_FILENAME;
	}
	public function setATTACHMENT_FILENAME ($ATTACHMENT_FILENAME) {
		$this->ATTACHMENT_FILENAME = $ATTACHMENT_FILENAME;
    }
	public function getSERVICE () {
		return $this->SERVICE;
	}
	public function setSERVICE ($SERVICE) {
		$this->SERVICE = $SERVICE;
    }
	public function getMESSAGE () {
		return $this->MESSAGE;		
	}
	public function setMESSAGE ($MESSAGE) {
		$this->MESSAGE = $MESSAGE;
    }    
}
?>