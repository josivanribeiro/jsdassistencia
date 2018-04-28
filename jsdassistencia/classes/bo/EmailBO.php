<?php 

require '../lib/PHPMailer/PHPMailerAutoload.php';

/**
 * EmailBO business object class.
 * 
 * @author josivanSilva(Developer);
 *
 */
class EmailBO {	

	private $config;
	
	public function __construct() {
		$this->config = new Config();
	}	

	/**
	 * Sends a Budget email via SMTP.
	 * 
	 * @param EmailContactVO $emailContactVO the email.
	 */
	public function sendBudgetEmail (EmailBudgetVO $emailBudgetVO) {
		$sent = false;
		try {						
			$mailer = new PHPMailer (true);						
			$mailer->IsSMTP();
			$mailer->SMTPOptions = array(
			    'ssl' => array(
			        'verify_peer' => false,
			        'verify_peer_name' => false,
			        'allow_self_signed' => true
			    )
			);
			$mailer->SMTPDebug  = $this->config->__get("smtp.debug");
			$mailer->SMTPSecure = 'tls';
			$mailer->Port       = 587;
			$mailer->Host       = $this->config->__get("smtp.host");
			$mailer->SMTPAuth   = true;
			$mailer->Username   = $this->config->__get("smtp.username.budget");
			$mailer->Password   = $this->config->__get("smtp.pwd.budget");						
			$mailer->FromName   = $this->config->__get("smtp.from.name.budget");
			$mailer->From       = $this->config->__get("smtp.from.budget");
			$mailer->AddAddress ($this->config->__get("smtp.to.budget"));
			$mailer->Subject    = $this->config->__get("smtp.subject.budget");
			$mailer->CharSet    = 'UTF-8';
			$mailer->Body       = $this->getBudgetFormattedEmail ($emailBudgetVO);
			$mailer->IsHTML (true);			
			if ($this->existAttachment ($emailBudgetVO)) {
				$mailer->AddAttachment ($emailBudgetVO->getATTACHMENT_FILEPATH(), $emailBudgetVO->getATTACHMENT_FILENAME());
			} else {
				$mailer->ClearAttachments();
			}
			if(!$mailer->send()) {
			    print_r ('Mailer Error: ' . $mailer->ErrorInfo);			    
			 } else {
			    $sent = true;
			}
		} catch (Exception $e) {
			print_r ('Mailer Error: ' . $e->getMessage()) ;
		}
		return $sent;
	}
	
	/**
	 * Sends a Contact email via SMTP.
	 * 
	 * @param EmailVO $emailVO the email.
	 */
	public function sendContactEmail (EmailContactVO $emailContactVO) {
		$sent = false;
		try {						
			$mailer = new PHPMailer (true);						
			$mailer->IsSMTP();
			$mailer->SMTPOptions = array(
			    'ssl' => array(
			        'verify_peer' => false,
			        'verify_peer_name' => false,
			        'allow_self_signed' => true
			    )
			);
			$mailer->SMTPDebug  = $this->config->__get("smtp.debug");
			$mailer->SMTPSecure = 'tls';
			$mailer->Port       = 587;
			$mailer->Host       = $this->config->__get("smtp.host");
			$mailer->SMTPAuth   = true;
			$mailer->Username   = $this->config->__get("smtp.username.contact");
			$mailer->Password   = $this->config->__get("smtp.pwd.contact");						
			$mailer->FromName   = $this->config->__get("smtp.from.name.contact");
			$mailer->From       = $this->config->__get("smtp.from.contact");
			$mailer->AddAddress ($this->config->__get("smtp.to.contact"));
			$mailer->Subject    = $this->config->__get("smtp.subject.contact");
			$mailer->CharSet    = 'UTF-8';
			$mailer->Body       = $this->getContactFormattedEmail ($emailContactVO);
			$mailer->IsHTML (true);						
			$mailer->ClearAttachments();						
			if(!$mailer->send()) {
			    print_r ('Mailer Error: ' . $mailer->ErrorInfo);			    
			 } else {
			    $sent = true;
			}
		} catch (Exception $e) {
			print_r ('Mailer Error: ' . $e->getMessage()) ;
		}		
		return $sent;
	}
	
	/**
	 * Gets the Budget email formatted as plain text.
	 * 
	 * @param EmailBudgetVO $emailBudgetVO the email.
	 * @return string the result.
	 */
	private function getBudgetFormattedEmail (EmailBudgetVO $emailBudgetVO) {
		$result = null;
		$result  = "<b>Nome</b>: " . $emailBudgetVO->getNAME() . "<br>";
		$result .= "<b>Email</b>: " . $emailBudgetVO->getEMAIL() . "<br>";
		$result .= "<b>Telefone</b>: " . $emailBudgetVO->getPHONE() . "<br>";
		$result .= "<b>Serviço</b>: " . $emailBudgetVO->getSERVICE() . "<br>";
		$result .= "<b>Mensagem</b>: " . $emailBudgetVO->getMESSAGE() . "<br>";
		return $result; 
	}
	
	/**
	 * Gets the Contact email formatted as plain text.
	 * 
	 * @param EmailVO $emailVO the email.
	 * @return string the result.
	 */
	private function getContactFormattedEmail (EmailContactVO $emailContactVO) {
		$result = null;
		$result  = "<b>Nome</b>: " . $emailContactVO->getNAME() . "<br>";
		$result .= "<b>Email</b>: " . $emailContactVO->getEMAIL() . "<br>";
		$result .= "<b>Assunto</b>: " . $emailContactVO->getSUBJECT() . "<br>";
		$result .= "<b>Mensagem</b>: " . $emailContactVO->getMESSAGE() . "<br>";
		return $result; 
	}
	
	/**
	 * Checks if an attachment exist.
	 * 
	 * @param EmailBudgetVO $emailBudgetVO the email budget.
	 * @return boolean the success operation.
	 */
	private function existAttachment (EmailBudgetVO $emailBudgetVO) {
		$success = false;
		if (!empty ($emailBudgetVO->getATTACHMENT_FILEPATH()) 
				&& !empty ($emailBudgetVO->getATTACHMENT_FILENAME())) {
			$success = true;
		}
		return $success;
	}
		
} 

?>