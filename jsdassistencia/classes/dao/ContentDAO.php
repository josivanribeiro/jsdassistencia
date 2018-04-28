<?php
/**
 * ContentDAO Data Access Object class.
 * 
 * @author josivanSilva(Developer);
 *
 */
class ContentDAO extends AbstractDAO {
	
	public function __construct() {		
		parent::__construct();		
	}
			
	public function insert (ContentVO $contentVO) {
		$sql  = "INSERT INTO CONTENT (USER_ID, COMPONENT_ID, URL, TITLE, CONTENT, CREATION_DT, STATUS) "; 
		$sql .= "VALUES (" . $contentVO->getUSER_ID() . ", "; 
		$sql .= "'" . $contentVO->getCOMPONENT_ID() . "', ";
		$sql .= "'" . $contentVO->getURL() . "', ";
		$sql .= "'" . $contentVO->getTITLE() . "', ";
		$sql .= "'" . $contentVO->getCONTENT() . "', ";
		$sql .= "NOW(), ";
		$sql .= $contentVO->getSTATUS() . ")";
		$contentId = $this->insertDb ($sql);
		$contentVO->setCONTENT_ID ($contentId);
		return $contentVO;
    }
    
	public function update (ContentVO $contentVO) {
		$sql  = "UPDATE CONTENT SET USER_ID='" . $contentVO->getUSER_ID() . "', ";
		$sql .= "COMPONENT_ID = '" . $contentVO->getCOMPONENT_ID() . "', "; 
		$sql .= "URL = '" . $contentVO->getURL() . "', ";
		$sql .= "TITLE = '" . $contentVO->getTITLE() . "', ";
		$sql .= "CONTENT = '" . $contentVO->getCONTENT() . "', ";
		$sql .= "LAST_UPDATE_DT = NOW(), ";
		$sql .= "STATUS = " . $contentVO->getSTATUS() . " ";
		$sql .= "WHERE CONTENT_ID = " . $contentVO->getCONTENT_ID(); 
		$updatedRows = $this->queryDb ($sql);
		return $updatedRows;
    }

	public function delete (ContentVO $contentVO) {
		$sql = "DELETE FROM CONTENT WHERE CONTENT_ID = " . $contentVO->getCONTENT_ID();
		$rowCount = $this->queryDb ($sql);
		return $rowCount;
		
    }
	
	public function find (Pagination $pagination) {
		$sql = "SELECT CONTENT_ID, USER_ID, COMPONENT_ID, URL, TITLE, CONTENT, CREATION_DT, LAST_UPDATE_DT, STATUS FROM CONTENT ORDER BY CONTENT_ID LIMIT " . $pagination->getLIMIT();			
		return $this->selectDB ($sql, 'ContentVO');
	}
	
	public function findRowCount () {
		$sql = "SELECT COUNT(*) FROM CONTENT";
		$rowCount = $this->rowCount ($sql);
		return $rowCount;
	}
	
	public function findById (ContentVO $contentVO) {
		$sql = "SELECT CONTENT_ID, USER_ID, COMPONENT_ID, URL, TITLE, CONTENT, CREATION_DT, LAST_UPDATE_DT, STATUS FROM CONTENT WHERE CONTENT_ID = " . $contentVO->getCONTENT_ID();
		$arr = $this->selectDB ($sql, 'ContentVO');
		$newContent = $arr[0];
		return $newContent;
	}
	
	public function findByURL (ContentVO $contentVO) {
		$sql = "SELECT CONTENT_ID, USER_ID, COMPONENT_ID, URL, TITLE, CONTENT, CREATION_DT, LAST_UPDATE_DT, STATUS FROM CONTENT WHERE URL = '" . $contentVO->getURL() . "'";
		$arr = $this->selectDB ($sql, 'ContentVO');
		$newContent = $arr[0];
		return $newContent;
	}
	
}
?>