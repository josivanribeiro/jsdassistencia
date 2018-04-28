<!DOCTYPE html>
<html>
<!-- start head -->
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all"></link>
	<script src="js/functions.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>	
</head>
<!-- start head -->
	
	<script type="text/javascript"><!--
	
 
		$(document).ready(function() {					  

			  $("#btnLogin").click(function(event) {
				  
				  var usernameValue   = $("#txtUsername").val();
				  var pwdValue        = $("#txtPwd").val();		  

				  if (isValidForm ()) {

					  $.post ("ProcessLogin.php", { 
		        	  		username:   usernameValue,
		        	  		pwd:        pwdValue
				        }, function (data) {
							if (data != null && parseInt (data) == 0) {
								showMessage (3, "Nome do usuário ou senha inválidos.");
							} else {
								alert ("Welcome Corpo de Pipo!");
								redirectTo ("http://www.josivansilva.com/nw51/index.page?t=" + data);
							}
				        	resetForm();
		             	}
		         	  );
		         	  						
				  }
				  
	      	   });
	   	});

		/**
	    * Checks if the form is fulfilled or not.
	    * 
	    * @returns {boolean} boolean containing the operation result.
	    */
	   function isValidForm () {
			var isValid  = true;
			var username = $("#txtUsername").val();
			var pwd      = $("#txtPwd").val();						
			if (isEmpty (username) 
					|| isEmpty (pwd)) {
				isValid = false;
				showMessage (2, "Preencha todos os campos corretamente.");
			}
			return isValid;
	   }

	   /**
		* Resets the form to default values.
		*/
	   function resetForm () {
		   $("#txtUsername").val('');
		   $("#txtPwd").val('');	   		   
	   }
	
	--></script>
	
<body>	
	<div id="login-container">		
		<div id="login-form-container">
			<div id="login-logo-container">
				<img src="images/josivansilva_developer_logo.png" border="0" style="margin-left:-2px;margin-bottom: 3px;margin-right: 5px;" />				
			</div>
			<form id="loginForm" name="loginForm">
				<!-- message container -->
				<div id="message-container" class="message-container" style="display: none;width: 330px;">
					<p id="message-paragraph" class="error-message"></p>
				</div>		
       			<div class="container-form-field">
       				<label id="lblUsername" name="lblUsername" for="txtUsername">Nome do Usuário</label>
       				<input id="txtUsername" name="txtUsername" type="text" maxlength="50" class="login" style="width: 330px;" />								
				</div>
				<div class="container-form-field">
					<label id="lblPwd" name="lblPwd" for="txtPwd">Senha</label><br>
					<input id="txtPwd" name="txtPwd" type="password" class="login" maxlength="15" style="width: 330px;" />
				</div>																
				<input type="button" class="button-login" id="btnLogin" name="btnLogin" type="submit" value="Login" />								
			</form>
		</div>	
	</div>
</body>
</html> 
