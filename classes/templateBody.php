<?php
/**
 * The class is for the structure of Template table. 
 * 
 * @author Byung Seon Kim
 */
class TemplateBody {
	private $templateId;
	private $sequentialId;
	private $bodyId;
	private $controlPath;
	private $bodyText;

	function __construct($templateId, $sequentialId, $bodyId, $controlPath, $bodyText){
		$this->setTemplateId($templateId);
		$this->setSequentialId($sequentialId);
		$this->setBodyId($bodyId);
		$this->setControlPath($controlPath);
		$this->setBodyText($bodyText);
	}
		
	public function getTemplateId(){
		return $this->templateId;
	}
		
	public function setTemplateId($templateId){
		$this->templateId = $templateId;
	}
		
	public function getSequentialId(){
		return $this->sequentialId;
	}
		
	public function setSequentialId($sequentialId){
		$this->sequentialId = $sequentialId;
	}
		
	public function getBodyId(){
		return $this->bodyId;
	}
		
	public function setBodyId($bodyId){
		$this->bodyId = $bodyId;
	}
		
	public function getControlPath(){
		return $this->controlPath;
	}
		
	public function setControlPath($controlPath){
		$this->controlPath = $controlPath;
	}
		
	public function getBodyText(){
		return $this->bodyText;
	}
		
	public function setBodyText($bodyText){
		$this->bodyText = $bodyText;
	}
}

?>