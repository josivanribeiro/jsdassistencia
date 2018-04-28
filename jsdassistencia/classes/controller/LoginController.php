<?php

/**
 * Login Controller class.
 * 
 * @author josivanSilva(Developer);
 *
 */
class LoginController {
	
	private $userBO;
	private $config;
	
	public function __construct() {
			
	}
		
	/**
	 * Performs the normal user login.
	 * 
	 * @return void
	 */
	public function doLogin () {
		$username = null;
		$pwd      = null;
		$isLogged = 0;
		$username = $_REQUEST['username'];
		$pwd      =	$_REQUEST['pwd'];		
		$userVO = new UserVO();
		$userVO->setUSERNAME ($username);
		$userVO->setPWD ($pwd);
		$this->userBO = new UserBO();
		$isLogged = $this->userBO->doLogin ($userVO);		
		$isLogged = intval ($isLogged);
		if ($isLogged == 1) {
			session_start();
			$loggedUserVO = $this->userBO->findByUsername ($userVO);
			$_SESSION['loggedUser'] = $loggedUserVO;
		}
		echo $isLogged;
	}	
	
}

?>