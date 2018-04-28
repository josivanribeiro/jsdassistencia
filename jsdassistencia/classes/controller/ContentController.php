<?php

/**
 * Content Controller class.
 * 
 * @author josivanSilva(Developer);
 *
 */
class ContentController {
	
	private $contentBO;
	private $userBO;
	private $parameterBO;
	private $config;
	
	public function __construct() {
		
	}
		
	/**
	 * Inserts or updates a new content.
	 * 
	 * @return void
	 */
	public function updateContent() {
		$result    = 0;//(0=error,1=insertSuccess,2=updateSuccess)
		$id          = $_REQUEST['contentId'];
		$loggedUser  = Utils::getLoggedUser();
		$userId      = $loggedUser->getUSER_ID();
		$componentId = $_REQUEST['componentId'];
		$url         = $_REQUEST['url'];
		$title       = $_REQUEST['title'];
		$content     = str_replace ("'", "''", $_REQUEST['content']) ;
		$status      = $_REQUEST['status'];
					
		$contentVO = new ContentVO();
		$contentVO->setCONTENT_ID ($id);
		$contentVO->setUSER_ID ($userId);
		$contentVO->setCOMPONENT_ID ($componentId);
		$contentVO->setURL ($url);
		$contentVO->setTITLE ($title);
		$contentVO->setCONTENT ($content);
		$contentVO->setSTATUS ($status);
			
		$this->contentBO = new ContentBO();
		if ($id == null) {			
			$newContentVO = $this->contentBO->insert ($contentVO);
			$this->updateURLInJSON ($componentId, $url);			
			if ($newContentVO->getCONTENT_ID () > 0) {
				$result = 1;
			}
		} else {				
			$rowCount = $this->contentBO->update ($contentVO);
			$this->updateURLInJSON ($componentId, $url);
			if ($rowCount > 0) {
				$result = 2;				
			}
		}
		
		echo $result;
	}
	
