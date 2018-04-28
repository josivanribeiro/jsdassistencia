
  /**
   * Renders the pagination.
  */
  function renderContentsPagination (pageNum) {
   		var controllerValue = "ContentController";
		var actionValue     = "renderPagination";
        $.post ("../classes/controller/FrontController.php", { 
        	  		controller: controllerValue,
        	  		action:     actionValue,
        	  		pageNumber: pageNum
		        }, function (data) {
					$('#container-table-contents-navigation').html (data);						
				}
         );
   }
   
	/**
	* Renders the contents as an HTML table.
	*/
   function renderContentsTable (pageNum) {
   	  var controllerValue = "ContentController";
   	  var actionValue     = "renderTable";
	  $.post ("../classes/controller/FrontController.php",
	        { 
    	  		controller: controllerValue,
    	  		action:     actionValue,
    	  		pageNumber: pageNum
	        }, function (data) {
				$('#container-table-contents').html (data);
			}
      );
   }
   
   /**
    * Updates or Inserts the content with the form data.
    * 
    */
   function updateContent () {
   	
   		if (isValidContentForm ()) {   		  	
   			
   		  var controllerValue  = $("#controllerContent").val();
   		  var actionValue      = $("#actionContent").val();
   		  var contentIdValue   = $("#contentId").val();
   		  var componentIdValue = $("#selectComponentId").val();
   		  var urlValue         = $("#txtUrl").val();
   		  var titleValue       = $("#txtTitle").val();
   		  var contentValue     = tinymce.get('txtContent').getContent();  		
   		  var statusValue      = $("#chkStatusContent:checked").val();
   		  statusValue          = (statusValue != null) ? "1" : "0";
   		     		  
   		  $.post ("../classes/controller/FrontController.php", {
   	  	  		controller:  controllerValue,
   	  	  		action:      actionValue,
   				contentId:   contentIdValue,
   	  	  		componentId: componentIdValue,
   	  	  		url:         urlValue,
   	  	  		title:       titleValue,
   	  	  		content:     contentValue,
   	  	  		status:      statusValue
   	        }, function (data) {		 
   				if (data != null) {
   					if (parseInt (data) == 1) {   						
   						showMessageByContainer (1, "message-container-content", "message-paragraph-content", "Conteúdo adicionado com sucesso.");   						
   					} else if (parseInt (data) == 2) {
   						showMessageByContainer (1, "message-container-content", "message-paragraph-content", "Conteúdo atualizado com sucesso.");
   					} else if (parseInt (data) == 0) {
   						showMessageByContainer (3, "message-container-content", "message-paragraph-content", "Ocorreu um erro ao adicionar ou atualizar o Conteúdo.");
   					}   				
   				}
   				scrollBodyTop();
   	        	resetContentForm();
   	        	configContentButtons();
   	        }
      	 );   		    		  
   	   }
   }
   
   /**
	* Renders the associated menu as a HTML select.
	*/
  function renderAssociatedMenu () {
  	  var controllerValue = "ContentController";
  	  var actionValue     = "renderAssociatedMenu";
	  $.post ("../classes/controller/FrontController.php",
	        { 
   	  		controller: controllerValue,
   	  		action:     actionValue   	  		
	        }, function (data) {
				$('#selectComponentId').html (data);
			}
     );
   }       
  
   /**
	 * Resets the form to default values.
	*/
	function resetContentForm () {
	   $("#contentId").val('');
	   $("#selectComponentId").val('');
	   $("#txtUrl").val('');
	   $("#txtTitle").val('');
	   if (tinymce.get('txtContent') != null) {
		   tinymce.get('txtContent').setContent ('');
	   }	   
	   document.getElementById ("chkStatusContent").checked = true;
	}

	/**
	 * Edits or delete the content given its id.
	*/
	function editContent (contentId) {
		$("#contentId").val(contentId);
		loadContent ();
		configContentButtons();
		changeScreen ('add-content-container','content-list-container');	
	}

	/**
	* Loads a content if when its id is set.
	*/
	function loadContent () {
		var contentId = $("#contentId").val();
		if (!isEmpty(contentId)) {
			loadContentById (contentId);
		}	
	}

	/**
	* Loads a gallery by its id.
	*/
	function loadContentById (contentId) {
		var controllerValue = "ContentController";
		var actionValue     = "loadContent";
		$.post ("../classes/controller/FrontController.php", { 
			controller: controllerValue,
	    	action:     actionValue,
	    	id:         contentId
		}, function (data) {
			var result = data;
			var valueArr = result.split("&&");
			if (valueArr != null && valueArr.length > 0) {
				var contentId        = valueArr [0];
				var username         = valueArr [1];
				var componentId      = valueArr [2];
				var url              = valueArr [3];
				var title            = valueArr [4];
				var content          = valueArr [5];
				var creationDate     = valueArr [6];
				var lastUpdateDate   = valueArr [7];
				var status           = valueArr [8];
								
				$("#contentId").val (contentId);
				$("#txtUsernameContent").val (username);
				$("#selectComponentId").val (componentId);
				$("#txtUrl").val (url);
				$("#txtTitle").val (title);
				tinymce.get('txtContent').setContent (content);
				$("#txtCreationDateContent").val (creationDate);
				$("#txtLastUpdateDateContent").val (lastUpdateDate);
				
				if (status == 1) {
					document.getElementById ("chkStatusContent").checked = true;
				} else {
					document.getElementById ("chkStatusContent").checked = false;
				}
			}
		  }
	    );
	}	
	
	/**
	* Deletes the content.
	*/
	function deleteContent () {
		var controllerValue  = "ContentController";
		var actionValue      = "deleteContent";
		var contentIdValue   = $("#contentId").val ();
		var componentIdValue = $("#selectComponentId").val();
		var urlValue         = $("#txtUrl").val();	
		var result           = confirm ("Confirma exclusão?");
		if (result) {
			$.post ("../classes/controller/FrontController.php", { 
	        	  		controller:  controllerValue,
	        	  		action:      actionValue,
	        	  		id:          contentIdValue,
	        	  		componentId: componentIdValue,
	        	  		url:         urlValue 
			        }, function (data) {
						var countRows = parseInt (data);
						if (countRows == 1) {
							scrollBodyTop();
							showMessageByContainer (1, "message-container-content", "message-paragraph-content", "Conteúdo Excluído com Sucesso.");
							resetContentForm ();
							configContentButtons();
						}
					}
	         );
		}
	}
	
	/**
	* Configures, show and hide the content buttons.
	*/
	function configContentButtons() {
		var contentId = $("#contentId").val();
		if (!isEmpty(contentId)) {
			$("#btnUpdateContent").val ("Atualizar Conteúdo");
			$("#lblUsernameContent").show();
			$("#txtUsernameContent").show();
			$("#tab-3").css("height", "auto");			
			$("#lblCreationDateContent").show();
			$("#txtCreationDateContent").show();
			$("#lblLastUpdateDateContent").show();
			$("#txtLastUpdateDateContent").show();
			$("#btnDeleteContent").show();			
		} else {
			$("#btnUpdateContent").val ("Adicionar Conteúdo");
			$("#lblUsernameContent").hide();
			$("#txtUsernameContent").hide();
			$("#tab-3").css("height", "auto");
			$("#lblCreationDateContent").hide();
			$("#txtCreationDateContent").hide();
			$("#lblLastUpdateDateContent").hide();
			$("#txtLastUpdateDateContent").hide();			
			$("#btnDeleteContent").hide();
		}
	}
	
	/**
	* Validates the form before submit it.
	*/
	function isValidContentForm () {
		var isValid 	= true;
		var componentId = $("#selectComponentId").val();
		var content     = tinymce.get('txtContent').getContent();
		var url         = $("#txtUrl").val();
		var title       = $("#txtTitle").val();
		if (isEmpty (componentId)
				||  isEmpty (url) 
				||  isEmpty (title)
				||  isEmpty (content)) {
			isValid = false;
			scrollBodyTop();
			showMessageByContainer (2, "message-container-content", "message-paragraph-content", "Preencha todos os campos corretamente.");				
		}		
		return isValid;
	}
	
	