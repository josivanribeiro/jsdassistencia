<?php 
session_start();
if (!isset($_SESSION['loggedUser'])){	
	header ("location:https://rcfassistencia.websiteseguro.com/console/login.php");
}
?>