	/**
	 * Updates the url key in the JSON value (Parameter).
	 * 
	 * @return void
	 */
	private function updateURLInJSON ($componentId, $url) {
		$this->parameterBO = new ParameterBO();
		$parameterVO = new ParameterVO();
		$parameterVO->setKEY (Constants::$MENU_SITE);
		$parameterVO = $this->parameterBO->findByKey ($parameterVO);
		$jsonContent = $parameterVO->getVALUE();
		$menuArr = json_decode ($jsonContent, true);
		for ($i = 0; $i < count ($menuArr); $i++) {		
			if ($menuArr[$i]['id'] == $componentId) {
				$menuArr[$i]['href'] = $url;
				break;
			} else if (is_array ($menuArr[$i]['menuitem']) && count($menuArr[$i]['menuitem']) > 0 ) {				
				for ($j = 0; $j < count ($menuArr[$i]['menuitem']);$j++) {					
					if ($menuArr[$i]['menuitem'][$j]['id'] == $componentId) {
						$menuArr[$i]['menuitem'][$j]['href'] = $url;
						break 2; 
					}					
				}			
			}		
		}		
		$newJsonContent = json_encode ($menuArr, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		$parameterVO->setVALUE ($newJsonContent);
		$this->parameterBO->update ($parameterVO);
	}
		
	/**
	 * Loads a content.
	 * 
	 * @return void
	 */
	public function loadContent() {
		$contentId = $_REQUEST['id'];
		$contentVO = new ContentVO();
		$contentVO->setCONTENT_ID ($contentId);				
		$this->contentBO = new ContentBO();
		$newContentVO = $this->contentBO->findById ($contentVO);

		$this->userBO = new UserBO();
		$userVO = new UserVO();
		$userVO->setUSER_ID ($newContentVO->getUSER_ID());
		$userVO = $this->userBO->findById ($userVO);
		
		echo $newContentVO->getCONTENT_ID()
			 . "&&" . $userVO->getUSERNAME ()
			 . "&&" . $newContentVO->getCOMPONENT_ID()
			 . "&&" . $newContentVO->getURL()
			 . "&&" . $newContentVO->getTITLE()
			 . "&&" . $newContentVO->getCONTENT()
			 . "&&" . Utils::getFormattedDatetime ($newContentVO->getCREATION_DT())
			 . "&&" . Utils::getFormattedDatetime ($newContentVO->getLAST_UPDATE_DT())
			 . "&&" . $newContentVO->getSTATUS ();
	}
	
	/**
	 * Loads a content for the content page.
	 * 
	 * @return void
	 */
	public function loadContentForPage() {
		$url = $_REQUEST['url'];
		$contentVO = new ContentVO();
		$contentVO->setURL ($url);
		$this->contentBO = new ContentBO();
		$newContentVO = $this->contentBO->findByURL ($contentVO);
		echo $newContentVO->getCONTENT_ID()
			 . "&&" . $newContentVO->getTITLE()
			 . "&&" . $newContentVO->getCONTENT();	 
	}
	
	/**
	 * Deletes a content.
	 * 
	 * @return void
	 */
	public function deleteContent() {
		$contentId   = $_REQUEST['id'];
		$componentId = $_REQUEST['componentId'];
		$contentVO   = new ContentVO();
		$contentVO->setCONTENT_ID ($contentId);
		$this->contentBO = new ContentBO();
		$countRows = $this->contentBO->delete ($contentVO);
		if ($countRows > 0) {	
			$url = "#";	
			$this->updateURLInJSON ($componentId, $url);			
		}		
		echo $countRows;
	}
	
	/**
	 * Finds all the contents.
	 * 
	 * @return $arr array of galleries.
	 */
	public function find () {
		$this->configPagination ();
		$this->contentBO = new ContentBO();
		$pagination = $_REQUEST['pagination'];
		$arr = $this->contentBO->find ($pagination);
		return $arr;
	}
	
	/**
	 * Configures the pagination.
	 * 
	 * @return void
	 */
	public function configPagination () {
		$pageNumber = $_REQUEST['pageNumber'];
		if (!isset($_REQUEST['pagination'])) {		
			$this->contentBO = new ContentBO();
			$rows = $this->contentBO->findRowCount ();					
			$pageRows = 10;
			$pagination = new Pagination();
			$pagination->setROWS ($rows);
			$pagination->setPAGE_ROWS ($pageRows);			
			$_REQUEST['pagination'] = $pagination;			
		}
		$_REQUEST['pagination']->setPAGE_NUM ($pageNumber);
	}	
	
	/**
	 * Renders the pagination.
	 * 
	 * @return void
	 */
	public function renderPagination () {		
		$this->configPagination ();
		$pagination = $_REQUEST['pagination'];
		if ($pagination->getROWS() > 0) {
			$this->renderNavigation ($pagination);	
		}				
	}
	
	/**
	 * Renders the content HTML table.
	 * 
	 * @return void
	 */
	public function renderTable() {
		$arr = $this->find();		
		if (count($arr) == 0) {
			echo "Não foram encontrados registros.";
		} else {			
			
			echo "<table id=\"contentsTable\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">";
			echo "	<thead>";
			echo "		<tr>";
			echo "			<td>Id</td>";
			echo "			<td>Nome do Usuário</td>";
			echo "			<td>Menu Associado</td>";
			echo "			<td>Título</td>";
			echo "			<td>Data de Criação</td>";
			echo "			<td>Data da Última Atualização</td>";
			echo "			<td>Status</td>";
			echo "		</tr>";
			echo "	</thead>";
			foreach ($arr as $key => $content) {
				echo "<tr onClick=\"javascript:editContent('" . $content->getCONTENT_ID() . "');\" onmouseover=\"changeBackgroundColor(this, '#ebf3fb');\" onmouseout=\"changeBackgroundColor(this, '#fff');\" style=\"cursor: pointer;\">";
				echo "	<td>";
				echo "		<div id=\"container-table-item-label\">" . $content->getCONTENT_ID() . "</div>";
				echo "	</td>";
				
				$this->userBO = new UserBO();
				$userVO = new UserVO();
				$userVO->setUSER_ID ($content->getUSER_ID());
				$userVO = $this->userBO->findById ($userVO);
				
				echo "	<td>";
				echo "		<div id=\"container-table-item-label\">" . $userVO->getUSERNAME() . "</div>";
				echo "	</td>";
								
				$this->parameterBO = new ParameterBO();
				$associatedMenu = $this->parameterBO->findMenuNameById ($content->getCOMPONENT_ID()); 
								
				echo "	<td>";
				echo "		<div id=\"container-table-item-label\">" . $associatedMenu . "</div>";
				echo "	</td>";
				echo "	<td>";
				echo "		<div id=\"container-table-item-label\">" . $content->getTITLE() . "</div>";
				echo "	</td>";
				echo "	<td>";
				echo "		<div id=\"container-table-item-label\">" . Utils::getFormattedDatetime ($content->getCREATION_DT()) . "</div>";
				echo "	</td>";			
				echo "	<td>";
				echo "		<div id=\"container-table-item-label\">" . Utils::getFormattedDatetime ($content->getLAST_UPDATE_DT()) . "</div>";         
				echo "	</td>";
				$status = ($content->getSTATUS() == "1") ? "Ativo" : "Inativo";
				echo "	<td>";
				echo "		<div id=\"container-table-item-label\">" . $status . "</div>";      
				echo "	</td>";
				echo "</tr>";				
			}
			echo "</table>";			
		}		
	}
	
	/**
	 * Renders the content HTML table navigation.
	 * 
	 * @return void
	 */
	protected function renderNavigation ($pagination) {
		echo "	<div id=\"container-button-first\" title=\"Primeiro Registro\">";
		if ($pagination->getPAGE_NUM() > 1) {
			echo "		<a href=\"javascript:renderContentsTable(1);renderContentsPagination(1);\">";
		} else {
			echo "		<a href=\"javascript:void(0);\">";
		}		
		echo "			<img id=\"img-button-first\" onmouseover=\"javascript:changeImageSrc(this, 'bg_button_first_over.png');\" onmouseout=\"javascript:changeImageSrc(this, 'bg_button_first.png');\" border=\"0\" src=\"resources/images/bg_button_first.png\" border=\"0\" />";
		echo "		</a>";
		echo "	</div>";
		echo "	<div id=\"container-button-previous\" title=\"Registro Anterior\">";
		if ($pagination->getPAGE_NUM() > 1) {
			$previous = intval($pagination->getPAGE_NUM()-1);			
			echo "		<a href=\"javascript:renderContentsTable(" . $previous . ");renderContentsPagination(". $previous .");\">";
		} else {
			echo "		<a href=\"javascript:void(0);\">";		
		}
		echo "			<img id=\"img-button-previous\" onmouseover=\"javascript:changeImageSrc(this, 'bg_button_previous_over.png');\" onmouseout=\"javascript:changeImageSrc(this, 'bg_button_previous.png');\" src=\"resources/images/bg_button_previous.png\" border=\"0\" />";
		echo "		</a>";
		echo "	</div>";
		echo "	<div id=\"container-button-next\" title=\"Pr&oacute;ximo Registro\">";		
		if ($pagination->getPAGE_NUM() == $pagination->getLAST()) {
			echo "		<a href=\"javascript:void(0);\">";
		} else {
			$next = intval($pagination->getPAGE_NUM()+1);
			echo "		<a href=\"javascript:renderContentsTable(" . $next . ");renderContentsPagination(". $next .");\">";
		}
		echo "			<img id=\"img-button-next\" onmouseover=\"javascript:changeImageSrc(this, 'bg_button_next_over.png');\" onmouseout=\"javascript:changeImageSrc(this, 'bg_button_next.png');\" src=\"resources/images/bg_button_next.png\" border=\"0\" />";
		echo "		</a>";
		echo "	</div>";
		echo "	<div id=\"container-button-last\" title=\"&Uacute;ltimo Registro\">";
		if ($pagination->getPAGE_NUM() == $pagination->getLAST()) {
			echo "		<a href=\"javascript:void(0);\">";
		} else {
			echo "		<a href=\"javascript:renderContentsTable(" . $pagination->getLAST() . ");renderContentsPagination(". $pagination->getLAST() .");\">";
		}
		echo "			<img id=\"img-button-last\" onmouseover=\"javascript:changeImageSrc(this, 'bg_button_last_over.png');\" onmouseout=\"javascript:changeImageSrc(this, 'bg_button_last.png');\" src=\"resources/images/bg_button_last.png\" border=\"0\" />";
		echo "		</a>";
		echo "	</div>";		
	}
	
	/**
	 * Renders the associated menu HTML.
	 * 
	 * @return void
	 */
	public function renderAssociatedMenu() {
		$result = null;
		$this->parameterBO = new ParameterBO();
		$parameterVO = new ParameterVO();
		$parameterVO->setKEY (Constants::$MENU_SITE);
		$parameterVO = $this->parameterBO->findByKey ($parameterVO);
		$jsonContent = $parameterVO->getVALUE();
		$menuArr = json_decode ($jsonContent, true);
		$result .= "<option value=\"\"></option>";
		foreach ($menuArr as $menu) {			
			if ($this->isAllowedMenu ($menu['id'])) {				
				if ($this->isAllowedMenuFather ($menu['id'])) {					
					$result .= "<option value=" . $menu['id'] . ">". $menu['value'] ."</option>";					
				}				
				if (is_array ($menu['menuitem']) && count($menu['menuitem']) > 0) {
					$menuItemArr = $menu['menuitem'];				
					foreach ($menuItemArr as $menuItem) {					
						$result .= "<option value=" . $menuItem['id'] . ">&nbsp;&nbsp;&nbsp;&nbsp;" . $menuItem['value'] . "</option>";					
					}
				}			
			}
		}	
		echo $result;
	}

	/**
	 * Renders the JSON string of menu.
	 * 
	 * @return void
	 */
	public function getJSONMenu() {
		$this->parameterBO = new ParameterBO();
		$parameterVO = new ParameterVO();
		$parameterVO->setKEY (Constants::$MENU_SITE);
		$parameterVO = $this->parameterBO->findByKey ($parameterVO);
		$jsonContent = $parameterVO->getVALUE();
		echo $jsonContent;
	}
	
	/**
	 * Renders the JSON string of home intro.
	 * 
	 * @return void
	 */
	public function getJSONHomeIntro() {
		$this->parameterBO = new ParameterBO();
		$parameterVO = new ParameterVO();
		$parameterVO->setKEY (Constants::$HOME_INTRO_SITE);
		$parameterVO = $this->parameterBO->findByKey ($parameterVO);
		$jsonContent = $parameterVO->getVALUE();
		echo $jsonContent;		
	}

		
	/**
	 * Checks if the given menu is allowed.
	 * 
	 * @return void
	 */
	private function isAllowedMenu ($menuId) {
		$isAllowed = true;
		$notAllowedMenuArr = array (
			"mn_Home",
			"mn_Orcamento",
			"mn_Contato"
		);		
		foreach ($notAllowedMenuArr as $notAllowedMenu) {			
			if (strcmp ($notAllowedMenu, $menuId) == 0) {
				$isAllowed = false;
				break;
			}
		}
		return $isAllowed;
	}
	
	/**
	 * Checks if the given menu father is allowed.
	 * 
	 * @return void
	 */
	private function isAllowedMenuFather ($menuId) {
		$isAllowed = true;
		$notAllowedMenuFatherArr = array (
			""
		);		
		foreach ($notAllowedMenuFatherArr as $notAllowedMenuFather) {			
			if (strcmp ($notAllowedMenuFather, $menuId) == 0) {
				$isAllowed = false;
				break;
			}
		}
		return $isAllowed;
	}	
				
}

?>