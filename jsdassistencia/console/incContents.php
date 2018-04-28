<script type="text/javascript"><!--		

		$(document).ready(function () {	    		    
		    
			renderContentsTable(1);
			renderContentsPagination(1);
			renderAssociatedMenu ();

			$("#btnUpdateContent").click(function(event) {				  
				updateContent ();			  
	      	});

		    $("#btnDeleteContent").click(function(event) {				  
		    	deleteContent ();			  
	      	});			
					    		    	
		});

		tinymce.init({
			  selector: '#txtContent',
			  file_browser_callback: function(field_name, url, type, win) {
				    win.document.getElementById(field_name).value = 'my browser value';
			  },
			  file_browser_callback_types: 'file image media',
			  file_picker_types: 'file image media',
			  height: 500,
			  theme: 'modern',
			  plugins: [
			    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
			    'searchreplace wordcount visualblocks visualchars code fullscreen',
			    'insertdatetime media nonbreaking save table contextmenu directionality',
			    'emoticons template paste textcolor colorpicker textpattern imagetools'
			  ],
			  toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
			  toolbar2: 'print preview media | forecolor backcolor emoticons',
			  image_advtab: true,
			  templates: [
			    { title: 'Test template 1', content: 'Test 1' },
			    { title: 'Test template 2', content: 'Test 2' }
			  ],
			  content_css: [
			    '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
			    '//www.tinymce.com/css/codepen.min.css'
			  ]
		});		
		
--></script>
<div id="content-list-container">
	<div id="container-message-and-button">
		<div id="container-message-table">
			* Clique uma vez no item da tabela para editar ou excluir o registro.
		</div>
		<div id="container-button-table">
			<input type="button" class="button" id="btnAddContent" name="btnAddContent" onClick="javascript:changeScreen ('add-content-container','content-list-container');configContentButtons();" value="Adicionar Conteúdo"/>	
		</div>
	</div>
	<div id="container-table-contents" class="container-table">							
	</div>
	<div id="container-table-contents-navigation" class="container-table-navigation">													
	</div>
</div>

<div id="add-content-container" style="display:none;">
	<form id="contentForm" name="contentForm">	
		<input type="hidden" name="controllerContent" id="controllerContent" value="ContentController" />
		<input type="hidden" name="actionContent" id="actionContent" value="updateContent" />
		<input type="hidden" name="contentId" id="contentId" value="" />
		<!-- message container -->
		<div id="message-container-content" class="message-container" style="display: none;">
			<p id="message-paragraph-content" class="error-message"></p>
		</div>		
	    <div class="container-form-field">
	       	<label id="lblUsernameContent" name="lblUsernameContent" for="txtUsernameContent">Nome do usuário</label>
	       	<input id="txtUsernameContent" name="txtUsernameContent" type="text" maxlength="250" style="width:380px;" readonly />								
		</div>				
		<div class="container-form-field">
	       	<label for="selectComponentId">Menu Associado</label>
	       	<select id="selectComponentId" name="selectComponentId" style="height:35px;">				
			</select>
		</div>
		<div class="container-form-field">
	       	<label for="txtUrl">URL</label>
	       	<input id="txtUrl" name="txtUrl" type="text" maxlength="300" style="width: 380px;" />	       	
		</div>
		<div class="container-form-field">
	       	<label for="txtTitle">Título</label>
	       	<input id="txtTitle" name="txtTitle" type="text" maxlength="250" style="width:910px;" />
		</div>		
		<div id="container-form-html-editor" class="container-form-field" style="width:100%;">
			<label for="txtContent">Conteúdo</label>
			<textarea id="txtContent" name="txtContent"></textarea>
		</div>
		<div class="container-form-field">
	       	<label id="lblCreationDateContent" name="lblCreationDateContent" for="txtCreationDateContent">Data de criação</label>
	       	<input id="txtCreationDateContent" name="txtCreationDateContent" type="text" style="width:380px;" readonly />								
		</div>
		<div class="container-form-field">
	       	<label id="lblLastUpdateDateContent" name="lblLastUpdateDateContent" for="txtLastUpdateDateContent">Data da última atualização</label>
	       	<input id="txtLastUpdateDateContent" name="txtLastUpdateDateContent" type="text" style="width:380px;" readonly />								
		</div>
		<div class="container-form-field" style="margin-bottom:10px;">
			<input type="checkbox" id="chkStatusContent" name="chkStatusContent" value="1" checked>
			<label for="chkStatusContent">Ativo</label>			
		</div>
		<input type="button" class="button" id="btnBack" name="btnBack" value="Voltar" onClick="javascript:changeScreen ('content-list-container', 'add-content-container');resetContentForm ();renderContentsTable(1);renderContentsPagination(1);configScreen('tab-3', 'height', '500px');" style="width: 80px;" />
		<input type="button" class="button" id="btnUpdateContent" name="btnUpdateContent" value="Adicionar Conteúdo" style="margin-left:11px;" />	
		<input type="button" class="button" id="btnDeleteContent" name="btnDeleteContent" value="Excluir Conteúdo" style="margin-left:11px;" />
	</form>
</div>
