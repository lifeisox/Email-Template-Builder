<?php
/**
 * The class is for the structure of Template table. 
 * 
 * @author Byung Seon Kim
 */
class Template {
	private $templateId;
	private $templateName;
	private $baseId;
	private $baseName;
	private $width;
	private $emailSubject;
	private $companyName;
	private $companyPhone;
	private $companyEmail;
	private $companyAddress;
	private $companyFacebook;
	private $companyTwitter;
	private $companyGooglePlus;
	private $companyInstagram;

	function __construct($templateId, $templateName, $baseId, $baseName, $width, $emailSubject, $companyName, $companyPhone, 
		$companyEmail, $companyAddress, $companyFacebook, $companyTwitter, $companyGooglePlus, $companyInstagram){
		$this->setTemplateId($templateId);
		$this->setTemplateName($templateName);
		$this->setBaseId($baseId);
		$this->setBaseName($baseName);
		$this->setWidth($width);
		$this->setEmailSubject($emailSubject);
		$this->setCompanyName($companyName);
		$this->setCompanyPhone($companyPhone);
		$this->setCompanyEmail($companyEmail);
		$this->setCompanyAddress($companyAddress);
		$this->setCompanyFacebook($companyFacebook);
		$this->setCompanyTwitter($companyTwitter);
		$this->setCompanyGooglePlus($companyGooglePlus);
		$this->setCompanyInstagram($companyInstagram);
	}
		
	public function getTemplateId(){
		return $this->templateId;
	}
		
	public function setTemplateId($templateId){
		$this->templateId = $templateId;
	}
	
	public function getBaseId(){
		return $this->baseId;
	}
		
	public function setBaseId($baseId){
		$this->baseId = $baseId;
	}
	
	public function getBaseName(){
		return $this->baseName;
	}
		
	public function setBaseName($baseName){
		$this->baseName = $baseName;
	}
	
	public function getTemplateName(){
		return $this->templateName;
	}
		
	public function setTemplateName($templateName){
		$this->templateName = $templateName;
	}
		
	public function getWidth(){
		return $this->width;
	}
		
	public function setWidth($width){
		$this->width = $width;
	}
		
	public function getEmailSubject(){
		return $this->emailSubject;
	}
		
	public function setEmailSubject($emailSubject){
		$this->emailSubject = $emailSubject;
	}
		
	public function getCompanyName(){
		return $this->companyName;
	}
		
	public function setCompanyName($companyName){
		$this->companyName = $companyName;
	}
		
	public function getCompanyPhone(){
		return $this->companyPhone;
	}
		
	public function setCompanyPhone($companyPhone){
		$this->companyPhone = $companyPhone;
	}
		
	public function getCompanyEmail(){
		return $this->companyEmail;
	}
		
	public function setCompanyEmail($companyEmail){
		$this->companyEmail = $companyEmail;
	}
		
	public function getCompanyAddress(){
		return $this->companyAddress;
	}
		
	public function setCompanyAddress($companyAddress){
		$this->companyAddress = $companyAddress;
	}
		
	public function getCompanyFacebook(){
		return $this->companyFacebook;
	}
		
	public function setCompanyFacebook($companyFacebook){
		$this->companyFacebook = $companyFacebook;
	}
		
	public function getCompanyTwitter(){
		return $this->companyTwitter;
	}
		
	public function setCompanyTwitter($companyTwitter){
		$this->companyTwitter = $companyTwitter;
	}
		
	public function getCompanyGooglePlus(){
		return $this->companyGooglePlus;
	}
		
	public function setCompanyGooglePlus($companyGooglePlus){
		$this->companyGooglePlus = $companyGooglePlus;
	}
		
	public function getCompanyInstagram(){
		return $this->companyInstagram;
	}
		
	public function setCompanyInstagram($companyInstagram){
		$this->companyInstagram = $companyInstagram;
	}
}

?>