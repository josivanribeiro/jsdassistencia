<?php

/**
 * Email Controller class.
 * 
 * @author josivanSilva(Developer);
 *
 */
class EmailController {
	
	private $emailBO;
	
	public function __construct() {
				
	}

	/**
	 * Sends the budget form via email.
	 * 
	 * @return void
	 */
	public function sendBudgetEmail () {
		/*
			err=-3 fileInvalidExtension
			err=-2 errorSendingBudgetEmail; 
			err=-1 fileWasNotUploadedError
			err=0  fileWithBiggerSizeError
		*/
		$page = "../../index.php";
		$success = false;
		$name    = null;
		$email   = null;
		$phone   = null;
		$service = null;
		$message = null;
				
		$name    = $_REQUEST['budgetName'];
		$email   = $_REQUEST['budgetEmail'];
		$phone   = $_REQUEST['budgetPhone'];
		$service = $_REQUEST['budgetService'];
		$message = $_REQUEST['budgetMessage'];	 	
		
		$mailBudgetVO = new EmailBudgetVO();
		$mailBudgetVO->setNAME ($name);
		$mailBudgetVO->setEMAIL ($email);
		$mailBudgetVO->setPHONE ($phone);
		$mailBudgetVO->setSERVICE ($service);
		$mailBudgetVO->setMESSAGE ($message);
		
		$validateFormReturn = $this->validateFileUpload ('budgetFileUpload');
		
		if ($validateFormReturn === 1) {
			if (!empty($_FILES['budgetFileUpload']['tmp_name'])) {
				
				$filepath = $_FILES['budgetFileUpload']['tmp_name'];
				$filename = $_FILES['budgetFileUpload']['name'];
				
				$mailBudgetVO->setATTACHMENT_FILEPATH($filepath);
				$mailBudgetVO->setATTACHMENT_FILENAME ($filename);
								
				$this->emailBO = new EmailBO();
				$success = $this->emailBO->sendBudgetEmail ($mailBudgetVO);
		
				if ($success) {
					$page .= "?sc=1";
				} else {
					$page .= "?err=-2";
				}
				
			}
		} else if ($validateFormReturn === -3) {
			$page .= "?err=-3";
		} else if ($validateFormReturn === -1) {
			$page .= "?err=-1";
		} else if ($validateFormReturn === 0) {
			$page .= "?err=0";
		}
				
		header ('Location: ' . $page);
	}
	
	/**
	 * Sends the contact form via email.
	 * 
	 * @return void
	 */
	public function sendContactEmail () {
		$success = false;
		$name    = null;
		$email   = null;
		$subject = null;
		$message = null;
				
		$name    = $_REQUEST['contactName'];
		$email   = $_REQUEST['contactEmail'];
		$subject = $_REQUEST['contactSubject'];
		$message = $_REQUEST['contactMessage'];	 	
		
		$emailContactVO = new EmailContactVO();
		$emailContactVO->setNAME ($name);
		$emailContactVO->setEMAIL ($email);
		$emailContactVO->setSUBJECT ($subject);
		$emailContactVO->setMESSAGE ($message);
		
		$this->emailBO = new EmailBO();
		$success = $this->emailBO->sendContactEmail ($emailContactVO);
		
		echo $success;
	}	
		
	/**
	 * Checks of the file upload is valid or not.
	 */
	private function validateFileUpload ($fileUploadId) {
		/*
			err=-3 fileInvalidExtension
			err=-1 fileWasNotUploadedError
			err=0  fileWithBiggerSizeError			
		*/
		$this->config = new Config();
		$result = 1;
		//check if a file was uploaded
		if (!is_uploaded_file($_FILES[$fileUploadId]['tmp_name'])) {
			$result = -1;
		//check the file extension
		} else if (!$this->isValidFileExtension ($_FILES[$fileUploadId]['name'])) {
			$result = -3;	
		//check the file is less than the maximum file size
		} else if ($_FILES[$fileUploadId]['size'] > $this->config->__get("file.upload.max.size") ) { 
			$result = 0;
		}	
		return $result;
	}
	
	/**
	 * Validates the image file extension.
	 */
	private function isValidFileExtension ($filename) {
		$acceptedFormatArr = array ('doc', 'docx', 'ppt', 'pptx', 'xls', 'xlsx', 'pdf', 'png', 'jpg', 'jpeg', 'gif');
		foreach ($acceptedFormatArr as $acceptedFormat) {
			$extension = pathinfo ($filename, PATHINFO_EXTENSION);
			if (strcasecmp ($acceptedFormat, $extension) == 0) {
	    		return true;
			}
		}	
		return false;
	}
}

?>