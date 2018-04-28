<?php 

/**
 * ContentBO business object class.
 * 
 * @author josivanSilva(Developer);
 *
 */
class ContentBO {
	
	private $contentDAO;
			
	public function __construct() {
		$this->contentDAO = new ContentDAO();		
	}
		
	public function insert (ContentVO $contentVO) {
		$contentVO  = $this->contentDAO->insert ($contentVO);
		return $contentVO;
	}
			
	public function update (ContentVO $contentVO) {
		$updatedRows = null;
		$updatedRows = $this->contentDAO->update ($contentVO);
		return $updatedRows;
	}
	
	public function delete (ContentVO $contentVO) {
		$updatedRows = null;
		$updatedRows = $this->contentDAO->delete ($contentVO);
		return $updatedRows;
	}
	
	public function find (Pagination $pagination) {
		return $this->contentDAO->find ($pagination);
	}
	
	public function findRowCount () {
		$rowCount = null;
		$rowCount = $this->contentDAO->findRowCount ();
		return $rowCount;
	}
	
	public function findById (ContentVO $contentVO) {
		$contentVO = $this->contentDAO->findById ($contentVO);
		return $contentVO;
	}

	public function findByURL (ContentVO $contentVO) {
		$contentVO = $this->contentDAO->findByURL ($contentVO);
		return $contentVO;
	}
	
}
?>