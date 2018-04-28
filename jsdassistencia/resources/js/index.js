$(document).ready(function() {

	//getContentByURL ('#ABOUT', 'section-about-title', 'section-about-content');
	//getContentByURL ('#SERVICES', 'section-services-title', 'section-services-content');
	//getContentByURL ('#TESTIMONIAL', 'section-testimonial-title', 'section-testimonial-content');

	$( "#budgetFileUpload" ).change(function() {
		var value = $( "#budgetFileUpload" ).val();
  	  	$("#budgetFileUploadReadOnly").val (value);
	});
	
	$("#btnContactSend").click(function(event) {
		sendContactForm ();
  	});	
	
	handleBudgetEmailResponse();
				
});

/**
* Sends the Contact form.
*/
function sendContactForm () {
	var controllerValue = $("#contactController").val();
	var actionValue     = $("#contactAction").val();

    var nameValue       = $("#contactName").val();
    var emailValue      = $("#contactEmail").val();
    var subjectValue    = $("#contactSubject").val();
    var messageValue    = $("#contactMessage").val();

    if (isValidContactForm ()) {
	  $.post ("../classes/controller/FrontController.php", { 
  			controller: controllerValue,
  			action:     actionValue,
  			contactName:     nameValue,
  			contactEmail:    emailValue,
  			contactSubject:  subjectValue,
  			contactMessage:  messageValue
        }, function (data) {
			if (data != null && parseInt (data) == 1) {
				showMessageByContainer (1, "contact-message-container", "contact-message-paragraph", "Contato enviado com sucesso.");
			} else {
				showMessageByContainer (3, "contact-message-container", "contact-message-paragraph", "Ocorreu um erro durante o envio.");
			}
			resetContactForm();
        }
	 );  						
   }	
}

/**
* Checks if the form is fulfilled or not.
* 
* @returns {boolean} boolean containing the operation result.
*/
function isValidContactForm () {
	var isValid  = true;
	var name     = $("#contactName").val();
	var email    = $("#contactEmail").val();
	var subject  = $("#contactSubject").val();
	var message  = $("#contactMessage").val();			
	if (isEmpty (name) 
		|| isEmpty (email)
		|| !isValidEmail (email)
		|| isEmpty (subject)
		|| isEmpty (message)) {
		isValid = false;
		showMessageByContainer (2, "contact-message-container", "contact-message-paragraph", "Preencha todos os campos corretamente.");
	}
	return isValid;
}

/**
* Resets the contact form to default values.
*/
function resetContactForm () {
   $("#contactName").val('');
   $("#contactEmail").val('');
   $("#contactSubject").val('');
   $("#contactMessage").val('');		   
}

/**
* Resets the budget form to default values.
*/
function resetBudgetForm () {
   $("#budgetName").val('');
   $("#budgetEmail").val('');
   $("#budgetPhone").val('');
   $("#budgetFileUpload").val('');
   $("#budgetService").val('');
   $("#budgetMessage").val('');
}

/**
 * Validates the Budget form.
*/
function isValidBudgetForm () {
	var isValid = true;
	var name       = $("#budgetName").val();
	var email      = $("#budgetEmail").val();
	var phone      = $("#budgetPhone").val();
	var fileUpload = $("#budgetFileUpload").val();
	var service    = $("#budgetService").val();
	var message    = $("#budgetMessage").val();
	if (isEmpty (name)
		|| isEmpty (email)
		|| !isValidEmail (email)
		|| isEmpty (phone)
		|| isEmpty (fileUpload)
		|| isEmpty (service)
		|| isEmpty (message)) {
		isValid = false;
		showMessageByContainer (2, "budget-message-container", "budget-message-paragraph", "Preencha todos os campos corretamente.");
	}
	return isValid;
}

/**
 * Gets the content by url.
*/
function getContentByURL (urlValue, titleContainer, textContainer) {
  var resultArr = null;
  var controllerValue = "ContentController";
  var actionValue     = "loadContentForPage";
  $.post ("../classes/controller/FrontController.php", { 
	  		controller: controllerValue,
	  		action:     actionValue,
	  		url:        urlValue
        }, function (data) {
        	resultArr = data.split ("&&");
        	if (resultArr != null && resultArr.length > 0) {
        		var title   = resultArr[1];
        		var content = resultArr[2];
        		$('#' + titleContainer).text (title);
        		$('#' + textContainer).html (content);
        		console.log ('Content for [' + urlValue + '] loaded successfully.');
        	}
		}
  );
}

/**
 * Handles the response from the server (EmailController.php).
 */
function handleBudgetEmailResponse() {
	/*
		err=-3 fileInvalidExtension
		err=-2 errorSendingBudgetEmail
		err=-1 fileWasNotUploadedError
		err=0  fileWithBiggerSizeError
		sc=1   success		
	*/
	var statusCode = getUrlVars()['sc'];
	var errorCode  = getUrlVars()['err'];			
	var existsCode = false;
	if (statusCode != null) {		
		goToBudget ();		
		if (statusCode === "1") {			
			showMessageByContainer (1, "budget-message-container", "budget-message-paragraph", "Orçamento enviado com sucesso.");					
		}
		existsCode = true;
	} else if (errorCode != null) {		
		goToBudget ();				
		if (errorCode === "-3") {
			showMessageByContainer (3, "budget-message-container", "budget-message-paragraph", "Arquivo inválido. Formatos permitidos: doc, docx, ppt, pptx, xls, xlsx, pdf, png, jpg, jpeg ou gif.");
		} else if (errorCode === "-2") {
			showMessageByContainer (3, "budget-message-container", "budget-message-paragraph", "Erro ao enviar o orçamento.");
		} else if (errorCode === "-1") {
			showMessageByContainer (3, "budget-message-container", "budget-message-paragraph", "Nenhum arquivo foi selecionado para upload.");
		} else if (errorCode === "0") {
			showMessageByContainer (3, "budget-message-container", "budget-message-paragraph", "Erro no upload, o tamanho do arquivo excedeu o limite permitido (10 MB).");					
		}				
		existsCode = true;				
	}

	if (existsCode) {
		resetBudgetForm ();    	
	}
}

/**
 * Goes to budget section.
 */
function goToBudget () {
	setTimeout(function(){ $("#lnkBudget").trigger("click"); }, 2000);
}